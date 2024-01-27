<?php

namespace App\Enums;

enum RecipeUnit: string {
    case TSP = 'tsp';
    case TBSP = 'tbsp';
    case FL_OZ = 'fl oz';
    case CUP = 'cup';
    case PINT = 'pint';
    case QUART = 'quart';
    case GALLON = 'gallon';
    case OZ = 'oz'; // dry ounce
    case LB = 'lb'; // pound
    case ML = 'ml'; // milliliter
    case L = 'l'; // liter
    case G = 'g'; // gram
    case KG = 'kg'; // kilogram

    public static function toArray() : array
    {
        return collect(RecipeUnit::cases())->map->value->toArray();
    }
}

