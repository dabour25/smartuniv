<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_course', function (Blueprint $table) {
            $table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
			$table->tinyInteger('course_state', false, true)->default(0);
			$table->float('annual_evaluation', 3, 1)->default(0.0);
			$table->float('mid_term',3,1)->default(0.0);
			$table->smallInteger('final_degree', false, true)->default(0);
			$table->string('grade',2);
			$table->bigInteger('section_id', false, true);
			$table->bigInteger('course_id', false, true);
			$table->bigInteger('student_id', false, true);
			
			$table->foreign('section_id')->references('id')->on('sections');
			$table->foreign('course_id')->references('id')->on('courses');
			$table->foreign('student_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_course');
    }
}
