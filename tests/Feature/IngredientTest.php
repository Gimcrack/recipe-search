<?php


use App\Models\Author;
use App\Models\Ingredient;
use App\Models\Recipe;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_a_listing_of_recipe_authors()
    {
        $this->artisan('db:seed',["--class" => 'IngredientSeeder',"--env" => 'TESTING']);

        $this->assertEquals(100, Ingredient::count());

        $this->getJson(route('ingredients.index'))
            ->assertSuccessful()
            ->assertJsonCount(100)
            ->assertJsonFragment([
                'Salmon'
            ])
            ->assertJsonFragment([
                'Cod'
            ])
            ->assertJsonFragment([
                'Halibut'
            ]);
    }
}
