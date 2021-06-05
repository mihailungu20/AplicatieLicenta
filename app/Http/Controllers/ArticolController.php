<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Departament;
use \App\Categorie;
use \App\Articol;
use \App\TemplateArticol;
use \App\User;
use \App\permisiuniArticol;
use Auth;
use Carbon\Carbon;

class ArticolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vizualizareArticol($id){
        $articol = Articol::find($id);
        if(!$articol){
            abort(404);
        }

        $categorie = Categorie::find($articol->categorieID);
        $departament = Departament::find($categorie->departamentID);
        $autor = User::find($articol->creat_de);


        if($articol->aprobat != 1){
            if($articol->creat_de != Auth::user()->id){
                if(Auth::user()->administrator != 1 || Auth::user()->responsabilDepartament != 1){
                   echo $articol->creat_de . "-" . Auth::user()->id; abort(404);
                }
            }
        }

        $permisiuni = permisiuniArticol::where('articolID', $id)->where('departamentID', Auth::user()->departamentID)->get();
        if(!$permisiuni){
            return redirect()->back();
        }

        $articolInfo = array();
        $articolInfo['titlu'] = $articol->titlu;
        $articolInfo['id'] = $articol->id;
        $articolInfo['text'] = $articol->text;
        $articolInfo['categorie'] = $categorie->denumire;
        $articolInfo['departament'] = $departament->denumire;
        $articolInfo['departamentID'] = $departament->id;
        $articolInfo['autor'] = $autor->name;
        $articolInfo['autorID'] = $articol->creat_de;
        $articolInfo['data'] = $articol->created_at;
        $articolInfo['aprobat'] = $articol->aprobat;
        $articolInfo['aprobat_de'] = ($articol->aprobat == 1) ? User::find($articol->aprobat_de)->name : "-";
        $articolInfo['aprobat_la'] = ($articol->aprobat == 1) ? $articol->aprobat_la : "-";
        if($articol->aprobat == 1){
            $revizie = $articol->revizie;
        } else {
            $revizie = 0;
        }
        $articolInfo['codUnic'] = $departament->cod . '-' . $categorie->cod . '-' . $articol->codIdentificare . '-' . $revizie;

        return view('articole.vizualizare')
                ->with('articol', $articolInfo);

    }

    public function adaugaArticol(){
        $depInfo = Departament::find(Auth::user()->departamentID);
        $categorii = Categorie::where('departamentID', Auth::user()->departamentID)->get();
        $templateArticol = TemplateArticol::where('departamentID', $depInfo->id)->get();

        return view('articole.adauga')
                ->with('departament', $depInfo)
                ->with('categorii', $categorii)
                ->with('template', $templateArticol);
    }

    public function scrieArticol(Request $request){
        $template = TemplateArticol::find($request->input('articolTemplate'));

        if(!$template){
        }
       // dd($request);

        $articol = new Articol;
        $articol->titlu = $request->input('articolTitlu');
        $articol->categorieID = $request->input('articolCategorie');
        $articol->text = $template->format;
        $articol->codIdentificare = $request->input('articolCod');
        $articol->creat_de = Auth::user()->id;
        if($articol->revizie == 0 || $articol->revizie == null){
            $articol->revizie = 1;
        } else {
            $articol->revizie = $articol->revizie + 1;
        }
        $articol->save();
        
        return redirect('articole/editare/' . $articol->id);
    }

    public function editareArticol($id){
        
        $articol = Articol::find($id);

        return view('articole.editare')
                ->with('articol', $articol);
    }

    public function salvareArticol(Request $request){

        $articol = Articol::find($request->input('articolID'));

        $articol->text = $request->input('articolText');
        if($articol->aprobat == 1){
            $articol->aprobat = null;
            $articol->revizie = $articol->revizie + 1;
        }
        if($request->input('articolPentruAprobare') == 1){
            $articol->aprobat = 0;
            $articol->created_at = Carbon::now();
        }

        $articol->save();

        return redirect('articole/vizualizare/' . $articol->id);
    }

    public function respingereArticol(Request $request){
        $articol = Articol::find($request->input('articolID'));
        $articol->aprobat = null;
        $articol->save();

        //echo "X";
        return redirect()->back();
    }

    public function aprobaArticol($id){
        $articol = Articol::find($id);
        $articol->aprobat = 1;
        $articol->aprobat_de = Auth::user()->id;
        $articol->aprobat_la = Carbon::now();
        $articol->save();

        return redirect()->back();
    }

    public function permisiuniArticol($id){
        $articol = Articol::find($id);
        $permisiuniDisponibile = permisiuniArticol::where('articolID', $id)->get();
        $departamente = Departament::orWhere(function ($q) use ($permisiuniDisponibile){
            foreach($permisiuniDisponibile as $permisiune){
                $q->orWhere('id', $permisiune->departamentID);
            }
        })->get();
        $departamenteNepermise = Departament::orWhere(function ($q) use ($permisiuniDisponibile){
            foreach($permisiuniDisponibile as $permisiune){
                $q->orWhere('id', '<>', $permisiune->departamentID);
            }
        })->orWhere('id', '<>', Auth::user()->departamentID)->get();
       // $departamente = Departament::all();

        return view ('articole.permisiuni.editare')
                ->with('articol', $articol)
                ->with('departamente', $departamenteNepermise)
                ->with('permisiuni', $permisiuniDisponibile)
                ->with('listaDepartamente', $departamente->keyBy('id'));
    }

    public function adaugaPermisiuni($articol, $departament){
        $verificaPermisiune = permisiuniArticol::where('articolID', $articol)->where('departamentID', $departament)->first();

        if($verificaPermisiune === null){
            $permisiuni = new permisiuniArticol;
            $permisiuni->articolID = $articol;
            $permisiuni->departamentID = $departament;
            $permisiuni->save();
        }

        return redirect()->back();
    }

    public function revocaPermisiuni($articol, $departament){
        $permisiuni = permisiuniArticol::where('articolID', $articol)->where('departamentID', $departament);
        $permisiuni->delete();

        return redirect()->back();
    }

}
