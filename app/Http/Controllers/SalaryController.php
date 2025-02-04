<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::orderBy('id', 'desc')->paginate(10);
        return view('pages.Salary.salary-index', ['models' => $salaries]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'quantity' => 'nullable|numeric'
        ]);

        $salary = Salary::create($data);
        return back();
    }

    public function update(Request $request, Salary $salary)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'quantity' => 'nullable|numeric'
        ]);

        $salary->update($data);
        return back();
    }

    public function delete(Salary $salary)
    {
        $salary->delete();
        return back();
    }
}
