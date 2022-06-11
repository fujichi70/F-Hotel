<?php

namespace App\Calendar\Funcs;

use Carbon\Carbon;

class CalendarGetMonth
{

	public function __construct()
	{
		$this->now = new Carbon();
	}

	public function getMonth($request)
	{

		//クエリーのdateを受け取る
		$date = $request->date;

		if ($this->now->format("Y-m") == $date) {
			$date = $this->now->format("Y-m-d");
		} elseif ($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)) {
			//dateがYYYY-MMの形式かどうか判定し、日時を文字列に変換、YYYY.MM.01の形にする
			$date = $date . "-01";
		} elseif ($date && preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date)) {
		} else {
			$date = null;
		}


		//取得出来ない時は今月にする
		if (!$date) $date = $this->now->format("Y-m-d");

		return $date;
	}
}
