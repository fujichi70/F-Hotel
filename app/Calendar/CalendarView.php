<?php

namespace App\Calendar;

use App\Models\Reserve_day;
use App\Models\Setting;
use Carbon\Carbon;
use Yasumi\Yasumi;

class CalendarView
{
	protected $now;
	protected $room_id;
	protected $setPriceDays = [];

	function __construct($date, $room_id = null)
	{
		$this->now = new Carbon($date);
		$this->room_id = $room_id;
	}
	/**
	 * タイトル
	 */
	public function getTitle()
	{
		return $this->now->format('Y年n月');
	}

	/**
	 * 現在の年を取得
	 */
	public function getYear()
	{
		return $this->now->format('Y');
	}

	/**
	 * 現在の月を取得
	 */
	public function getMonth()
	{
		return $this->now->format('m');
	}

	/**
	 * 現在の日を取得
	 */
	public function getDay()
	{
		return $this->now->format('d');
	}

	public function getToday()
	{
		if (isset($_GET['date'])) {
			$date = $_GET['date'];
			return $date;
		} else {
			return $this->now->format('Y-m-d');
		}
	}

	public function getWeeks()
	{
		$weeks = [];

		//初日
		$firstDay = $this->now->copy()->firstOfMonth();

		//月末まで
		$lastDay = $this->now->copy()->lastOfMonth();

		//1週目
		$weeks[] = $this->getWeek($firstDay->copy());

		//初日をコピーし、1週間後の最初の日付を取得
		$tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

		//月末までループ
		while ($tmpDay->lte($lastDay)) {
			//週カレンダー
			$weeks[] = $this->getWeek($tmpDay->copy(), count($weeks));

			//次の週=+7日する
			$tmpDay->addDay(7);
		}

		return $weeks;
	}

	protected function getWeek(Carbon $date, $index = 0) {
		return new CalendarWeek($date, $index);
	}

	/**
	 * カレンダーを出力
	 */
	public function render()
	{
		$setting = new Setting();
		$setting->loadHoliday($this->now->format('Y'));

		$this->setPriceDays = $setting->getSettingPrice($this->now->format("Ym"));

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
		$html[] = '<th class="sat">土</th>';
		$html[] = '<th class="sun">日</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';

		$html[] = '<tbody>';

		$weeks = $this->getWeeks();
		foreach ($weeks as $week) {
			$html[] = '<tr class="' . $week->getClassName() . '">';
			$days = $week->getDays($setting);
			foreach ($days as $day) {
				$html[] = $this->renderDay($day);
			}
			$html[] = '</tr>';
		}


		$html[] = '</tbody>';

		$html[] = '</table>';
		$html[] = '</div>';
		return implode("", $html);
	}

	protected function renderDay(CalendarWeekDay $day)
	{
		$html = [];
		$html[] = '<td class="' . $day->getClassName() . '">';
		$html[] = $day->render();
		$html[] = '</td>';
		return implode("", $html);
	}

	/**
	 * 前の月出力
	 */
	public function getPreviousMonth()
	{
		return $this->now->copy()->subMonthsNoOverflow()->format('Y-m');
	}

	/**
	 * 次の月出力
	 */
	public function getNextMonth()
	{
		return $this->now->copy()->addMonthsNoOverflow()->format('Y-m');
	}


}
