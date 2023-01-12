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
        ->withTimestamps()
        ->wherePivot('score', 8);
    }
}

