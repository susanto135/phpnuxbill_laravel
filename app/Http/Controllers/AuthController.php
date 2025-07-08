<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Try customer login first
        $customer = Customer::where('username', $username)->first();
        if ($customer && Hash::check($password, $customer->password)) {
            if ($customer->status === 'Banned') {
                return back()->withErrors(['error' => 'This account is banned.']);
            }
            
            Session::put('customer_id', $customer->id);
            Session::put('user_type', 'customer');
            $customer->update(['last_login' => now()]);
            
            return redirect()->route('customer.dashboard');
        }

        // Try admin login
        $admin = User::where('email', $username)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            if ($admin->status === 'Inactive') {
                return back()->withErrors(['error' => 'This account is inactive.']);
            }
            
            Session::put('admin_id', $admin->id);
            Session::put('user_type', 'admin');
            $admin->update(['last_login' => now()]);
            
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['error' => 'Invalid username or password.']);
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:customers,username',
            'password' => 'required|string|min:6',
            'fullname' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phonenumber' => 'required|string',
        ]);

        $customer = Customer::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'status' => 'Active',
            'created_at' => now(),
        ]);

        Session::put('customer_id', $customer->id);
        Session::put('user_type', 'customer');

        return redirect()->route('customer.dashboard');
    }
}

