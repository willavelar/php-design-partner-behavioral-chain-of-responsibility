## Chain of Responsibility

Chain of Responsibility is behavioral design pattern that allows passing request along the chain of potential handlers until one of them handles request.

-----

We need to create a discount calculator. With this we will have our budget with value and item and it will show the discount depending on the value of the parameters
### The problem

If we do it this way, we have the problem: With each new discount we will have to modify the file by adding another “if”, which can generate additional bugs.

```php
<?php
class Budget 
{
    public float $value;
    public int $items;
}
```
```php
<?php
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
```

### The solution

Now, using the Chain of Responsibility pattern, we create an abstract class so that new discounts can be classes and what is the next discount to be calculated passed by reference, thus forming a chain where the discounts should go, and we make a class without discount for the end of this chain.

```php
<?php
abstract class Discount
{
    protected ?Discount $nextDiscount;

    public function __construct(?Discount $nextDiscount)
    {
        $this->nextDiscount = $nextDiscount;
    }

    abstract public function calc(Budget $budget): float;

}
```
```php
<?php
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
```
```php
<?php
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
```
```php
<?php
class NoDiscount extends Discount
{

    public function __construct()
    {
        parent::__construct(null);
    }

    public function calc(Budget $budget): float
    {
        return 0;
    }
}
```
```php
<?php
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
```
-----

### Installation for test

![PHP Version Support](https://img.shields.io/badge/php-7.4%2B-brightgreen.svg?style=flat-square) ![Composer Version Support](https://img.shields.io/badge/composer-2.2.9%2B-brightgreen.svg?style=flat-square)

```bash
composer install
```

```bash
php wrong/test.php
php right/test.php
```