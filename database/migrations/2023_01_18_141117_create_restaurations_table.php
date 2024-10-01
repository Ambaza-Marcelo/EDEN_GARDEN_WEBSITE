<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurations', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable(true);
            $table->string('title')->nullable(true);
            $table->string('subtitle')->nullable(true);
            $table->text('description')->nullable(true);
            $table->string('old_price')->nullable(true);
            $table->string('price')->nullable(true);
            $table->string('published')->default('0');
            $table->string('status')->default('0');
            $table->string('auteur')->nullable(true);
            $table->bigInteger('category_restauration_id')->unsigned();
            $table->foreign('category_restauration_id')
                    ->references('id')
                    ->on('category_restaurations')
                    ->onUpdate('cascade')
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
        Schema::dropIfExists('restaurations');
    }
}
