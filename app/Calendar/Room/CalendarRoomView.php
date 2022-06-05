<?php

namespace App\Calendar\Room;

use Carbon\Carbon;
use App\Calendar\CalendarView;
use App\Calendar\CalendarWeekDay;
use App\Http\Controllers\ReserveController;
use App\Models\Room;
use App\Models\Season;

/**
 * 表示用
 */
class CalendarRoomView extends CalendarView
{
	/**
	 * 日を描画する
	 */
	protected function renderDay(CalendarWeekDay $day)
	{

		$html = [];
		$setPriceDay = null;
		$setPrice = null;

		$selectRoom = Room::where('room_id', $this->room_id)->get();
		$price = Season::get();

		if (isset($this->setPriceDays[$day->getDateKey()])) {
			$setPriceDay = $this->setPriceDays[$day->getDateKey()];
			if ($setPriceDay->isAseason()) {
				$setPrice = $selectRoom[0]->price + $price[0]->priceup;
			} else if ($setPriceDay->isBseason()) {
				$setPrice = $selectRoom[0]->price + $price[1]->priceup;
			} else if ($setPriceDay->isCseason()) {
				$setPrice = $selectRoom[0]->price + $price[2]->priceup;
			}
		} else {
			$setPrice = $selectRoom[0]->price;
		}

		$html[] = '<td class="' . $day->getClassName() . '">';
		$html[] = $day->render();
		$html[] = '<p>' . number_format($setPrice) . '円</p>';
		$html[] = '</td>';

		return implode("", $html);
	}
}
