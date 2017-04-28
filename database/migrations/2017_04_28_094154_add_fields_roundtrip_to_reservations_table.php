<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsRoundtripToReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('reservations', function(Blueprint $table)
        {
            
            $table->dateTime('round_date')->nullable();
            $table->string('round_time')->nullable();
            $table->string('round_pickup')->nullable();
         
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('round_date');
            $table->dropColumn('round_time');
            $table->dropColumn('round_pickup');
        });
    }
}
