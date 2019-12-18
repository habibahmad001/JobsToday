<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
			$table->integer('user_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->text('answer');
			$table->integer('session_id')->unsigned();
			$table->boolean('is_correct');
			$table->date('created_at');
            $table->date('updated_at');
			
			$table->foreign('question_id')
            ->references('id')
            ->on('questions')
            ->onDelete('cascade');
			
			$table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('level_id')
            ->references('id')
            ->on('levels')
            ->onDelete('cascade');
			
			$table->foreign('session_id')
            ->references('id')
            ->on('sessions')
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
        Schema::dropIfExists('user_questions');
    }
}
