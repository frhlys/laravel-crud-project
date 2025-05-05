<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request) {
        $incomingCalls= $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['name' => $incomingCalls['loginname'], 'password' =>$incomingCalls['loginpassword']])) {
            $request->session()->regenerate();

        }

        return redirect('/');
    }

public function logout(){
    auth()->logout();
    return redirect('/');
}


    public function register(Request $request){
        $incomingCalls = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200'],
        ]);
        $incomingCalls['password']= bcrypt($incomingCalls['password']);
        $user = User::create($incomingCalls);
        auth()->login($user);
        return redirect('/');
    }
}
