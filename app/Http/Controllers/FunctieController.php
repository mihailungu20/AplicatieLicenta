<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Functie;
use Auth;

class FunctieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function adaugare(Request $request){
        //$verificaDuplicat = Functie::where('titlu', $request->input('departamentTitluFunctie'))->get();

        //dd($request->input('departamentTitluFunctie'));

        if(Auth::user()->responsabilDepartament = 1 || Auth::user()->administrator == 1){
            $functie = new Functie;
            $functie->titlu = $request->input('departamentTitluFunctie');
            $functie->departamentID = $request->input('departamentID');
            $functie->save();
        }
        return redirect()->back();
    }
}
