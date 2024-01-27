<?php

namespace Tests\Feature;

use App\Enums\RecipeUnit;
use App\Models\Ingredient;
use App\Models\IngredientRecipe;
use App\Models\Recipe;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_a_listing_of_recipes()
    {
        $recipes = Recipe::factory()
            ->count(3)
            ->create();

        $this->getJson(route('recipes.index'))
            ->assertSuccessful()
            ->assertJsonCount(3, key: 'data')
            ->assertJsonFragment([
                'name' => $recipes[0]->name
            ]);
    }

    /** @test */
    public function it_can_get_a_single_recipe()
    {
        [$r1, $r2, $r3] = Recipe::factory()
            ->count(3)
//            ->hasAttached(Ingredient::factory()->count(3), [
//                'amount' => 1,
//                'unit' => RecipeUnit::CUP->value
//            ])
            ->create();

        $this->getJson(route('recipes.show', $r1->slug))
            ->assertSuccessful()
            ->assertJsonFragment([
                'name' => $r1->name
            ]);

        $this->getJson(route('recipes.show', $r2->slug))
            ->assertSuccessful()
            ->assertJsonFragment([
                'name' => $r2->name
            ]);

        $this->getJson(route('recipes.show', $r3->slug))
            ->assertSuccessful()
            ->assertJsonFragment([
                'name' => $r3->name
            ]);
    }

    /** @test */
    public function it_can_search_by_author_email()
    {
        $jane = Recipe::factory()
            ->count(3)
            ->create([
                'author' => 'jane@example.com'
            ]);

        $john = Recipe::factory()
            ->count(3)
            ->create([
                'author' => 'john@example.com'
            ]);

        $this->getJson(route('recipes.index') . "?email=jane@example.com")
            ->assertSuccessful()
            ->assertJsonCount(3, key: 'data')
            ->assertJsonFragment([
                'author' => 'jane@example.com'
            ])
            ->assertJsonMissing([
                'author' => 'john@example.com'
            ]);
    }

    /** @test */
    public function it_can_search_by_ingredient()
    {
        $salmon = Recipe::factory()
            ->count(3)
            ->hasAttached(Ingredient::factory()->create(['name' => 'king salmon']), [
                'amount' => 1,
                'unit' => RecipeUnit::LB->value
            ])
            ->create();

        $cod = Recipe::factory()
            ->count(3)
            ->hasAttached(Ingredient::factory()->create(['name' => 'cod']), [
                'amount' => 1,
                'unit' => RecipeUnit::LB->value
            ])
            ->create();


        $this->getJson(route('recipes.index') . "?ingredient=salmon")
            ->assertSuccessful()
            ->assertJsonCount(3, key: 'data')
            ->assertJsonFragment([
                'name' => 'king salmon'
            ])
            ->assertJsonMissing([
                'name' => 'cod'
            ]);
    }

    /** @test */
    public function it_can_search_by_ingredient_using_keyword()
    {
        $salmon = Recipe::factory()
            ->count(3)
            ->hasAttached(Ingredient::factory()->create(['name' => 'king salmon']), [
                'amount' => 1,
                'unit' => RecipeUnit::LB->value
            ])
            ->create();

        $cod = Recipe::factory()
            ->count(3)
            ->hasAttached(Ingredient::factory()->create(['name' => 'cod']), [
                'amount' => 1,
                'unit' => RecipeUnit::LB->value
            ])
            ->create();


        $this->getJson(route('recipes.index') . "?keyword=salmon")
            ->assertSuccessful()
            ->assertJsonCount(3, key: 'data')
            ->assertJsonFragment([
                'name' => 'king salmon'
            ])
            ->assertJsonMissing([
                'name' => 'cod'
            ]);
    }

    /** @test */
    public function it_can_search_by_name_using_keyword()
    {
        $fish_and_chips = Recipe::factory()
            ->count(3)
            ->create([
                'name' => 'Fish and chips'
            ]);

        $garlic_shrimp = Recipe::factory()
            ->count(3)
            ->create([
                'name' => 'Garlic shrimp'
            ]);


        $this->getJson(route('recipes.index') . "?keyword=fish and")
            ->assertSuccessful()
            ->assertJsonCount(3, key: 'data')
            ->assertJsonFragment([
                'name' => 'Fish and chips'
            ])
            ->assertJsonMissing([
                'name' => 'Garlic shrimp'
            ]);
    }

    /** @test */
    public function it_can_search_by_description_using_keyword()
    {
        $fish_and_chips = Recipe::factory()
            ->count(3)
            ->create([
                'description' => 'Fish and chips'
            ]);

        $garlic_shrimp = Recipe::factory()
            ->count(3)
            ->create([
                'description' => 'Garlic shrimp'
            ]);


        $this->getJson(route('recipes.index') . "?keyword=fish")
            ->assertSuccessful()
            ->assertJsonCount(3, key: 'data')
            ->assertJsonFragment([
                'description' => 'Fish and chips'
            ])
            ->assertJsonMissing([
                'description' => 'Garlic shrimp'
            ]);
    }

    /** @test */
    public function it_can_search_by_steps_using_keyword()
    {
        $potatoes = Recipe::factory()
            ->count(3)
            ->create([
                'steps' => [
                    'step 1 - peel the potatoes',
                    'step 2 - dice the potatoes'
                ]
            ]);

        $onions = Recipe::factory()
            ->count(3)
            ->create([
                'steps' => [
                    'step 1 - peel the onions',
                    'step 2 - dice the onions'
                ]
            ]);


        $this->getJson(route('recipes.index') . "?keyword=potato")
            ->assertSuccessful()
            ->assertJsonCount(3, key: 'data')
            ->assertJsonFragment([
                'steps' => [
                    'step 1 - peel the potatoes',
                    'step 2 - dice the potatoes'
                ]
            ])
            ->assertJsonMissing([
                'steps' => [
                    'step 1 - peel the onions',
                    'step 2 - dice the onions'
                ]
            ]);
    }
}
