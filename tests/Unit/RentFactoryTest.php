<?php

namespace Tests\Unit;

use App\Factories\RentFactory;
use PHPUnit\Framework\TestCase;

class RentFactoryTest extends TestCase
{

    public function testGetDayRent()
    {
        $rent = RentFactory::get('Day');

        $this->assertInstanceOf('\App\DayRent', $rent);
    }

    public function testGetHourRent()
    {
        $rent = RentFactory::get('Hour');

        $this->assertInstanceOf('\App\HourRent', $rent);
    }

    public function testGetWeekRent()
    {
        $rent = RentFactory::get('Week');

        $this->assertInstanceOf('\App\WeekRent', $rent);
    }

    public function testInvalidRent()
    {
        $this->expectExceptionMessage('Missing format class.');

        RentFactory::get('Invalid');
    }
}
