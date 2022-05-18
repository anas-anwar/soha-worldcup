<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=>$this->faker->firstNameMale(),
            "team_id"=>rand(1,10),
            "nationality"=>$this->faker->name(),
            "birthdate"=>$this->faker->date( 'Y-m-d', 'now-18') ,
            "height"=>$this->faker->randomFloat( NULL,150, 220),
            'weight'=>$this->faker->randomFloat( NULL,60, 90),
            
        ];
    }
}
