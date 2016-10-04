<?php
/**
 * Created by PhpStorm.
 * User: sergiu.luca
 * Date: 10/4/2016
 * Time: 9:37 AM
 */

namespace app\Services;


use Illuminate\Support\MessageBag;

class DBOrderProcessor implements OrderProcessorInterface {

    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function process(Cart $cart, User $user, MessageBag $messageBag) {
        if ($cart->isEmpty()) {
            $this->messageBag->add('empty', 'Sorry, your cart is empty.');
        } else {
            /* to do */
        }

    }
}