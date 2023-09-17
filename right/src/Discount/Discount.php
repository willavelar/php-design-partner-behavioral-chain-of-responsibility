<?php

namespace DesignPattern\Right\Discount;

use DesignPattern\Right\Budget;

abstract class Discount
{
    protected ?Discount $nextDiscount;

    public function __construct(?Discount $nextDiscount)
    {
        $this->nextDiscount = $nextDiscount;
    }

    abstract public function calc(Budget $budget): float;

}