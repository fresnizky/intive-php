<?php

namespace App;

class HourRent extends Rent
{
    public function __construct(array $attributes = [])
    {
        $this->type = Rent::HOUR_TYPE;
        $this->price_cents = 500;
        $this->max_duration = 23;

        parent::__construct($attributes);
    }

    function getRentToDate(\DateTime $date, int $duration)
    {
        $date->add(new \DateInterval("PT{$duration}H"));

        return $date->format('Y-m-d H:i:s');
    }
}
