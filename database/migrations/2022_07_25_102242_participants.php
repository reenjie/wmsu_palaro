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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->integer('sports_id');     
            $table->integer('user_id');
            $table->integer('CollegeId');
            $table->datetime('date_added');
            $table->text('submitted_req');
            $table->integer('isverified');
            $table->integer('team')->nullable();
            $table->integer('status');
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
        Schema::dropifExist('participants');
    }
};
