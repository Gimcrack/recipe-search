<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ingredient::factory()
            ->count(100)
            ->sequence(...static::getIngredients())
            ->create();

    }

    public static function getIngredients(): array
    {
        return [
            ["name" => 'Anchovies'],
            ["name" => 'Basil'],
            ["name" => 'Bay leaves'],
            ["name" => 'Bell peppers'],
            ["name" => 'Black pepper'],
            ["name" => 'Butter'],
            ["name" => 'Capers'],
            ["name" => 'Carrots'],
            ["name" => 'Catfish'],
            ["name" => 'Cayenne pepper'],
            ["name" => 'Celery'],
            ["name" => 'Chervil'],
            ["name" => 'Chilies'],
            ["name" => 'Chives'],
            ["name" => 'Cilantro'],
            ["name" => 'Clams'],
            ["name" => 'Cod'],
            ["name" => 'Coriander'],
            ["name" => 'Corn'],
            ["name" => 'Crab'],
            ["name" => 'Cream'],
            ["name" => 'Cumin'],
            ["name" => 'Dill'],
            ["name" => 'Fennel'],
            ["name" => 'Fennel seeds'],
            ["name" => 'Flour'],
            ["name" => 'Garlic'],
            ["name" => 'Ginger'],
            ["name" => 'Halibut'],
            ["name" => 'Heavy cream'],
            ["name" => 'Herring'],
            ["name" => 'Lemon'],
            ["name" => 'Lemon juice'],
            ["name" => 'Lemon zest'],
            ["name" => 'Lime'],
            ["name" => 'Lobster'],
            ["name" => 'Mackerel'],
            ["name" => 'Mahi Mahi'],
            ["name" => 'Mussels'],
            ["name" => 'Mustard'],
            ["name" => 'Mustard seeds'],
            ["name" => 'Olive oil'],
            ["name" => 'Onions'],
            ["name" => 'Oregano'],
            ["name" => 'Paprika'],
            ["name" => 'Parsley'],
            ["name" => 'Pasta'],
            ["name" => 'Pepper'],
            ["name" => 'Prawns'],
            ["name" => 'Red pepper flakes'],
            ["name" => 'Rice'],
            ["name" => 'Rosemary'],
            ["name" => 'Saffron'],
            ["name" => 'Sage'],
            ["name" => 'Salmon'],
            ["name" => 'Salt'],
            ["name" => 'Sardines'],
            ["name" => 'Scallops'],
            ["name" => 'Sea bass'],
            ["name" => 'Sea salt'],
            ["name" => 'Sherry'],
            ["name" => 'Shrimp'],
            ["name" => 'Snapper'],
            ["name" => 'Sour cream'],
            ["name" => 'Soy sauce'],
            ["name" => 'Spaghetti'],
            ["name" => 'Spinach'],
            ["name" => 'Squid'],
            ["name" => 'Star anise'],
            ["name" => 'Sugar'],
            ["name" => 'Swordfish'],
            ["name" => 'Thyme'],
            ["name" => 'Tilapia'],
            ["name" => 'Tomato paste'],
            ["name" => 'Tomato sauce'],
            ["name" => 'Tomatoes'],
            ["name" => 'Trout'],
            ["name" => 'Tuna'],
            ["name" => 'Turmeric'],
            ["name" => 'Vanilla'],
            ["name" => 'Vegetable oil'],
            ["name" => 'Vinegar'],
            ["name" => 'Water'],
            ["name" => 'White pepper'],
            ["name" => 'White wine'],
            ["name" => 'Worcestershire sauce'],
            ["name" => 'Yeast'],
            ["name" => 'Yellowfin tuna'],
            ["name" => 'Zucchini'],
            ["name" => 'Lemon grass'],
            ["name" => 'Coconut milk'],
            ["name" => 'Curry powder'],
            ["name" => 'Garam masala'],
            ["name" => 'Chickpeas'],
            ["name" => 'Lentils'],
            ["name" => 'Quinoa'],
            ["name" => 'Bulgur'],
            ["name" => 'Couscous'],
            ["name" => 'Polenta'],
            ["name" => 'Arborio rice'],
        ];
    }
}
