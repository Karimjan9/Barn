<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('command', function (Blueprint $table) {
            $table->bigInteger('order_id')->unsigned()->after('id');
            // $table->foreign('order_id')->references('id')->on('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('command', function (Blueprint $table) {
            // $table->dropForeign('order_id');
            $table->dropColumn('order_id');
        });
    }
};
