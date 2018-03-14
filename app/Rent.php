<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class Rent extends Model
{
    const HOUR_TYPE = 'Hour';
    const DAY_TYPE = 'Day';
    const WEEK_TYPE = 'Week';

    const FAMILY_RENT_MIN = 3;
    const FAMILY_RENT_MAX = 5;
    const FAMILY_RENT_DISCOUNT = 30;

    protected $table = 'rents';
    protected $type;
    protected $price_cents;
    protected $max_duration;

    abstract function getRentToDate(\DateTime $date, int $duration);

    public function __construct(array $attributes = [])
    {
        $this->validateClass();
        parent::__construct($attributes);
    }

    /**
     * @param int $quantity Number of bikes to rent.
     * @param string $type Type of rent (Hour, Day, Week).
     * @param int $duration Duration in number of hours, days or weeks.
     * @throws \Exception
     */
    public function familyRent(int $quantity, int $duration)
    {
        if ($quantity <= self::FAMILY_RENT_MIN
            || $quantity >= self::FAMILY_RENT_MAX) {

            throw new \Exception('Number of bikes must be between 3 and 5 for Family Rent.');
        }

        if (!$this->validateDuration($duration)) {
            throw new \Exception('Maximum duration for this rent type exceeded.');
        }

        for ($i = 0; $i < $quantity; $i++) {
            $this->rent($duration, self::FAMILY_RENT_DISCOUNT);
        }
    }

    /**
     * Rent a bike for a specified duration
     *
     * @param int $duration Duration in number of hours, days or weeks.
     * @param int $discount Discount percentage.
     * @throws \Exception
     */
    public function rent($duration, $discount = 0)
    {
        if (!$this->validateDuration($duration)) {
            throw new \Exception('Maximum duration for this rent type exceeded.');
        }

        $currentDate = new \DateTime();

        $this->rent_from = $currentDate->format('Y-m-d H:i:s');
        $this->rent_to = $this->getRentToDate($currentDate, $duration);
        $this->base_price = $this->price_cents * $duration;
        $this->discount = $discount;
        $this->total_price = $this->base_price - $this->discount;

        // $this->save() this is disabled because there's no database
    }

    /**
     * Validates rent duration
     *
     * @param $duration
     * @return bool
     */
    protected function validateDuration($duration)
    {
        return $duration <= $this->max_duration;
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
