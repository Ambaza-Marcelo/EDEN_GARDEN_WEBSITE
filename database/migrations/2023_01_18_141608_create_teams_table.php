<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(true);
            $table->string('name')->nullable(true);
            $table->text('description')->nullable(true);
            $table->string('published')->default('0');
            $table->bigInteger('position_id')->unsigned();
            $table->foreign('position_id')
                    ->references('id')
                    ->on('positions')
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
        Schema::dropIfExists('teams');
    }
}
