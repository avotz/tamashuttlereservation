<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->string('time');
            $table->string('pickup');
            $table->string('pickup_number');
            $table->string('dropoff');
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->integer('baby_seat')->default(0);
            $table->integer('infants')->default(0);
            $table->double('rate')->default(0);
            $table->double('price')->default(0);
            $table->string('type_service');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('flight')->nullable();
            $table->integer('service_color')->default(0);
            $table->tinyInteger('last_minute')->default(0);
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('assigned')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
