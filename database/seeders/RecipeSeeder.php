<?php

namespace Database\Seeders;

use App\Enums\RecipeUnit;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{

    protected \Illuminate\Support\Collection $ingredients;

    public function __construct()
    {
        $this->ingredients = Ingredient::all()->pluck('name');
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recipe::factory()
            ->count(200)
            ->create()
            ->each($this->populateIngredients(...));
    }

    protected function populateIngredients(Recipe $recipe): void
    {
        $recipe_ingredients = (clone $this->ingredients)
            ->shuffle()
            ->take($num_ingredients = fake()->numberBetween(6,20))
            ->mapWithKeys($this->getPivotData(...));

        $recipe->ingredients()->sync($recipe_ingredients);
    }

    protected function getPivotData(string $ingredient): array
    {
        return [
            Ingredient::ofName($ingredient)->id => [
                "amount" => fake()->numberBetween(1,4),
                "unit" => fake()->randomElement(RecipeUnit::toArray()),
                "notes" => fake()->sentence()
            ]
        ];
    }
}
