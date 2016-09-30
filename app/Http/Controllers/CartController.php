<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\IngredientRepositoryInterface;
use App\Services\Cart;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\CartTrait;

class CartController extends Controller {

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

	/**
	 * @return \Illuminate\Support\Collection
	 */
	public function index() {

		$items = $this->getCart()->getLines();
		
		return view('partials.cart', compact('items'));
	}

	/**
	 * @param $productId int
	 * @return Illuminate\Http\Response
	 *
	 */
	public function addToCart($productId) {
		$product = $this->ingredients->getById($productId);

		if ($product) {
			try {
				$this->getCart()->addItem($product, 1);
				return response()->json([
					'success' => true,
					'product' => $product
				]);	
			} catch (\Exception $e) {								
				return response()->json(['error' => 400, 'message' => $e->getMessage()], 400);
			}
			
		}		
		return response()->json(['error' => 400, 'message' => "No product with id {$productId}."], 400);
	}

	/**
	 * @param $productId int
	 * @return Illuminate\Http\Response
	 */
	public function removeFromCart($productId) {
		$product = $this->ingredients->getById($productId);

		if ($product) {
			$this->getCart()->removeLine($product);
			return response()->json([
				'success' => true,
				'product' => $product
			]);
		}
		throw (new ModelNotFoundException)->setModel('Ingredient');		
	}


}