<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => []], function () {
    Route::name('recipes.index')->get('/recipes', [RecipeController::class, 'index']);
    Route::name('recipes.show')->get('/recipes/{slug}', [RecipeController::class, 'show']);

    Route::name('authors.index')->get('/authors', AuthorController::class);

    Route::name('ingredients.index')->get('/ingredients', IngredientController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
