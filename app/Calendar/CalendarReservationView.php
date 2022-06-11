<?php

namespace App\Calendar;

use App\Models\Reserve_day;

class CalendarReservationView extends CalendarView
{
	protected function renderDay(CalendarWeekDay $day)
	{
		$html = [];
		$html[] = '<td class="' . $day->getClassName() . '">';
		$html[] = $day->render();
		$html[] = $this->checkRoom($day->getDateKey());
		$html[] = '</div>';
		$html[] = '</td>';
		return implode("", $html);
	}

	/**
	 * 空き部屋取得
	 */
	public function checkRoom($day)
	{
		$blankDay = null;
		$pastDay = null;

		$blankDay = substr($day, 0, 7);

		$pastDay = date("Y-m-d", strtotime("+1 day", strtotime($day)));

		if ($blankDay != $this->now->format('Y-m')) {
			return "";
		}

		if ($pastDay < $this->now) {
			return '<p class="calendar-room">×</p>';
		}

		$checkRoom = Reserve_day::where('day', $day)->get()->toArray();

		$room_id = [
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 0,
			6 => 0,
		];

		foreach ($checkRoom as $row) {
			$room_id[$row["room_id"]]++;
		}

		$emptyRoom = array_filter($room_id, function ($x) {
			return $x !== 10;
		});

		if (!empty($emptyRoom)) {
			return '<p class="calendar-room">◯</p>';
		} else {
			return '<p class="calendar-room">×</p>';
		}
	}
}
