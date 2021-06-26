<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id('ride_id');
            $table->string('from_loc');
            $table->string('to_loc');
            $table->dateTime('time_in',0);
            $table->dateTime('time_out',0);
            $table->string('client_id');
            $table->string('driver_id');
            $table->string('service_type');
            $table->float('distance',8,2);
            $table->float('pay',8,2);
            $table->string('vehicle');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rides');
    }
}
