<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'price', 'category_id'];

    /**
     * Get the price in decimals
     *
     * @param integer $value
     * @return float
     */
    public function getPriceAttribute($value) {
    	return round($value / 100, 2);
    }

    /**
     * Store the price in integer
     *
     * @param float $value
     * @return void
     */
    public function setPriceAttribute($value) {
    	$this->attributes['price'] = round($value, 2) * 100; 
    }

    /**
     * Get the category that owns the ingredient
     */
    public function category() {
    	return $this->belongsTo(Category::class);
    }
}
