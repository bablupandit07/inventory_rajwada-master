<?php

namespace App\Http\Controllers;

use App\Models\departments;
use App\Models\Designations;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()

    {
        $departments_data = departments::all();
        $designation_data = Designations::all();
        $designationData = [];
        $btnName = "Save";
        return view('admin/employee', compact('departments_data', 'btnName', 'designationData', 'designation_data'));
    }
}
