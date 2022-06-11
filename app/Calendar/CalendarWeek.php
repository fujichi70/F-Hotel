<?php

namespace App\Calendar;

use App\Models\Reserve_day;
use App\Models\Setting;
use Carbon\Carbon;

class CalendarWeek
{

	protected $now;
	protected $index = 0;

	function __construct($date, $index = 0)
	{
		$this->now = new Carbon($date);
		$this->index = $index;
	}

	function getClassName()
	{
		return "week-" . $this->index;
	}

	/**
	 * @return CalendarWeekDay[]
	 */
	function getDays(Setting $setting)
	{

		$days = [];

		//開始日〜終了日
		$startDay = $this->now->copy()->startOfWeek();
		$lastDay = $this->now->copy()->endOfWeek();

		//開始日をコピー
		$tmpDay = $startDay->copy();

		//月曜日〜日曜日までループ
		while ($tmpDay->lte($lastDay)) {

			//先月または翌月の場合空白を表示する
			if ($tmpDay->month != $this->now->month) {
				$day = new CalendarWeekBlankDay($tmpDay->copy());
				$days[] = $day;
				$tmpDay->addDay(1);
				continue;
			}

			//今月
			$days[] = $this->getDay($tmpDay->copy(), $setting);
			//翌日に移動
			$tmpDay->addDay(1);
		}

		return $days;
	}

	/** 
	 * 祝日か判定し格納
	 * @return CalendarWeekDay
	 */
	function getDay(Carbon $date, Setting $setting)
	{
		$day = new CalendarWeekDay($date);
		$day->checkHoliday($setting);
		return $day;
	}


}
