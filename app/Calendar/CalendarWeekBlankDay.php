<?php

namespace App\Calendar;

/**
 * 余白を出力するクラス
 */
class CalendarWeekBlankDay extends CalendarWeekDay
{

	public function getClassName()
	{
		return "day-blank";
	}

	/**
	 * @return 
	 */
	public function render()
	{
		return '';
	}
}
