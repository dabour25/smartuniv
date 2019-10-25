<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_data', function (Blueprint $table) {
            $table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
			$table->tinyInteger('level',false,true);
			$table->float('GPA',5,3)->default(0.000);
			$table->float('CGPA',5,3)->default(0.000);
			$table->smallInteger('done_hrs',false,true)->default(0);
			$table->smallInteger('rem_hrs',false,true)->default(180);
			$table->bigInteger('department_id', false, true);
            $table->bigInteger('student_id', false, true);
			$table->bigInteger('academic_year', false, true);
			
			$table->foreign('department_id')->references('id')->on('departments');
			$table->foreign('student_id')->references('id')->on('users');
			$table->foreign('academic_year')->references('id')->on('academic_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_data');
    }
}
