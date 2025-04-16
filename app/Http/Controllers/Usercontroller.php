<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Usercontroller extends Controller
{
    public function index()
    {
        // return "qjkeq";
        $allData = User::all();
        $module = "User Master";
        $btnname = "Save";
        $data = compact('allData', 'btnname', "module");
        return view('admin/master/user_master')->with($data);
    }
    public function store(Request $req)
    {

        // return ($req);
        // if ($req->user_id == "") {
        // }

        if ($req->user_id != "") {
            $editData = User::find($req->user_id);
            $editData->username = $req->username;
            $editData->password = hash::make($req->password);
            $editData->full_name = $req->full_name;
            $editData->status = $req->status;
            $editData->address = $req->address;
            $editData->email = $req->email;
            $editData->update();
            return redirect('admin/master/user_master')->with('success', 'Data Update Successfully');
        }
        $req->validate([
            'username' => 'required',
            'password' => 'required',
            'user_type' => 'required',
            'full_name' => 'required',
            'contact' => 'required',
            // 'status' => 'required',
        ], [
            'username.required' => 'Please Enter User Name'


        ]);


        $user = new User;
        $user->username = $req->username;
        $user->password = hash::make($req->password);
        $user->user_type = $req->user_type;
        $user->full_name = $req->full_name;
        $user->contact = $req->contact;
        $user->status = $req->status;
        $user->address = $req->address;
        $user->email = $req->email;
        // $user->ipaddress = $req->ip();
        $user->save();
        return redirect()->back()->with('success', "Data Saved Successfully");
    }
    public function edit($id)
    {
        $editData = User::find($id);
        $allData = User::all();
        $btnname = "Update";
        return view('admin/master/user_master', compact('editData', 'allData', 'btnname'));
    }
    public function delete($id)
    {
        $department = User::find($id);
        $department->delete($id);
        return redirect('admin/master/user_master')->with('error', 'Data Delete Successfully!!');
    }
}
