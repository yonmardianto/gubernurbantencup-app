<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class ManagerDashboardController extends Controller
{
    function dashboard() {
        $lock = filter_var(Setting::where('key', 'lock application')->value('value'), FILTER_VALIDATE_BOOLEAN);
        return view('frontend.manager-dashboard.participants.create', compact('lock'));
    }
}
