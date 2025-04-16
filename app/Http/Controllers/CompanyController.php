<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function show()
    {
        $companyData = Company::get()->first();
        //return $companyData;
        if ($companyData) {
            $btnName = 'Update';
        } else {
            $btnName = 'Save';
        }

        $module = "Company Setting";
        return view('admin/master/company', compact('btnName', 'companyData', "module"));
    }
    public function store(Request $request)
    {
        // dd($request);
        $company =  new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->number = $request->contact_no;
        $company->address = $request->address;
        $company->ipaddress = $request->ip();
        $company->save();
        if ($company) {
            return redirect('admin/master/company')->with('success', 'Data Saved Successfully');
        }
        return redirect()->back()->with('error', 'Data Not Saved');
    }
    public function update(Request $request, $id)
    {
        // print_r($request);
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->number = $request->contact_no;
        $company->address = $request->address;
        $company->ipaddress = $request->ip();
        $company->update();
        if ($company) {
            return redirect('admin/master/company')->with('success', 'Data Updated Successfully');
        }
        return redirect()->back()->with('error', 'Data Not Saved');
    }
}
