<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Categorie;
use Auth;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adauga(){
    	return view('categorii.home');
    }

    public function adaugaCategorie(Request $request){
        if(Auth::user()->responsabilDepartament == 1 || Auth::user()->administrator == 1){
            $criteriiDuplicat = array('denumire' => $request->input('departamentAdaugaCategorieDenumire'), 'cod' => $request->input('departamentAdaugaCategorieCod'));

            $verificaDuplicat = Categorie::where('departamentID', $request->input('departamentID'))->where(function($q) use ($criteriiDuplicat){
                foreach($criteriiDuplicat as $coloana => $valoare){
                    $q->orWhere($coloana, $valoare);
                }
            })->get();

            if(count($verificaDuplicat) > 0){
                return redirect()->back();
            }
            
            $categorie = new Categorie;
                $categorie->denumire = $request->input('departamentAdaugaCategorieDenumire');
                $categorie->cod = $request->input('departamentAdaugaCategorieCod');
                $categorie->departamentID = $request->input('departamentID');
            $categorie->save();

            return redirect()->back();
        }
    }

}
