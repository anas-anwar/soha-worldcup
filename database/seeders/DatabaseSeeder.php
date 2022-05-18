<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
       // \App\Models\Resturent::factory(5)->create();
        // \App\Models\Hotel::factory(10)->create();
        // \App\Models\Stadium::factory(10)->create();
        //\App\Models\Group::factory(10)->create();
        // \App\Models\Team::factory(5)->create();
        //  \App\Models\Player::factory(10)->create();
        // $this->call(TypeOfEventSeeder::class);
       // \App\Models\Round::factory(10)->create();
       \App\Models\Matchs::factory(10)->create();
      //\App\Models\Service::factory(10)->create();
     // \App\Models\Room::factory(10)->create();
     //\App\Models\Event::factory(10)->create();
     //\App\Models\LineUp::factory(10)->create();
    }
}
