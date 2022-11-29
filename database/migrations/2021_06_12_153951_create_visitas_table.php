<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visitante_id')->nullable();
            $table->foreign('visitante_id')
                ->references('id')
                ->on('visitantes')
                ->onDelete('cascade');
            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->foreign('responsable_id')
                ->references('id')
                ->on('responsables')
                ->onDelete('cascade');
            $table->text('asunto')->nullable();
            $table->dateTime('inicio', 0);
            $table->dateTime('fin', 0)->nullable();
            $table->unsignedBigInteger('estado')->default(1);
            $table->text('imagen')->nullable();
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
        Schema::dropIfExists('visitas');
    }
}
