<?php

namespace App\Http\Controllers\Admin;

use App\Calendar\Form\CalendarFormView;
use App\Calendar\Funcs\CalendarGetMonth;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    function update(Request $request)
    {

        $input = $request->get("season");
        Setting::updatePrice(date('Y-m'), $input);

        return redirect()
            ->action([SettingController::class, 'show'])
            ->with('status', '更新しました');
    }

    function show(Request $request)
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
    }

    function checkreserves()
    {
        
        $reserves = Reservation::with('room')->get();

        return view("admin.checkreserves", [
            "reserves" => $reserves,
        ]);
    }

}
