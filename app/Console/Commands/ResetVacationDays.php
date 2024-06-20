<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; // Assuming you have a User model
use Carbon\Carbon;

class ResetVacationDays extends Command
{
    protected $signature = 'vacations:reset';
    protected $description = 'إعادة تعيين أيام الإجازة لجميع المستخدمين في 30 يونيو من كل عام';
    // protected $description = 'Reset vacation days for all users on June 30th each year'; 

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get the current date
        $today = Carbon::now();

        // Check if today is June 30th
        if ($today->isSameDay(Carbon::createFromDate($today->year, 6, 30))) {
            // Reset vacation days for all users
            User::all()->each(function($user) {
                $user->vacation_days = 0; // Assuming you have a vacation_days attribute
                $user->save();
            });

            $this->info('تمت إعادة تعيين أيام الإجازة لجميع المستخدمين.');
            // $this->info('Vacation days have been reset for all users.');
        } else {
            $this->info('اليوم ليس 30 يونيو. لم تتم إعادة تعيين أي أيام عطلة.');
            // $this->info('Today is not June 30th. No vacation days were reset.');
        }
    }
}
