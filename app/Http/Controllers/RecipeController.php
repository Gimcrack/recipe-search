<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of recipes.
     */
    public function index(Request $request)
    {
        return Recipe::with('ingredients')
            // search by email
            ->when($request->input('email'), function (Builder $query, string $email) {
                $query->where('author', $email); // exact match
            })

            // search by keyword
            ->when($request->input('keyword'), function (Builder $query, string $keyword) {
                $query
                    // search recipe name
                    ->where('name', 'like', '%' . $keyword . '%') // partial match

                    // search description
                    ->orWhere('description', 'like', '%' . $keyword . '%') // partial match

                    // search ingredients
                    ->orWhereHas('ingredients', function (Builder $qq) use ($keyword) {
                        $qq->where('name', 'like', '%' . $keyword . '%'); // partial match
                    })

                    // search steps
                    ->orWhere('steps', 'like', '%' . $keyword . '%'); // partial match
            })

            // search by ingredient
            ->when($request->input('ingredient'), function (Builder $query, string $ingredient) {
                $query->whereHas('ingredients', function (Builder $qq) use ($ingredient) {
                    $qq->where('name', 'like', '%' . $ingredient . '%'); // partial match
                });
            })
            ->paginate(10)
            ->withQueryString();
    }


    /**
     * Display the specified recipe.
     */
    public function show(string $slug)
    {
        $recipe = Recipe::ofSlug($slug);

        if (is_null($recipe)) {
            return response()->json([
                "error" => "Recipe not found"
            ], 404);
        }

        $recipe->load('ingredients');

        return response()->json($recipe, 200);
    }


}
