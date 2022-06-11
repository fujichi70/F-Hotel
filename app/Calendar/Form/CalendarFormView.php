<?php

namespace App\Calendar\Form;

use App\Calendar\CalendarView;
use Carbon\Carbon;
use App\Models\Setting;

class CalendarFormView extends CalendarView {

	/**
	 * @return $week[]
	 */
	public function getWeek(Carbon $date, $index = 0)
	{
		$week = new CalendarWeekForm($date, $index);

		//臨時営業日を設定する
		$start = $date->copy()->startOfWeek()->format("Y-m-d");
		$end = $date->copy()->endOfWeek()->format("Y-m-d");

		$week->setPriceDays = $this->setPriceDays->filter(function ($value, $key) use ($start, $end) {
			return $key >= $start && $key <= $end;
		})->keyBy("date_key");

		return $week;
	}
}
