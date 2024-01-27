<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\Recipe;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeederTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_seed_the_ingredients()
    {
        $this->artisan('db:seed',["--class" => 'IngredientSeeder',"--env" => 'TESTING']);

        $this->assertEquals(100, Ingredient::count());
    }

    /** @test */
    public function it_can_seed_the_recipes()
    {
        $this->artisan('db:seed',["--class" => 'IngredientSeeder',"--env" => 'TESTING']);
        $this->artisan('db:seed',["--class" => 'RecipeSeeder',"--env" => 'TESTING']);

        $this->assertEquals(200, Recipe::count());
    }
}
