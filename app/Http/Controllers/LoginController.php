<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function adminLogin()
    {
        return view('admin.login');
    }
    
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
    
    //     $user = User::where('email', $request->email)->first();
    
    //     if ($user && Hash::check($request->password, $user->password)) {
    //         Auth::login($user, $request->has('remember'));
    
    //         return redirect()->route('admin.dashboard')->with('success', 'Welcome to Dashboard!');
    //     }
    
    //     return back()->withErrors(['credentials' => 'Invalid credentials.']);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors(['credentials' => 'Invalid email or password']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
    
        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }



}
