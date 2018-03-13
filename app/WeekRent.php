<?php

namespace App;

class WeekRent extends Rent
{
    public function __construct(array $attributes = [])
    {
        $this->type = Rent::WEEK_TYPE;
        $this->price_cents = 6000;
        $this->max_duration = 4;

        parent::__construct($attributes);
    }
}
