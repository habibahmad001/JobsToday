<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('jobstable', function (Blueprint $table) {
            $table->increments('id',100);
			$table->integer('category_id')->unsigned();
			$table->text('job_title');
			$table->longText('job_desc');
			
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
         Schema::dropIfExists('jobstable');
    }
}
