<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeOfEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name="Yello Card";
        DB::table('type_of_events')->insert(
            ["name"=>$name,
            "slug"=>Str::slug($name),

            ]
            );


            $name="Red Card";
            DB::table('type_of_events')->insert(
                ["name"=>$name,
                "slug"=>Str::slug($name),
    
                ]
                );
    }

}
