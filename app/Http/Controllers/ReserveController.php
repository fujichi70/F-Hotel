<?php

namespace App\Http\Controllers;

use App\Calendar\CalendarView;
use App\Calendar\Funcs\CalendarGetMonth;
use App\Calendar\Room\CalendarRoomView;
use App\Models\Reservation;
use App\Models\Reserve_day;
use App\Models\Room;
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
        //クエリーのdateを受け取る
        $date = $request->date;

        //dateがYYYY-MMの形式かどうか判定し、日時を文字列に変換、YYYY.MM.01の形にする
        if ($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)) {
            $date = $date . "-01";
        } elseif ($date && preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date)) {
        } else {
            $date = null;
        }

        //取得出来ない時は今月の月にする
        if (!$date) $date = time();

        $calendar = new CalendarView($date);

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
        $select_day = $year. "年" . $month . "月" . $date . "日";

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


        // //クエリーのdateを受け取る
        // $date = $request->date;

        // //dateがYYYY-MMの形式かどうか判定し、日時を文字列に変換、YYYY.MM.01の形にする
        // if ($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)) {
        //     $date = $date . "-01";
        // } elseif ($date && preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date)) {
        // } else {
        //     $date = null;
        // }

        // //取得出来ない時は今月の月にする
        // if (!$date) $date = time();

        return view('reservation.show', [
            "select_day" => $select_day,
            // "reserves" => $reserves,
            "space_rooms" => $space_rooms,
        ]);
    }

    public function standard(Request $request)
    {
        $date = new CalendarGetMonth();

        $room = Room::where('room_id', 1)->get();
        $reserves = Reserve_day::where('room_id', 1)->get();
        
        $room_id = null;
        foreach($room as $val) {
            $room_id = $val->room_id;
        }
        $calendar = new CalendarRoomView($date->getMonth($request), $room_id);
        
        return view('reservation.standard', [
            "calendar" => $calendar,
            "room" => $room,
        ]);


    }
    public function double(Request $request)
    {
        return view('reservation.double');
    }
    public function standarddelux(Request $request)
    {
        return view('reservation.standard-delux');
    }
    public function semidoubledelux(Request $request)
    {
        return view('reservation.semidouble-delux');
    }
    public function doubledelux(Request $request)
    {
        return view('reservation.double-delux');
    }
    public function highfloor(Request $request)
    {
        return view('reservation.highfloor');
    }
}
