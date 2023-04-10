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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->text('announcement');
            $table->integer('CollegeId');
            $table->integer('sports_id')->nullable();
            $table->integer('isactive')->nullable();
            $table->datetime('date_added');
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
        //
        Schema::dropIfExists('announcements');
    }
};
