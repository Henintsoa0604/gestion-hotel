<?php

namespace App\Http\Controllers\Categorie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Categorie;
use Session;
use DB;
class CategorieController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
       
    }
    public function showAddCategorieForm(){
        $liste = DB::table('categories')->paginate(10);        

        return view('categorie.add_categorie')->with('categorie',$liste);
    }
    public function ajoutCategorie(Request $request){
        $this->validate($request,[
            'code_cat' => 'required|string|max:500|unique:categories',
            'description_cat' => 'required',
            'prix_cat' => 'required|max:255',
           
        ],[
            'code_cat.required' =>'le code est obligatoire',
            'code_cat.string' =>'le code est incorrecte',
            'code_cat.max' =>'Le code est trop longue',
            'code_cat.unique' =>'Ce code  existe est deja',
            'description_cat.required' =>'Description est obligatoire',
           
            'prix_cat.required' =>'Le prix est obligatoire',
           
            
        ]);
        $cat = new Categorie;
        $cat ->code_cat = $request ->code_cat;
        $cat ->description_cat = $request ->description_cat;
        $cat ->prix_cat = $request ->prix_cat;
        $cat->save();
        Session::flash('success','La categorie de chambre est ajouté avec succés');
      return redirect()->back();
    }
    public function listeCategorie(){
        $liste = DB::table('categories')->paginate(10);  
        return view('categorie.liste_categorie')->with('categorie',$liste);
    }
    public function updateCategorie(Request $request){
        $this->validate($request,[
            
            'description_cat' => 'required',
            'prix_cat' => 'required',
           
        ],[
          
            'description_cat.required' =>'Description est obligatoire',
           
            'prix_cat.required' =>'Le prix est obligatoire',
           
            
        ]);
        $id = \Request::get('id');
        $cat = Categorie::find($id);
        $cat ->description_cat = $request ->description_cat;
        $cat ->prix_cat = $request ->prix_cat;
        $cat->save();
        Session::flash('success','La categorie modifié avec succés');
      return redirect()->back();
    }
    public function deleteCat($id){
        //recherche par rapport a id supprimer
        Categorie::find($id)->delete();
        Session::flash('successs','Supression avec succés');
        return redirect()->back();
    }
}
