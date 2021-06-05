<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Departament;
use \App\Categorie;
use \App\Functie;
use \App\Articol;
use \App\TemplateArticol;
use Auth;

class PanouControl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($departament){
        $depInfo = Departament::where('id', $departament)->first();
        if($depInfo != null){
            if(($depInfo->id == Auth::user()->departamentID && Auth::user()->responsabilDepartament = 1) || Auth::user()->administrator == 1){
                $listaUtilizatori = User::where('departamentID', $departament)->get();
                $functii = Functie::where('departamentID', $departament)->get();
                $templateArticole = TemplateArticol::where('departamentID', $departament)->get();
                
                $categoriiDepartament = Categorie::where('departamentID', $departament)->get();
                $categoriiArticole = $categoriiDepartament->toArray();
                
                $selectareArticoleNeaprobate = Articol::where(function ($q) use ($categoriiArticole){
                    foreach($categoriiArticole as $a => $v)
                    $q->orWhere('categorieID', $v['id']);
                })->where('aprobat', 0)->get();

                $categoriiArticoleNeaprobate = $categoriiDepartament->keyBy('id')->toArray();

                $articoleNeaprobate = array();

                $i = 0;

                foreach($selectareArticoleNeaprobate as $articol){
                    $articoleNeaprobate[$i]['id'] = $articol->id;
                    $articoleNeaprobate[$i]['titlu'] = $articol->titlu;
                    $articoleNeaprobate[$i]['categorie'] = $categoriiArticoleNeaprobate[$articol->categorieID]['denumire'];
                    $articoleNeaprobate[$i]['cod'] = $depInfo->cod . '-' . $categoriiArticoleNeaprobate[$articol->categorieID]['cod'] . '-' . $articol->codIdentificare;
                    $articoleNeaprobate[$i]['autor'] = User::find($articol->creat_de)->name;
                    $articoleNeaprobate[$i]['data'] = ($articol->created_at === null) ? $articol->creat_la : $articol->created_at;
                    $i++;
                }

                //dd($articoleNeaprobate);
            
                return view('panou-control/index')
                    ->with('departament', $depInfo)
                    ->with('utilizatori', $listaUtilizatori)
                    ->with('categorii', $categoriiDepartament)
                    ->with('functii', $functii)
                    ->with('articole', $articoleNeaprobate)
                    ->with('template', $templateArticole);
            } else {
                abort(404);
            }
        }
    }
}
