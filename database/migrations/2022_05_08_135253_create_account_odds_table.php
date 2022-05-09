<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountOddsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_odds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('match_id')->constrained('matches')->cascadeOnDelete(); 
            $table->foreignId('account_id')->constrained('accounts')->cascadeOnDelete(); 
            $table->foreignId('vote')->default(0)->constrained('teams'); 
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_odds');
    }
}
