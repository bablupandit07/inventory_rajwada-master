<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        // Validate inputs
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Manually check user (no hashing)
        $user = User::where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        if ($user) {
            // Log the user in manually
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('admin/index');
        }

        return back()->withErrors([
            'errorTitle' => 'Invalid email or password.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
