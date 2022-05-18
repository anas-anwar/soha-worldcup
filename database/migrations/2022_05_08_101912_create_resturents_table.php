<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResturentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resturents', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->time('hour_open');
            $table->time('hour_close');
            $table->string('phone');
            $table->integer('rate');
            $table->string('address',255);
            $table->string('menu_url',255)->nullable();
            $table->double('longtude');
            $table->double('latitude');
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
        Schema::dropIfExists('resturents');
    }
}
