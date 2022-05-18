<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {$type=['single','double','Triple','quad','queen','king'];
        return [
            "hotel_id"=>rand(1,10),
            "type"=>$type[rand(0,5)],
            "price"=>$this->faker->randomFloat(1000,10,1000),
            "url"=>$this->faker->url()
        ];
    }
}
