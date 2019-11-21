<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('patronymic');
            $table->date('date_of_birth');
            $table->unsignedBigInteger('department_id');
            $table->string('job_position');
            $table->smallInteger('type');
            $table->double('monthly_rate')->nullable();
            $table->double('hours')->nullable();
            $table->double('hourly_rate')->nullable();
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments')->
            onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
