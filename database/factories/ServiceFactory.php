<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $model_type=['App\Models\Resturent',"App\Models\Hotel"];
        $type=['cofee','wifi'];
        return [
          "model_id"=>rand(1,10),
          "model_type"=>$model_type[rand(0,1)],
          "type" =>$type[rand(0,1)], 
        ];
    }
}
