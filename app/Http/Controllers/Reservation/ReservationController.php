<?php

namespace App\Http\Controllers\Reservation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chambre;
use App\Models\Reservation;
use App\Models\Favorie;
use DB;
use Session;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function editReservationCli($id){
          $ch = Chambre::find($id);

          $user_id = Auth::id();
          $count_res = DB::table('reservations')
          ->selectRaw('count(id) as count')
          ->where('user_id','=', $user_id)
          ->get();
          $resListe = DB::table('reservations')
          ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
          ->join('users', 'reservations.user_id', '=', 'users.id')
          ->select('reservations.id','reservations.status','chambres.description_ch','chambres.img_ch','chambres.nbr_pers')
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
          return view('reservation.add_reservation')->with('chambre',$ch)->with('count_id',$count_res)->with('resListe',$resListe)->with('count_id_fav',$count_fav)->with('favListe',$favListe);
    }
    public function ajoutReservation(Request $request){
      $this->validate($request,[
          'date_debut' => 'required',
          'date_fin' => 'required',
          'chambre_id' => 'required|unique:reservations',
          'user_id' => 'required',
        
        ],[
          'date_debut.required' =>'Champ obligatoire',
          'date_fin.required' =>'Champ obligatoire',
          'chambre_id.required' =>'Champ obligatoire',
          'chambre_id.unique' =>'Reservation deja envoyer',
          'user_id.required' =>'Champ obligatoire',
         
          
      ]);
    
      $id = \Request::get('chambre_id');
      $chc = DB::table('chambres')
      ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
      ->select('categories.prix_cat')
      ->where('chambres.id','=',$id)
      ->first();

      $ch = Chambre::find($id);
      $res = new Reservation;
      $fdate = $request->date_fin;
      $ddate  = $request->date_debut;
    
      if( $ddate <= $fdate){
        $date1 = new DateTime($fdate);
        $date2 = new DateTime($ddate);
        $dateDebut = $date2->format('Y-m-d');
        $now = new DateTime('now');
        $dateNow = $now->format('Y-m-d');
        $interval = $date1->diff($date2);
        $days = ($interval->format('%a')) + 1;
        if($dateDebut >= $dateNow){
          //ajout reservation
          $res->date_debut = $request->date_debut;
          $res->date_fin = $request->date_fin;
          $res->date_paye = $res->date_fin ;
          $res->nbr_jour =   $days ;
          $res->montant = $res->nbr_jour * $chc->prix_cat;
          $res->status =  "En attente";
          $res->desc =  "Reservation en attente";
          $res->user_id = $request->user_id;
          $res->chambre_id = $request->chambre_id;
          $res->save();
          //update chambre
          $ch->status_ch =  "En attente";
          $ch->update();
          Session::flash('success','Reservation envoyer');
          return redirect()->back();
        } else {
          Session::flash('error','La date de reservation est incorrecte, veuillez verifier la date debut et la date fin');
          return redirect()->back();
        }
      } else {
        Session::flash('error','La date de reservation est incorrecte, veuillez entrer la date debut et la date fin');
        return redirect()->back();
      }
    }
    public function reservationCli_detail(){
     
      $user_id = Auth::id();
      $count_res = DB::table('reservations')
      ->selectRaw('count(id) as count')
      ->where('user_id','=', $user_id)
      ->get();
      $resListe = DB::table('reservations')
      ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
      ->join('users', 'reservations.user_id', '=', 'users.id')
      ->select('reservations.id','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.num_tel_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.nbr_pers')
      ->where('users.id','=',$user_id)
      ->orderBy('reservations.id','ASK')
      ->paginate(2);
      $count_fav = DB::table('favories')
      ->selectRaw('count(id) as count')
      ->where('user_id','=', $user_id)
      ->get();
      $favListe = DB::table('favories')
      ->select('*')
      ->where('user_id','=',$user_id)
      ->paginate(2);
     
    
      return view('reservation.detail_reservation')->with('count_id',$count_res)->with('resListe',$resListe)->with('count_id_fav',$count_fav)->with('favListe',$favListe);
    }
    public function favorieCli_detail(){
     
      $user_id = Auth::id();
      $count_res = DB::table('reservations')
      ->selectRaw('count(id) as count')
      ->where('user_id','=', $user_id)
      ->get();
      $resListe = DB::table('reservations')
      ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
      ->join('users', 'reservations.user_id', '=', 'users.id')
      ->select('reservations.id','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.num_tel_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.nbr_pers')
      ->where('users.id','=',$user_id)
      ->orderBy('reservations.id','ASK')
      ->paginate(2);
      $count_fav = DB::table('favories')
      ->selectRaw('count(id) as count')
      ->where('user_id','=', $user_id)
      ->get();
      $favListe = DB::table('favories')
      ->select('*')
      ->where('user_id','=',$user_id)
      ->paginate(2);
     
      $favories = DB::table('favories')
      ->select('*')
      ->where('user_id','=',$user_id)
      ->get();
      return view('client.favories')->with('count_id',$count_res)->with('resListe',$resListe)->with('count_id_fav',$count_fav)->with('favListe',$favListe)->with('favories',$favories);
    }
    public function deleteFavorie($id){
      //recherche par rapport a id supprimer
      Favorie::find($id)->delete();
  
      Session::flash('success','chambre supprimer avec succés');
  
     return redirect()->back();
  
     }
    public function deleteReservation($id){
     
       $chc = DB::table('reservations')
      ->where('id','=',$id)
      ->first();

      $idc = $chc->chambre_id;
      $chambre = Chambre::find($idc);

      $chambre->status_ch =  "libre";
      $chambre->update();
       //recherche par rapport a id supprimer
      Reservation::find($id)->delete();
      Session::flash('success','Reservation supprimer avec succés');
  
     
       return redirect()->back();
  
     }
     public function printReservation($id){
       
      
        
        $resListe = DB::table('reservations')
        ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->select('reservations.id','chambres.nbr_pers','users.id as cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.num_tel_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.categorie_id','users.name','users.prenom_cli','users.adrs_cli','users.ville_cli','users.code_postal_cli','users.pays_cli','users.tel_cli','users.email')
        ->where('reservations.id','=',$id)
        ->get();

        return view('reservation.print_reservation')->with('resListe',$resListe);
     }
     public function printIdReservation($id){
       
      $resListe = DB::table('reservations')
      ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
      ->join('users', 'reservations.user_id', '=', 'users.id')
      ->select('reservations.id','chambres.nbr_pers','users.id as cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.num_tel_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.categorie_id','users.name','users.prenom_cli','users.adrs_cli','users.ville_cli','users.code_postal_cli','users.pays_cli','users.tel_cli','users.email')
      ->where('reservations.id','=',$id)
      ->get();
    
      return view('reservation.print')->with('resListe',$resListe);
   }

   //admin
   public function liste(){
     
   
    $resListe = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->get();
     $androany = Carbon::now()->format('Y-m-d');
    $now = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->where('reservations.date_debut','like','%'.$androany.'%')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->get();
   
  
    return view('reservation.liste')->with('resListe',$resListe)->with('now',$now);
  }
  
  public function liste_attente(){
     
   
    $resListe = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->where('reservations.status','=','En attente')
    ->get();
   
  
        $androany = Carbon::now()->format('Y-m-d');
    $now = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->where('reservations.date_debut','like','%'.$androany.'%')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->get();
   
  
    return view('reservation.liste')->with('resListe',$resListe)->with('now',$now);
  }
  public function liste_accepte(){
     
   
    $resListe = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->where('reservations.status','=','Accepté')
    ->get();
   
  
        $androany = Carbon::now()->format('Y-m-d');
    $now = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->where('reservations.date_debut','like','%'.$androany.'%')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->get();
   
  
    return view('reservation.liste')->with('resListe',$resListe)->with('now',$now);
  }
  public function liste_annule(){
     
   
    $resListe = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->where('reservations.status','=','Annulé')
    ->get();
   
  
        $androany = Carbon::now()->format('Y-m-d');
    $now = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->where('reservations.date_debut','like','%'.$androany.'%')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->get();
   
  
    return view('reservation.liste')->with('resListe',$resListe)->with('now',$now);
  }
  public function liste_search(){
     
    $motCle = \Request::get('motCle');
    $resListe = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->where('reservations.id','=',$motCle)
    ->get();
   
  
        $androany = Carbon::now()->format('Y-m-d');
    $now = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->where('reservations.date_debut','like','%'.$androany.'%')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->get();
   
  
    return view('reservation.liste')->with('resListe',$resListe)->with('now',$now);
  }
  public function liste_search_date(){
     
    $motCle = \Request::get('motCle');
    $resListe = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->where('reservations.created_at','like', '%'.$motCle.'%')
    ->get();
   
  
        $androany = Carbon::now()->format('Y-m-d');
    $now = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->where('reservations.date_debut','like','%'.$androany.'%')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->get();
   
  
    return view('reservation.liste')->with('resListe',$resListe)->with('now',$now);
  }
  public function liste_search_debut(){
     
    $motCle = \Request::get('motCle');
    $resListe = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->where('reservations.date_debut','like', '%'.$motCle.'%')
    ->get();
   
  
        $androany = Carbon::now()->format('Y-m-d');
    $now = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->where('reservations.date_debut','like','%'.$androany.'%')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->get();
   
  
    return view('reservation.liste')->with('resListe',$resListe)->with('now',$now);
  }
  public function liste_search_fin(){
     
    $motCle = \Request::get('motCle');
    $resListe = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->where('reservations.date_fin','like', '%'.$motCle.'%')
    ->get();
   
  
        $androany = Carbon::now()->format('Y-m-d');
    $now = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->where('reservations.date_debut','like','%'.$androany.'%')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->get();
   
  
    return view('reservation.liste')->with('resListe',$resListe)->with('now',$now);
  }
  public function editReservation($id){
    $res = Reservation::find($id);

    $resListe = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->paginate(10);
   
    return view('reservation.edit')->with('res',$res)->with('resListe',$resListe);
  }
  public function updateReservation(Request $request,$id){
    $this->validate($request,[
        'status' => 'required',
        'desc' => 'required|max:200',
       
       
    ],[
        'status.required' =>'Entrer status',
        'desc.required' =>'Entrer la description',
       
        
    ]);
    
    $ch = Reservation::find($id);
    $ch->status = $request->status;
    $ch->desc = $request->desc;
    $ch->update();

    $chc = DB::table('reservations')
          ->select('chambre_id')
          ->where('id','=',$id)
          ->first();
      $idch = $chc->chambre_id;
      $acc = \Request::get('status');
      if($acc == "Accepté"){
        $chambre = Chambre::find($idch);
        $chambre->status_ch =  "Reservé";
        $chambre->update();
      } else if($acc == "Annulé"){ 
        $chambre = Chambre::find($idch);
        $chambre->status_ch =  "En attente";
        $chambre->update();
      }
    Session::flash('success','Reservation confirmé avec success!');
  
    return redirect()->back();
  }
  public function deleteReservationAdmin($id){
        
      $chc = DB::table('reservations')
    ->where('id','=',$id)
    ->first();

    $idc = $chc->chambre_id;
    $chambre = Chambre::find($idc);

    $chambre->status_ch =  "libre";
    $chambre->update();
      //recherche par rapport a id supprimer
    Reservation::find($id)->delete();
    Session::flash('success','Reservation supprimer avec succés');


      return redirect()->back();

  }
  public function liste_search_cli(){
     
    $motCle = \Request::get('motCle');
    $resListe = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->where('users.id','=', $motCle)
    ->get();
   
  
        $androany = Carbon::now()->format('Y-m-d');
    $now = DB::table('reservations')
    ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
    ->join('users', 'reservations.user_id', '=', 'users.id')
    ->where('reservations.date_debut','like','%'.$androany.'%')
    ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
    ->orderBy('reservations.created_at','ASK')
    ->get();
   
  
    return view('reservation.liste')->with('resListe',$resListe)->with('now',$now);
  }
  
}
