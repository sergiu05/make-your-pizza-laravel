<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\IngredientRepositoryInterface;
use App\Services\CartTrait;

class HomeController extends Controller
{
	use CartTrait;

    /**
     * The ingredient repository instance
     */
    protected $ingredients;

    /**
     * Create a new controller instance
     * 
     * @param IngredientRepositoryInterface $ingredients
     */
    public function __construct(IngredientRepositoryInterface $ingredients) {
    	$this->ingredients = $ingredients;
    }

    public function index() {
    	$ingredients = $this->ingredients->all();
    	
    	$cartItems = $this->getCart()->getLines();

    	return view('frontend.index', compact('ingredients', 'cartItems'));
    }

    public function store() {

    }

}
