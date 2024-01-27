<?php

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->foreignIdFor(Recipe::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Ingredient::class)->constrained()->cascadeOnDelete();
            $table->unsignedDecimal('amount',10,2);
            $table->string('unit',20);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->primary(['recipe_id','ingredient_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_recipe');
    }
};
