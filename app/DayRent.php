<?php

namespace App;

class DayRent extends Rent
{
    public function __construct(array $attributes = [])
    {
        $this->type = Rent::DAY_TYPE;
        $this->price_cents = 2000;
        $this->max_duration = 6;

        parent::__construct($attributes);
    }

    function getRentToDate(\DateTime $date, int $duration)
    {
        $date->add(new \DateInterval("P{$duration}D"));

        return $date->format('Y-m-d H:i:s');
    }
}
