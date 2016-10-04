<?php
/**
 * Created by PhpStorm.
 * User: sergiu.luca
 * Date: 10/4/2016
 * Time: 9:41 AM
 */

namespace app\Repositories;


use App\Services\OrderProcessorInterface;

class EloquentRepositoryInterface extends AbstractEloquentRepository implements OrderRepositoryInterface {

    /**
     * Constructor
     *
     * @param Order $model
     */
    public function __construct(Order $model) {

        parent::__construct($model);

    }
}