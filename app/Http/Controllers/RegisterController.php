<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function input(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:40|unique:users',
            'email' => 'required|email:dns|ends_with:@gmail.com|unique:users',
            'password' => 'required|min:6|max:12',
            'phoneNumber' => 'required|numeric|starts_with:08'
        ]);
        
        User::create($validatedData);
        
        return redirect('/')->with('success', 'Registration successful! Please login.');
    }
}
