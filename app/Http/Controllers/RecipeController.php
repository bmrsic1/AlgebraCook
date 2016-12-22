<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Ingredient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
	//index stranica
	public function index(Request $request)
	{
	return view('recipes.index')
	->with('recipes', Recipe::get());
	}

	//dodavanje recepta
	public function add()	
	{
	return view('recipes.add');
	}
	
	//Pregled recepta
	public function view($id)	
	{
	return view('recipes.view')
	->with('recipe', Recipe::find($id));
	}
	
	public function edit($id)	
	{
	return view('recipes.edit')
	->with('recipe', Recipe::find($id));
	}
	
	public function update(Request $request)	
	{
	
	$data=$request->all();
	$recipe=Recipe::find($data['id']);
	
	if($recipe->creator_id !== auth()->user()->id)
		return redirect()->action('RecipeController@index');
	
	foreach($recipe->ingredients as $ingrediant)
	$ingrediant->delete();
	
	$recipe->name=$data['name'];
	$recipe->description=$data['description'];
	
	if($recipe->save()){
		foreach($data['ingredient'] as $key=>$value) {
			$sastojak=new Ingredient;
			$sastojak->name=$value;
			$sastojak->recipe_id=$recipe->id;
			$sastojak->save();
		}
	}
	return redirect()->action('RecipeController@index');
	}

	public function save(Request $request)
	{
		$data=$request->all();
		$noviRecept=new Recipe;
		$noviRecept->name=$data['name'];
		$noviRecept->description=$data['description'];
		$noviRecept->creator_id=auth()->user()->id;
		
		if($noviRecept->save()){
			foreach($data['ingredient'] as $key=>$value){
				$sastojak=new Ingredient;
				$sastojak->name=$value;
				$sastojak->recipe_id=$noviRecept->id;
				$sastojak->save();
			}
		}
		return redirect()->action('RecipeController@index');
	}
	
	public function deleteRecipe($id)	
	{
	Recipe::findOrFail($id)->delete();
	
	return redirect('/')
			->withInput();
	}

}