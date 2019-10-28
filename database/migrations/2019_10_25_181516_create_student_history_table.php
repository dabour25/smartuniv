<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_history', function (Blueprint $table) {
            $table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
			$table->tinyInteger('course_state',false,true);
			$table->float('annual_evaluation',3,1)->default(0.0);
			$table->float('mid_term',3,1)->default(0.0);
			$table->smallInteger('final',false,true)->default(0);
			$table->string('grade',2);
			$table->bigInteger('academic_year', false, true);
			$table->bigInteger('student_id', false, true);
            
			$table->foreign('academic_year')->references('id')->on('academic_year');
			$table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_history');
    }
}
