<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Auth;

class ManagerDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $lock = filter_var(Setting::where('key', 'lock application')->value('value'), FILTER_VALIDATE_BOOLEAN);

        if ($user->manual_unlock) {
            $lock = false;
        }

        return view('frontend.manager-dashboard.participants.create', compact('lock'));
    }
}
