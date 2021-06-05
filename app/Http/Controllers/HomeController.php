<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \App\Departament;
use \App\Categorie;
use \App\Articol;
use \App\permisiuniArticol;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd($this->afiseazaDepartamentPropriu());
        $depInfo = Departament::find(Auth::user()->departamentID);
        $departamentPropriu = $this->afiseazaDepartamentPropriu();
        $departamentePublice = $this->afiseazaDepartamentePublice();
        if($departamentePublice != null){
            $departamente = array_merge($this->afiseazaDepartamentPropriu(), $this->afiseazaDepartamentePublice());
        } else {
            $departamente = $departamentPropriu;
        }
        if(Auth::user()->administrator == 1){
            $departamente = $this->toateDepartamentele();
        }


        return view('home')
                ->with('articoleProprii', $this->afiseazaDepartamentPropriu())
                ->with('departamente', $departamente)
                ->with('departament', $depInfo);
    }

    public function afiseazaDepartamentPropriu(){
        
        $depInfo = Departament::find(Auth::user()->departamentID);
        if(!$depInfo){
            return view('home')->with('articole', null)->with('categorii', null)->with('departament', null);
        }
        $categoriiDisponibile = Categorie::where('departamentID', $depInfo->id)->get();
        if(!$categoriiDisponibile){
            return view('home')->with('articole', null)->with('categorii', null)->with('departament', null);
        }
        $articoleDisponibile = Articol::where('aprobat', 1)->where(function($q) use ($categoriiDisponibile){
            foreach($categoriiDisponibile as $categorie){
                $q->orWhere('categorieID', $categorie->id);
            }
        })->orWhere('creat_de', Auth::user()->id)->get();

        $categorii = $categoriiDisponibile->keyBy('id')->toArray();
        $articole = array();

        $i = 0;
        foreach($articoleDisponibile as $articol){
            $articole[$i]['id'] = $articol->id;
            $articole[$i]['titlu'] = $articol->titlu;
            $articole[$i]['categorie'] = $categorii[$articol->categorieID]['denumire'];
            $articole[$i]['autor'] = User::find($articol->creat_de)->name;
            $articole[$i]['data'] = $articol->created_at;
            $i++;
        }
        
        //dd($articole);
        $departament = array();
        $departament[0]['denumire'] = $depInfo->denumire;
        $departament[0]['id'] = $depInfo->id;
        $departament[0]['articole'] = $articole;
        //dd($departament);

        return $departament;
    }

    public function afiseazaDepartamentePublice(){
        $permisiuni = permisiuniArticol::where('departamentID', Auth::user()->departamentID)->get();
        if(count($permisiuni) == 0){
            return null;
        }
        //dd($permisiuni);
        $articole = Articol::where('aprobat', 1)->where(function ($q) use ($permisiuni){
            foreach($permisiuni as $permisiune){
                $q->orWhere('id', $permisiune->articolID);
            }
        })->get();
        //dd($articole);

        $categorii = Categorie::where(function ($q) use ($articole){
            foreach($articole as $articol){
                $q->orWhere('id', $articol->categorieID);
            }
        })->get();

       $departamente = Departament::where(function ($q) use ($categorii){
           foreach($categorii as $categorie){
               $q->orWhere('id', $categorie->departamentID);
           }
       })->get();
       //dd($departamente->toSql());

        $departamentePublice = array();
        $i = $x = 0;
        foreach($departamente as $departament){
            $departamentePublice[$i]['denumire'] = $departament->denumire;
            $departamentePublice[$i]['id'] = $departament->id;
            foreach($articole as $articol){
                $departamentePublice[$i]['articole'][$x]['id'] = $articol->id;
                $departamentePublice[$i]['articole'][$x]['titlu'] = $articol->titlu;
                $departamentePublice[$i]['articole'][$x]['categorie'] = $categorii->keyBy('id')->get($articol->categorieID)->denumire;
                $departamentePublice[$i]['articole'][$x]['autor'] = User::find($articol->creat_de)->name;;
                $departamentePublice[$i]['articole'][$x]['data'] = $articol->creat_la;
                $x++;
            }
            $i++;
        }
        //dd($departamentePublice);
        return $departamentePublice;
    }

    public function toateDepartamentele(){
        $departamente = Departament::all();

        $categorii = Categorie::where(function ($q) use ($departamente){
            foreach($departamente as $departament){
                $q->orWhere('departamentID', $departament->id);
            }
        })->get();

        $articole = Articol::where(function ($q) use ($categorii){
            foreach($categorii as $categorie){
                $q->orWhere('categorieID', $categorie->id);
            }
        })->get();

        $departamentePublice = array();
        $i = $x = 0;
        foreach($departamente as $departament){
            $departamentePublice[$i]['denumire'] = $departament->denumire;
            $departamentePublice[$i]['id'] = $departament->id;
            foreach($articole as $articol){
                if($categorii->keyBy('id')->get($articol->categorieID)->departamentID == $departament->id){
                    $departamentePublice[$i]['articole'][$x]['id'] = $articol->id;
                    $departamentePublice[$i]['articole'][$x]['titlu'] = $articol->titlu;
                    $departamentePublice[$i]['articole'][$x]['categorie'] = $categorii->keyBy('id')->get($articol->categorieID)->denumire;
                    $departamentePublice[$i]['articole'][$x]['autor'] = User::find($articol->creat_de)->name;;
                    $departamentePublice[$i]['articole'][$x]['data'] = $articol->creat_la;
                    $x++;
                }
            }
            $i++;
        }
        //dd($departamentePublice);
        return $departamentePublice;
    }

    public function adaugaArticol(){
        return view('articole.vizualizare');
    }
}
