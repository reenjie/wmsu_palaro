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
        Schema::create('carousels', function (Blueprint $table) {
            $table->id();
            $table->string('images')->unique();
            $table ->integer('priority');
            $table->integer('sports_id')->nullable();
            $table->integer('isactive')->nullable();
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
        Schema::dropIfExists('carousels');
    }
};
