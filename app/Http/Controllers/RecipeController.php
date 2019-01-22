<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Model\Recipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::latest()->get();

        return view('recipe.index', compact('recipe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RecipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipeRequest $request)
    {
        dump($request->all());
        // $recipe = Recipe::create($request->all());
        // return response()->json($recipe, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $recipe = Recipe::findOrFail($id);

        
        return view('recipe.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        return view('recipe.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RecipeRequest  $request
     * @param  \App\Model\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(RecipeRequest $request, Recipe $recipe)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->update($request->all());

        return response()->json($recipe, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        Recipe::destroy($id);

        return response()->json(null, 204);
    }
}