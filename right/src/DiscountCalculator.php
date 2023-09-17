<?php

namespace DesignPattern\Right;

use DesignPattern\Right\Discount\DiscountMoreThan500Value;
use DesignPattern\Right\Discount\DiscountMoreThan5Items;
use DesignPattern\Right\Discount\NoDiscount;

class DiscountCalculator
{
    public function calc(Budget $budget) : float
    {
        $discountChain = new DiscountMoreThan5Items(
            new DiscountMoreThan500Value(
                new NoDiscount()
            ));

        return $discountChain->calc($budget);
    }
}