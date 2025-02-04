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

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_type');
    }
}
