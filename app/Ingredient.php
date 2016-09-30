<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\ProductInterface;

class Ingredient extends Model implements ProductInterface
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'price', 'category_id', 'image_name'];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = ['category_id', 'created_at', 'updated_at', 'image_name'];

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

    public function getUrl() {
    	return '/uploads/' . $this->attributes['image_name'];
    }

    public function getId() {
    	return $this->id;
    }

    public function getPrice() {
    	return $this->price;
    }

    public function getName() {
    	return $this->name;
    }

    /**
     * @return string
     */
    public function getCategoryName() {
        return $this->category->name;
    }

}
