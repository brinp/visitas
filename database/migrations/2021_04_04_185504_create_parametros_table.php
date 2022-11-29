<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('documento_id')->nullable()->unique();
            $table->foreign('documento_id')
                ->references('id')
                ->on('documentos')
                ->onDelete('set null');
            $table->text('razon')->nullable();
            $table->text('nrodocumento')->nullable();
            $table->text('telefono')->nullable();
            $table->text('direccion')->nullable();
            $table->text('horarios')->nullable();
            $table->text('logo')->nullable();
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
        Schema::dropIfExists('parametros');
    }
}
