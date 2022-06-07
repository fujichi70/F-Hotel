<?php

namespace App\Calendar;

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
		// return '<a href="/reservation?date='. $this->now->format("Y-m-d") .'"><p class="day">' . $this->now->format("j") . '</p>';
		return '<input class="day" type="submit" value="'.$this->now->format("Y-m-d").'" name="day">' . $this->now->format("j");
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
