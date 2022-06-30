<?php

namespace App\Http\Controllers;

use App\Calendar\CalendarReservationView;
use App\Calendar\CalendarView;
use App\Calendar\Funcs\CalendarGetMonth;
use App\Calendar\Room\CalendarRoomView;
use App\Http\Requests\ReserveRequest;
use App\Models\Reservation;
use App\Models\Reserve_day;
use App\Models\Room;
use App\Models\Season;
use App\Models\Setting;
use App\Rules\PeopleSum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ReserveController extends Controller
{
    public function index(Request $request)
    {
        $select_day = 0;
        $people = 0;
        $stay = 0;

        $rooms = Room::get();

        $date = new CalendarGetMonth();
        $calendar = new CalendarReservationView($date->getMonth($request));

        return view('reservation', [
            "calendar" => $calendar,
            "rooms" => $rooms,
        ]);
    }

    public function confirm(ReserveRequest $request)
    {

        $reservation = $request->validated();

        $reservation_id = 0;
        $reservation_id = "#" . str_pad(mt_rand(0, 999999), 6, 0, STR_PAD_LEFT);
        
        $arrival = $reservation["arrival"];
        $tmpStay = '+' . $reservation['stay'] . ' day';
        $departure = date("Y-m-d", strtotime($tmpStay, strtotime($arrival)));

        $arrivalDisplay = date("Y年m月d日", strtotime($arrival));
        $departureDisplay = date("Y年m月d日", strtotime($departure));
        
        $arrivalDate = date("w", strtotime($arrival));
        $departureDate = date("w", strtotime($departure));
        $week_name = ["日", "月", "火", "水", "木", "金", "土"];

        $arrivalDisplay = date($arrivalDisplay . "($week_name[$arrivalDate])");
        $departureDisplay = date($departureDisplay . "($week_name[$departureDate])");


        return view('reservation.confirm', [
            "reservation" => $reservation,
            "arrivalDisplay" => $arrivalDisplay,
            "departureDisplay" => $departureDisplay,
            "departure" => $departure,
            "reservation_id" => $reservation_id
        ]);
    }

    public function store(Request $request)
    {


        try {
            DB::transaction(function () use ($request) {
                Reservation::create([
                    'reservation_id' => $request->reservation_id,
                    'room_id' => $request->room_id,
                    'lastname' => $request->lastname,
                    'firstname' => $request->firstname,
                    'email' => $request->email,
                    'address' => $request->address,
                    'tel' => $request->tel,
                    'people' => $request->people,
                    'men' => $request->men,
                    'women' => $request->women,
                    'arrival' => $request->arrival,
                    'departure' => $request->departure,
                    'checkin_time' => $request->checkin_time,
                    'totalprice' => $request->totalprice,
                ]);
            });
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        // 宿泊期間を算出(チェックアウト日は含まず)
        $start = $request->arrival;
        $end = $request->departure;
        $days = [];
        for ($i = date('Ymd', strtotime($start)); $i < date('Ymd', strtotime($end)); $i++) {
            $year = substr($i, 0, 4);
            $month = substr($i, 4, 2);
            $day = substr($i, 6, 2);

            if (checkdate($month, $day, $year))
                $days[] = date('Y-m-d', strtotime($i));
        }

        foreach ($days as $day) {
            Reserve_day::create([
                'reservation_id' => $request->reservation_id,
                'room_id' => $request->room_id,
                'day' => $day,
            ]);
        }

        $request->session()->regenerateToken();

        return view('reservation.complete', ['message' => '予約が完了しました。', 'reservation_id' => $request->reservation_id]);
    }

    public function selectRoom(Request $request, $room_id)
    {

        $select_day = 0;
        $totalPrice = 0;
        $people = $request->people;
        $stay = $request->stay;

        $date = new CalendarGetMonth();
        $today = $date->now->format("Y-m-d");
        
        $selectRoom = Room::where('room_id', $room_id)->with('reserve_day')->get();
        
        $calendar = new CalendarRoomView($date->getMonth($request), $room_id);

        // 日付選択の上部屋選択した場合
        if (!empty($request->select_day)) {
            $select_day = $request->select_day;

            $tmpDay = $select_day;

            // 泊数が２泊以上の場合
            if ($stay != 1) {
                $tmpStay = '+' . $stay . ' day';
                $stayDuration = date("Y-m-d", strtotime($tmpStay, strtotime($tmpDay)));

                // 宿泊期間を取得
                for ($i = date('Ymd', strtotime($tmpDay)); $i < date('Ymd', strtotime($stayDuration)); $i++) {
                    $year = substr($i, 0, 4);
                    $month = substr($i, 4, 2);
                    $date = substr($i, 6, 2);

                    if (checkdate($month, $date, $year))
                        $stayDays[] = date('Y-m-d', strtotime($i));
                }

                $price = 0;
                $priceSettings = [];
                $priceUp = 0;

                // 宿泊期間で予約があるか確認
                foreach ($stayDays as $stayDay) {
                    $price += $selectRoom[0]->price;
                    $priceSettings[] = Setting::where('date_key', $stayDay)->with('season')->get();
                }

                foreach ($priceSettings as $priceSetting) {
                    foreach ($priceSetting as $p) {
                        if (!empty($p->season)) {
                            $priceUp = $p->season->priceup;
                        }
                    }
                }

                $totalPrice = ($price + $priceUp) * $people;

                // 1名で2人部屋宿泊の場合は金額2名分にする
                if ($people == 1 && ($room_id == 2 || $room_id == 4 || $room_id == 5 || $room_id == 6)) {
                    $totalPrice *= 2;
                }
            } else {
                // 1泊の場合はその日の予約があるか確認
                $priceSetting = Setting::where('date_key', $select_day)->with('season')->get();

                if (!empty($priceSetting[0]->season)) {
                    $totalPrice = ($selectRoom[0]->price + $priceSetting[0]->season->priceup) * $people;
                } else {
                    $totalPrice = $selectRoom[0]->price * $people;
                }

                // 1名で2人部屋宿泊の場合は金額2名分にする
                if ($people == 1 && ($room_id == 2 || $room_id == 4 || $room_id == 5 || $room_id == 6)) {
                    $totalPrice *= 2;
                }
            }

            // 日付選択せず部屋選択した場合
        } else {
            $date = new CalendarGetMonth();

            $selectRoom = Room::where('room_id', $room_id)->with('reserve_day')->get();

            $calendar = new CalendarRoomView($date->getMonth($request), $room_id);
        }

        if ($request->ajax()) {

            return
                response()->json(
                    [
                        "totalPrice" => $totalPrice,
                    ]
                );

        } else {

            return view('reservation.room', [
                "today" => $today,
                "selectRoom" => $selectRoom,
                "calendar" => $calendar,
                "select_day" => $select_day,
                "people" => $people,
                "stay" => $stay,
                "totalPrice" => $totalPrice,
            ]);
        }
    }


    public function selectDate(Request $request)
    {

        if (!empty($request->day)) {
            $day = $request->day;
            $people = $request->people;
            $stay = $request->stay;

            $tmpDay = $day;

            // 泊数が２泊以上の場合
            if ($stay != 1) {
                $tmpStay = '+' . $stay . ' day';
                $stayDuration = date("Y-m-d", strtotime($tmpStay, strtotime($tmpDay)));

                // 宿泊期間を取得
                for ($i = date('Ymd', strtotime($tmpDay)); $i < date('Ymd', strtotime($stayDuration)); $i++) {
                    $year = substr($i, 0, 4);
                    $month = substr($i, 4, 2);
                    $date = substr($i, 6, 2);

                    if (checkdate($month, $date, $year))
                        $stayDays[] = date('Y-m-d', strtotime($i));
                }

                $reservesDays = [];
                // 宿泊期間で予約があるか確認
                foreach ($stayDays as $stayDay) {
                    $reservesDays[$stayDay] = Reserve_day::where("day", $stayDay)->get();
                }
            } else {
                // 1泊の場合はその日の予約があるか確認
                $reservesDay = Reserve_day::where('day', $tmpDay)->get();
            }

            // 予約があったら残部屋があるか確認
            if (!empty($reservesDays) || !empty($reservesDay)) {

                $room_id = [
                    1 => 0,
                    2 => 0,
                    3 => 0,
                    4 => 0,
                    5 => 0,
                    6 => 0,
                ];

                // 2泊以上の場合
                if (!empty($reservesDays)) {
                    foreach ($reservesDays as $reserveDays) {
                        foreach ($reserveDays as $reserveDay) {
                            $room_id[$reserveDay->room_id] += 1;
                        }
                    }
                    // 1泊の場合
                } elseif (!empty($reservesDay)) {

                    foreach ($reservesDay as $reserveDay) {
                        $room_id[$reserveDay->room_id] += 1;
                    }
                }

                $full_room = array_filter($room_id, function ($e) {
                    return $e >= 10;
                });

                $full_room = array_keys($full_room);

                // 満室を除外 ※宿泊人数が2人の場合1人部屋は候補に出さない
                if ($people == 2) {
                    $rooms = Room::whereNotIn('room_id', $full_room)->where('people', $people)->get();
                } else {
                    $rooms = Room::whereNotIn('room_id', $full_room)->get();
                }
            } else {
                // 宿泊期間の予約がなかったらそのまま部屋取得 ※宿泊人数が2人の場合1人部屋は候補に出さない
                if ($people == 2) {
                    $rooms = Room::where('people', $people)->get();
                } else {
                    $rooms = Room::get();
                }
            }

            // 宿泊日が価格設定されているか取得 ※表示用
            $priceSettings = Setting::where('date_key', $day)->with('season')->get();

            if (!empty($priceSettings)) {
                $priceUp = 0;
                foreach ($priceSettings as $priceSetting) {
                    $priceUp = $priceSetting->season->priceup;
                }
            }

            return response()->json(
                [
                    "rooms" => $rooms,
                    "priceUp" => $priceUp,
                ]
            );
        }
    }
}
