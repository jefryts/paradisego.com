<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('api_token', 60)->nullable()->unique();
            $table->enum('type', ['admin', 'user', 'customer'])->default('user'); // Admin , User, Customer
            $table->enum('state', ['active', 'inactive'])->default('active'); // Active, Inactive
			$table->rememberToken();
			// Created and updated register
			$table->timestamps();
			
			// SoftDelete
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
