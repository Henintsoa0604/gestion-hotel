<?php

namespace App\Http\Controllers\Prestation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\USER;
use App\Models\Prestation;
use App\Models\Reservation;
use App\Models\Prestation_liste;
use Session;
use DB;
class PrestationController extends Controller
{ 
    public function __construct(){
      $this->middleware('auth:admin');
   
    }
    public function listeClient(){
        $resListe = DB::table('reservations')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->select('reservations.id as idPres','reservations.date_debut','reservations.date_fin','users.id','users.name','users.prenom_cli','users.adrs_cli')
        ->where('reservations.status','=','Accepté')
        ->paginate(5);

        $pres = DB::table('prestation_listes')
        ->select('*')
        ->get();
       return view('prestation.liste_client',['client' => $resListe,'pres' => $pres ]);
    }
    public function editPrestationCli($id){
        $ch = Reservation::find($id);
       
        return view('prestation.show_client')->with('client',$ch);
   }
   public function ajoutPrestation(Request $request){
    $this->validate($request,[
        'user_id' => 'required',
        'reservation_id' => 'required',
        'prestation_id' => 'required',
        
     
       
      
    ],[
        'user_id.required' =>'Champ obligatoire',
        'reservation_id.required' =>'Champ obligatoire',
        'prestation_id.required' =>'Champ obligatoire',
       
       
       
        
    ]);
   
    $id = \Request::get('prestation_id');
    $prix = DB::table('prestation_listes')
    ->select('*')
    ->where('id','=',$id)
    ->first();
    $ch = new Prestation;
    $ch->prestation_id = $request->prestation_id;
   
    $ch->montant_pres =  $prix->prix_unique;
    $ch->user_id = $request->user_id;
    $ch->reservation_id = $request->reservation_id;
    $ch->save();
    Session::flash('success','Prestation enregistrer avec succés');
    return redirect()->back();
  }
  public function searchClient(){
    $select = \Request::get('select');  
    $search=\Request::get('motCle');
    if($select == 'idCli'){
        $resListe = DB::table('reservations')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->select('reservations.id as idPres','reservations.date_debut','reservations.date_fin','users.id','users.name','users.prenom_cli','users.adrs_cli')
            ->where('reservations.status','=','Accepté')
            ->where('users.name','like','%'.$search.'%')
            ->orWhere('users.prenom_cli','like','%'.$search.'%')
            ->paginate(5);
            $pres = DB::table('prestation_listes')
            ->select('*')
            ->get();
        return view('prestation.liste_client',['client' => $resListe,'pres' => $pres]);
    } 
   }
   public function listePrestation(){
    $listes = DB::table('prestations')
    ->join('prestation_listes', 'prestations.prestation_id', '=', 'prestation_listes.id')
    ->join('users', 'prestations.user_id', '=', 'users.id')
    ->select('prestations.id','prestation_listes.designation','prestations.montant_pres','prestations.user_id','prestations.reservation_id','prestations.prestation_id','prestations.created_at','users.name','users.prenom_cli')
    ->paginate(5);
    $pres = DB::table('prestation_listes')
    ->select('*')
    ->get();
   return view('prestation.liste_prestation',['ch' => $listes,'pres' => $pres]);
   }
   public function editPrestation($id){
    $ch = Prestation::find($id);
 
    return view('prestation.edit_prestation')->with('pres',$ch);
   }
   public function updatePrestation(Request $request){

   $id = \Request::get('id'); 
   $idpres = \Request::get('prestation_id'); 
    $this->validate($request,[
       'prestation_id' => 'required',
    ],[
        'prestation_id.required' =>'Champ obligatoire',
        
    ]);
    $idd = DB::table('prestation_listes')
   
    ->select('*')
    ->where('id','=',$idpres)
    ->first();
    $ch = Prestation::find($id);
    
    $ch->prestation_id = $request->prestation_id;
    
    $ch->montant_pres = $idd->prix_unique;
    
    $ch->update();
    Session::flash('success','Prestation modifié avec succés');
   
    return redirect()->back();
    }
    public function deletePrestation($id){
        //recherche par rapport a id supprimer
        Prestation::find($id)->delete();
    
        Session::flash('successs','Suppression avec succés');
    
       
       return redirect()->back();
    
       }
    public function searchPrestation(){
        $select = \Request::get('select');
        $search=\Request::get('motCle');
        if ($select == 'id') {
            $listes = DB::table('Prestations')
            ->select('id','designation_pres','prix_pres','montant_pres','user_id','reservation_id','created_at')
            ->where('id', '=',$search)
            ->paginate(5);
            return view('prestation.liste_prestation',['ch' => $listes]);
        } elseif ($select == 'designation_pres') {
            $listes = DB::table('Prestations')
            ->select('id','designation_pres','prix_pres','montant_pres','user_id','reservation_id','created_at')
            ->where('designation_pres', 'like','%'.$search.'%')
            ->paginate(5);
            return view('prestation.liste_prestation',['ch' => $listes]);
        } elseif ($select == 'prix_pres') {
            $listes = DB::table('Prestations')
            ->select('id','designation_pres','prix_pres','montant_pres','user_id','reservation_id','created_at')
            ->where('prix_pres', '=',$search)
            ->paginate(5);
            return view('prestation.liste_prestation',['ch' => $listes]);
        } elseif ($select == 'montant_pres') {
            $listes = DB::table('Prestations')
            ->select('id','designation_pres','prix_pres','montant_pres','user_id','reservation_id','created_at')
            ->where('montant_pres', '=',$search)
            ->paginate(5);
            return view('prestation.liste_prestation',['ch' => $listes]);
        } elseif ($select == 'id_cli') {
            $listes = DB::table('Prestations')
            ->select('id','designation_pres','prix_pres','montant_pres','user_id','reservation_id','created_at')
            ->where('user_id', '=',$search)
            ->paginate(5);
            return view('prestation.liste_prestation',['ch' => $listes]);
        } elseif ($select == 'id_res') {
            $listes = DB::table('Prestations')
            ->select('id','designation_pres','prix_pres','montant_pres','user_id','reservation_id','created_at')
            ->where('reservation_id', '=',$search)
            ->paginate(5);
            return view('prestation.liste_prestation',['ch' => $listes]);
        } 
    }
    public function searchPrestationDate(){
        $search=\Request::get('date');
        $listes = DB::table('Prestations')
        ->select('id','designation_pres','prix_pres','montant_pres','user_id','reservation_id','created_at')
        ->where('created_at', 'like','%' .$search. '%')
        ->paginate(5);
       return view('prestation.liste_prestation',['ch' => $listes]);
    }
    //Prestation dans l'hotel
    public function ajout(){
        $pres = DB::table('prestation_listes')
        ->select('*')
        ->paginate(5);
       
       return view('prestation.ajout_pres_hotel',['pres' => $pres]);
    }
    public function ajoutPres(Request $request){
        $this->validate($request,[
            
            'designation' => 'required',
            'qte' => 'numeric|nullable',
            'prix_unique' => 'required',
           
          
        ],[
           
            'designation.required' =>'Champ obligatoire',
            'prix_unique.required' =>'Champ obligatoire',
            'qte.numeric' =>'Prix incorrecte',
           
            
        ]);
        
        $ch = new Prestation_liste;
        $ch->designation = $request->designation;
        $ch->prix_unique = $request->prix_unique;
        $ch->qte = $request->qte;
        $ch->save();
        Session::flash('success','prestation enregistrer avec succés');
        return redirect()->back();
      }
      public function listePres(){
        $listes = DB::table('prestation_listes')
        ->select('*')
        ->paginate(5);
    
       return view('prestation.liste_pres',['listes' => $listes]);
       }

       public function updatePres(Request $request){
   
        $id = \Request::get('id');
        $this->validate($request,[
           
            'designation' => 'required',
            'prix_unique' => 'required|max:500000',
           
          
        ],[
          
            'designation.required' =>'Champ obligatoire',
            'prix_unique.required' =>'Champ obligatoire',
            'prix_pres.numeric' =>'Prix incorrecte',
            
           
            
        ]);
        
        $ch = Prestation_liste::find($id);
        $ch->designation = $request->designation;
        $ch->prix_unique = $request->prix_unique;
        $ch->update();
        Session::flash('successs','prestation modifié avec succés');
       
        return redirect()->back();
        }
        public function deletePres($id){
            //recherche par rapport a id supprimer
            Prestation_liste::find($id)->delete();
        
            Session::flash('successs','Suppression avec succés');
        
           
           return redirect()->back();
        
        }
        public function searchPres(){
            $select = \Request::get('select');
            $search=\Request::get('motCle');
            if ($select == 'id') {
                $listes = DB::table('prestation_listes')
                ->select('*')
                ->where('id', '=',$search)
                ->paginate(5);
                return view('prestation.liste_pres',['listes' => $listes]);
            } elseif ($select == 'designation') {
                $listes = DB::table('prestation_listes')
                ->select('*')
                ->where('designation', 'like','%'.$search.'%')
                ->paginate(5);
                return view('prestation.liste_pres',['listes' => $listes]);
            } elseif ($select == 'prix_unique') {
                $listes = DB::table('prestation_listes')
                ->select('*')
                ->where('prix_unique', '=',$search)
                ->paginate(5);
                return view('prestation.liste_pres',['listes' => $listes]);
            } 
        }
        public function searchPresDate(){
            $search=\Request::get('date');
            $listes = DB::table('prestation_listes')
            ->select('*')
            ->where('created_at', 'like','%' .$search. '%')
            ->paginate(5);
           return view('prestation.liste_pres',['listes' => $listes]);
        }

}
