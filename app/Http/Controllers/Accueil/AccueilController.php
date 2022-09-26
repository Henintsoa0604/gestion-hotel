<?php

namespace App\Http\Controllers\Accueil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use Illuminate\Support\Facades\Auth;
class AccueilController extends Controller
{

   
   public function index(){
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
      $count_fav = DB::table('favories')
      ->selectRaw('count(id) as count')
      ->where('user_id','=', $user_id)
      ->get();
      $favListe = DB::table('favories')
      ->select('*')
      ->where('user_id','=',$user_id)
      ->paginate(2);
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
           'resListe' =>  $resListe,
           'count_id_fav' =>  $count_fav,
           'favListe' =>  $favListe
           ]);
   }
   
  

}
