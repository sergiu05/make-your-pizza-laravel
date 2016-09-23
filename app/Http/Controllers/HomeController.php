<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\IngredientRepository;

class HomeController extends Controller
{
    /**
     * The ingredient repository instance
     */
    protected $ingredients;

    /**
     * Create a new controller instance
     * 
     * @param IngredientRepository $ingredients
     */
    public function __construct(IngredientRepository $ingredients) {
    	$this->ingredients = $ingredients;
    }

    public function index() {
    	$ingredients = $this->ingredients->all();

    	return view('frontend.index', compact('ingredients'));
    }

}
