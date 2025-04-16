<?php

namespace App\Http\Controllers;

use App\Models\m_party_supp;

use Illuminate\Http\Request;

class Partycontroller extends Controller

{
    function index()
    {
        $btnname = "Save";
        $module = "Party Master";
        $allData = m_party_supp::all()->sortDesc()->where('type', 'party');
        return view('admin/master/party_master', compact('btnname', 'allData', 'module'));
        // return view('admin/index', compact('btnname', 'allData'));
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
            return redirect('admin/master/party_master')->with('success', 'Data Update Successfully');
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
        $user->type = "party";
        $user->ipaddress = $req->ip();
        $user->save();
        return redirect()->back()->with('success', "Data Saved Successfully");
    }

    public function delete($id)
    {
        // return $id;
        $department = m_party_supp::find($id);
        $department->delete($id);
        // echo 1;
        // return redirect('admin/master/product_master')->with('error', 'Data Delete Successfully!!');
    }

    public function edit($id)
    {
        $editData = m_party_supp::find($id);
        $btnname = "Update";
        $allData = m_party_supp::all()->sortDesc()->where('type', 'party');
        return view('admin/master/party_master', compact('btnname', 'allData', 'editData'));
    }
}
