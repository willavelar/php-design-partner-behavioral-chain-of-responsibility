<?php

namespace DesignPattern\Right\Discount;

use DesignPattern\Right\Budget;

class DiscountMoreThan500Value extends Discount
{
    public function calc(Budget $budget): float
    {
        if ($budget->value > 500) {
            return $budget->value *  0.05;
        }

        return $this->nextDiscount->calc($budget);
    }
}