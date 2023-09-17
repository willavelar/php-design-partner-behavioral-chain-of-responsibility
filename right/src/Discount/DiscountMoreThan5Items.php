<?php

namespace DesignPattern\Right\Discount;

use DesignPattern\Right\Budget;

class DiscountMoreThan5Items extends Discount
{

    public function calc(Budget $budget): float
    {
        if ($budget->items > 5) {
            return $budget->value *  0.1;
        }

        return $this->nextDiscount->calc($budget);
    }
}