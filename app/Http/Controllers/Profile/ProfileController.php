<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Session;
use DateTime;
class ProfileController extends Controller
{
     //profile
     public function profile_cli(){
        $user_id = Auth::id();
       
        $count_res = DB::table('reservations')
        ->selectRaw('count(id) as count')
        ->where('user_id','=', $user_id)
        ->get();
        $resListe = DB::table('reservations')
        ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->select('reservations.id','reservations.status','chambres.description_ch','chambres.img_ch')
        ->where('users.id','=',$user_id)
        ->get();
        $profile = DB::table('users')
        ->select('*')
        ->where('id','=', $user_id)
        ->get();
        return view('client.profile')->with('count_id',$count_res)
                                     ->with('resListe',$resListe);
     }
}
