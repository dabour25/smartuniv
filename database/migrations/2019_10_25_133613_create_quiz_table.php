<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
			$table->string('title',50);
			$table->tinyInteger('state', false, true)->default(1);
			$table->bigInteger('course_id', false, true);
			$table->bigInteger('doctor_id', false, true);
			
			$table->foreign('course_id')->references('id')->on('courses');
			$table->foreign('doctor_id')->references('id')->on('doctors');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz');
    }
}
