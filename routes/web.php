<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ManagerDashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PaymentController;
use App\Models\Participant;
use Illuminate\Support\Facades\Route;


/**
 *_________________________________________________
 * Frontend Routes
 *-------------------------------------------------
 */

 Route::get('/', [FrontendController::class, 'index'])->name('home');



/**
 *_________________________________________________
 * Manager Team Routes
 *-------------------------------------------------
 */

Route::group(['middleware'=> ['auth:web', 'verified', 'check_role:manager-team'], 'prefix'=> 'manager-team', 'as'=>'manager-team.'], function(){

    // Route::get('/registrasi', [FrontendController::class, 'registrasi'])->name('registrasi');
    // Route::get('participants', [ParticipantController::class, 'index'])->name('participants');
    // Route::post('participant', [ParticipantController::class, 'store'])->name('participant.store');

    Route::get('dashboard', [ManagerDashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('participants', ParticipantController::class);

    Route::resource('payments', PaymentController::class);


});



require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
