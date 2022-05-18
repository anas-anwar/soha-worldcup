<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LineUpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    { $substituation=["primary","reserve"];
        return [
            "match_id"=>rand(1,10),
            "team_id"=>rand(1,10),
            "player_id"=>rand(1,10),
            "substitution"=>$substituation[rand(0,1)],
        ];
    }
}
