<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsetModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_aset', function (Blueprint $table) {
            $table->id('id_aset');
            $table->string('nama_aset');
            $table->string('serial_number')->nullable();
            $table->year('tahun_pengadaan')->nullable();
            $table->integer('kategori_id');
            $table->integer('qty');
            $table->integer('satuan_id');
            $table->string('nama_pegawai')->nullable();
            $table->integer('departement_id');
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('aset_models');
    }
}
