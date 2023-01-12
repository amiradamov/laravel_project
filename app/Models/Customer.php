<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_first_name',
        'customer_last_name',
        'customer_middle_name',
        'email',
        'customer_phone_number',
        'address',
        'profile_image',
        'customer_username',
        'customer_password',
    ];

    /**
     * The item that belong to the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function item()
    {
        return $this->belongsToMany(Item::class, 'ratings')->withPivot('score', 'comments')
        ->withTimestamps();
    }

}
