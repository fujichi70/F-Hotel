<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yasumi\Yasumi;

class Setting extends Model
{
    use HasFactory;

    private $holidays = null;

    public function loadHoliday($year)
    {
        $this->holidays = Yasumi::create("Japan", $year, "ja_JP");
    }

    public function isHoliday($date)
    {
        if (!$this->holidays) return false;
        return $this->holidays->isHoliday($date);
    }
}
