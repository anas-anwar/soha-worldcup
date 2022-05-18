<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {$model_type=['App\Models\Resturent',"App\Models\Hotel","App\Models\Stadium"];
        return [
            "name"=>$this->faker->name(),
            "file_name"=>$this->faker->,
            "model_type"=>$model_type[rand(0,1)],
            
        ];
    }
}
