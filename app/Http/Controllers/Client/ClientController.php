<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Session;
use DateTime;

class ClientController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function liste(){
       $totalCli = DB::table('users')
       ->selectRaw('id')
       ->get();

       $totalRes = DB::table('reservations')
       ->selectRaw('id')
       ->get();

       $totalCons = DB::table('consommations')
       ->selectRaw('id')
       ->get();

       $totalPres = DB::table('prestations')
       ->selectRaw('id')
       ->get();

       $totalCh = DB::table('chambres')
       ->selectRaw('id')
       ->get();

       $totalChLibre = DB::table('chambres')
       ->selectRaw('id')
       ->where('status_ch','=','libre')
       ->get();

       $totalAd = DB::table('admins')
       ->selectRaw('id')
       ->get();

        $listes = DB::table('users')
        ->select('*')
        ->paginate(9);
        return view('client.liste',[
            'listes' => $listes,
            'total' => $totalCli,
            'totalRes' => $totalRes,
            'totalCons' => $totalCons,
            'totalPres' => $totalPres,
            'totalCh' => $totalCh,
            'totalChLibre' => $totalChLibre,
            'totalAd' => $totalAd
        ]);
    }
    public function deleteClient($id){
        //recherche par rapport a id supprimer
        User::find($id)->delete();
    
        Session::flash('success','Suppression avec succés');
        return redirect()->back();
    
    }
    public function editClient($id){
        $ch = User::find($id);
       
        return view('client.show_client')->with('client',$ch);
   }
   public function editClientSubmit(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|string|max:255',
          
            'adrs_cli' => 'required',
            'ville_cli' => 'required',
            'code_postal_cli' => 'required',
            'pays_cli' => 'required',
            'tel_cli' => 'required',
        
        ],[
            'name.required' =>'Champ obligatoire',
            
            'adrs_cli.required' =>'Champ obligatoire',
            'ville_cli.required' =>'Champ obligatoire',
            'code_postal_cli.required' => 'Champ obligatoire',
            'pays_cli.required' => 'Champ obligatoire',
            'tel_cli.required' => 'Champ obligatoire',
        
            
        ]);
        
        $ch = user::find($id);
        $ch->name = $request->name;
        $ch->prenom_cli = $request->prenom_cli;
        $ch->adrs_cli = $request->adrs_cli;
        $ch->ville_cli = $request->ville_cli;
        $ch->pays_cli = $request->pays_cli;
        $ch->code_postal_cli =  $request->code_postal_cli;
    

        $ch->update();
        Session::flash('success','Client modifié');
    
        return redirect()->back();
    }
    public function gerer(){
        $resListe = DB::table('reservations')
        ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->select('reservations.id','users.id as idcli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.num_tel_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.categorie_id','users.name','users.prenom_cli','users.adrs_cli','users.ville_cli','users.code_postal_cli','users.pays_cli','users.tel_cli','users.email')
        ->where('reservations.status','=','Accepté')
        ->get();

        $countRes = DB::table('reservations')
        ->selectRaw('count(reservations.id) as count')
        ->get();

        $countResAccept = DB::table('reservations')
        ->selectRaw('count(reservations.id) as count')
        ->where('reservations.status','=','Accepté')
        ->get();
        $countCli = DB::table('users')
        ->selectRaw('count(users.id) as count')
        ->get();

        return view('client.facture')->with('resListe',$resListe)
                                     ->with('countRes',$countRes)
                                     ->with('countResAccept',$countResAccept)
                                     ->with('countCli',$countCli);
    }
    public function facture(){
       $id_cli = \Request::get('id_cli');
       $id_res = \Request::get('id_res');
            
        $resListe = DB::table('reservations')
        ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->select('reservations.id','users.id as cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.nbr_pers','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.num_tel_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.categorie_id','users.name','users.prenom_cli','users.adrs_cli','users.ville_cli','users.code_postal_cli','users.pays_cli','users.tel_cli','users.email')
        ->where('users.id','=',$id_cli)
        ->where('reservations.id','=',$id_res)
        ->get();

        $consListe =  DB::table('consommations')
        ->join('reservations', 'consommations.reservation_id', '=', 'reservations.id')
        ->join('produits', 'consommations.produit_id', '=', 'produits.id')
        ->select('consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
        ->where('consommations.user_id','=',$id_cli)
        ->where('consommations.reservation_id','=',$id_res)
        ->get();

        $presListe = DB::table('prestations')
        ->join('prestation_listes', 'prestations.prestation_id', '=', 'prestation_listes.id')
        
        ->select('prestations.id','prestation_listes.designation','prestations.montant_pres','prestations.user_id','prestations.reservation_id','prestations.prestation_id','prestations.created_at')
        ->get();

        $consTotal = DB::table('consommations')
        ->selectRaw('sum(consommations.montant_cons) as sum')
        ->where('user_id','=',$id_cli)
        ->where('reservation_id','=',$id_res)
        ->get();

        $presTotal = DB::table('prestations')
        ->selectRaw('sum(prestations.montant_pres) as sum')
        ->where('user_id','=',$id_cli)
        ->where('reservation_id','=',$id_res)
        ->get();

        return view('client.print_facture')->with('resListe',$resListe)
                                           ->with('consListe',$consListe)
                                           ->with('presListe',$presListe) 
                                           ->with('consTotal',$consTotal)
                                           ->with('presTotal',$presTotal);
    }
    public function printFacture($id_cli,$id_res){
      
             
        $resListe = DB::table('reservations')
        ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->select('reservations.id','users.id as cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.nbr_pers','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.num_tel_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.categorie_id','users.name','users.prenom_cli','users.adrs_cli','users.ville_cli','users.code_postal_cli','users.pays_cli','users.tel_cli','users.email')
        ->where('users.id','=',$id_cli)
        ->where('reservations.id','=',$id_res)
        ->get();

 
        $consListe =  DB::table('consommations')
        ->join('reservations', 'consommations.reservation_id', '=', 'reservations.id')
        ->join('produits', 'consommations.produit_id', '=', 'produits.id')
        ->select('consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
        ->where('consommations.user_id','=',$id_cli)
        ->where('consommations.reservation_id','=',$id_res)
        ->get();
         $presListe = DB::table('prestations')
         ->join('prestation_listes', 'prestations.prestation_id', '=', 'prestation_listes.id')
        
        ->select('prestations.id','prestation_listes.designation','prestations.montant_pres','prestations.user_id','prestations.reservation_id','prestations.prestation_id','prestations.created_at')
        ->get();
 
         $consTotal = DB::table('consommations')
         ->selectRaw('sum(consommations.montant_cons) as sum')
         ->where('user_id','=',$id_cli)
         ->where('reservation_id','=',$id_res)
         ->get();
 
         $presTotal = DB::table('prestations')
         ->selectRaw('sum(prestations.montant_pres) as sum')
         ->where('user_id','=',$id_cli)
         ->where('reservation_id','=',$id_res)
         ->get();

       //  $now = new DateTime('now');
       //  $dateNow = $now->format('Y-m-d');
 
         return view('client.print')->with('resListe',$resListe)
                                            ->with('consListe',$consListe)
                                            ->with('presListe',$presListe) 
                                            ->with('consTotal',$consTotal)
                                            ->with('presTotal',$presTotal);
                                          
     }
     public function search(){
         $select = \Request::get('select');
         $motCle = \Request::get('motCle');

         if($select == 'id'){
            $totalCli = DB::table('users')
            ->selectRaw('id')
            ->get();
     
            $totalRes = DB::table('reservations')
            ->selectRaw('id')
            ->get();
     
            $totalCons = DB::table('consommations')
            ->selectRaw('id')
            ->get();
     
            $totalPres = DB::table('prestations')
            ->selectRaw('id')
            ->get();
     
            $totalCh = DB::table('chambres')
            ->selectRaw('id')
            ->get();
     
            $totalChLibre = DB::table('chambres')
            ->selectRaw('id')
            ->where('status_ch','=','libre')
            ->get();
     
            $totalAd = DB::table('admins')
            ->selectRaw('id')
            ->get();
     
             $listes = DB::table('users')
             ->select('*')
             ->where('id','=',$motCle)
             ->paginate(9);
             return view('client.liste',[
                 'listes' => $listes,
                 'total' => $totalCli,
                 'totalRes' => $totalRes,
                 'totalCons' => $totalCons,
                 'totalPres' => $totalPres,
                 'totalCh' => $totalCh,
                 'totalChLibre' => $totalChLibre,
                 'totalAd' => $totalAd
             ]);
         } elseif ($select == 'name') {
            $totalCli = DB::table('users')
            ->selectRaw('id')
            ->get();
     
            $totalRes = DB::table('reservations')
            ->selectRaw('id')
            ->get();
     
            $totalCons = DB::table('consommations')
            ->selectRaw('id')
            ->get();
     
            $totalPres = DB::table('prestations')
            ->selectRaw('id')
            ->get();
     
            $totalCh = DB::table('chambres')
            ->selectRaw('id')
            ->get();
     
            $totalChLibre = DB::table('chambres')
            ->selectRaw('id')
            ->where('status_ch','=','libre')
            ->get();
     
            $totalAd = DB::table('admins')
            ->selectRaw('id')
            ->get();
     
             $listes = DB::table('users')
             ->select('*')
             ->where('name','like','%'.$motCle.'%')
             ->paginate(9);
             return view('client.liste',[
                 'listes' => $listes,
                 'total' => $totalCli,
                 'totalRes' => $totalRes,
                 'totalCons' => $totalCons,
                 'totalPres' => $totalPres,
                 'totalCh' => $totalCh,
                 'totalChLibre' => $totalChLibre,
                 'totalAd' => $totalAd
             ]);
         } elseif ($select == 'prenom_cli') {
            $totalCli = DB::table('users')
            ->selectRaw('id')
            ->get();
     
            $totalRes = DB::table('reservations')
            ->selectRaw('id')
            ->get();
     
            $totalCons = DB::table('consommations')
            ->selectRaw('id')
            ->get();
     
            $totalPres = DB::table('prestations')
            ->selectRaw('id')
            ->get();
     
            $totalCh = DB::table('chambres')
            ->selectRaw('id')
            ->get();
     
            $totalChLibre = DB::table('chambres')
            ->selectRaw('id')
            ->where('status_ch','=','libre')
            ->get();
     
            $totalAd = DB::table('admins')
            ->selectRaw('id')
            ->get();
     
             $listes = DB::table('users')
             ->select('*')
             ->where('prenom_cli','like','%'.$motCle.'%')
             ->paginate(9);
             return view('client.liste',[
                 'listes' => $listes,
                 'total' => $totalCli,
                 'totalRes' => $totalRes,
                 'totalCons' => $totalCons,
                 'totalPres' => $totalPres,
                 'totalCh' => $totalCh,
                 'totalChLibre' => $totalChLibre,
                 'totalAd' => $totalAd
             ]);
         } elseif ($select == 'adrs_cli') {
            $totalCli = DB::table('users')
            ->selectRaw('id')
            ->get();
     
            $totalRes = DB::table('reservations')
            ->selectRaw('id')
            ->get();
     
            $totalCons = DB::table('consommations')
            ->selectRaw('id')
            ->get();
     
            $totalPres = DB::table('prestations')
            ->selectRaw('id')
            ->get();
     
            $totalCh = DB::table('chambres')
            ->selectRaw('id')
            ->get();
     
            $totalChLibre = DB::table('chambres')
            ->selectRaw('id')
            ->where('status_ch','=','libre')
            ->get();
     
            $totalAd = DB::table('admins')
            ->selectRaw('id')
            ->get();
     
             $listes = DB::table('users')
             ->select('*')
             ->where('adrs_cli','like','%'.$motCle.'%')
             ->paginate(9);
             return view('client.liste',[
                 'listes' => $listes,
                 'total' => $totalCli,
                 'totalRes' => $totalRes,
                 'totalCons' => $totalCons,
                 'totalPres' => $totalPres,
                 'totalCh' => $totalCh,
                 'totalChLibre' => $totalChLibre,
                 'totalAd' => $totalAd
             ]);
         } elseif ($select == 'ville_cli') {
            $totalCli = DB::table('users')
            ->selectRaw('id')
            ->get();
     
            $totalRes = DB::table('reservations')
            ->selectRaw('id')
            ->get();
     
            $totalCons = DB::table('consommations')
            ->selectRaw('id')
            ->get();
     
            $totalPres = DB::table('prestations')
            ->selectRaw('id')
            ->get();
     
            $totalCh = DB::table('chambres')
            ->selectRaw('id')
            ->get();
     
            $totalChLibre = DB::table('chambres')
            ->selectRaw('id')
            ->where('status_ch','=','libre')
            ->get();
     
            $totalAd = DB::table('admins')
            ->selectRaw('id')
            ->get();
     
             $listes = DB::table('users')
             ->select('*')
             ->where('ville_cli','like','%'.$motCle.'%')
             ->paginate(9);
             return view('client.liste',[
                 'listes' => $listes,
                 'total' => $totalCli,
                 'totalRes' => $totalRes,
                 'totalCons' => $totalCons,
                 'totalPres' => $totalPres,
                 'totalCh' => $totalCh,
                 'totalChLibre' => $totalChLibre,
                 'totalAd' => $totalAd
             ]);
         } elseif ($select == 'code_postal_cli') {
            $totalCli = DB::table('users')
            ->selectRaw('id')
            ->get();
     
            $totalRes = DB::table('reservations')
            ->selectRaw('id')
            ->get();
     
            $totalCons = DB::table('consommations')
            ->selectRaw('id')
            ->get();
     
            $totalPres = DB::table('prestations')
            ->selectRaw('id')
            ->get();
     
            $totalCh = DB::table('chambres')
            ->selectRaw('id')
            ->get();
     
            $totalChLibre = DB::table('chambres')
            ->selectRaw('id')
            ->where('status_ch','=','libre')
            ->get();
     
            $totalAd = DB::table('admins')
            ->selectRaw('id')
            ->get();
     
             $listes = DB::table('users')
             ->select('*')
             ->where('code_postal_cli','like','%'.$motCle.'%')
             ->paginate(9);
             return view('client.liste',[
                 'listes' => $listes,
                 'total' => $totalCli,
                 'totalRes' => $totalRes,
                 'totalCons' => $totalCons,
                 'totalPres' => $totalPres,
                 'totalCh' => $totalCh,
                 'totalChLibre' => $totalChLibre,
                 'totalAd' => $totalAd
             ]);
         } elseif ($select == 'pays_cli') {
            $totalCli = DB::table('users')
            ->selectRaw('id')
            ->get();
     
            $totalRes = DB::table('reservations')
            ->selectRaw('id')
            ->get();
     
            $totalCons = DB::table('consommations')
            ->selectRaw('id')
            ->get();
     
            $totalPres = DB::table('prestations')
            ->selectRaw('id')
            ->get();
     
            $totalCh = DB::table('chambres')
            ->selectRaw('id')
            ->get();
     
            $totalChLibre = DB::table('chambres')
            ->selectRaw('id')
            ->where('status_ch','=','libre')
            ->get();
     
            $totalAd = DB::table('admins')
            ->selectRaw('id')
            ->get();
     
             $listes = DB::table('users')
             ->select('*')
             ->where('pays_cli','like','%'.$motCle.'%')
             ->paginate(9);
             return view('client.liste',[
                 'listes' => $listes,
                 'total' => $totalCli,
                 'totalRes' => $totalRes,
                 'totalCons' => $totalCons,
                 'totalPres' => $totalPres,
                 'totalCh' => $totalCh,
                 'totalChLibre' => $totalChLibre,
                 'totalAd' => $totalAd
             ]);
         } elseif ($select == 'tel_cli') {
            $totalCli = DB::table('users')
            ->selectRaw('id')
            ->get();
     
            $totalRes = DB::table('reservations')
            ->selectRaw('id')
            ->get();
     
            $totalCons = DB::table('consommations')
            ->selectRaw('id')
            ->get();
     
            $totalPres = DB::table('prestations')
            ->selectRaw('id')
            ->get();
     
            $totalCh = DB::table('chambres')
            ->selectRaw('id')
            ->get();
     
            $totalChLibre = DB::table('chambres')
            ->selectRaw('id')
            ->where('status_ch','=','libre')
            ->get();
     
            $totalAd = DB::table('admins')
            ->selectRaw('id')
            ->get();
     
             $listes = DB::table('users')
             ->select('*')
             ->where('tel_cli','like','%'.$motCle.'%')
             ->paginate(9);
             return view('client.liste',[
                 'listes' => $listes,
                 'total' => $totalCli,
                 'totalRes' => $totalRes,
                 'totalCons' => $totalCons,
                 'totalPres' => $totalPres,
                 'totalCh' => $totalCh,
                 'totalChLibre' => $totalChLibre,
                 'totalAd' => $totalAd
             ]);
         } elseif ($select == 'email') {
            $totalCli = DB::table('users')
            ->selectRaw('id')
            ->get();
     
            $totalRes = DB::table('reservations')
            ->selectRaw('id')
            ->get();
     
            $totalCons = DB::table('consommations')
            ->selectRaw('id')
            ->get();
     
            $totalPres = DB::table('prestations')
            ->selectRaw('id')
            ->get();
     
            $totalCh = DB::table('chambres')
            ->selectRaw('id')
            ->get();
     
            $totalChLibre = DB::table('chambres')
            ->selectRaw('id')
            ->where('status_ch','=','libre')
            ->get();
     
            $totalAd = DB::table('admins')
            ->selectRaw('id')
            ->get();
     
             $listes = DB::table('users')
             ->select('*')
             ->where('email','like','%'.$motCle.'%')
             ->paginate(9);
             return view('client.liste',[
                 'listes' => $listes,
                 'total' => $totalCli,
                 'totalRes' => $totalRes,
                 'totalCons' => $totalCons,
                 'totalPres' => $totalPres,
                 'totalCh' => $totalCh,
                 'totalChLibre' => $totalChLibre,
                 'totalAd' => $totalAd
             ]);
         }
     } 

    public function activiteClient($id){
        $user = User::find($id);
        $resTotal = DB::table('reservations')
         ->selectRaw('id')
         ->where('user_id','=',$id)
          ->get();
        $favTotal = DB::table('favories')
         ->selectRaw('count(id) as fav')
         ->where('user_id','=',$id)
          ->first();

        $resListe = DB::table('reservations')
            ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
            ->where('users.id','=',$id)
            ->paginate(6);
         $listeCons = DB::table('consommations')
            ->join('users', 'consommations.user_id', '=', 'users.id')
            ->join('produits', 'consommations.produit_id', '=', 'produits.id')
            ->select('users.id as userid','users.name','users.prenom_cli','consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
            ->where('users.id','=',$id)
            ->paginate(6); 
        $listePres = DB::table('prestations')
            ->join('prestation_listes', 'prestations.prestation_id', '=', 'prestation_listes.id')
            ->join('users', 'prestations.user_id', '=', 'users.id')
            ->select('prestations.id','prestation_listes.designation','prestations.montant_pres','prestations.user_id','prestations.reservation_id','prestations.prestation_id','prestations.created_at','users.name','users.prenom_cli')
            ->where('users.id','=',$id)
            ->paginate(6); 
        $favorie = DB::table('favories')
            ->select('*')
            ->where('user_id','=',$id)
            ->paginate(6); 
        $post = DB::table('reservations')
                ->selectRaw('sum(montant) as count')
                ->where('user_id','=',$id)
                ->first();
       $data = $post->count;
       $post_cons = DB::table('consommations')
                ->selectRaw('sum(montant_cons) as count_res')
                ->where('user_id','=',$id)
                ->first();
       $data_cons = $post_cons->count_res;
       $post_pres = DB::table('prestations')
                ->selectRaw('sum(montant_pres) as count_pres')
                ->where('user_id','=',$id)
                ->first();
       $data_pres = $post_pres->count_pres;
            
        return view('client.activite')->with('user',$user)
                                      ->with('resTotal',$resTotal)
                                      ->with('favTotal',$favTotal)
                                      ->with('resListe',$resListe)
                                      ->with('favories',$favorie)
                                      ->with('ch',$listeCons)
                                      ->with('chc',$listePres)
                                      ->with('data',$data)
                                      ->with('data_cons',$data_cons)
                                      ->with('data_pres',$data_pres);
    }

}
