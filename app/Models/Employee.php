<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'tel',
        'address',
        'salary_type',
        'department_id',
        'start_day',
        'end_day',
        'daily_time',
        'status',
    ];
}
