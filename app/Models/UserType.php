<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_type_name',
        'user_type_status',
    ];

    /**
     * Get all of the comments for the UserType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function User()
    {
        return $this->hasMany(User::class);
    }
}
