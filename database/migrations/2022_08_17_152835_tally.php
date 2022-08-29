<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tallies', function (Blueprint $table) {
            $table->id();
            $table->integer('team')->nullable();
            $table->integer('sports_id');   
            $table->integer('user_id')->nullable();
            $table->integer('match_id');   
            $table->integer('isofficial');   
            $table->text('tally'); 
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropifExist('tallies');
    }
};
