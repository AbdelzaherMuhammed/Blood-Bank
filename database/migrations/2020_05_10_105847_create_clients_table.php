<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone');
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->date('date_of_birth');
			$table->date('last_donation_date');
			$table->integer('city_id')->unsigned();
			$table->integer('blood_type_id')->unsigned();
			$table->string('pin_code')->nullable();
			$table->string('api_token')->unique()->nullable();
            $table->tinyInteger('status');
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
