<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWhereToJobstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobstable', function (Blueprint $table) {
            $table->integer('where')->unsigned();

            $table->foreign('where')
                ->references('id')
                ->on('locationtable')
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
        Schema::table('jobstable', function (Blueprint $table) {
            $table->dropColumn(['where']);
        });
    }
}
