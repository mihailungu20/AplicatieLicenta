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

class TemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function vizualizare($template){
        $format = TemplateArticol::find($template);

        return view('articole.template.vizualizare')
                ->with('template', $format);
    }

    public function editare(Request $request){
        $template = TemplateArticol::find($request->input('templateID'));

        $template->format = $request->input('editorTemplate');
        $template->save();

        return redirect()->back();
    }

    public function postare(Request $request){
        $template = new TemplateArticol;
        $template->departamentID = $request->input('departamentID');
        $template->titlu = $request->input('departamentAdaugaTemplateDenumire');
        $template->format = "";
        $template->save();

        return redirect()->back();
    }

    public function stergere($id){
        $template = TemplateArticol::find($id);
        if($template){
            $template->delete();
        }
        return redirect()->back();
    }

}
