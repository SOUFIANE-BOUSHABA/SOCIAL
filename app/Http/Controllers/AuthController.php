<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReservationController;

class AuthController extends Controller
{
    //

    public function index(){
        return view("auth.login");
    }
    public function showForm(){
        return view("auth.register");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id'=>2,
        ]);

        Session::flash('success', 'Registration successful. Please login.');

        return redirect()->route('login');
    }

 

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role_id == '1') {
                return redirect()->route('admin.books');
            } else {
                return redirect()->route('user.show.book');
            }
        }

        return redirect()->route('login')->with('error', 'Invalid login credentials. Please try again.');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }

}