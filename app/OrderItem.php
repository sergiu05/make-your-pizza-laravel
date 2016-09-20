<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'price', 'order_id'];

    /**
     * Get the order that owns this order item
     */
    public function order() {
    	return $this->belongsTo(Order::class);
    }
}
