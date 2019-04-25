<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Votes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('id_voteur');
            $table->integer('id_post');
			$table->boolean('sun');
            $table->boolean('cloud');
            $table->unique(['id_voteur', 'id_post']);
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
