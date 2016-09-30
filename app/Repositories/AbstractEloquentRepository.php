<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

# Blueprint class for Eloquent repositories 
# Learning source: http://culttt.com/2014/03/17/eloquent-tricks-better-repositories/ 

abstract class AbstractEloquentRepository implements IngredientRepositoryInterface {

	/**
	 * @var Model
	 */
	protected $model;

	public function __construct(Model $model) {

		$this->model = $model;

	}

	/**
	 * Make a new instance of the entity to query on
	 *
	 * @param array $with	 
	 */
	protected function make(array $with = array()) {

		return $this->model->with($with);

	}

	/**
	 * Return all users
	 *
	 * @return Illuminate\Database\Eloquent\Collection	 
	 */
	public function all(array $with = array()) {

		return $this->make($with)->get();

	}

	/**
	 * Find an entity by id
	 *
	 * @param int $id
	 * @param array $with
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function getById($id, array $with = array()) {

		return $this->make($with)->find($id);

	}

	/**
	 * Return all models that have a required relationship
	 *
	 * @param string $relation
	 * @param array $with
	 */
	public function has($relation, array $with = array()) {

		$entity = $this->make($with);

		return $entity->has($relation)->get();
	}

}