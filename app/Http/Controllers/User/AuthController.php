<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        dd('hrer');
        if (Auth::check()){
            return redirect('/home');
        }
        return view('users.login',[
            'title' => 'User Login',
            'loginRoute' => 'user.login',
            'forgotPasswordRoute' => 'user.password.request',
        ]);
    }
}
