<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_request', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('course_id', false, true);
			$table->bigInteger('prerequest_id', false, true);
            
			$table->foreign('prerequest_id')->references('id')->on('courses');
			$table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pre_request');
    }
}
