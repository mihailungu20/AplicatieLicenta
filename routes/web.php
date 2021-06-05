<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('articole')->group(function(){
	Route::get('vizualizare/{id}', 'ArticolController@vizualizareArticol');
	Route::get('adauga', 'ArticolController@adaugaArticol');
	Route::post('scrie', 'ArticolController@scrieArticol')->name('postareArticol');
	Route::get('editare/{id}', 'ArticolController@editareArticol');
	Route::post('salveaza', 'ArticolController@salvareArticol')->name('salvareArticol');
	Route::post('respingere', 'ArticolController@respingereArticol')->name('respingereArticol');
	Route::get('aprobare/{id}', 'ArticolController@aprobaArticol');
	Route::get('permisiuni/{id}', 'ArticolController@permisiuniArticol');
	Route::get('permite/{articol}/{departament}', 'ArticolController@adaugaPermisiuni');
	Route::get('revoca/{articol}/{departament}', 'ArticolController@revocaPermisiuni');

	Route::get('test', 'HomeController@toateDepartamentele');
});

Route::prefix('template')->group(function(){
	Route::get('vizualizare/{template}', 'TemplateController@vizualizare');
	Route::post('editare', 'TemplateController@editare')->name('editareTemplate');
	Route::post('postare', 'TemplateController@postare')->name('postareTemplate');
	Route::get('stergere/{id}', 'TemplateController@stergere');
});

Route::prefix('user')->group(function(){
	Route::get('profil/{id}', 'UserController@vizualizareProfil')->name('vizualizareProfil');
});

Route::prefix('categorie')->group(function(){
	Route::post('posteaza', 'CategorieController@adaugaCategorie')->name('postareCategorie');
});

Route::prefix('panou-control')->group(function(){
	Route::get('departament-{departament}', 'PanouControl@index');
});

Route::prefix('departament')->group(function(){
	Route::post('actualizare', 'DepartamentController@actualizare')->name('actualizareDepartament');
	Route::get('vizualizare/lista/{departament}', 'DepartamentController@vizualizareLista');
	Route::post('adauga', 'DepartamentController@adaugaDepartament')->name('adaugareDepartament');
	Route::get('stergere/{id}', 'DepartamentController@stergereDepartament');
});

Route::prefix('functie')->group(function(){
	Route::post('adauga', 'FunctieController@adaugare')->name('adaugaFunctie');
});

Route::prefix('administrare')->group(function(){
	Route::get('/', 'AdministrareController@index');
});

Auth::routes();
