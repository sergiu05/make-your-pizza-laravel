<?php

namespace App\Services;

interface ProductInterface {

    /**
     * @return int
     */
    public function getId();

    /**
     * @return float
     */
    public function getPrice();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getCategoryName();

}