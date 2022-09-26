<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
class AdminLoginController extends Controller
{
    
    public function __construct(){
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }
    public function showLoginForm(){
        return view('auth.admin_login');
    }
    public function login(Request $request){
        //validation
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ],[
            'email.required' =>'Entrer votre email',
            'email.email' =>'Email incorrecte',
           
            'password.required' =>'Entrer votre mot de passe',
            'password.min' =>'Mot de passe doit superieur a 6',
        ]);
        //attemp
        if (Auth::guard('admin')->attempt([
            'email' => $request->email, 
            'password' => $request->password
        ], $request->remember)){
            return redirect()->intended(route('admin.dashboard'));
        } else {
            Session::flash('error','Email ou mot de passe incorrecte');
            return redirect()->back();
        }
        return redirect()->back()->withInput($request->only('email', 'remember'));
       
    }
    public function logout(){
       
        Auth::guard('admin')->logout();
        return view('auth.admin_login');
    }
}
