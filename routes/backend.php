<?php

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\Vacation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Dashboard\JobController;
use App\Http\Controllers\Auth\LockScreenController;
use App\Http\Controllers\Dashboard\HolidayController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\JobGradeController;
use App\Http\Controllers\Dashboard\VacationController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DepartmentController;

/*
|--------------------------------------------------------------------------
| backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|   $2y$10$2YUyPz/1nmGGZTfteXWCteClA6R7bh45aQalwBGFctG0jbfjNmjdC


*/
//define('PAGINATION_COUNT', 1);

##################################### Route User #################################
//Route::get('user/dashboard', function () {
//    $employees = Employee::orderBy('created_at', 'desc')->with('employeeAppointments')->get();
//    $today = Carbon::today()->toDateString();
//    Carbon::setLocale('ar');
//
//    // الحصول على اسم اليوم باللغة العربية
//    $textToday = Carbon::now()->locale('ar')->dayName;
//    $vacations = Vacation::whereDate('start', $today)->take(10)->get();
//    $jobGrades = JobGrade::get();
//    $today = Carbon::today()->toDateString();
//    return view('dashboard.users.dashboard',compact('employees','vacations','jobGrades','today','textToday'));
//})->middleware(['auth', 'verified'])->name('dashboard.user');
##################################### End Route User #################################

Route::middleware(['auth', 'verified'])->name('dashboard.')->group(function () {
    Route::get('dashboard/index', [DashboardController::class, 'index'])->name('index');
    ##################################### Start Route Profile ################################
    Route::view('/Profile', 'profile.profile')->name('my-profile');
    ##################################### End Route Profile ################################
        ######################################### Start LockScreen  #########################################################
        Route::get('/lock-screen', [LockScreenController::class, 'showLockScreen'])->name('lock-screen');
        Route::post('/unlock', [LockScreenController::class, 'unlock'])->name('unlock');
        ######################################### End LockScreen  #########################################################
    ##################################### Start Dashboard Department #######################
    Route::resource('/departments', DepartmentController::class);
    ##################################### End Dashboard Department #########################
    ##################################### Start Dashboard Employee ######################
    Route::resource('/employees', EmployeeController::class);
    Route::get('/employees/show/vacation', [EmployeeController::class,'employeeshowvacation'])->name('show.vacation');
    Route::post('/calculate-vacation-days', [EmployeeController::class, 'calculateVacationDays'])->name('calculateVacationDays');
    ##################################### End Dashboard Employee ########################
    ##################################### Start Dashboard Vacation ######################
    Route::resource('/vacations', VacationController::class);
    Route::get('/vacation/print/{id}', [VacationController::class, 'print'])->name('vacation-print');
    Route::get('/vacation/print-emergancy/{id}', [VacationController::class, 'printEmergancy'])->name('vacation-print-emergancy');
    Route::get('/Vacation/settings', [VacationController::class, 'settingVacation'])->name('vacations.settingVacation');
    Route::get('/search-vacations', [VacationController::class, 'search'])->name('vacations.search');
    // Route::view('Vacation/add', 'dashboard.vacations.add')->name('vacations.add');
    ##################################### End Dashboard Vacation ########################
    ##################################### Start Dashboard Vacation ######################
    Route::resource('/holidays', HolidayController::class);
    ##################################### End Dashboard Vacation ########################
    ##################################### Start Dashboard jobgrades ######################
    Route::resource('/jobgrades', JobGradeController::class);
    ##################################### End Dashboard jobgrades ########################
    ##################################### Start Dashboard Profile ######################
    Route::resource('/jobs', JobController::class);
    ##################################### End Dashboard Profile ########################

});

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware(['auth', 'verified']);
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware(['auth', 'verified']);
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware(['auth', 'verified']);
Route::put('password', [PasswordController::class, 'update'])->name('password.update')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    // Our resource routes
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';





