<?php

namespace App\Calendar\Form;

use Carbon\Carbon;
use App\Calendar\CalendarWeek;
use App\Models\Setting;

class CalendarWeekForm extends CalendarWeek
{
	/**
	 * @return setPriceDay[]
	 */
	public $setPriceDays = [];

	/**
	 * @return CalendarWeekDayForm
	 */
	public function getDay(Carbon $date, Setting $setting)
	{
		$day = new CalendarWeekDayForm($date);
		$day->checkHoliday($setting);

		if (isset($this->setPriceDays[$day->getDateKey()])) {
			$day->setPriceDay = $this->setPriceDays[$day->getDateKey()];
		}

		return $day;
	}
}
