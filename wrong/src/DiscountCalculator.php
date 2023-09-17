<?php

namespace DesignPattern\Wrong;

class DiscountCalculator
{
    public function calc(Budget $budget) : float
    {
        if ($budget->items > 5) {
            return $budget->value *  0.1;
        }

        if ($budget->value > 500) {
            return $budget->value *  0.05;
        }

        return 0;
    }
}