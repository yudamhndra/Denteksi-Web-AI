<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanFisikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_fisik', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anak');
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->unsignedBigInteger('id_kelas')->nullable();
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->float('imt',10,1);
            $table->integer('sistole')->nullable();
            $table->integer('diastole')->nullable();
            $table->datetime('waktu_pemeriksaan');
            $table->softDeletes();
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
        Schema::dropIfExists('pemeriksaan_fisik');
    }
}
