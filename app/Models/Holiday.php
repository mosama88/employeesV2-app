<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'from',
        'to',
    ];

    public function calculateTotalDaysExcludingFridays()
    {
        $from = Carbon::createFromFormat('Y-m-d', $this->from);
        $to = Carbon::createFromFormat('Y-m-d', $this->to);

        $totalDays = 0;

        // Loop through each day between $from and $to, including $to
        while ($from->lte($to)) {
            // Check if the current day is not a Friday (5 is the numeric representation of Friday)
            if ($from->dayOfWeek != Carbon::FRIDAY) {
                // Increment the total days if it's not a Friday
                $totalDays++;
            }
            // Move to the next day
            $from->addDay();
        }

        return $totalDays;
    }
}
