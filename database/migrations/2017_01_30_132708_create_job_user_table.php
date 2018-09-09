<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_user', function (Blueprint $table) {
            $table->integer('job_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('cover_letter', 10000)->nullable();
            $table->integer('status')->nullable();
            $table->integer('cv_id')->unsigned();
            $table->tinyInteger('active');

            $table->timestamps();

            $table->foreign('job_id')
                ->references('id')
                ->on('jobs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('cv_id')
                ->references('id')
                ->on('cv')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(['job_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_user');
    }
}
