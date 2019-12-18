<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SessionWinner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('session_winners', function (Blueprint $table) {
            $table->increments('id',100);
            $table->integer('user_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('assigned_superpoint')->unsigned();
            
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
        //
    }
}
