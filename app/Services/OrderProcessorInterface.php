<?php

namespace App\Services;

use App\User;
use Illuminate\Support\MessageBag;

interface OrderProcessorInterface {
    /**
     * Handle the details of order processing
     *
     * @param Cart $cart
     * @param User $user
     * @param MessageBag $messageBag
     * @return mixed
     */
    public function process(Cart $cart, User $user, MessageBag $messageBag);

    /**
     * @return array
     */
    public function getErrors();
}