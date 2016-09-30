<?php

namespace App\Repositories;

use App\Ingredient;

class EloquentIngredientRepository extends AbstractEloquentRepository {

	/**
	 * Constructor
	 * 
	 * @param User $model
	 */
	public function __construct(Ingredient $model) {

		parent::__construct($model);

	}
}