<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id', 'desc')->paginate(10);
        return view('pages.Department.department-index', ['models' => $departments]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
        ]);

        $department = Department::create($data);
        return back();
    }

    public function update(Request $request, Department $department)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
        ]);

        $department->update($data);
        return back();
    }

    public function delete(Department $department)
    {
        $department->delete();
        return back();
    }
}
