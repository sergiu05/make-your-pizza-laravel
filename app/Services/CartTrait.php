<?php

namespace App\Services;

trait CartTrait {	
	
	/**
 	 * @return Cart
 	 */
	public function getCart() {
		if (!session()->get('cart')) {
			session()->put(['cart' => resolve(Cart::class)]);
		}
		return session()->get('cart');
	}

	/**
	 * @return Illuminate\Support\Collection
	 */
	public function getCartLines() {
		return $this->getCart()->getLines();
	}
	
}