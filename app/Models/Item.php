<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * Get the category that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected $fillable = [
    'item_name',
    'item_price',
    'category_id',
    'item_image',
    'item_status',
    'item_description',
];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * The customer that belong to the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customer()
    {
        return $this->belongsToMany(Customer::class, 'ratings')->withPivot('score', 'comments')
        ->withTimestamps();
        // ->wherePivot('score', 8);
    }
    /**
     * The ingredient that belong to the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredient()
    {
        return $this->belongsToMany(Ingredient::class, "item_ingredients")
        ->withTimestamps();
    }
    /**
     * The order that belong to the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, "order_details")
        ->withPivot('no_of_serving')
        ->withTimestamps();
    }
}

