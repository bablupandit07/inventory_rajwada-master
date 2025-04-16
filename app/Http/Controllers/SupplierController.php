<?php

namespace App\Http\Controllers;

use App\Models\m_party_supp;

use Illuminate\Http\Request;

class SupplierController extends Controller

{
    function index()
    {
        $btnname = "Save";
        $module = "Supplier Master";
        $allData = m_party_supp::all()->sortDesc()->where('type', 'supplier');
        return view('admin/master/supplier_master', compact('btnname', 'allData', "module"));
    }

    public function store(Request $req)
    {

        $req->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'address' => 'required',
            // 'status' => 'required',
        ]);

        if ($req->party_id != "") {
            $editData = m_party_supp::find($req->party_id);
            $editData->name = $req->name;
            $editData->mobile = $req->mobile;
            $editData->email = $req->email;
            $editData->breckfast = $req->breckfast;
            $editData->lunch = $req->lunch . "";
            $editData->dinner = $req->dinner . "";
            $editData->hightea = $req->hightea . "";
            $editData->address = $req->address . "";
            $editData->update();
            return redirect('admin/master/supplier_master')->with('success', 'Data Update Successfully');
        }


        $user = new m_party_supp;
        $user->name = $req->name;
        $user->mobile = $req->mobile;
        $user->address = $req->address;
        $user->email = $req->email;
        $user->breckfast = $req->breckfast . "";
        $user->lunch = $req->lunch . "";
        $user->dinner = $req->dinner . "";
        $user->hightea = $req->hightea . "";
        $user->type = "supplier";
        $user->ipaddress = $req->ip();
        $user->save();
        return redirect()->back()->with('success', "Data Saved Successfully");
    }

    public function delete($id)
    {
        if ($id != "") {
            $department = m_party_supp::find($id);
            $department->delete($id);
            echo 1;
        }
    }

    public function edit($id)
    {
        $editData = m_party_supp::find($id);
        $btnname = "Update";
        $allData = m_party_supp::all()->sortDesc()->where('type', 'supplier');
        return view('admin/master/supplier_master', compact('btnname', 'allData', 'editData'));
    }
}
