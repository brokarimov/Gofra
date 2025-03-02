<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'name',
        'quantity'
    ];
    public function employees()
    {
        return $this->hasMany(Employee::class, 'salary_type');
    }
}
