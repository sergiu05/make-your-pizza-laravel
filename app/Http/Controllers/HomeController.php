<?php

namespace App\Http\Controllers;

use App\Services\OrderProcessorInterface;
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
     * The order processor instance
     */
    protected $orderProcessor;

    /**
     * Create a new controller instance
     * 
     * @param IngredientRepositoryInterface $ingredients
     */
    public function __construct(IngredientRepositoryInterface $ingredients, OrderProcessorInterface $orderProcessor) {
    	$this->ingredients = $ingredients;
        $this->orderProcessor = $orderProcessor;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
    	$ingredients = $this->ingredients->all();
    	
    	$cartItems = $this->getCart()->getLines();

    	return view('frontend.index', compact('ingredients', 'cartItems'));
    }

    public function store(Request $request) {
        $this->orderProcessor->process($this->getCart(), $request->user());
    }

}
