<?php

namespace Database\Factories;

use Database\Seeders\IngredientSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use function vprintf;
use function vsprintf;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->getName(),
            'description' => $this->getDescription($name),
            'author' => fake()->randomElement([
                'john@example.com',
                'jane@example.com',
                'jim@example.com',
                'jeremy@example.com',
                'foodie@example.com'
            ]),
            'steps' => $this->getSteps($name)
        ];
    }

    protected function getName(): string
    {
        return str(vsprintf("%s %s %s %s", [
            fake()->randomElement(["Mom's", "Dad's", "Grandma's", "Grandpa's", "Jeremy's", "Chef's"]),
            fake()->randomElement($superlatives = [
                "World Famous",
                "Award Winning",
                "Best",
                "No Compromises",
                "Most Edible",
                "Dubious",
                "Critical",
                "Chef-Kissed",
                "Unparalleled",
                "Cromulent",
                "Galactic",
                "Legendary",
                "Fantastic",
                "Pretty Good",
                "Dreamy",
                "Mouth-Watering",
                "Savory",
                "Epic",
                "Magical",
                "Sizzling",
                "Secret Recipe",
                "Heartwarming",
                "Delicious",
                "Tempting",
                "Celestial"
            ]),
            fake()->randomElement([
                "BBQ",
                "grilled",
                "poached",
                "steamed",
                "sous vide",
                "smoked",
                "broiled",
                "air fried",
                "pan fried",
                "deep fried"
            ]),
            fake()->randomElement(["salmon", "cod", "trout", "lobster", "mussels", "shrimp", "scallops"])
        ]))->title();
    }

    protected function getDescription($name): string
    {
        return match (str($name)->explode(" ")->last()) {
            "Trout" => "A family favorite, this recipe involves a unique blend of herbs and spices for smoking trout, creating a flavorful and moist dish that's perfect for gatherings.",
            "Salmon" => "Featuring a homemade BBQ marinade, this recipe turns fresh salmon into a savory, smoky delight, ideal for summer barbecues and family dinners.",
            "Cod" => "A gentle poaching method is used to perfectly cook the cod, which is then served with a light, herby sauce, making it a hit at family events.",
            "Mussels" => "This recipe treats mussels with a special BBQ twist, using a blend of spices and a grilling technique that brings out their natural flavors.",
            "Scallops" => "A unique recipe that combines smoking with a special marinade to create tender, flavorful scallops that are always a crowd-pleaser.",
            "Lobster" => "This luxurious dish involves grilling lobsters with a rich, buttery sauce, making it a sought-after recipe during special occasions.",
            "Shrimp" => "Known for its simplicity and elegance, this recipe gently poaches shrimp in a flavorful broth, resulting in a delicate and delicious appetizer or main dish.",
            default => "We haven't been brave enough to try it, but we're fairly confident it's not poisonous"
        };
    }

    protected function getSteps($name): array
    {
        return match (str($name)->explode(" ")->last()) {
            "Trout" => [
                "1. Charm the trout with Dad’s secret fish-whispering technique, then gently smoke it over a bed of mystical herbs gathered under a full moon.",
                "2. Serenade the smoking trout with your favorite campfire songs to infuse it with joy and a hint of whimsy.",
                "3. Serve the trout with a side of laughter and tall tales of legendary family fishing adventures."
            ],
            "Salmon" => [
                "1. Slather the salmon with Dad’s BBQ sauce, rumored to contain the essence of a thousand sunsets and the sweetness of summer’s first love.",
                "2. Grill the salmon while performing a BBQ dance to ensure even cooking and imbue it with the spirit of the grill master.",
                "3. Present the salmon on a platter of wildflowers, singing its praises to all who will partake."
            ],
            "Cod" => [
                "1. Gently poach the cod in a broth brewed from the tears of mermaids and a pinch of Grandpa’s secret sea salt.",
                "2. Whisper old sea shanties to the cod as it cooks, ensuring it absorbs the tales of the ocean deep.",
                "3. Serve the cod with a garnish of seashells and a sprinkle of pixie dust for an enchanting finish."
            ],
            "Mussels" => [
                "1. Engage the mussels in a lively debate about the merits of BBQ vs. traditional cooking, then grill them to perfection.",
                "2. Sprinkle the mussels with a dusting of moonbeam glitter and a splash of ocean essence.",
                "3. Arrange the mussels in a pattern resembling ancient sea maps, ready for a culinary treasure hunt."
            ],
            "Scallops" => [
                "1. Convince the scallops of their starring role in Mom’s famous dish, then smoke them over a bed of enchanted applewood.",
                "2. Sing lullabies to the scallops as they smoke, ensuring they are soothed and tender.",
                "3. Serve the scallops on a canvas of seaweed art, accompanied by a chorus of sea nymphs."
            ],
            "Lobster" => [
                "1. Pamper the lobsters with a spa day, including a seaweed wrap, before grilling them in Grandma’s legendary butter sauce.",
                "2. Tell the lobsters tales of grand banquets and regal feasts as they grill, preparing them for their moment of glory.",
                "3. Serve the lobster with a tiara of lemon slices and a scepter of fresh herbs, fit for seafood royalty."
            ],
            "Shrimp" => [
                "1. Initiate the shrimp into Grandpa’s secret poaching society, using a broth made from the fountain of youth and a dash of liquid moonlight.",
                "2. Gently simmer the shrimp while reciting an ancient mariner’s poem, allowing them to soak up the rhythm and rhyme.",
                "3. Arrange the shrimp in a spiral galaxy formation, garnished with stardust and a side of cosmic wonder."
            ]
        };
    }
}
