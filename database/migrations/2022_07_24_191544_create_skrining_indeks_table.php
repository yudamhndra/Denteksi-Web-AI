<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkriningIndeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skrining_indeks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemeriksaan')->nullable();
            $table->integer('def_d')->default(0);
            $table->integer('def_e')->default(0);
            $table->integer('def_f')->default(0);
            $table->integer('dmf_d')->default(0);
            $table->integer('dmf_e')->default(0);
            $table->integer('dmf_f')->default(0);
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
        Schema::dropIfExists('skrining_indeks');
    }
}
