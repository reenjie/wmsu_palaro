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
        Schema::create('videolinks', function (Blueprint $table) {
            $table->id();
            $table->text('video')->unique();
            $table ->text('videotype');
            $table-> integer('priority');
            $table-> integer('CollegeId');
            $table->datetime('date_added');
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
        Schema::dropIfExists('videolinks');
    }
};
