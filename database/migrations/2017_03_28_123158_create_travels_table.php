<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->increments('id');
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
        Schema::create('reservation_travel', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('reservation_id')->unsigned()->index();
            $table->integer('travel_id')->unsigned()->index();
            
        });
         Schema::create('travel_vehicle', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('vehicle_id')->unsigned()->index();
            $table->integer('travel_id')->unsigned()->index();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_vehicle');
        Schema::dropIfExists('reservation_travel');
        Schema::dropIfExists('travels');
    }
}
