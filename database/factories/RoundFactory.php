<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name=["semi final","quarter final"];
       
        return [
            "name"=>$name[rand(0,1)],
           

           
        ];
    }
}
