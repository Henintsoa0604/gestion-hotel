<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed|max:255',
            'adrs_cli' => 'required|string|max:255',
            'ville_cli' => 'required|string|max:255',
            'code_postal_cli' => 'required|string|max:255',
            'pays_cli' => 'required|string|max:255',
            'tel_cli' => 'required|string|max:255',
        ],[
            'name.required' => 'Champ obligatoire',
            'name.string' => 'Nom invalide',
            'name.max' => 'Nom trop longue',
            'email.required' => 'Champ obligatoire',
            'email.string' => 'Email invalide',
            'email.email' => 'Email invalide',
            'email.max' => 'Email trop longue',
            'email.unique' => 'Email est unique, veuillez changer!',
            'password.required' => 'Champ obligatoire',
            'password.string' => 'Mot de passe incorrecte',
            'password.min' => 'Mot de passe trop courte',
            'password.confirmed' => 'Mot de passe n est pas confirmer',
            'password.string' => 'Mot de passe incorrecte',
            'password.max' => 'Mot de passe trop longue',
            'adrs_cli.string' => 'Adresse incorrecte',
            'adrs_cli.required' => 'Champ obligatoire',
            'adrs.max' => 'Adresse trop longue',
            'ville_cli.string' => 'Ville incorrecte',
            'ville_cli.required' => 'Champ obligatoire',
            'ville_cli.max' => 'Ville trop longue',
            'code_postal_cli.string' => 'Code postal incorrecte',
            'code_postal_cli.required' => 'Champ obligatoire',
            'code_postal_cli.max' => 'Code postal trop longue',
            'pays_cli.string' => 'Pays incorrecte',
            'pays_cli.required' => 'Champ obligatoire',
            'pays_cli.max' => 'Pays trop longue',
            'tel_cli.string' => 'Tel incorrecte',
            'tel_li.required' => 'Champ obligatoire',
            'tel_cli.max' => 'Tel trop longue',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'prenom_cli' => $data['prenom_cli'],
            'adrs_cli' => $data['adrs_cli'],
            'ville_cli' => $data['ville_cli'],
            'code_postal_cli' => $data['code_postal_cli'],
            'pays_cli' => $data['pays_cli'],
            'tel_cli' => $data['tel_cli'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
