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
        Schema::create('sportevents', function (Blueprint $table) {
            $table->id();
            $table->text('name');     
            $table->date('datestart')->nullable();
            $table->date('dateend')->nullable();
            $table->time('timestart')->nullable();
            $table->time('timeend')->nullable();
            $table->text('description');
            $table->text('rules_regulation');
            $table->text('requirements');
            $table->text('file')->nullable();
            $table->integer('nop');
            $table->integer('nor');
            $table->integer('CollegeId');
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
        Schema::dropifExist('sportevents');
    }
};
