<?php

namespace App\Http\Controllers\Admin;

use App\Calendar\Form\CalendarFormView;
use App\Calendar\Funcs\CalendarGetMonth;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    function index(Request $request)
    {
        $date = new CalendarGetMonth();

        $calendar = new CalendarFormView($date->getMonth($request));
        
        //取得
        $setting = Setting::firstOrNew();
        return view("admin.calendar", [
            "calendar" => $calendar,
            "setting" => $setting,
            "FLAG_A" => Setting::A_season,
            "FLAG_B" => Setting::B_season,
            "FLAG_C" => Setting::C_season,
        ]);
        return view("admin.calendar");
    }

    function update(Request $request)
    {

        $input = $request->get("season");
        Setting::updatePrice(date('Y-m'), $input);

        // return view('admin.calendar', [
        //     "calendar" => $calendar,
        //     "input" => $input
        // ]);
        //取得
        // $setting = Setting::firstOrNew();
        //更新
        // $setting->update($request->all());
        return redirect()
            ->action([SettingController::class, 'index'])
            ->with('status', '更新しました');
    }
}
