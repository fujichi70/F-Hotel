<?php

namespace App\Calendar;

use App\Models\Reserve_day;
use App\Models\Setting;
use Carbon\Carbon;

class CalendarWeekDay
{
	protected $now;
	protected $isHoliday = false;

	public function __construct($date)
	{
		$this->now = new Carbon($date);
	}

	public function getClassName()
	{
		$classNames = ["day-" . strtolower($this->now->format("D"))];

		// 祝日のクラス付与
		if ($this->isHoliday) {
			$classNames[] = "day-holiday";
		}

		return implode(" ", $classNames);
		
	}

	/**
	 * @return 
	 */
	public function render()
	{
		return '<div class="day" data-day="' . $this->now->format("Y-m-d") . '"><div>' . $this->now->format("j") . '</div>';
	}

	/**
	 * 祝日かどうか判定
	 */
	public function checkHoliday($setting) {
		if ($setting->isHoliday($this->now)) {
			$this->isHoliday = true;
		}
	}


	function getDateKey()
	{
		return $this->now->format("Y-m-d");
	}

}
