<?php
require 'Restaurant.php';

class RestaurantTestCase extends PHPUnit_Framework_TestCase
{

    public function test_empty(){
        $restaurant = new Restaurant([]);
        $this->assertTrue(strlen($restaurant->get_opening_hours()) == 0);
    }

    public function test_simple(){
        $restaurant = new Restaurant(
            [
                new OpeningHour(8, 16),  # Sunday
                new OpeningHour(8, 17),  # Monday
                new OpeningHour(8, 18),  # Tuesday
                new OpeningHour(8, 19),  # Wednesday
                new OpeningHour(8, 20),  # Thursday
                new OpeningHour(8, 21),  # Friday
                new OpeningHour(8, 22)   # Saturday
            ]
        );

        $this->assertEquals(
            "Sun: 8-16, Mon: 8-17, Tue: 8-18, Wed: 8-19, Thu: 8-20, Fri: 8-21, Sat: 8-22",
            $restaurant->get_opening_hours()
        );
    }

    public function test_single_group(){
        $restaurant = new Restaurant(
            [
                new OpeningHour(8, 16),  # Sunday
                new OpeningHour(8, 16),  # Monday
                new OpeningHour(8, 16),  # Tuesday
                new OpeningHour(8, 16),  # Wednesday
                new OpeningHour(8, 20),  # Thursday
                new OpeningHour(8, 21),  # Friday
                new OpeningHour(8, 22)   # Saturday
            ]
        );

        $this->assertEquals(
            "Sun - Wed: 8-16, Thu: 8-20, Fri: 8-21, Sat: 8-22",
            $restaurant->get_opening_hours()
        );
    }

    public function test_multiple_groups(){
        $restaurant = new Restaurant(
            [
                new OpeningHour(8, 16),  # Sunday
                new OpeningHour(8, 16),  # Monday
                new OpeningHour(8, 16),  # Tuesday
                new OpeningHour(8, 17),  # Wednesday
                new OpeningHour(8, 18),  # Thursday
                new OpeningHour(8, 20),  # Friday
                new OpeningHour(8, 20)   # Saturday
            ]
        );

        $this->assertEquals(
            "Sun - Tue: 8-16, Wed: 8-17, Thu: 8-18, Fri - Sat: 8-20",
            $restaurant->get_opening_hours()
        );
    }

    public function test_edge_case(){
        $restaurant = new Restaurant(
            [
                new OpeningHour(8, 16),  # Sunday
                new OpeningHour(8, 17),  # Monday
                new OpeningHour(8, 17),  # Tuesday
                new OpeningHour(8, 17),  # Wednesday
                new OpeningHour(8, 16),  # Thursday
                new OpeningHour(8, 16),  # Friday
                new OpeningHour(8, 16)   # Saturday
            ]
        );

        $this->assertEquals(
            "Sun, Thu - Sat: 8-16, Mon - Wed: 8-17",
            $restaurant->get_opening_hours()
        );
    }
            
    public function test_edge_case2(){
        $restaurant = new Restaurant(
            [
                new OpeningHour(8, 15),  # Sunday
                new OpeningHour(8, 16),  # Monday
                new OpeningHour(8, 16),  # Tuesday
                new OpeningHour(8, 16),  # Wednesday
                new OpeningHour(8, 16),  # Thursday
                new OpeningHour(8, 16),  # Friday
                new OpeningHour(8, 15)   # Saturday
            ]
        );

        $this->assertEquals(
            "Sun, Sat: 8-15, Mon - Fri: 8-16",
            $restaurant->get_opening_hours()
        );
    }
        
}
?>      

