<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('posts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('id_author');
			$table->string('id_pic_1');
			$table->string('id_pic_2');
            $table->string('date1');
            $table->string('date2');
			$table->string('titre');
			$table->string('description',3000);
			$table->integer('sun_vote');
            $table->integer('cloud_vote');
			$table->timestamps();
		});
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
