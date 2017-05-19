<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsHotelsToReservationsTable extends Migration
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
            $table->tinyInteger('credit_hotel')->default(0);
            $table->string('hotel')->nullable();
          
         
            
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
           
            $table->dropColumn('credit_hotel');
            $table->dropColumn('hotel');

        });
    }
}
