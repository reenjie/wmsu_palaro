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
        Schema::create('blacklists', function (Blueprint $table) {
            $table->id();
            $table->integer('sports_id');
            $table->integer('user_id');
            $table->integer('CollegeId');
            $table->integer('batch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropifExist('blacklists');
    }
};
