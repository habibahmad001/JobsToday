<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Questions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('questions', function (Blueprint $table) {
            $table->increments('id',100);
            $table->integer('level_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->text('question');
			$table->text('answer');
			
			$table->foreign('level_id')
            ->references('id')
            ->on('levels')
            ->onDelete('cascade');
			
			$table->foreign('category_id')
            ->references('id')
            ->on('categories')
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
         Schema::dropIfExists('questions');
    }
}
