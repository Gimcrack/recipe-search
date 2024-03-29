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
            ->each($this->populateIngredients(...))
            ->each($this->setImage(...));
    }

    protected function populateIngredients(Recipe $recipe): void
    {
        $recipe_ingredients = (clone $this->ingredients)
            ->shuffle()
            ->take($num_ingredients = fake()->numberBetween(6,20))
            ->mapWithKeys($this->getPivotData(...));

        // add the main ingredient
        $main = str($recipe->name)->explode(" ")->last();
        $recipe_ingredients[Ingredient::ofName($main)->id] = [
            "amount" => 3,
            "unit" => RecipeUnit::LB->value,
        ];

        $recipe->ingredients()->sync($recipe_ingredients);
    }

    protected function getPivotData(string $ingredient): array
    {
        return [
            Ingredient::ofName($ingredient)->id => [
                "amount" => fake()->numberBetween(1,4),
                "unit" => fake()->randomElement(RecipeUnit::toArray()),
                "notes" => fake()->randomElement([
                    "to taste",
                    "room temperature",
                    "chilled",
                    "frozen",
                    "in pieces",
                    "from the shores of Ireland",
                    "arranged in a hexagon",
                    "plus a little more for dipping",
                    "",
                    "",
                    "",
                    "marinated for 12 days",
                    "dry aged in butter",
                    "salted",
                    "from a dank basement"
                ])
            ]
        ];
    }

    protected function setImage(Recipe $recipe): void
    {
        $main = str($recipe->name)->explode(" ")->last();
        $variant = fake()->randomElement(["","2","3"]);

        $recipe->update([
            "image" => "https://res.cloudinary.com/codefaber/image/upload/ar_1:1,c_fill,e_art:hairspray,g_auto,w_1000/v1706381551/recipes/{$main}{$variant}.jpg"
        ]);
    }
}
