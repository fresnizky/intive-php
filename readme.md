# Context
A company rents bikes under following options:
1. Rental by hour, charging $5 per hour
2. Rental by day, charging $20 a day
3. Rental by week, changing $60 a week
4. Family Rental, is a promotion that can include from 3 to 5 Rentals (of any type) with a discount
of 30% of the total price

# Assigment:
1. Implement a set of classes to model this domain and logic
2. Add automated tests to ensure a coverage over 85%
3. Use GitHub to store and version your code
4. Apply all the recommended practices you would use in a real project
5. Add a README.md file to the root of your repository to explain: your design, the development
practices you applied and how run the tests.

# Design
The context was vague in some aspects so I implemented the following constraints:
1. Each rental type duration should not exceed the following rental type, so rental by hour should be between 1 and 23 hours, rental by day between 1-6 and rental by week limited to 4 weeks.
2. Family rentals must be of the same type and duration.

I implemented a main abstract rent class that holds all the logic with child classes that hold the details of each rental type.

These classes must be instantiated using a factory class.

I developed using a TDD approach incrementally adding new functionality.

# Running
This exam was developed using Docker Compose, but can be run on any environment with PHP 7.2.

You need to install composer dependencies with `composer install`

After installing dependencies you can run PHPUnit from vendor with `vendor/bin/phpunit`