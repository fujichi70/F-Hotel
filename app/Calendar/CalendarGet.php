<?php

namespace App\Calendar;

use Carbon\Carbon;

class CalendarGet
{

	protected $now;

	public function __construct($date)
	{
		$this->now = new Carbon($date);
	}

	public function getTitle()
	{
		return $this->now->format('Y年m月');
	}

	/**
	 * 月曜日〜日曜日までループ（１週間になる）
	 * @param object $startDay 週の初めの日（月）
	 * @param object $endDay 週の最終日（日）
	 * @return array $days １週間分の日付格納
	 */
	public function getDays($startDay, $endDay)
	{

		$day = 0;
		$days = [];

		while ($startDay->lte($endDay)) {

			//前の月、もしくは後ろの月の場合は空白を表示
			if ($startDay->month != $this->now->month) {
				$day = "";
				$days[] = $day;
				$startDay->addDay(1);
				continue;
			} else {
				$day = $startDay->format("j");
				$days[] = $day;
			}

			//翌日に移動
			$startDay->addDay(1);
		}

		return $days;
	}


	public function getWeeks()
	{
		$weeks = [];

		// 当月の初日と最終日を取得
		$firstDay = $this->now->copy()->firstOfMonth(); // 例2022-05-01
		$lastDay = $this->now->copy()->lastOfMonth(); // 例2022-05-31

		// 週の初めと終わりを取得（1週間）
		$startDay = $firstDay->copy()->startOfWeek();
		$endDay = $firstDay->copy()->endOfWeek();

		// 週の初めの日と最終日をコピー
		$startDayCopy = $startDay->copy();
		$endDayCopy = $endDay->copy();

		// 第1週取得
		$days = $this->getDays($startDayCopy, $endDayCopy);
		// 第1週格納
		$weeks[] = $days;

		//作業日
		$tmpStartDay = $startDay->copy()->addDay(7)->startOfWeek();
		// 例2022-05-02(月)
		$tmpEndDay = $startDay->copy()->addDay(7)->endOfWeek();
		// 例2022-05-08(日)

		/** 作業日から月の最終日まで日付をループで1週間分を取得し、1週間をループで1か月分取得 **/
		// 第1週以外の1週間をループ（１か月になる）
		while ($tmpStartDay->lte($lastDay)) {
			$days = $this->getDays($tmpStartDay, $tmpEndDay);
			$weeks[] = $days;
			//最終日を+7日する
			$tmpEndDay->addDay(7);
		}

		return $weeks;
	}

	/**
	 * 選択した日を取得
	 */
	public function getSelectDay($day)
	{
		$getMonth = $this->now->copy()->format('Y-m');
		$getDay = sprintf('%02d', $day);
		return $getMonth . "-" .$getDay;
	}

	public function render()
	{
		$html = [];
		$html[] = '<div class="calendar">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th>月</th>';
		$html[] = '<th>火</th>';
		$html[] = '<th>水</th>';
		$html[] = '<th>木</th>';
		$html[] = '<th>金</th>';
		$html[] = '<th>土</th>';
		$html[] = '<th>日</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';

		$html[] = '<tbody>';

		$weeks = $this->getWeeks();
		foreach ($weeks as $week) {
			$html[] = '<tr class="week">';
			foreach ($week as $day) {
				$html[] = '<td class="day">';
				$html[] = '<a class="day-item" href="/calendar?date='. $this->getSelectDay($day). '">';
				$html[] = $day;
				$html[] = '</a>';
				$html[] = '</td>';
			}
			$html[] = '</tr>';
		}

		$html[] = '</tbody>';

		$html[] = '</table>';
		$html[] = '</div>';
		return implode("", $html);
	}

	/**
	 * 前の月
	 */
	public function getPreviousMonth()
	{
		return $this->now->copy()->subMonthsNoOverflow()->format('Y-m');
	}
	
	/**
	 * 次の月
	 */
	public function getNextMonth()
	{
		return $this->now->copy()->addMonthsNoOverflow()->format('Y-m');
	}


}
