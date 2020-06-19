<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersBarberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->time('time');
            $table->time('time_final');
            $table->integer('client_id')->unsigned();
            $table->integer('barbers_id')->unsigned();
            $table->integer('service_id')->unsigned();
            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');
            $table->foreign('barbers_id')
                    ->references('id')
                    ->on('barbers')
                    ->onDelete('cascade');
            $table->foreign('service_id')
                    ->references('id')
                    ->on('services')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('clients_barbers', function (Blueprint $table) {
            //
        });
    }
}
