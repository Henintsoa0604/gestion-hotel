<?php

namespace App\Http\Controllers\Chambre;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Chambre;
use App\Models\Favorie;
use App\Mail\ContactMail;
use Session;
use Mail;
use DB;
use Auth;

class ChambreController extends Controller
{   
    /*
    public function __construct(){
        $this->middleware('auth:admin');
       
    }
    */
    public function showAddChambreForm(){
      $listes = DB::table('chambres')
      ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
      ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.etage_ch','chambres.img_ch','categories.description_cat')
      ->paginate(10);
        $cat = Categorie::orderBy('created_at','desc')->get();
       
        return view('chambre.add_Chambre')->with('chambre',$listes)->with('categorie',$cat);
    }
    public function ajoutChambre(Request $request){
        $this->validate($request,[
            'num_ch' => 'required|numeric|unique:chambres',
            'description_ch' => 'required',
            'nbr_lit_ch' => 'required|numeric',
            'nbr_pers' => 'required|numeric',
            'etage_ch' => 'required',
            'img_ch' => 'required|mimes:jpeg,png',
          
        ],[
            'num_ch.required' =>'Entrer numero chambre',
            'num_ch.numeric' =>'Numero chambre incorrecte',
            'num_ch.unique' =>'Le numero champbre existe est deja',
            'description_ch.required' =>'Entrer la description',
            'nbr_lit_ch.required' =>'Entrer le nombre de lit',
            'nbr_lit_ch.numeric' =>'Nombre incorrecte',
            'etage_ch.required' =>'Champ obligatoire',
            'img_ch.mimes' => 'Format image invalide',
            'img_ch.required' => 'Choisir image',
            
        ]);
        
        $ch = new Chambre;
        $ch->num_ch = $request->num_ch;
        $ch->num_tel_ch = $request->num_tel_ch;
        $ch->description_ch = $request->description_ch;
        $ch->nbr_lit_ch = $request->nbr_lit_ch;
        $ch->nbr_pers = $request->nbr_pers;
        $ch->etage_ch = $request->etage_ch;
        $ch->status_ch =  "libre";
        $ch->categorie_id = $request->categorie_id;

        if($request->hasFile('img_ch')){
            $file = $request->img_ch;
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/chambre/',$filename);
            $ch->img_ch = $filename;
        } else {
           return $request;
        }
        $ch->save();
        $listes = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.etage_ch','chambres.img_ch','categories.description_cat')
        ->paginate(10);
        Session::flash('success','chambre  ajouté avec succés');
        $cat = Categorie::orderBy('created_at','desc')->get();
        return view('chambre.add_Chambre')->with('chambre',$listes)->with('categorie',$cat);
    }
    public function listeChambre(){
        $listes = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.etage_ch','chambres.img_ch','categories.description_cat')
        ->orderBy('chambres.created_at','ask')
        ->paginate(6);
       return view('chambre.liste_chambre',['chambre' => $listes]);
    }
    public function editChambre($id){
         $ch = Chambre::find($id);
         $catModif = Categorie::orderBy('created_at','desc')->get();
         $cat =  DB::table('chambres')
         ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
         ->select('categories.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.etage_ch','chambres.img_ch','categories.description_cat')
         ->orderBy('chambres.created_at','ask')
         ->where('chambres.id', '=',$id)
         ->get();
         $listes = DB::table('chambres')
         ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
         ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.etage_ch','chambres.img_ch','categories.description_cat')
         ->orderBy('chambres.created_at','ask')
         ->paginate(6);
        
         return view('chambre.edit_chambre')->with('chambre',$ch)->with('categorie',$cat)->with('catModif',$catModif)->with('listes',$listes);
    }
    public function updateChambre(Request $request,$id){
        $this->validate($request,[
            'num_ch' => 'required|numeric',
            'num_tel_ch' => 'required',
            'description_ch' => 'required',
            'nbr_lit_ch' => 'required|numeric',
            'nbr_pers' => 'required|numeric',
            'etage_ch' => 'required',
            'categorie_id' => 'required',
           
        ],[
            'num_ch.required' =>'Entrer numero chambre',
            'num_ch.numeric' =>'Numero chambre incorrecte',
            'num_tel_ch.required' =>'Entrer numero telephone chambre',
            'description_ch.required' =>'Entrer la description',
            'nbr_lit_ch.required' =>'Entrer le nombre de lit',
            'nbr_lit_ch.numeric' =>'Nombre incorrecte',
            'etage_ch.required' =>'Champ obligatoire',
            'categorie_id.required' =>'Champ obligatoire',
         
            
        ]);
        
        $ch = Chambre::find($id);
        $ch->num_ch = $request->num_ch;
        $ch->num_tel_ch = $request->num_tel_ch;
        $ch->description_ch = $request->description_ch;
        $ch->nbr_lit_ch = $request->nbr_lit_ch;
        $ch->nbr_pers = $request->nbr_pers;
        $ch->etage_ch = $request->etage_ch;
        $ch->status_ch =  "libre";
        $ch->categorie_id = $request->categorie_id;

        
        $ch->update();
        Session::flash('success','chambre modifié avec succés');
        $cat = Categorie::orderBy('created_at','desc')->get();
        return redirect()->back();
   }
   public function deleteChambre($id){
    //recherche par rapport a id supprimer
    Chambre::find($id)->delete();

    Session::flash('success','chambre supprimer avec succés');

    
     return redirect()->back();

   }
   public function searchChambre(){
    $search=\Request::get('motCle'); 
    $listes = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch','chambres.img_ch','categories.description_cat')
    ->where('chambres.id', '=', $search)
    ->orWhere('chambres.num_ch', '=',$search)
    ->orWhere('chambres.num_tel_ch', 'like','%' .$search. '%')
    ->orWhere('chambres.description_ch', 'like','%' .$search. '%')
    ->orWhere('chambres.nbr_lit_ch', 'like','%' .$search. '%')
    ->orWhere('chambres.etage_ch', '=',$search)
    ->orWhere('chambres.status_ch', 'like','%' .$search. '%')
    ->orWhere('categories.description_cat', 'like','%' .$search. '%')
    ->paginate(6);
     return view('chambre.liste_chambre',['chambre' => $listes]);
   }
   public function searchChambreCat(){
    $select=\Request::get('select');
    $search=\Request::get('cat');
    if($select == 'id'){
      $listes = DB::table('chambres')
      ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
      ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch','chambres.img_ch','categories.description_cat')
      ->where('chambres.num_ch', '=', $search)
      
      ->paginate(6);
      return view('chambre.liste_chambre',['chambre' => $listes]);
    } elseif($select == 'nbr_lit_ch') {
      $listes = DB::table('chambres')
      ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
      ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch','chambres.img_ch','categories.description_cat')
      ->where('chambres.nbr_lit_ch', '=', $search)
      
      ->paginate(6);
      return view('chambre.liste_chambre',['chambre' => $listes]);
    } elseif($select == 'description_ch') {
      $listes = DB::table('chambres')
      ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
      ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch','chambres.img_ch','categories.description_cat')
      ->where('chambres.description_ch', 'like','%' .$search. '%')
      
      ->paginate(6);
      return view('chambre.liste_chambre',['chambre' => $listes]);
    } elseif($select == 'etage_ch') {
      $listes = DB::table('chambres')
      ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
      ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch','chambres.img_ch','categories.description_cat')
      ->where('chambres.etage_ch', 'like','%' .$search. '%')
      
      ->paginate(6);
      return view('chambre.liste_chambre',['chambre' => $listes]);
    }
   }
   public function uneChambre(){
   
    $listes = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch','chambres.img_ch','categories.description_cat')
    ->where('chambres.nbr_lit_ch', '=', 1)
    ->paginate(6);
     return view('chambre.liste_chambre',['chambre' => $listes]);
   }
   public function deuxChambre(){
   
    $listes = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch','chambres.img_ch','categories.description_cat')
    ->where('chambres.nbr_lit_ch', '=', 2)
    ->paginate(6);
     return view('chambre.liste_chambre',['chambre' => $listes]);
   }
   public function familleChambre(){
   
    $listes = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch','chambres.img_ch','categories.description_cat')
    ->where('chambres.nbr_lit_ch', '>', 2)
    ->paginate(6);
     return view('chambre.liste_chambre',['chambre' => $listes]);
   }
   public function libreChambre(){
   
    $listes = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch','chambres.img_ch','categories.description_cat')
    ->where('chambres.status_ch', '=', 'libre')
    ->paginate(6);
     return view('chambre.liste_chambre',['chambre' => $listes]);
   }
   public function reserveChambre(){
   
    $listes = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch','chambres.img_ch','categories.description_cat')
    ->where('chambres.status_ch', '=', 'reserve')
    ->paginate(6);
     return view('chambre.liste_chambre',['chambre' => $listes]);
   }
   public function liste_chambre(){
       //header
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
        //liste
        $listes = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.etage_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->orderBy('chambres.created_at','ask')
        ->paginate(9);

     
        //count

        $countLibre = DB::table('chambres')
        ->selectRaw('count(id) as count')
        ->where('status_ch','=', 'libre')
        ->get();
        $countReserve = DB::table('chambres')
        ->selectRaw('count(id) as count')
        ->where('status_ch','=', 'Reservé')
        ->get();
        $countSimple = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->selectRaw('count(chambres.id) as count')
        ->where('description_cat','=', 'Chambre simple')
        ->get();
        $countMoyenne = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->selectRaw('count(chambres.id) as count')
        ->where('description_cat','=', 'Chambre moyenne')
        ->get();
        $countLuxe = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->selectRaw('count(chambres.id) as count')
        ->where('description_cat','=', 'Chambre luxe')
        ->get();
        $countUneLit = DB::table('chambres')
        ->selectRaw('count(id) as count')
        ->where('nbr_lit_ch','=', 1)
        ->get();
        $countDeuxLit = DB::table('chambres')
        ->selectRaw('count(id) as count')
        ->where('nbr_lit_ch','=', 2)
        ->get();
        $countFamille = DB::table('chambres')
        ->selectRaw('count(id) as count')
        ->where('nbr_lit_ch','>', 2)
        ->get();
        $countPetage = DB::table('chambres')
        ->selectRaw('count(id) as count')
        ->where('etage_ch','=', 'Premiere')
        ->get();
        $countDetage = DB::table('chambres')
        ->selectRaw('count(id) as count')
        ->where('etage_ch','=', 'Deuxieme')
        ->get();
        $countTetage = DB::table('chambres')
        ->selectRaw('count(id) as count')
        ->where('etage_ch','=', 'Troisieme')
        ->get();
        $countPlus = DB::table('chambres')
        ->selectRaw('count(id) as count')
        ->where('etage_ch','=', 'Autre')
        ->get();
        $countTotal = DB::table('chambres')
        ->selectRaw('count(id) as count')
        ->get();
        //prix
        $minprix = DB::table('categories')->min('prix_cat');
        $maxprix = DB::table('categories')->max('prix_cat');

        //betweenPrix
 
      
       return view('chambre.liste_chambre_reservation',[
    //   'simple' =>  $simpleLit ,
    //   'double' =>  $doubleLit ,
    //   'luxe' =>  $luxe ,
    //   'uneLit' =>  $uneLit,
     //  'deuxLit' =>  $deuxLit ,
    //   'famille' =>  $famille,
       'count_id' => $count_res,
       'resListe' => $resListe,
       'count_id_fav' => $count_fav,
       'favListe' => $favListe,
       'liste' => $listes,
    //   'libre' => $libre,
    //   'petage' => $petage,
    //   'detage' => $detage,
     //  'tetage' => $tetage,
       'countLibre' => $countLibre,
       'countReserve' => $countReserve,
       'countSimple' => $countSimple,
       'countMoyenne' => $countMoyenne,
       'countLuxe' => $countLuxe,
       'countUneLit' => $countUneLit,
       'countDeuxLit' => $countDeuxLit,
       'countFamille' => $countFamille,
       'countPetage' => $countPetage,
       'countDetage' => $countDetage,
       'countTetage' => $countTetage,
       'countPlus' => $countPlus,
       'countTotal' => $countTotal,
       'minprix' => $minprix,
       'maxprix' => $maxprix,
       ]);
   }
   public function liste_simple(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
    $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
    $doubleLit = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->where('categories.description_cat','=','Chambre moyenne')
    ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $doubleLit ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
   public function liste_double(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
    $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
    $simpleLit = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->where('categories.description_cat','=','Chambre simple')
    ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $simpleLit ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
   public function liste_luxe(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
    $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
    $luxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->where('categories.description_cat','=','Chambre luxe')
    ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $luxe ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
   public function liste_une(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
    $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
    $uneLit = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->where('chambres.nbr_pers','=',1)
    ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $uneLit ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
   public function liste_deux(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
      $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
  
    $deuxLit = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->where('chambres.nbr_pers','=',2)
    ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $deuxLit ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
   public function liste_famille(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
      $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
  
    $famille = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->where('chambres.nbr_lit_ch','>',2)
        ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $famille ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
   public function liste_libre(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
      $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
  
    $libre = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->where('chambres.status_ch','=','libre')
    ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $libre ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
   public function liste_reserve(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
      $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
  
    $reserve = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->where('chambres.status_ch','=','Reservé')
    ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $reserve ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
   public function liste_petage(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
      $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
  
    $petage = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->where('chambres.etage_ch','=','Premiere')
        ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $petage ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
   public function liste_detage(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
      $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
  
    $detage = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->where('chambres.etage_ch','=','Deuxieme')
    ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $detage ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
   public function liste_tetage(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
      $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
  
    $tetage = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->where('chambres.etage_ch','=','Troisieme')
        ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $tetage ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
   public function liste_plus(){
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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_pers','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
    $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');
  
    $plus = DB::table('chambres')
        ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
        ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
        ->where('chambres.etage_ch','=','Plus')
        ->paginate(9);

    return view('chambre.liste_chambre_reservation',[
      'liste' =>  $plus ,
     
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
     
      'countLibre' => $countLibre,
      'countReserve' => $countReserve,
      'countSimple' => $countSimple,
      'countMoyenne' => $countMoyenne,
      'countLuxe' => $countLuxe,
      'countUneLit' => $countUneLit,
      'countDeuxLit' => $countDeuxLit,
      'countFamille' => $countFamille,
      'countPetage' => $countPetage,
      'countDetage' => $countDetage,
      'countTetage' => $countTetage,
      'countPlus' => $countPlus,
      'countTotal' => $countTotal,
      'minprix' => $minprix,
      'maxprix' => $maxprix,
      ]);
   }
  public function liste_chambre_prix(){

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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_lit_ch','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_lit_ch','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_lit_ch','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
      $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');

    //betweenPrix
    $min=\Request::get('minprix');
    $max=\Request::get('maxprix');
    $between = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->where('categories.prix_cat','>=',$min)
    ->where('categories.prix_cat','<=',$max)
    ->get();
    return view('chambre.liste_chambre_reservation_prix',[
   
        'count_id' => $count_res,
        'resListe' => $resListe,
        'count_id_fav' => $count_fav,
        'favListe' => $favListe,
        'countLibre' => $countLibre,
        'countReserve' => $countReserve,
        'countSimple' => $countSimple,
        'countMoyenne' => $countMoyenne,
        'countLuxe' => $countLuxe,
        'countUneLit' => $countUneLit,
        'countDeuxLit' => $countDeuxLit,
        'countFamille' => $countFamille,
        'countPetage' => $countPetage,
        'countDetage' => $countDetage,
        'countTetage' => $countTetage,
        'countPlus' => $countPlus,
        'countTotal' => $countTotal,
        'minprix' => $minprix,
        'maxprix' => $maxprix,
        'between' => $between,
        'min' => $min,
        'max' => $max,
    ]);
  }
  public function liste_chambre_search(){

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
    //count

    $countLibre = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'libre')
    ->get();
    $countReserve = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('status_ch','=', 'Reservé')
    ->get();
    $countSimple = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre simple')
    ->get();
    $countMoyenne = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre moyenne')
    ->get();
    $countLuxe = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->selectRaw('count(chambres.id) as count')
    ->where('description_cat','=', 'Chambre luxe')
    ->get();
    $countUneLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_lit_ch','=', 1)
    ->get();
    $countDeuxLit = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_lit_ch','=', 2)
    ->get();
    $countFamille = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('nbr_lit_ch','>', 2)
    ->get();
    $countPetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Premiere')
    ->get();
    $countDetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Deuxieme')
    ->get();
    $countTetage = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Troisieme')
    ->get();
    $countPlus = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->where('etage_ch','=', 'Autre')
    ->get();
    $countTotal = DB::table('chambres')
    ->selectRaw('count(id) as count')
    ->get();
    //prix
      $minprix = DB::table('categories')->min('prix_cat');
    $maxprix = DB::table('categories')->max('prix_cat');

    //betweenPrix
    $etage=\Request::get('etage');
    $categorie=\Request::get('nbr_lit');
    $nbr_pers=\Request::get('nbr_pers');
    $between = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->where('chambres.etage_ch','=',$etage)
    ->where('chambres.nbr_pers','=',$nbr_pers)
    ->where('chambres.nbr_lit_ch','=',$categorie)
    ->get();
    return view('chambre.liste_chambre_reservation_search',[
   
        'count_id' => $count_res,
        'resListe' => $resListe,
        'count_id_fav' => $count_fav,
        'favListe' => $favListe,
        'countLibre' => $countLibre,
        'countReserve' => $countReserve,
        'countSimple' => $countSimple,
        'countMoyenne' => $countMoyenne,
        'countLuxe' => $countLuxe,
        'countUneLit' => $countUneLit,
        'countDeuxLit' => $countDeuxLit,
        'countFamille' => $countFamille,
        'countPetage' => $countPetage,
        'countDetage' => $countDetage,
        'countTetage' => $countTetage,
        'countPlus' => $countPlus,
        'countTotal' => $countTotal,
        'minprix' => $minprix,
        'maxprix' => $maxprix,
        'between' => $between,
        
    ]);
  }
  public function detailChambre($id){
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

    $listes = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.etage_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->where('chambres.id','=',$id)
    ->get();

    $liste_ch = DB::table('chambres')
    ->join('categories', 'chambres.categorie_id', '=', 'categories.id')
    ->select('chambres.id','chambres.nbr_pers','chambres.num_ch','chambres.num_tel_ch','chambres.description_ch','chambres.nbr_lit_ch','chambres.status_ch','chambres.etage_ch','chambres.img_ch','categories.description_cat','categories.prix_cat')
    ->get();
    return view('chambre.detail_chambre_reservation',[
      
      'count_id' => $count_res,
      'resListe' => $resListe,
      'count_id_fav' => $count_fav,
      'favListe' => $favListe,
      'listes' => $listes,
      'liste_ch' => $liste_ch,
      ]);
  }
  public function favorieChambre($id){
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
    $idch = DB::table('chambres')
     ->select('*')
    ->where('id','=',$id)
    ->first();
    $numfav = $idch->num_ch;
    $telfav = $idch->num_tel_ch;
    $descriptionfav = $idch->description_ch;
    $litfav = $idch->nbr_lit_ch;
    $persfav = $idch->nbr_pers;
    $etagefav = $idch->etage_ch;
    $statusfav = $idch->status_ch;
    $catfav = $idch->categorie_id;

   $fav = new Favorie;
   $fav->num_ch = $numfav;
   $fav->num_tel_ch = $telfav;
   $fav->description_ch = $descriptionfav;
   $fav->nbr_lit_ch = $litfav;
   $fav->nbr_pers = $persfav;
   $fav->etage_ch = $etagefav;
   $fav->status_ch = $statusfav;
   $fav->categorie_id =  $catfav;
   $fav->user_id =  $user_id;
   $fav->save();
    
   Session::flash('success','Chambre ajout au favorie');
   return redirect()->back();
  }
  public function contacte(){
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
    return view('client.contacte')->with('count_id',$count_res)
                                ->with('resListe',$resListe)
                                ->with('count_id_fav',$count_fav)
                                ->with('favListe',$favListe);
                                
  }
  public function contacte_submit(Request $request){
     $this->validate($request,[
      'nom' => 'required',
      'email' => 'required|email',
      'message' => 'required|max:1000',
    
    
  ],[
      'nom.required' =>'Entrer votre nom',
      
      'email.required' =>'Entrer votre email',
      'email.email' =>'Email incorrecte',
      'message.required' =>'Entrer votre message',
      'message.max' =>'Message trop longue',
     
      
  ]);
  $data = [
     'nom' => \Request::get('nom'),
     'email' => \Request::get('email'),
     'message' => \Request::get('message')
  ];
  Mail::to('miraygeek@gmail.com')->send(new ContactMail($data));
  Session::flash('success','message envoyer !!!');
  return redirect()->back();
 
  }
}
