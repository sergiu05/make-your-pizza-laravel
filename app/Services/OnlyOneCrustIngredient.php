<?php

namespace App\Services;

use App\Repositories\ProductInterface;

class OnlyOneCrustIngredient implements CartValidationInterface {

    /**
     * @param Cart $cart
     * @param ProductInterface $product
     */
    public function validate(Cart $cart, ProductInterface $product) {

	    if ("Crust" != $product->getCategoryName()) {
	        return;
        }

        $cart->getLines()->contains(function($item, $key)  {
            if ("Crust" == $item->product->getCategoryName()) {
                throw new \Exception('Only one ingredient from Crust category can be ordered.');
            }
        });

	}

}