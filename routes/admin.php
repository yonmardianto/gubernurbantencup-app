<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=> 'guest:admin', 'prefix'=> 'admin', 'as'=> 'admin.'], function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::group(['middleware'=> 'auth:admin', 'prefix'=> 'admin', 'as'=> 'admin.'], function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');


    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('participants', ParticipantController::class);
    Route::post('participant-data', [ParticipantController::class, 'getDataParticipants'])->name('participants.data');
    Route::post('participants/download', [ParticipantController::class, 'downloadParticipants'])->name('participants.download');


    Route::resource('clubs', ClubController::class);
    Route::post('club-data', [ClubController::class, 'getDataClubs'])->name('clubs.data');


    Route::resource('users', UserController::class);
    Route::post('users/data', [UserController::class, 'getDataUsers'])->name('user.data');
    Route::get('users/{manager_id}/payments', [PaymentController::class, 'getUserBuktiTransfer'])->name('user.payments');
    Route::get('users/{manager_id}/participants', [ParticipantController::class, 'getUserParticipants'])->name('user.participants');


    Route::resource('settings', SettingController::class);

});

