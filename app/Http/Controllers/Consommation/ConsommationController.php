<?php

namespace App\Http\Controllers\Consommation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\USER;
use App\Models\Consommation;
use App\Models\Reservation;
use App\Models\Produit;
use Session;
use DB;
class ConsommationController extends Controller
{ 
    public function __construct(){
    $this->middleware('auth:admin');
   
    }
    public function listeClient(){
        $resListe = DB::table('reservations')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->select('reservations.id as idres','reservations.date_debut','reservations.date_fin','users.id','users.name','users.prenom_cli','users.adrs_cli')
        ->orderBy('reservations.created_at','ask')
        ->where('reservations.status','=','Accepté')
        ->paginate(5);
        $liste_produit = DB::table('produits')
        ->select('*')
        ->get();
       
       return view('consommation.liste_client',['client' => $resListe ,'liste_prod' => $liste_produit]);
    }
    public function editConsommationCli($id){
        $ch = Reservation::find($id);
       
        return view('consommation.show_client')->with('client',$ch);
   }
   public function ajoutConsommation(Request $request){
    $this->validate($request,[
        'user_id' => 'required',
        'reservation_id' => 'required',
        'produit_id' => 'required',
        
        'quantite_cons' => 'required|numeric',
       
      
    ],[
        'user_id.required' =>'Champ obligatoire',
        'reservation_id.required' =>'Champ obligatoire',
        'produit_id.required' =>'Champ obligatoire',
        'quantite_cons.required' =>'Champ obligatoire',
        'quantite_cons.numeric' =>'Prix incorrecte',
       
        
    ]);
    
    
    $qte_cons = \Request::get('quantite_cons');
    $id = \Request::get('produit_id');
    $qte= DB::table('produits')
          ->select('*')
          ->where('id','=',$id)
          ->first();
    $qte_stock = $qte->qte;
    $nouveau_stock = $qte_stock - $qte_cons;
    $ch = new Consommation;
    $pro = Produit::find($id);
    if($qte_cons > 0 ){
        if($qte_cons <= $qte_stock) {
        
            $ch->quantite_cons = $request->quantite_cons;
        
            $ch->montant_cons = $request->quantite_cons * $qte->prix_unique;
            $ch->user_id = $request->user_id;
            $ch->reservation_id = $request->reservation_id;
            $ch->produit_id = $request->produit_id;
            $ch->save();

            //update produit par rapport a l id
            $pro->qte = $nouveau_stock;
            $pro->update();

            Session::flash('success','consommation enregistrer avec succés');
            return redirect()->back();
        } else {
            Session::flash('insuffisant','quantite du stock insufissanr insufissant!!');
            return redirect()->back();
           
        } 
    } else {
        Session::flash('invalide','quantite invalide!!');
        return redirect()->back();
    }
    
  }
  public function searchClient(){
    $select = \Request::get('select');  
    $search=\Request::get('motCle');
    if($select == 'idCli'){
        $resListe = DB::table('reservations')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->select('reservations.id as idres','reservations.date_debut','reservations.date_fin','users.id','users.name','users.prenom_cli','users.adrs_cli')
        ->where('reservations.status','=','Accepté')
        ->where('users.id','=',$search)
        ->paginate(5);
        $liste_produit = DB::table('produits')
        ->select('*')
        ->get();
           return view('consommation.liste_client',['client' => $resListe,'liste_prod' => $liste_produit ]);
    } elseif ($select == 'idRes') {
        $resListe = DB::table('reservations')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->select('reservations.id as idres','reservations.date_debut','reservations.date_fin','users.id','users.name','users.prenom_cli','users.adrs_cli')
        ->where('reservations.status','=','Accepté')
        ->where('users.name','like','%'.$search.'%')
        ->paginate(5);
        $liste_produit = DB::table('produits')
        ->select('*')
        ->get();
           return view('consommation.liste_client',['client' => $resListe,'liste_prod' => $liste_produit ]);
    }
   }
   public function listeConsommation(){
    $listes = DB::table('consommations')
    ->join('users', 'consommations.user_id', '=', 'users.id')
    ->join('produits', 'consommations.produit_id', '=', 'produits.id')
    ->select('users.id as userid','users.name','users.prenom_cli','consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
    ->paginate(5);

   return view('consommation.liste_consommation',['ch' => $listes]);
   }
   public function editConsommation($id){
    $ch = Consommation::find($id);
 
    return view('consommation.edit_consommation')->with('cons',$ch);
   }
   public function updateConsommation(Request $request){
   

    $this->validate($request,[
       
        'produit_id' => 'required',
        
        'quantite_cons' => 'required|numeric',
       
      
    ],[
      
        'produit_id.required' =>'Champ obligatoire',
        'quantite_cons.required' =>'Champ obligatoire',
        'quantite_cons.numeric' =>'Prix incorrecte',
       
        
    ]);
    
    $idc = \Request::get('id');
    $qte_cons = \Request::get('quantite_cons');
    $id = \Request::get('produit_id');
    $qte= DB::table('produits')
          ->select('*')
          ->where('id','=',$id)
          ->first();
    $qte_stock = $qte->qte;
    $nouveau_stock = $qte_stock - $qte_cons;
    $ch = Consommation::find($idc);
    $pro = Produit::find($id);
    if($qte_cons > 0 ){
        if($qte_cons <= $qte_stock) {
        
            $ch->quantite_cons = $request->quantite_cons;
        
            $ch->montant_cons = $request->quantite_cons * $qte->prix_unique;
          
            $ch->produit_id = $request->produit_id;
            $ch->update();

            //update produit par rapport a l id
            $pro->qte = $nouveau_stock;
            $pro->update();

            Session::flash('success','consommation du client modifié avec succés');
            return redirect()->back();
        } else {
            Session::flash('insuffisant','quantite du stock insufissanr insufissant!!');
            return redirect()->back();
           
        } 
    } else {
        Session::flash('invalide','quantite invalide!!');
        return redirect()->back();
    }
    }
    public function deleteConsommation($id){
        //recherche par rapport a id supprimer
        Consommation::find($id)->delete();
    
        Session::flash('successs','Suppression avec succés');
    
       
       return redirect()->back();
    
       }
       public function annulerConsommation($id){
        //recherche par rapport a id supprimer
       
        $idc= DB::table('consommations')
        ->select('*')
        ->where('id','=',$id)
        ->first();
        
        $idp = $idc->produit_id;
        $idprod= DB::table('produits')
        ->select('*')
        ->where('id','=',$idp)
        ->first();
        $produit = Produit::find($idp);
        $produit->qte = $idc->quantite_cons +  $idprod->qte; 
        $produit->update();
        Consommation::find($id)->delete();
        Session::flash('successs','Consommation annulé');
    
       
       return redirect()->back();
    
       }
    public function searchConsommation(){
        $select = \Request::get('select');
        $search=\Request::get('motCle');
        if ($select == 'id') {
            $listes = DB::table('consommations')
            ->join('users', 'consommations.user_id', '=', 'users.id')
            ->join('produits', 'consommations.produit_id', '=', 'produits.id')
            ->select('users.id as userid','users.name','users.prenom_cli','consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
            ->where('consommations.id','=',$search)
            ->paginate(5);
            return view('consommation.liste_consommation',['ch' => $listes]);
        } elseif ($select == 'produit_id') {
            $listes = DB::table('consommations')
            ->join('users', 'consommations.user_id', '=', 'users.id')
            ->join('produits', 'consommations.produit_id', '=', 'produits.id')
            ->select('users.id as userid','users.name','users.prenom_cli','consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
            ->where('produits.designation','like','%'.$search.'%')
            ->paginate(5);
            return view('consommation.liste_consommation',['ch' => $listes]);
        } elseif ($select == 'qte_cons') {
            $listes = DB::table('consommations')
            ->join('users', 'consommations.user_id', '=', 'users.id')
            ->join('produits', 'consommations.produit_id', '=', 'produits.id')
            ->select('users.id as userid','users.name','users.prenom_cli','consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
            ->where('consommations.quantite_cons','=',$search)
            ->paginate(5);
            return view('consommation.liste_consommation',['ch' => $listes]);
        } elseif ($select == 'prix_cons') {
            $listes = DB::table('consommations')
            ->join('users', 'consommations.user_id', '=', 'users.id')
            ->join('produits', 'consommations.produit_id', '=', 'produits.id')
            ->select('users.id as userid','users.name','users.prenom_cli','consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
            ->where('produits.prix_unique','=',$search)
            ->paginate(5);
            return view('consommation.liste_consommation',['ch' => $listes]);
        } elseif ($select == 'montant_cons') {
            $listes = DB::table('consommations')
            ->join('users', 'consommations.user_id', '=', 'users.id')
            ->join('produits', 'consommations.produit_id', '=', 'produits.id')
            ->select('users.id as userid','users.name','users.prenom_cli','consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
            ->where('consommations.montant_cons','=',$search)
            ->paginate(5);
            return view('consommation.liste_consommation',['ch' => $listes]);
        } elseif ($select == 'id_cli') {
            $listes = DB::table('consommations')
            ->join('users', 'consommations.user_id', '=', 'users.id')
            ->join('produits', 'consommations.produit_id', '=', 'produits.id')
            ->select('users.id as userid','users.name','users.prenom_cli','consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
            ->where('users.name','like','%'.$search.'%')
            ->orWhere('users.prenom_cli','like','%'.$search.'%')
            ->paginate(5);
            return view('consommation.liste_consommation',['ch' => $listes]);
        } elseif ($select == 'id_res') {
            $listes = DB::table('consommations')
            ->join('users', 'consommations.user_id', '=', 'users.id')
            ->join('produits', 'consommations.produit_id', '=', 'produits.id')
            ->select('users.id as userid','users.name','users.prenom_cli','consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
            ->where('consommations.reservation_id','=',$search)
            ->paginate(5);
            return view('consommation.liste_consommation',['ch' => $listes]);
        }
    }
    public function searchConsommationDate(){
        $search=\Request::get('date');
        $listes = DB::table('consommations')
            ->join('users', 'consommations.user_id', '=', 'users.id')
            ->join('produits', 'consommations.produit_id', '=', 'produits.id')
            ->select('users.id as userid','users.name','users.prenom_cli','consommations.id','consommations.quantite_cons','consommations.montant_cons','consommations.user_id','consommations.reservation_id','consommations.created_at','produits.designation','produits.prix_unique','produits.id as prod')
            ->where('consommations.created_at','like','%'.$search.'%')
            ->paginate(5);
       return view('consommation.liste_consommation',['ch' => $listes]);
    }
    //Consommation dans l'hotel
    public function ajout(){
        $cons = DB::table('produits')
        ->select('*')
        ->paginate(5);
       
       return view('consommation.ajout_cons_hotel',['cons' => $cons]);
    }
    public function ajoutCons(Request $request){
        $this->validate($request,[
            
            'designation' => 'required',
            'qte' => 'required|numeric',
            'prix_unique' => 'required|numeric',
           
          
        ],[
           
            'designation.required' =>'Champ obligatoire',
            'prix_unique.required' =>'Champ obligatoire',
            'qte.required' =>'Champ obligatoire',
            'qte.numeric' =>'Quantite incorrecte',
            'prix_unique.numeric' =>'Prix incorrecte',
           
            
        ]);
        
        $ch = new Produit;
        $ch->designation = $request->designation;
        $ch->prix_unique = $request->prix_unique;
        $ch->qte = $request->qte;
        $ch->save();
        Session::flash('success','consommation enregistrer avec succés');
        return redirect()->back();
      }
      public function listeCons(){
        $listes = DB::table('produits')
        ->select('*')
        ->paginate(5);
    
       return view('consommation.liste_cons',['listes' => $listes]);
       }

       public function updateCons(Request $request){
   
        $id = \Request::get('id');
        $this->validate($request,[
           
            'designation' => 'required',
            'qte' => 'required|numeric',
            'prix_unique' => 'required|numeric',
           
          
        ],[
           
            'designation.required' =>'Champ obligatoire',
            'prix_unique.required' =>'Champ obligatoire',
            'qte.required' =>'Champ obligatoire',
            'qte.numeric' =>'Quantite incorrecte',
            'prix_unique.numeric' =>'Prix incorrecte',
           
            
        ]);
        
        $ch = Produit::find($id);
        $ch->designation = $request->designation;
        $ch->prix_unique = $request->prix_unique;
        $ch->qte = $request->qte;
        $ch->update();
        Session::flash('successs','consommation modifié avec succés');
       
        return redirect()->back();
        }
        public function deleteCons($id){
            //recherche par rapport a id supprimer
            Produit::find($id)->delete();
        
            Session::flash('successs','Suppression avec succés');
        
           
           return redirect()->back();
        
        }
        public function searchCons(){
            $select = \Request::get('select');
            $search=\Request::get('motCle');
            if ($select == 'id') {
                $listes = DB::table('produits')
                ->select('*')
                ->where('id', '=',$search)
                ->paginate(5);
                return view('consommation.liste_cons',['listes' => $listes]);
            } elseif ($select == 'designation') {
                $listes = DB::table('produits')
                ->select('*')
                ->where('designation', 'like','%'.$search.'%')
                ->paginate(5);
                return view('consommation.liste_cons',['listes' => $listes]);
            } elseif ($select == 'qte') {
                $listes = DB::table('produits')
                ->select('*')
                ->where('qte', '=',$search)
                ->paginate(5);
                return view('consommation.liste_cons',['listes' => $listes]);
            } elseif ($select == 'prix_unique') {
                $listes = DB::table('produits')
                ->select('*')
                ->where('prix_unique', '=',$search)
                ->paginate(5);
                return view('consommation.liste_cons',['listes' => $listes]);
            } 
        }
        public function searchConsDate(){
            $search=\Request::get('date');
            $listes = DB::table('produits')
            ->select('*')
            ->where('created_at', 'like','%' .$search. '%')
            ->paginate(5);
           return view('consommation.liste_cons',['listes' => $listes]);
        }
}
