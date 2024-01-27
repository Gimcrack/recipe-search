<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 */
class Ingredient extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get or create the ingredient with the given name
     *
     * @param Builder $query
     * @param string $name
     * @return Model|Builder|Ingredient
     */
    public function scopeOfName(Builder $query, string $name): Model|Builder|Ingredient
    {
        return $query->firstOrCreate(["name" => str($name)->title()]);
    }

    /**
     * An Ingredient belongs to many Recipes (uses Pivot Model)
     *
     * @see \App\Models\IngredientRecipe
     * @return BelongsToMany
     */
    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class)
            ->using(IngredientRecipe::class)
            ->withPivot([
                'amount',
                'unit',
                'notes'
            ])
            ->withTimestamps();
    }
}
