<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
class AdminController extends Controller
{
    public function index(){
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
        $liste = DB::table('admins')
        ->select('*')
        ->get();

        return view('membre_hotel.liste')->with('liste',$liste)->with('count_id', $count_res)->with('resListe',$resListe)->with('count_id_fav', $count_fav)->with('favListe',$favListe);
    }
}
