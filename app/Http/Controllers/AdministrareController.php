<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Departament;


class AdministrareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $departamente = Departament::all();

        return view('administrare-site.index')
                ->with('departamente', $departamente);
    }
}
