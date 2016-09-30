<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Repositories\ProductInterface;

class Cart implements CartInterface {

	private $lineCollection;

	private $validators;

	public function __construct(array $validators = array()) {
		$this->lineCollection = new Collection();
		$this->validators = $validators;
	}

	public function addItem(ProductInterface $product, $quantity = 1) {
		
		# Learning Source: "Laravel 4 - From Apprentice to Artisan", p.48
		foreach($this->validators as $validator) {
			$validator->validate($this, $product);
		}

		$filtered = $this->lineCollection->filter(function($item, $key) use ($product) {
			return $item->product->getId() == $product->getId();
		});		

		if ($filtered->isEmpty()) {
			$this->lineCollection->push(new CartLine($product, $quantity));
		} else {
			$filtered->first()->quantity += $quantity;
		}

	}

	public function removeLine(ProductInterface $product) {

		$this->lineCollection = $this->lineCollection->reject(function($item) use ($product) {
			return $item->product->getId() == $product->getId();
		});

	}

	public function computeTotalValue() {
		return $this->lineCollection->sum(function($item) {
			return $item->product->getPrice() * $item->quantity;
		});
	}

	public function clear() {
		$this->lineCollection = new Collection();
	}

	public function getLines() {
		return $this->lineCollection;
	}

	public function __toString() {
		return (string) $this->lineCollection;
	}
}