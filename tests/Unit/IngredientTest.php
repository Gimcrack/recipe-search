<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\QueryException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_name()
    {
        $this->expectException(QueryException::class);

        Ingredient::factory()->create([
            'name' => null
        ]);
    }

    /** @test */
    public function it_has_a_unique_name()
    {
        $this->expectException(QueryException::class);

        Ingredient::factory()->create([
            'name' => 'Salmon'
        ]);

        Ingredient::factory()->create([
            'name' => 'Salmon'
        ]);
    }

    /** @test */
    public function it_can_get_ingredients_by_name()
    {
        $ing1 = Ingredient::factory()->create(['name' => 'Water']);
        $ing2 = Ingredient::factory()->create(['name' => 'Olive Oil']);

        $this->assertEquals($ing1->id, Ingredient::ofName("water")->id);
        $this->assertEquals($ing2->id, Ingredient::ofName("olive oil")->id);
    }

    /** @test */
    public function it_has_recipes()
    {
        $ing1 = Ingredient::factory()->create(['name' => 'Water']);

        $recipes = Recipe::factory()->count(6)->create();

        $recipes->each(function($recipe) {
            $recipe->ingredients()->sync([
                Ingredient::ofName('water')->id => [
                    'amount' => 1,
                    'unit' => 'c'
                ]
            ]);
        });

        $this->assertCount(6, $ing1->recipes);
    }
}
