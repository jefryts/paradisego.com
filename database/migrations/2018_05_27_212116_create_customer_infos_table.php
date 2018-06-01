<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_infos', function (Blueprint $table) {
			$table->increments('id');
			$table->string('business_name', 100);
			$table->string('ruc', 11)->unique();
            $table->string('address', 200);
			$table->string('phone', 9)->nullable();
			$table->string('cell_phone', 9)->nullable();
			$table->integer('user_id')->unsigned();
			
			// Created and updated attribute
			$table->timestamps();

			// SoftDelete
			$table->softDeletes();

			// Relation
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
        Schema::dropIfExists('customer_infos');
    }
}
