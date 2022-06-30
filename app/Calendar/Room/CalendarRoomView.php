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
		$reserve_days = [];
		$pastDay = [];
		$total = [];
		$setPriceDay = null;
		$setPrice = null;

		$tmpDay = $this->now->copy();
		$startDay = $tmpDay->copy()->startOfMonth()->toDateString();
		$today = $tmpDay->toDateString();

		for ($i = date('Ymd', strtotime($startDay)); $i < date('Ymd', strtotime($today)); $i++) {
			$year = substr($i, 0, 4);
			$month = substr($i, 4, 2);
			$date = substr($i, 6, 2);

			if (checkdate($month, $date, $year)) {
				$pastDay[date('Y-m-d', strtotime($i))] = "";
			}
		}

		$selectRoom = Room::where('room_id', $this->room_id)->with(['reserve_day' => function ($q) {
			$q->where('day', 'like', $this->now->format("Y-m") . '%');
		}])->get()->toArray();
		
		$price = Season::get();

		$reserve_days =  $selectRoom[0]["reserve_day"];

		$keys = array_values(array_unique(array_column($reserve_days, "day")));
		foreach ($keys as $value) {
			$num = 0;
			foreach ($reserve_days as $row) {
				if ($row["day"] == $value) {
					$num++;
				}
			}
			$total[$value] = $num;
		}

		$full_room = array_filter($total, function($e) {
			return $e == 10;
		});

		if (isset($this->setPriceDays[$day->getDateKey()])) {
			$setPriceDay = $this->setPriceDays[$day->getDateKey()];
			if ($setPriceDay->isAseason()) {
				$setPrice = number_format($selectRoom[0]["price"] + $price[0]->priceup) . "円";
			} else if ($setPriceDay->isBseason()) {
				$setPrice = number_format($selectRoom[0]["price"] + $price[1]->priceup) . "円";
			} else if ($setPriceDay->isCseason()) {
				$setPrice = number_format($selectRoom[0]["price"] + $price[2]->priceup) . "円";
			}
		} else {
			$setPrice = number_format($selectRoom[0]["price"]). "円";
		}

		if (isset($pastDay[$day->getDateKey()])) {
			$setPrice = "×";
		} elseif (isset($full_room[$day->getDateKey()])) {
			$setPrice = "満室";
		}
		

		$html[] = '<td class="' . $day->getClassName() . '">';
		$html[] = $day->render();
		if (isset($pastDay[$day->getDateKey()]) || isset($full_room[$day->getDateKey()])) {
			$html[] = '<p class="room-full">' . $setPrice . '</p>';
		} else {
			$html[] = '<p class="room-price">' . $setPrice . '</p>';
		}
		$html[] = '</td>';

		return implode("", $html);
	}
}
