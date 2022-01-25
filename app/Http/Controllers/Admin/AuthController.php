<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        if ( Auth::guard('admin')->check()){
            return redirect('admin/home');
        }
        return view('admin.login',[
            'title' => 'Admin Login',
            'loginRoute' => 'admin.login',
            'forgotPasswordRoute' => 'admin.password.request',
        ]);
    }

    public function login(Request $request)
    {
        $this->validator($request);
        if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
            //Authentication passed...
            return redirect()
                ->intended(route('admin.home'))
                ->with('status','You are Logged in as Admin!');
        }

        //Authentication failed...
        return $this->loginFailed();
    }

    public function logout(Request $request)
    {

        Auth::guard('admin')->logout();

        return redirect()
            ->route('admin.login')
            ->with('status','Admin has been logged out!');
    }

    private function validator(Request $request)
    {
        //validate the form...

        $rules = [
            'email'    => 'required|email|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        $request->validate($rules,$messages);

    }

        //Login failed...
        private function loginFailed(){
             return redirect('/admin/login')
                ->withInput()
                ->with('error','Login failed, please try again!');
    }
}
