<?php

namespace App\Repositories;

interface OrderRepositoryInterface {

    public function all(array $with = array());

    public function getById($id, array $with = array());

}