<?php

namespace App\Services;

interface CartInterface {

	public function addItem(ProductInterface $product, $quantity = 1);
	public function removeLine(ProductInterface $product);
	public function computeTotalValue();
	public function clear();
	public function getLines();
	
}