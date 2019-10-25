<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_schedule', function (Blueprint $table) {
            $table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
			$table->tinyInteger('day', false, true);
			$table->tinyInteger('type', false, true);
			$table->bigInteger('course_id', false, true);
			$table->bigInteger('period_id', false, true);
			$table->bigInteger('instructor_id', false, true);
			$table->bigInteger('place_id', false, true);
			$table->bigInteger('section_id', false, true);
			
			$table->foreign('instructor_id')->references('id')->on('users');
			$table->foreign('course_id')->references('id')->on('courses');
			$table->foreign('period_id')->references('id')->on('periods');
			$table->foreign('place_id')->references('id')->on('places');
			$table->foreign('section_id')->references('id')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_schedule');
    }
}
