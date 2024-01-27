<?php

namespace Database\Factories;

use Database\Seeders\IngredientSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use function vprintf;
use function vsprintf;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->getName(),
            'description' => fake()->realText(200),
            'author' => fake()->randomElement([
                'john@example.com',
                'jane@example.com',
                'jim@example.com',
                'jeremy@example.com',
                'foodie@example.com'
            ]),
            'steps' => ['step 1 ' . fake()->realText(200), 'step 2 '. fake()->realText(200), 'step 3 '. fake()->realText(200)]
        ];
    }

    protected function getName(): string
    {
        return str(vsprintf("%s %s %s %s", [
            fake()->randomElement(["Mom's","Dad's","Grandma's","Grandpa's"]),
            fake()->randomElement(["world-famous", "award-winning", "best", "no-compromises"]),
            fake()->randomElement(["BBQ","grilled","poached","steamed","sous vide","smoked"]),
            fake()->randomElement(["salmon","cod","trout","lobster","mussels","shrimp","scallops"])
        ]))->title();
    }
}
