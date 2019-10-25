<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_status', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('state', false, true)->default(0);
			$table->bigInteger('academic_year', false, true);
			
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
        Schema::dropIfExists('system_status');
    }
}
