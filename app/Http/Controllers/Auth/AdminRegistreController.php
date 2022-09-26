<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;
class AdminRegistreController extends Controller
{
 
    public function showRegistrationForm()
    {
        return view('auth.admin_register');
    }
    public function register(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'adrs_resp' => 'required|string|max:255',
            'tel_resp' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:admins',
            'job_title' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed|max:255',
            'image' => 'required|mimes:jpeg,png',
        ],[
            'name.required' =>'le nom est obligatoire',
            'name.string' =>'le nom  est incorrecte',
            'name.max' =>'le nom est trop longue',
            'adrs_resp.required' =>'Adresse  obligatoire',
            'adrs_resp.string' =>'Adresse  est incorrecte',
            'adrs_resp.max' =>'Adresse est trop longue',
            'tel_resp.required' =>'Telephone est obligatoire',
            'tel_resp.string' =>'Telephone incorrecte',
            'tel_resp.max' =>'Telephone trop longue',
            'email.required' =>'Email est obligatoire',
            'email.string' =>'Email est incorrecte',
            'email.email' =>'Email est incorrecte',
            'email.max' =>'Email trop longue',
            'email.unique' =>'Email existe est deja',
            'password.required' =>'le mot de passe est obligatoire',
            'password.string' =>'le mot de passe est incorrecte',
            'password.min' =>'le mot de passe est trop court',
            'password.max' =>'le mot de passe est trop longue',
            'password.confirmed' =>'confirmation incorrecte',
            'job_title.required' =>'la fonction est obligatoire',
            'job_title.string' =>'la fonction est incorrecte',
            'job_title.max' =>'la fonction est trop longue',
            'image.required' =>'Image est obligatoire',
            'image.mimes' =>'Format image invalide',
           
            
        ]);
        $admin = new Admin;

        $admin ->name = $request ->name;
        $admin ->prenom_resp = $request ->prenom_resp;
        $admin ->adrs_resp = $request ->adrs_resp;
        $admin ->tel_resp = $request ->tel_resp;
        $admin ->email = $request ->email;
        $admin ->job_title = $request ->job_title;
        $admin ->password = bcrypt($request ->password);

        if($request->hasFile('image')){
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/admin/',$filename);
            $admin->image =   $filename;
        } else {
           return $request;
        }
        $admin->save();
        Auth::guard('admin')->login($admin);
        return redirect()->intended(route('admin.dashboard'));
      
    }
   
 
}
