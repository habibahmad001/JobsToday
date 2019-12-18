<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegularPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regular_points', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('regular_point')->nullable();
			$table->integer('user_id')->unsigned();
			$table->integer('session_id')->unsigned();
			$table->bigInteger('rewarded_superpoint')->nullable();
			
			$table->foreign('user_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('regular_points');
    }
}
