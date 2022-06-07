<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yasumi\Yasumi;

class Setting extends Model
{
    use HasFactory;

    const A_season = "A";
    const B_season = "B";
    const C_season = "C";

    private $holidays = null;

    protected $fillable = [
        "date_key",
        "season_flag",
    ];

    // 祝日の取得
    public function loadHoliday($year)
    {
        $this->holidays = Yasumi::create("Japan", $year, "ja_JP");
    }

    // 祝日かどうか判断
    public function isHoliday($date)
    {
        if (!$this->holidays) return false;
        return $this->holidays->isHoliday($date);
    }

    /** 
     * 価格設定されているか判定する
    */
    public function isAseason()
    {
        return $this->season_flag == Setting::A_season;
    }

    public function isBseason()
    {
        return $this->season_flag == Setting::B_season;
    }

    public function isCseason()
    {
        return $this->season_flag == Setting::C_season;
    }

    /**
     * 指定した月の価格設定した日付を取得（キーを日付にする）
     * @return $setPriceDay[]
     */
    public static function getSettingPrice($ym)
    {
        return Setting::where("date_key", 'like', $ym . '%')
            ->get(["date_key", "season_flag"])->keyBy("date_key");
    }

    public static function updatePrice($ym, $input)
    {

        $setPriceDays = self::getSettingPrice($ym);

        foreach ($input as $date_key => $array) {

            if (isset($setPriceDays[$date_key])) {

                $setPriceDay = $setPriceDays[$date_key];
                $setPriceDay->fill($array);

                //価格設定済みの場合は上書き
                if ($setPriceDay->isAseason() || $setPriceDay->isBseason()|| $setPriceDay->isCseason()) {
                    $setPriceDay->save();

                //未指定の場合は削除
                } else {
                    $setPriceDay->delete();
                }
                continue;
            }

            $setPriceDay = new Setting();
            $setPriceDay->date_key = $date_key;
            $setPriceDay->fill($array);

            if ($setPriceDay->isAseason() || $setPriceDay->isBseason() || $setPriceDay->isCseason()) {
                $setPriceDay->save();
            }
        }
    }

// リレーション
    public function Season()
    {
        return $this->belongsTo(Season::class, 'season_flag', 'season');
    }
}
