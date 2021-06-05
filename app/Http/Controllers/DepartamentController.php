<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Departament;
use \App\Categorie;
use \App\Articol;
use Auth;

class DepartamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
          
    public function actualizare(Request $request){
        if(Auth::user()->responsabilDepartament == 1 || Auth::user()->administrator == 1){
            $departament = Departament::find($request->departamentID);

            if($departament){
                $departament->denumire = $request->input('departamentTitlu');
                $departament->cod = $request->input('departamentCodDocumente');
                $departament->save();

                return redirect()->back();
            } else {
                // afisare eroare/erori
                return redirect()->back();
            }
        }
    }

    public function adaugaDepartament(Request $request){
        if(Auth::user()->administrator == 1){
            $verificareDuplicat = Departament::where('denumire', $request->input('departamentTitlu'))->orWhere('cod', $request->input('departamentTitluCod'))->get();
            if($verificareDuplicat){
                //return redirect()->back();
            }

            $departament = new Departament;
            $departament->denumire = $request->input('departamentTitlu');
            $departament->cod = $request->input('departamentCod');
            $departament->save();
        }
        
        return redirect()->back();
    }

    public function stergereDepartament($id){
        $departament = Departament::find($id);
        $categorii = Categorie::where('departamentID', $id)->get();
        if(count($categorii) == 0){
            $departament->delete();
            return redirect()->back();
        } else {
            $articole = Articol::where(function ($q) use ($categorii){
                foreach($categorii as $categorie){
                    $q->orWhere('categorieID', $categorie->id);
                }
            })->get();
           //dd($articole);
            if($articole){
                return redirect()->back();
            } else {
                $departament->delete(); 
                return redirect()->back();
            }
            echo "X";
        }
       
    }

    public function vizualizareLista($departament){
        $depInfo = Departament::find($departament);
        if(!$depInfo){
            abort(404);
        }
        $categoriiDepartament = Categorie::where('departamentID', $departament)->get();
        $articoleDepartament = Articol::where(function ($q) use ($categoriiDepartament){
            foreach($categoriiDepartament as $categorie){
                $q->orWhere('categorieID', $categorie->id);
            }
        })->get();

        dd($articoleDepartament);

        $articoleDisponibile = array();

        $i = $x = 0;

    }

}
