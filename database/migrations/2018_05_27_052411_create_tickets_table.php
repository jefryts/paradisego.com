<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
			$table->increments('id');
			$table->string('code', 10);
			$table->integer('qty');
			$table->decimal('unite_price', 10, 2);
			$table->enum('type', ['General', 'VIP', 'Super VIP']);
			$table->integer('event_id')->unsigned();
			
			// Created and updated attribute
			$table->timestamps();
			
			// SoftDelete
			$table->softDeletes();

			// Relation
			$table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
