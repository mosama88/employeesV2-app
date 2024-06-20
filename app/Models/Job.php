<?php

namespace App\Models;

use App\Models\JobGrade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
];


public function jobgrade()
{
    return $this->belongsTo(JobGrade::class);
}

}
