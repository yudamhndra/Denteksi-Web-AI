<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanMataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_mata', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anak');
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->unsignedBigInteger('id_kelas')->nullable();
            $table->string('msoal1');
            $table->string('msoal2');
            $table->string('msoal3');
            $table->string('msoal4');
            $table->string('msoal5');
            $table->string('msoal6');
            $table->string('msoal7');
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
        Schema::dropIfExists('pemeriksaan_mata');
    }
}
