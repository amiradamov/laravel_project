<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Get all of the item for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected $fillable = [
    'category_name',
    'description',
    'category_status'];
    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
