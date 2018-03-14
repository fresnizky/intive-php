<?php
namespace App\Factories;

use App\Rent;

class RentFactory
{
    /**
     * Returns expected Rent class or throw exception if class doesn't exist
     *
     * @param string $type
     * @return Rent
     * @throws \Exception
     */
    public static function get($type)
    {
        $class = '\App\\' . $type . 'Rent';
        if (!class_exists($class)) {
            throw new \Exception('Missing format class.');
        }
        return new $class;
    }
}