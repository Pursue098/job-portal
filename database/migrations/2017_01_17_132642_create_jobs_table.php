<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description', 10000);
            $table->string('specification', 10000)->nullable();
            $table->string('experience');
            $table->string('location');
            $table->string('type');
            $table->string('salary_range');
            $table->string('qualification');
            $table->string('vacancies');
            $table->boolean('gender');
            $table->boolean('travel');
            $table->dateTime('last_date');
            $table->tinyInteger('active');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
