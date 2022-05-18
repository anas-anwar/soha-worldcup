<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=>$this->faker->titleMale(),
            'stadium_id'=>rand(1,10),
            'logo'=>$this->faker->image(),
            'shirt_color'=>$this->faker->colorName(),
            'group_id'=>rand(1,10)
        ];
    }
}
