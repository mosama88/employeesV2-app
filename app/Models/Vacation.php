<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacation extends Model
{
    use HasFactory;

    public $totalDays;
    protected $fillable = [
        'code_num',
        'type',
        'start',
        'to',
        'notes',
        'file',
        'int_ext',
        'status',
        'acting_employee_id',
        'department_id',
        ];


    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'acting_employee_id');
    }


    public function jobgrade()
    {
        return $this->belongsTo(JobGrade::class, 'job_grades_id');
    }



    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function vacationEmployee()
    {
        return $this->belongsToMany(Employee::class, 'employee_vacation');
    }



    public function typeVaction()
{
    switch ($this->type) {
        case 'satisfying':
            return 'مرضى';
        case 'emergency':
            return 'عارضة';
        case 'regular':
            return 'اعتيادية';
        case 'Annual':
            return 'سنوية';
        case 'mission':
            return 'مأمورية';
        default:
            return $this->type;
    }
}



protected static function boot()
{
    parent::boot();

    static::creating(function ($vacation) {
        $lastvacation = static::orderBy('id', 'desc')->first();

        // Set the starting code if no companies exist yet
        $code = ($lastvacation) ? $lastvacation->id + 1 : 1001;

        $vacation->code_num = 'vac' . $code;
    });
}
   


    public function getTotalDaysExcludingFridays()
    {
        // Get all vacations for this employee
        $vacations = $this->vacations;

        // Check if vacations are not null
        if ($vacations) {
            $totalDays = 0;

            // Loop through each vacation and calculate total days excluding Fridays
            foreach ($vacations as $vacation) {
                $totalDays += $vacation->calculateTotalDaysExcludingFridays();
            }

            return $totalDays;
        } else {
            // If no vacations are found, return 0
            return 0;
        }
    }


    public function calculateTotalDaysExcludingFridays()
    {
        $start = Carbon::createFromFormat('Y-m-d', $this->start);
        $to = Carbon::createFromFormat('Y-m-d', $this->to);

        $totalDays = 0;

        // Loop through each day between $from and $to, including $to
        while ($start->lte($to)) {
            // Check if the current day is not a Friday (5 is the numeric representation of Friday)
            if ($start->dayOfWeek != Carbon::FRIDAY) {
                // Increment the total days if it's not a Friday
                $totalDays++;
            }
            // Move to the next day
            $start->addDay();
        }

        return $totalDays;
    }
}
