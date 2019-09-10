<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use App\Models\Food;
use App\Models\Ingredient;
use App\Models\Instruction;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();

        return view('recipe.index', compact('recipes'));
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
        $data = $request->all();
        $recipe = Recipe::create(['name' => $data['name']]);
        foreach ($data['ingredients'] as $order => $ingredient) {
            $food = Food::retrieveOrCreate($ingredient['ingredient']);
            Ingredient::create([
                'recipe_id' => $recipe->id,
                'food_id' => $food->id,
                'amount' => $ingredient['amount']['quantity'],
                'amount_unit' => $ingredient['amount']['unit'],
                'order' => $order
            ]);
        }
        foreach ($data['instructions'] as $order => $instruction) {
            Instruction::create([
                'recipe_id' => $recipe->id,
                'instruction' => $instruction,
                'order' => $order
            ]);
        }

        return response()->json($recipe, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $recipe->load('ingredients.food', 'instructions');
        
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
        $recipe->load('ingredients.food', 'instructions');

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
        $data = $request->all();
        $recipe->name = $data['name'];
        foreach ($data['ingredients'] as $order => $ingredient) {
            $food = Food::retrieveOrCreate($ingredient['ingredient']);
            $ing = Ingredient::firstOrCreate([
                'recipe_id' => $recipe->id,
                'food_id' => $food->id
            ]);
            $ing->amount = $ingredient['amount']['quantity'];
            $ing->amount_unit = $ingredient['amount']['unit'];
            $ing->order = $order;
            $ing->save();
        }
        foreach ($data['instructions'] as $order => $instruction) {
            $ins = Instruction::firstOrCreate([
                'recipe_id' => $recipe->id,
                'order' => $order
            ]);
            $ins->instruction = $instruction;
            $ins->save();
        }
        $recipe->save();

        return response()->json($request, 200);
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