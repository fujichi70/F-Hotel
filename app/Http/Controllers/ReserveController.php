<?php

namespace App\Http\Controllers;

use App\Calendar\CalendarGet;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ReserveController extends Controller
{
    public function index(Request $request)
    {

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

        $calendar = new CalendarGet($date);

        return view('reservation', [
            "calendar" => $calendar
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|integer|digits:7',
            'room_id' => 'required|integer|digits:2',
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'tel' => 'required|string|digits_between:9,11',
            'people' => 'required|string|between:1,2',
            'men' => 'required|string|between:0,2',
            'women' => 'required|string|between:0,2',
            'arrival' => 'required|date|after:yesterday',
            'departure' => 'required|date|after:arrival',
            'checkin_time' => 'required|time',
        ]);

        $reservation = [
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
        ];

        return view('reservation.confirm', [
            "reservation" => $reservation
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $request->Reservation::create([
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

        return to_route('reservation.show')->with(['message' => '予約が完了しました。', 'status' => 'info']);
    }

    public function show(Request $request)
    {

    }
}
