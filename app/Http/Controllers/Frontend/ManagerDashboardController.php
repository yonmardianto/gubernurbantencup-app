<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Auth;

class ManagerDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $lock = $user->isApplicationLocked();

        return view('frontend.manager-dashboard.participants.create', compact('lock'));
    }
}
