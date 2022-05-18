<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StadiumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {
        return [
            "name"=>$this->faker->company(),
            'description'=>$this->faker->text(),
            "phone"=>$this->faker->phoneNumber(),
            "capacity"=>$this->faker->randomFloat(),
            "latitude"=>$this->faker->latitude(),
            "longtude"=>$this->faker->longitude(),
            "address"=>$this->faker->address(),
        ];
    }
}
