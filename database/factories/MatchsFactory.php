<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    { $starts_at = Carbon::create($this->faker->time(" H:i:s")) ;
$date= Carbon::create($this->faker->date()) ;
        $ends_at= Carbon::create( $starts_at)->addHours(2);
        return [
            "round_id"=>rand(1,10),
            "stadium_id"=>rand(1,10),
            "localteam_id"=>rand(1,5),
            "visitorteam_id"=>rand(6,10),
            "start"=>$starts_at,
            "end"=>$ends_at,
            "date"=>$date
        ];
    }
}
