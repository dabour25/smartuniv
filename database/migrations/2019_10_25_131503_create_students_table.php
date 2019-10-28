<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
			$table->string('email',80)->unique();
            $table->string('password');
			$table->string('first_name',50);
			$table->string('middle_name',50);
			$table->string('last_name',50);
			$table->string('mobile_no',30);
			$table->date('birth_date');
			$table->tinyInteger('level',false,true);
			$table->float('GPA',5,3)->default(0.000);
			$table->float('CGPA',5,3)->default(0.000);
			$table->smallInteger('done_hrs',false,true)->default(0);
			$table->smallInteger('rem_hrs',false,true)->default(180);
			$table->bigInteger('department_id', false, true);
			$table->bigInteger('academic_year', false, true);
			$table->rememberToken();
			
			$table->foreign('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('students');
    }
}
