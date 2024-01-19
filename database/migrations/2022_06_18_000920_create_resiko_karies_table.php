<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResikoKariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resiko_karies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemeriksaan_gigi')->unique()->nullable();
            $table->string('rksoal1');
            $table->string('rksoal2');
            $table->string('rksoal3');
            $table->string('rksoal4');
            $table->string('rksoal5');
            $table->string('rksoal6');
            $table->string('rksoal7');
            $table->string('rksoal8');
            $table->string('rksoal9');
            $table->string('rksoal10');
            $table->string('rksoal11');
            $table->string('rksoal12');
            $table->string('rksoal13');
            $table->string('penilaian')->nullable();
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
        Schema::dropIfExists('resiko_karies');
    }
}
