<?php

namespace App\Http\Controllers;

use App\Calendar\CalendarGet;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function show(Request $request)
    {

        //クエリーのdateを受け取る
        $date = $request->date;
        
        //dateがYYYY-MMの形式かどうか判定し、日時を文字列に変換、YYYY.MM.01の形にする
        if ($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)) {
            $date = $date . "-01";
        } elseif($date && preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date)) {
        } else {
            $date = null;
        }

        //取得出来ない時は今月の月にする
        if (!$date)$date = time();

        $calendar = new CalendarGet($date);

        return view('calendar', [
            "calendar" => $calendar
        ]);        
    }
}
