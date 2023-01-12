<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        "ingredient_name",
    ];

    /**
     * The roles that belong to the Ingredient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function item()
    {
        return $this->belongsToMany(Item::class, "item_ingredients")
        ->withTimestamps();
    }
}

