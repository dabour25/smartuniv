<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
			$table->string('course_name',80);
			$table->string('code',15)->unique();
			$table->smallInteger('credit', false, true);
			$table->smallInteger('state', false, true)->default(1);
			$table->smallInteger('level', false, true);
			$table->tinyInteger('lec', false, true)->default(1);
			$table->smallInteger('sec', false, true)->default(0);
			$table->smallInteger('lab', false, true)->default(0);
			$table->bigInteger('department_id', false, true);
			
			$table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
