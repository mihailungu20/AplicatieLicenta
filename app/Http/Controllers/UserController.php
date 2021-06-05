<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Functie;
use \App\Articol;
use Auth;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function vizualizareProfil($id){
		$user = User::find($id);
		$articole = Articol::where('creat_de', $id)->where('aprobat', 1)->get();

		if($id !== null){
			$user = User::find($id);
			if($user == null){
				App::abort(404, "ERROR");
			}
			
			$functie = Functie::where('id', $user->functie)->first();
			return view('utilizator.profil')
					->with('user', $user)
					->with('userData', array('functie' => (!$functie) ? "-" : $functie->titlu))
					->with('articole', $articole);
		} else {
			App::abort(404, "ERROR");
		}
	}


}
