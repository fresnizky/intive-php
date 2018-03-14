<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class Rent extends Model
{
    const HOUR_TYPE = 'Hour';
    const DAY_TYPE = 'Day';
    const WEEK_TYPE = 'Week';

    protected $table = 'rents';
    protected $type;
    protected $price_cents;
    protected $max_duration;

    public function __construct(array $attributes = [])
    {
        $this->validateClass();
        parent::__construct($attributes);
    }

    /**
     * Validate child class has defined the required properties.
     *
     * @throws \Exception
     */
    protected function validateClass()
    {
        if (empty($this->type)) {
            throw new \Exception('Type not set for class: ' . __CLASS__);
        }

        if (empty($this->price_cents)) {
            throw new \Exception('Price not set for class: ' . __CLASS__);
        }

        if (empty($this->max_duration)) {
            throw new \Exception('Duration not set for class: ' . __CLASS__);
        }
    }
}
