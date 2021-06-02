<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showRegistrationForm()
    {
        return view('auth.admin-register');
    }

    public function register(Request $request)
    {
        // Validate form data
        $this->validate($request,
            [
                'username' => 'required', 'string', 'max:255',
                
                'password' => 'required', 'string', 'min:8'
            ]
        );

        // Create admin user
        // try {
            $admin = Admin::create([
                'username' => $request->username,
                // 'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Log the admin in
            Auth::guard('admin')->loginUsingId($admin->id);
            return redirect()->route('admin.dashboard');
        // } catch (\Exception $e) {
            // return redirect()->back()->withInput($request->only('username', 'email'));
        // }
    }
}
