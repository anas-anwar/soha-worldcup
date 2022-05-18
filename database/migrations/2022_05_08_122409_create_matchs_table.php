<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->id();
            $table->time("start");
            $table->time("end");
            $table->foreignId('round_id')->constrained('rounds')->cascadeOnDelete();
            $table->foreignId('stadium_id')->constrained('stadia')->cascadeOnDelete(); 
            $table->foreignId('localteam_id')->constrained('teams')->cascadeOnDelete();
            $table->foreignId('visitorteam_id')->constrained('teams')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
