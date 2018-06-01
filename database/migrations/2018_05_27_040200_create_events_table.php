<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 200);
			$table->text('description');
			$table->string('place', 200);
			$table->date('date');
			$table->time('time');
			$table->enum('state', ['active', 'inactive']);
			$table->integer('user_id')->unsigned();

			// Created and updated attribute
			$table->timestamps();
			
			// SoftDelete
			$table->softDeletes();

			//Relation
			$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
