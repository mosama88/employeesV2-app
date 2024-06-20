<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobGrade extends Model
{
    use HasFactory;

    protected $fillable = [
            'name',
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


    public function vacations()
    {
        return $this->hasMany(Vacation::class);
    }


}
