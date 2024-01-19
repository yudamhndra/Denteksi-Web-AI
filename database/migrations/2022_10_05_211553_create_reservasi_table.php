<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->integer('poli_id');
            $table->string('kode');
            $table->string('antrian');
            $table->date('tanggal');
            $table->integer('id_anak');
            $table->integer('id_pemeriksaan');
            $table->mediumText('keluhan');
            $table->enum('status',['Reservasi','Sedang Pemeriksaan','Selesai Pemeriksaan','Batal Reservasi']);
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
        Schema::dropIfExists('reservasi');
    }
}
