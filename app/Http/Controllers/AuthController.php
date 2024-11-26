<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_admin (){
        if(Auth::check() && Auth::user()->is_admin == 1){
            return redirect('admin/dashboard');
        }
        return view('admin.auth.login');
    }

    public function auth_login_admin ( Request $request ) {
       $remember = !empty($request->remember) ? true : false;
       if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1], $remember)){
        return redirect('admin/dashboard');
        
    }else{
        return redirect()->back()->with('error', 'Login Failed');
    }
    }

    public function logout_admin () {
        Auth::logout();
        return redirect('admin');
    }

}
