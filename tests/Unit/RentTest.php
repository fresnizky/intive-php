<?php

namespace Tests\Unit;

use App\Rent;
use App\Factories\RentFactory;
use PHPUnit\Framework\TestCase;


class RentTest extends TestCase
{
    public function testRentWithNoTypeThrowsException()
    {
        $this->expectExceptionMessage('Type not set for class: App\Rent');
        new InvalidRentClassNoType();
    }

    public function testRentWithNoPriceThrowsException()
    {
        $this->expectExceptionMessage('Price not set for class: App\Rent');
        new InvalidRentClassNoPrice();
    }

    public function testRentWithNoDurationThrowsException()
    {
        $this->expectExceptionMessage('Duration not set for class: App\Rent');
        new InvalidRentClassNoDuration();
    }

    public function testExceededDurationThrowsException()
    {
        $rent = RentFactory::get('Day');

        $this->expectExceptionMessage('Maximum duration for this rent type exceeded.');
        $rent->rent(20);
    }
}

class InvalidRentClassNoType extends Rent
{
    public function __construct(array $attributes = [])
    {
        $this->price_cents = 2000;
        $this->max_duration = 6;
        parent::__construct($attributes);
    }
}

class InvalidRentClassNoPrice extends Rent
{
    public function __construct(array $attributes = [])
    {
        $this->type = Rent::DAY_TYPE;
        $this->max_duration = 6;
        parent::__construct($attributes);
    }
}

class InvalidRentClassNoDuration extends Rent
{
    public function __construct(array $attributes = [])
    {
        $this->type = Rent::DAY_TYPE;
        $this->price_cents = 2000;
        parent::__construct($attributes);
    }
}