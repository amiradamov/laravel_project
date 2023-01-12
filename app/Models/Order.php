<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_id",
        "total_amount",
        "proccessed_by",
        "order_status",
    ];
    /**
     * The item that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function item()
    {
        return $this->belongsToMany(Item::class, 'order_details')
        ->withPivot('no_of_serving')
        ->withTimestamps();
    }
}
