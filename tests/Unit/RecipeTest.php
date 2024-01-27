<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_name()
    {
        $this->expectException(QueryException::class);

        Recipe::factory()->create([
            'name' => null
        ]);
    }

    /** @test */
    public function it_has_a_description()
    {
        $this->expectException(QueryException::class);

        Recipe::factory()->create([
            'description' => null
        ]);
    }

    /** @test */
    public function it_has_an_author()
    {
        $this->expectException(QueryException::class);

        Recipe::factory()->create([
            'author' => null
        ]);
    }

    /** @test */
    public function it_has_steps()
    {
        $this->expectException(QueryException::class);

        Recipe::factory()->create([
            'steps' => null
        ]);
    }

    /** @test */
    public function it_can_get_the_slug_from_the_name()
    {
        /**
         * @var Recipe $recipe
         */
        $recipe = Recipe::factory()->create();

        $this->assertEquals($recipe->slug, str($recipe->name)->slug()->prepend($recipe->id . "-")->toString());
    }

    /** @test */
    public function it_can_find_a_recipe_by_slug()
    {
        /**
         * @var Recipe $recipe
         */
        $recipe = Recipe::factory()->create();

        $this->assertTrue(Recipe::ofSlug($recipe->slug)->is($recipe));
    }

    /** @test */
    public function it_has_ingredients()
    {
        $recipe = Recipe::factory()->create();

        $recipe->ingredients()->sync([
            Ingredient::ofName('Water')->id => [
                'amount' => 1,
                'unit' => 'c',
                'notes' => "Tepid"
            ],
            Ingredient::ofName('Egg')->id => [
                'amount' => 2,
                'unit' => 'ea',
                'notes' => "Large"
            ]
        ]);

        $this->assertCount(2, $recipe->ingredients);
    }
}
