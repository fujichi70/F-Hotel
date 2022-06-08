<?php

namespace App\Http\Controllers;

use App\Calendar\CalendarView;
use App\Calendar\Funcs\CalendarGetMonth;
use App\Calendar\Room\CalendarRoomView;
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
        $rooms = Room::get();

        $date = new CalendarGetMonth();
        $calendar = new CalendarView($date->getMonth($request));

        return view('reservation', [
            "calendar" => $calendar,
            "rooms" => $rooms,
        ]);
    }

    public function confirm(Request $request)
    {
        $reservation_id = 0;
        $reservation_id = "#" . str_pad(mt_rand(0, 999999), 6, 0, STR_PAD_LEFT);
        $room_id = "01";

        $reservation = [
            'reservation_id' => $reservation_id,
            'room_id' => $room_id,
            // 'room_id' => $request->room_id,
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
        ];

        return view('reservation.confirm', [
            "reservation" => $reservation
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

    public function show(Request $request)
    {

        $day = $_POST["day"];

        $reserves = Reserve_day::where('day', $day)->get();

        if (!empty($reserves)) {
            $year = substr($day, 0, 4);
            $month = substr($day, 5, 2);
            $date = substr($day, 8, 2);
            $select_day = $year . "年" . $month . "月" . $date . "日";

            $room_id = [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
            ];
            foreach ($reserves as $reserve) {
                $room_id[$reserve->room_id] += 1;
            }

            $full_room = array_keys($room_id, 10);

            $space_rooms = Room::whereNotIn('room_id', $full_room)->get();
        } else {
            $space_rooms = Room::get();
        }

        $day = str_replace('-', '', $day);
        $priceSettings = Setting::where('date_key', $day)->with('season')->get();

        if (!empty($priceSettings)) {
            $priceUp = 0;
            foreach ($priceSettings as $priceSetting) {
                $priceUp = $priceSetting->season->priceup;
            }
        }

        return view('reservation.show', [
            "select_day" => $select_day,
            "space_rooms" => $space_rooms,
            "priceUp" => $priceUp,
            "day" => $day,
        ]);
    }

    public function room(Request $request, $room_id)
    {
        $date = new CalendarGetMonth();

        $selectRoom = Room::where('room_id', $room_id)->with('reserve_day')->get();
        $reserves = Reserve_day::where('room_id', $room_id)->get();

        $calendar = new CalendarRoomView($date->getMonth($request), $room_id);

        return view('reservation.room', [
            "selectRoom" => $selectRoom,
            "calendar" => $calendar,
        ]);
    }

    public function selectDayRoom(Request $request, $room_id)
    {
        $date = new CalendarGetMonth();

        $selectRoom = Room::where('room_id', $room_id)->get();
        $reserves = Reserve_day::where('room_id', $room_id)->get();

        $calendar = new CalendarRoomView($date->getMonth($request), $room_id);

        return view('reservation.room', [
            "selectRoom" => $selectRoom,
            "calendar" => $calendar,
        ]);
    }


    public function selectDate(Request $request)
    {

        $day = $request->day;
        
        $reserves = Reserve_day::where('day', $day)->get();

        $date = new CalendarGetMonth();

            if (!empty($reserves)) {
                $year = substr($day, 0, 4);
                $month = substr($day, 5, 2);
                $date = substr($day, 8, 2);
                $select_day = $year . "年" . $month . "月" . $date . "日";

                $room_id = [
                    1 => 0,
                    2 => 0,
                    3 => 0,
                    4 => 0,
                    5 => 0,
                    6 => 0,
                ];
                foreach ($reserves as $reserve) {
                    $room_id[$reserve->room_id] += 1;
                }

                $full_room = array_keys($room_id, 10);

                $rooms = Room::whereNotIn('room_id', $full_room)->get();
            } else {
                $rooms = Room::get();
            }

            $priceSettings = Setting::where('date_key', $day)->with('season')->get();

            if (!empty($priceSettings)) {
                $priceUp = 0;
                foreach ($priceSettings as $priceSetting) {
                    $priceUp = $priceSetting->season->priceup;
                }
            }

            return response()->json(
                [
                        "select_day" => $select_day,
                        "rooms" => $rooms,
                        "priceUp" => $priceUp,
                        "day" => $day,
                ]);


    }
}
