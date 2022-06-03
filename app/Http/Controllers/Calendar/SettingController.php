<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    function form()
    {

        //取得
        $setting = Setting::firstOrNew();
        return view("dashboard", [
            "setting" => $setting,
            "FLAG_A" => Setting::A_season,
            "FLAG_B" => Setting::B_season,
            "FLAG_C" => Setting::C_season,
        ]);
    }
    
    function update(Request $request)
    {
        //取得
        $setting = Setting::firstOrNew();
        //更新
        $setting->update($request->all());
        return redirect()
            ->action("Calendar\SettingController@form")
            ->withStatus("更新しました");
    }
}
