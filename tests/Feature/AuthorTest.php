<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Recipe;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_a_listing_of_recipe_authors()
    {
        Recipe::factory()
            ->count(6)
            ->sequence(
                ['author' => 'john@example.com'],
                ['author' => 'jane@example.com'],
                ['author' => 'person@example.com']
            )
            ->create();

        $this->getJson(route('authors.index'))
            ->assertSuccessful()
            ->assertJsonCount(3)
            ->assertJsonFragment([
                'john@example.com'
            ])
            ->assertJsonFragment([
                'jane@example.com'
            ])
            ->assertJsonFragment([
                'person@example.com'
            ]);
    }
}
