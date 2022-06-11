<?php

namespace App\Calendar\Form;

use Carbon\Carbon;

use App\Calendar\CalendarWeekDay;
use App\Models\Setting;

class CalendarWeekDayForm extends CalendarWeekDay
{

	public $setPriceDay = null;

	/**
	 * @return 
	 */
	function render()
	{
		//selectタグの名前
		$select_form_name = "season[" . $this->now->format("Y-m-d") . "][season_flag]";

		$isSelectA = ($this->setPriceDay && $this->setPriceDay->isAseason()) ? 'selected' : '';
		$isSelectB = ($this->setPriceDay && $this->setPriceDay->isBseason()) ? 'selected' : '';
		$isSelectC = ($this->setPriceDay && $this->setPriceDay->isCseason()) ? 'selected' : '';

		//HTMLの組み立て
		$html = [];

		//日付
		$html[] = '<p class="day">' . $this->now->format("j") . '</p>';
		// シーズンの設定
		$html[] = '<select name="' . $select_form_name . '" class="form-control">';
		$html[] = '<option value="0">- 通常</option>';
		$html[] = '<option value="'. Setting::A_season .'" '. $isSelectA .'>Aシーズン<br>+3,000</option>';
		$html[] = '<option value="'. Setting::B_season .'" '. $isSelectB .'>Bシーズン<br>+5,000</option>';
		$html[] = '<option value="'. Setting::C_season .'" '. $isSelectC .'>Cシーズン<br>+7,000</option>';
		$html[] = '</select>';
		
		return implode("", $html);
	}

}
