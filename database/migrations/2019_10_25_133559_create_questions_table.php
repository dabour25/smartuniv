<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
			$table->text('question');
			$table->text('answer');
			$table->tinyInteger('seen', false, true)->default(0);		
			$table->bigInteger('student_id', false, true);
			$table->bigInteger('doctor_id', false, true)->nullable();
			$table->bigInteger('course_id', false, true);
			
			$table->foreign('student_id')->references('id')->on('students');
			$table->foreign('doctor_id')->references('id')->on('doctors');
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
        Schema::dropIfExists('questions');
    }
}
