<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaillotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paillotes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(true);
            $table->string('status')->nullable(true);
            $table->string('ofpeople')->nullable(true);
            $table->string('booked')->nullable(true);
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
        Schema::dropIfExists('paillotes');
    }
}
