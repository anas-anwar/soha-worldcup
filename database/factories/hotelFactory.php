<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class hotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rate=[0,1,2,3,4,5];
        return [
            "name"=>$this->faker->company(),
            'description'=>$this->faker->text(),
            "phone"=>$this->faker->phoneNumber(),
            "rate"=>$rate[rand(0,5)],
            "latitude"=>$this->faker->latitude(),
            "longtude"=>$this->faker->longitude(),
            "address"=>$this->faker->address(),
            "hotel_url"=>$this->faker->url(),
        ];
    }
}
