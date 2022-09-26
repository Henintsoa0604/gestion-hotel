<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest', ['except' => ['logout','userLogout']]);
    }
     public function userLogout(){
       
        Auth::guard('web')->logout();
        $listes = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->take(3)
        ->get();
    
        $simpleLit = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->where('categories.description_cat','=','Chambre simple')
        ->get();
    
        $doubleLit = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->where('categories.description_cat','=','Chambre moyenne')
        ->get();
    
        $luxe = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->where('categories.description_cat','=','Chambre luxe')
        ->get();
    
        $uneLit = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->where('chambres.nbr_lit_ch','=',1)
        ->get();
    
        $deuxLit = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->where('chambres.nbr_lit_ch','=',2)
        ->get();
    
        $famille = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->where('chambres.nbr_lit_ch','>',2)
        ->get();
    
        $listes_ch = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->get();
    
        $s = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->take(3)
        ->where('categories.description_cat','=','Chambre simple')
        ->get();
    
        
        $d = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->take(3)
        ->where('categories.description_cat','=','Chambre moyenne')
        ->get();
    
        $l = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->take(3)
        ->where('categories.description_cat','=','Chambre luxe')
        ->get();
    
        $user_id = Auth::id();
          $count_res = DB::table('reservations')
          ->selectRaw('count(id) as count')
          ->where('user_id','=', $user_id)
          ->get();
          $resListe = DB::table('reservations')
          ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
          ->join('users', 'reservations.user_id', '=', 'users.id')
          ->select('reservations.id','chambres.nbr_pers','reservations.status','chambres.description_ch','chambres.img_ch')
          ->where('users.id','=',$user_id)
          ->get();
         return view('accueil.index',[
               'collection' => $listes ,
               'simple' =>  $simpleLit ,
               'double' =>  $doubleLit ,
               'luxe' =>  $luxe ,
               'uneLit' =>  $uneLit,
               'deuxLit' =>  $deuxLit ,
               'famille' =>  $famille,
               'liste_ch' =>  $listes_ch ,
               's' =>  $s,
               'd' =>  $d ,
               'l' =>  $l,
               'count_id' =>  $count_res,
               'resListe' =>  $resListe
               ]);
       
    }
}
