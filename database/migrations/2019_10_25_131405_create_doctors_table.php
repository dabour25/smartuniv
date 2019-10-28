<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
			$table->string('email',80)->unique();
            $table->string('password');
			$table->string('first_name',50);
			$table->string('middle_name',50);
			$table->string('last_name',50);
			$table->string('mobile_no',30);
			$table->text('courses');
			$table->float('evaluation',2,1)->default(5.0);
			$table->bigInteger('department_id', false, true);
			$table->rememberToken();
			
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
        Schema::dropIfExists('doctors');
    }
}
