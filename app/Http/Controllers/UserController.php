<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // === SHOW REGISTER/CREATE FORM
    public function create()
    {
        return view('/users/register');
    }

    // === CREATE NEW USER
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
            // 'password' => 'required|confirmed|min:6',
        ]);
        // === HASH PASSWORD
        $formFields['password'] = bcrypt($formFields['password']);

        // === CREATE USERS
        $user = User::create($formFields);

        // AUTO LOGIN USER
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    // === USER LOGOUT
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');
    }

    // === SHOW LOGIN FORM
    public function login()
    {
        return view('/users/login');
    }

    // === LOGIN USER
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
