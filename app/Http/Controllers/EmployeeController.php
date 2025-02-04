<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\EmployeeCreateRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        $salaries = Salary::all();
        $departments = Department::all();
        return view('pages.Employee.employee-index', ['models' => $employees, 'salaries' => $salaries, 'departments' => $departments]);
    }

    public function store(EmployeeCreateRequest $request)
    {
        $data = $request->all();

        $startTime = \DateTime::createFromFormat('H:i', $request->start_day);
        $endTime = \DateTime::createFromFormat('H:i', $request->end_day);

        if ($startTime && $endTime) {
            $interval = $startTime->diff($endTime);
            $hours = ltrim($interval->format('%H'), '0');
            $data['daily_time'] = $hours !== '' ? $hours : '0';
        }


        $employee = Employee::create($data);
        return back();
    }



    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $data = $request->all();

        $startTime = \DateTime::createFromFormat('H:i', $request->start_day);
        $endTime = \DateTime::createFromFormat('H:i', $request->end_day);

        if ($startTime && $endTime) {
            $interval = $startTime->diff($endTime);
            $hours = ltrim($interval->format('%H'), '0');
            $data['daily_time'] = $hours !== '' ? $hours : '0';
        }

        $employee->update($data);
        return back();
    }

    public function delete(Employee $employee)
    {
        $employee->delete();
        return back();
    }

    public function status(Employee $employee)
    {
        if ($employee->status == 1) {
            $employee->status = 0;
            $employee->save();
        } elseif ($employee->status == 0) {
            $employee->status = 1;
            $employee->save();
        }
        return back();
    }
}
