<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class resturentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rate=[0,1,2,3,4,5];
        $starts_at = Carbon::create($this->faker->time()) ;

        $ends_at= Carbon::create($starts_at)->addHours(8);
        return [
            "name"=>$this->faker->company(),
            "phone"=>$this->faker->phoneNumber(),
            "rate"=>$rate[rand(0,5)],
            "hour_open"=>$starts_at ,
            "hour_close"=>$ends_at,
            "latitude"=>$this->faker->latitude(),
            "longtude"=>$this->faker->longitude(),
            "address"=>$this->faker->address(),
            "menu_url"=>$this->faker->url(),
            //
        ];
    }
}
