<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('about_app');
            $table->string('fb_link');
            $table->string('tw_link');
            $table->string('insta_link');
            $table->string('phone');
            $table->string('email');
            $table->string('whatsapp');
            $table->string('small_disc');
            $table->string('app_message`');
            $table->string('long_disc');
            $table->string('google_play_link');
            $table->string('app_store_link');

		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
