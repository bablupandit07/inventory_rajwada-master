<?php

namespace App\Http\Controllers;

use App\Models\departments;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class departmentController extends Controller
{   
    public function index()
    {
        $departmentData = departments::all();
        // return $departmentData;
        // $editData = [];
        // return Auth::user();
        $btnName = "Save";
        return view('admin/master/department', compact('btnName', 'departmentData'));
    }
    public function store(Request $request)
    {
        // return $request;    
        $validated = $request->validate([
            'department_name' => 'required',
        ]);
        if (isset($request->department_id)) {
            $id = $request->department_id;
            $data = departments::find($id);
            $data->department_name = $request->input('department_name');
            $data->update();
            return redirect('admin/master/Departments')->with('update', 'Data Update Successfully!!');
        }
        $designation =  new departments;
        $designation->department_name = $request->department_name;
        $designation->ipaddress = $request->ip();
        $designation->save();
        if ($designation) {
            return redirect('admin/master/Departments')->with('success', 'Data Saved Successfully');
        }
        return redirect()->back()->with('error', 'Data Not Saved');
    }
    public function destroy($id)
    {
        $department = departments::find($id);
        $department->delete();
        return redirect('admin/master/Departments')->with('error', 'Data Delete Successfully!!');
    }
    public function edit($id)
    {

        $editData = departments::find($id);
        // return $editData;
        $departmentData = departments::all();
        $btnName = "Update";
        return view('admin/master/department', compact('btnName', 'departmentData', 'editData'));
    }
    // public function update(Request $request, $id)
    // {
    //     // return "jaegf";
    //     $validated = $request->validate([
    //         'department_name' => 'required',
    //     ]);
    //     $data = departments::find($id);
    //     $data->department_name = $request->input('department_name');
    //     $data->update();
    //     return redirect('Departments')->with('update', 'Data Update Successfully!!');
    // }
}
