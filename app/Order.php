<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['address', 'city', 'country', 'gift_wrap', 'order_name', 'total', 'user_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    	'gift_wrap' => 'boolean'
    ];

    /**
     * Get the total value in cents
     *
     * @param integer $value
     * @return float
     */
    public function getTotalAttribute($value) {
    	return round($value / 100, 2);
    }

    /**
     * Set the total value in cents
     *
     * @param float $value
     * @return void
     */
    public function setTotalAttribute($value) {
    	$this->attributes['total'] = round(value, 2) * 100;
    }

    /**
     * Get the user that owns the order
     */
    public function user() {
    	return $this->belongsTo(User::class);
    }

    /**
     * Get the items
     */
    public function items() {
    	return $this->hasMany(OrderItem::class);
    }
}
