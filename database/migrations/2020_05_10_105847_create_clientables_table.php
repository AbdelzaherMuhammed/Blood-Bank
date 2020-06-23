<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientablesTable extends Migration {

	public function up()
	{
		Schema::create('clientables', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id');
			$table->integer('is_read')->default(0);
			$table->integer('clientable_id');
			$table->string('clientable_type');
		});
	}

	public function down()
	{
		Schema::drop('clientables');
	}
}
