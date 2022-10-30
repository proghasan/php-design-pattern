<?php
abstract class Package
{
    public abstract function type(): string;
    public abstract function cost(): float;
    public abstract function facilities(): array;
}

abstract class CreateBookingFactory
{
    public abstract function create(): Package;
}

class Standard extends Package
{
    public function type(): string
    {
        return 'Standard type package';
    }

    public function cost(): float
    {
        return 199.50;
    }
    public function facilities(): array
    {
        return ['Free snack', '16 hours support'];
    }
}

class Premium extends Package
{
    public function type(): string
    {
        return 'Premium type package';
    }

    public function cost(): float
    {
        return 499.50;
    }

    public function facilities(): array
    {
        return ['Free snack', '24 hours support', 'Free dinner'];
    }
}

class StandardFactory extends CreateBookingFactory
{
    public function create(): Package
    {
        return new Standard();
    }
}

class PremiumFactory extends CreateBookingFactory
{
    public function create(): Package
    {
        return new Premium();
    }
}

class BookingFactory
{
    public function getStandardPackage(): StandardFactory
    {
        return new StandardFactory();
    }
    public function getPremiumPackage(): PremiumFactory
    {
        return new PremiumFactory();
    }
}

$bookingFactory = new BookingFactory();
$premium = $bookingFactory->getPremiumPackage();
$premium = $premium->create();

// output
echo $premium->type() . PHP_EOL;
echo $premium->cost() . PHP_EOL;
var_dump($premium->facilities());
