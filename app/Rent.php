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
}
