<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegularSuperPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
			$table->bigInteger('superpoint')->nullable();
			$table->bigInteger('rewarded_superpoint')->nullable();
            $table->integer('session_id')->unsigned();
			
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
        Schema::dropIfExists('super_points');
    }
}
