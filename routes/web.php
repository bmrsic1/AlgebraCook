<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
*/


Route::group(['middleware' => 'web'], function () {

	// Rute vezane za autentifikaciju
    Route::auth();
	Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    // Home
	Route::get('/', function () { return view('welcome'); });

	// Recipes
	/*
		Ovdje treba dodati route za prikaz i editiranje recepata
		 - popis recepata
		 - form za unos recepta
		 - spremanje recepta u bazu
		 
		 - prikaz odabranog recepta
		 
		 - form za izmjenu odabranog recepta
		 - spremanje izmijenjenog recepta u bazu
	*/
	
	
	// User
    Route::get('/profil', 'UsersController@profil');
    Route::post('/profil', 'UsersController@profil');

	//Recepti
	
	Route::get('/recipes', 'RecipeController@index');
	
	/*
	Dodaj novi recept
	*/
	Route::get('/recipe/add', 'RecipeController@add');
	Route::post('/recipe/add', 'RecipeController@save');
	
	/*
	Pregled recepta
	*/
	Route::get('/recipes/view/{id}', 'RecipeController@view');
	
	/*
	Editiranje recepta
	*/
	Route::get('/recipes/edit/{id}', 'RecipeController@edit');
	Route::post('/recipes/edit', 'RecipeController@update');

	
});