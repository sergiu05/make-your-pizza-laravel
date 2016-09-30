<?php

namespace App\Repositories;

interface IngredientRepositoryInterface {

	public function all(array $with = array());

	public function getById($id, array $with = array());

}