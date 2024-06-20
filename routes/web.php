<?php

use App\Http\Controllers\ProfileController;
use App\Models\Employee;
use App\Models\JobGrade;
use App\Models\Vacation;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|$2y$10$f7XR1hcw5caS6tEU1pXd6.sPPLlzb.4TjPZwKoFlI6966GZGFqvYK
*/

Route::get('/', function () {
    $employees = Employee::orderBy('created_at', 'desc')->with('employeeAppointments')->get();
    $today = Carbon::today()->toDateString();
    Carbon::setLocale('ar');

    // الحصول على اسم اليوم باللغة العربية
    $textToday = Carbon::now()->locale('ar')->dayName;
    $vacations = Vacation::whereDate('start', $today)->take(10)->get();
    $jobGrades = JobGrade::get();
    $today = Carbon::today()->toDateString();
    return view('dashboard.users.dashboard',compact('employees','vacations','jobGrades','today','textToday'));
})->middleware(['auth', 'verified'])->name('dashboard.user');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

});

