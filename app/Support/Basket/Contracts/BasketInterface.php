<?php
    /**
     * Created by PhpStorm.
     * User: Komail
     * Date: 2/9/2020
     * Time: 12:44 PM
     */

    namespace App\Support\Basket\Contracts;


    interface BasketInterface
    {
        public function saveOrder();
        public function getOrder();
        public function delete();
    }