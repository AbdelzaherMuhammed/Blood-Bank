<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
            $table->string('phone');
			$table->string('email');
			$table->string('subject');
			$table->string('message');
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}
