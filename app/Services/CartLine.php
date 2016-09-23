<?php

namespace App\Services;

class CartLine implements \JsonSerializable {

	protected $product;
	protected $quantity;

	public function __construct(ProductInterface $product, $quantity = 1) {
		$this->product = $product;
		$this->quantity = $quantity;
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}
	}

	public function __isset($property) {
		return isset($this->$property);
	}

	public function jsonSerialize() {
		return [$this->product, $this->quantity];
	}
}