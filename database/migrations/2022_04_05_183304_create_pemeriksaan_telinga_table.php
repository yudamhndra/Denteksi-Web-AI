<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanTelingaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_telinga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anak')->nullable();
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->unsignedBigInteger('id_kelas')->nullable();
            $table->string('tsoal1');
            $table->string('tsoal2');
            $table->string('tsoal3');
            $table->string('tsoal4');
            $table->string('tsoal5');
            $table->string('tsoal6');
            $table->string('tsoal7');
            $table->string('tsoal8');
            $table->string('tsoal9');
            $table->datetime('waktu_pemeriksaan')->nullable();
            $table->timestamps();

            $table->foreign('id_anak')->references('id')->on('anak')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemeriksaan_telinga');
    }
}
