<?php

namespace App\Services;

use App\Repositories\ProductInterface;

# Learning Source: "Laravel 4 - From Apprentice to Artisan", p.48

interface CartValidationInterface {
	public function validate(Cart $cart, ProductInterface $product);
}
