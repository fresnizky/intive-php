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

    function getRentToDate(\DateTime $date, int $duration)
    {
        $date->add(new \DateInterval("P{$duration}W"));

        return $date->format('Y-m-d H:i:s');
    }

}
