<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view("login");
    }
    public function check(Request $request){
        $check=$request->only("name","password");
        if(Auth::attempt($check)){
            $request->session()->regenerate();
            return redirect(route("dash"));
        }
        return back()->withErrors(["message"=>"アカウントまたはパスワードが正しくありません"]);
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect(route("login"));
    }
}
