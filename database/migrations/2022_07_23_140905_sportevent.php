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
            $table->text('description')->nullable();
            $table->text('rules_regulation')->nullable();
            $table->text('requirements')->nullable();
            $table->text('file')->nullable();
            $table->integer('nop');
            $table->text('nor');
            $table->integer('CollegeId');
            $table->text('istype')->nullable();
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
