<?php

namespace App\Services;
use App\Repositories\ProductInterface;

interface CartInterface {

	public function addItem(ProductInterface $product, $quantity = 1);
	public function removeLine(ProductInterface $product);
	public function computeTotalValue();
	public function clear();
	public function getLines();
	
}