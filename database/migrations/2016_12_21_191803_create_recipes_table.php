<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('creator_id')->unsigned();
			$table->string('name');
			$table->text('description');
            $table->timestamps();
			
			$table
				->foreign('creator_id')
				->references('id')->on('users')
				->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
