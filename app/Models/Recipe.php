<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'slug'
    ];

    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn():string => str($this->name)->slug()->prepend($this->id . "-"),
        );
    }

    protected function steps(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => json_decode($value, true),
            set: fn($value) => is_null($value) ? null : json_encode($value),
        );
    }

    /**
     * Find the recipe of the corresponding slug
     *
     * @param string $slug
     * @return Recipe|null
     */
    public static function ofSlug(string $slug): Recipe|null
    {
        try {
            return Recipe::find(id: intval($slug));
        }
        catch(ModelNotFoundException $e)
        {
            return null;
        }
    }

    /**
     * A Recipe BelongsToMany Ingredients (uses Pivot Model)
     *
     * @see \App\Models\IngredientRecipe
     * @return BelongsToMany
     */
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)
            ->using(IngredientRecipe::class)
            ->withPivot([
                'amount',
                'unit',
                'notes'
            ])
            ->withTimestamps();
    }
}
