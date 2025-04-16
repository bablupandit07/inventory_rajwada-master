<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Units;
// use App\Http\Controllers\ProductController;

class ProductController extends Controller {}

class UnitsController extends Controller
{
    public function index()
    {
        // return $this->test();
        $module = "Unit master";
        $btnName = "save";
        $unitData = Units::all();
        return view('admin/master/unitmaster', compact('btnName', 'unitData', "module"));
    }
    public function store(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'unit_name' => 'required',
        ]);
        if (isset($request->unit_id)) {
            $id = $request->unit_id;
            $data = Units::find($id);
            $data->unit_name = $request->input('unit_name');
            $data->update();
            return redirect('admin/master/unitmaster')->with('update', 'Data Update Successfully!!');
        }
        $designation =  new Units;
        $designation->unit_name = $request->unit_name;
        $designation->ipaddress = $request->ip();
        $designation->save();
        if ($designation) {
            return redirect('admin/master/unitmaster')->with('success', 'Data Saved Successfully');
        }
        return redirect()->back()->with('error', 'Data Not Saved');
    }
    public function edit($id)
    {

        $editData = Units::find($id);
        // return $editData;
        $unitData = Units::all();
        $btnName = "Update";
        return view('admin/master/unitmaster', compact('btnName', 'unitData', 'editData'));
    }
    public function delete($id)
    {
        $department = Units::find($id);
        $department->delete();
        return redirect('admin/master/unitmaster')->with('error', 'Data Delete Successfully!!');
    }
}
