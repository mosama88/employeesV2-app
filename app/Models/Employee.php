<?php

namespace App\Models;
use Carbon\Carbon;
use App\Models\JobGrade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;


protected $fillable =[
    'name',
    'phone',
    'alter_phone',
    'hiring_date',
    'start_from',
    'num_of_days',
    'job_grades_id',
    'address_id',
    'department_id',
    'notes',
    'add_service',
    'years_service',
];

   // العلاقة مع جدول EmployeeVacation كقائم بأعمال
   public function actingEmployeeVacations(): HasMany
   {
       return $this->hasMany(Vacation::class, 'acting_employee_id');
   }


    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function jobgrade()
    {
        return $this->belongsTo(JobGrade::class, 'job_grades_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function vacation()
    {
        return $this->belongsTo(Vacation::class);
    }

    public function getAgeAttribute()
    {
        return now()->diffInYears($this->birth_date);
    }

    public function employeeAppointments(){                                    //Pivot Table
        return $this->belongsToMany(Appointment::class, 'appointment_employee');
    }


    public function vacationEmployee()
{
    return $this->belongsToMany(Vacation::class, 'employee_vacation'); // Adjust the pivot table name as per your actual setup
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
