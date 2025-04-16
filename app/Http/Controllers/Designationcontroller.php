<?php

namespace App\Http\Controllers;

use App\Models\departments;
use Illuminate\Support\Facades\DB;
use App\Models\Designations;


use Illuminate\Http\Request;

class Designationcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments_data = departments::all();

        $designationData = departments::Join('designations', function ($join) {
            $join->on('departments.id', '=', 'designations.department_id');
        })->whereNotNull('designations.department_id')
            ->get();
            
        $btnName = "Save";
        return view('admin/master/designation', compact('btnName', 'departments_data', 'designationData'));
        // return ("sdfvd");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // return $request->department_id;
        $validated = $request->validate([
            'department_id' => 'required',
            'designation_name' => 'required',
        ], ['department_id.required' => 'Please Choose Designation Name']);
        $designation =  new Designations;
        $designation->designation_name = $request->designation_name;
        if ($request->department_id == "") {
            $designation->department_id = 0;
        }
        $designation->department_id = $request->department_id;
        $designation->ipaddress = $request->ip();
        $designation->save();
        if ($designation) {
            return redirect('admin/master/Designations')->with('success', 'Data Saved Successfully');
        }
        return redirect()->back()->with('error', 'Data Not Saved');
    }


    public function edit($id)
    {
        $departments_data = departments::all();

        $designationData = departments::Join('designations', function ($join) {
            $join->on('departments.id', '=', 'designations.department_id');
        })->whereNotNull('designations.department_id')
            ->get();
        $editData = Designations::find($id);
        $btnName = "Update";
        return view('admin/master/designation', compact('btnName', 'editData', 'departments_data', 'designationData'));
    }

    public function update(Request $request, $id)
    {
        $updataData = Designations::find($id);
        $updataData->department_id = $request->department_id;
        $updataData->designation_name = $request->designation_name;
        $updataData->update();
        return redirect('admin/master/Designations')->with('success', 'Data Updated Successfully');
    }
    public function destroy($id)
    {
        // return $id;
        $department = Designations::find($id);
        $department->delete($id);
        return redirect('admin/master/Designations')->with('error', 'Data Delete Successfully!!');
    }
}
