<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ChangePassword extends Controller
{
    public function change()
    {
        return view('admin/master/changepassword');
    }

    public function oldpass($oldpass)
    {
        if (Hash::check($oldpass, auth()->user()->password)) {
            return response()->json(['success' => 'Old Password Mached !!']);
        } else {
            return response()->json(['error' => 'Old Password Doesn`t matched !']);
        }
    }

    public function updatepass(Request $request)
    {
        // return $request;
        $request->validate([
            'oldpass' => 'required',
            'newpass' => 'required',
            'confirmpass' => 'required',
        ]);
        if (!Hash::check($request->oldpass, auth()->user()->password)) {
            return redirect('admin/master/changepassword')->with('error', 'Old Password Doesn`t match !');
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->newpass)
        ]);
        return redirect('admin/master/changepassword')->with('update', 'Password Changed successfully !');
    }
}
