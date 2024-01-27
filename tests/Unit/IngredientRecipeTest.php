<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\IngredientRecipe;
use App\Models\Recipe;
use Illuminate\Database\QueryException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientRecipeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_recipe_id()
    {
        $this->expectException(QueryException::class);

        IngredientRecipe::factory()->create([
            'recipe_id' => null
        ]);
    }

    /** @test */
    public function it_has_a_recipe()
    {
        $ir = IngredientRecipe::factory()->create([
            'recipe_id' => $recipe = Recipe::factory()->create()
        ]);

        $this->assertTrue($ir->recipe->is($recipe));
    }

    /** @test */
    public function it_has_an_ingredient_id()
    {
        $this->expectException(QueryException::class);

        IngredientRecipe::factory()->create([
            'ingredient_id' => null
        ]);
    }

    /** @test */
    public function it_has_an_ingredient()
    {
        $ir = IngredientRecipe::factory()->create([
            'ingredient_id' => $ingredient = Ingredient::factory()->create()
        ]);

        $this->assertTrue($ir->ingredient->is($ingredient));
    }

    /** @test */
    public function it_has_an_amount()
    {
        $this->expectException(QueryException::class);

        IngredientRecipe::factory()->create([
            'amount' => null
        ]);
    }

    /** @test */
    public function it_has_a_unit()
    {
        $this->expectException(QueryException::class);

        IngredientRecipe::factory()->create([
            'unit' => null
        ]);
    }

    /** @test */
    public function it_can_have_optional_notes()
    {
        $ir = IngredientRecipe::factory()->create([
            'notes' => null
        ]);

        $this->assertNull($ir->notes);
    }
}
