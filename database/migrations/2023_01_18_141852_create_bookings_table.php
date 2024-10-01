<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('phone_no')->nullable(true);
            $table->string('date')->nullable(true);
            $table->string('time')->nullable(true);
            $table->string('ofpeople')->nullable(true);
            $table->text('message')->nullable(true);
            $table->string('status')->default('0');
            $table->string('confirmed_by')->nullable(true);
            $table->bigInteger('room_id')->unsigned()->nullable(true);
            $table->bigInteger('restauration_id')->unsigned()->nullable(true);
            $table->bigInteger('salle_id')->unsigned()->nullable(true);
            $table->bigInteger('paillote_id')->unsigned()->nullable(true);
            $table->foreign('room_id')
                    ->references('id')
                    ->on('rooms')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('paillote_id')
                    ->references('id')
                    ->on('paillotes')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('restauration_id')
                    ->references('id')
                    ->on('restaurations')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign('salle_id')
                    ->references('id')
                    ->on('salles')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('auteur')->nullable(true);
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
        Schema::dropIfExists('bookings');
    }
}
