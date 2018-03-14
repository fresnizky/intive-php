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

    public function testHourRent()
    {
        $rent = RentFactory::get('Hour');

        $rent->rent('10');

        $this->assertEquals(5000, $rent->base_price);
        $this->assertEquals(0, $rent->discount);
        $this->assertEquals(5000, $rent->total_price);
    }

    public function testDayRent()
    {
        $rent = RentFactory::get('Day');

        $rent->rent('5');

        $this->assertEquals(10000, $rent->base_price);
        $this->assertEquals(0, $rent->discount);
        $this->assertEquals(10000, $rent->total_price);
    }

    public function testWeekRent()
    {
        $rent = RentFactory::get('Week');

        $rent->rent('2');

        $this->assertEquals(12000, $rent->base_price);
        $this->assertEquals(0, $rent->discount);
        $this->assertEquals(12000, $rent->total_price);
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

    public function getRentToDate(\DateTime $date, int $duration) {}
}

class InvalidRentClassNoPrice extends Rent
{
    public function __construct(array $attributes = [])
    {
        $this->type = Rent::DAY_TYPE;
        $this->max_duration = 6;
        parent::__construct($attributes);
    }
    public function getRentToDate(\DateTime $date, int $duration) {}
}

class InvalidRentClassNoDuration extends Rent
{
    public function __construct(array $attributes = [])
    {
        $this->type = Rent::DAY_TYPE;
        $this->price_cents = 2000;
        parent::__construct($attributes);
    }
    public function getRentToDate(\DateTime $date, int $duration) {}
}