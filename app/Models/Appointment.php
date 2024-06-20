<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable =['name'];


//    public function employeeAppointments(){                                    //Pivot Table
//        return $this->belongsToMany(Employee::class, 'appointment_employee');
//    }

}
