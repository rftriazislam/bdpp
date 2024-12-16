<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Free\FreeExamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin', [DashboardController::class, 'dashboard'])->middleware(['auth', 'admin'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'dashboard', 'as' => 'admin.'], function () {
    Route::get('admin', [DashboardController::class, 'dashboard'])->name('admin');
    Route::get('user-lists', [DashboardController::class, 'user'])->name('userList');

    Route::get('edit/setting', [DashboardController::class, 'editSetting'])->name('edit.setting');
    Route::post('update/setting', [DashboardController::class, 'editPostSetting'])->name('update.setting');
});


Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'dashboard', 'as' => 'user.'], function () {
    Route::get('user', [UserDashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('time-out', [UserDashboardController::class, 'examTimeOut'])->name('examTimeOut');


    Route::get('profile', [UserDashboardController::class, 'profile'])->name('profile');
    Route::get('my-team', [UserDashboardController::class, 'my_team'])->name('my_team');
    Route::get('leader-board', [UserDashboardController::class, 'leader_board'])->name('leader_board');
    Route::post('profile-update', [UserDashboardController::class, 'profileUpdate'])->name('profileUpdate');
    Route::get('logout', [UserDashboardController::class, 'logout'])->name('logout');
});

require __DIR__ . '/auth.php';
