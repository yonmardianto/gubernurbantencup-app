<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\User;

use Auth;

class DashboardController extends Controller
{
    public function index(){

        $totalParticipant = Participant::all()->count();
        $totalClub = User::all()->count();

        return view('admin.dashboard', compact('totalParticipant', 'totalClub'));
    }
}
