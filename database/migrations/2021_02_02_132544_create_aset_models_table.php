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
            $table->string('kode_barang');
            $table->date('tanggal_masuk');
            $table->integer('kategori_id');
            $table->integer('departement_id');
            $table->integer('satuan_id');
            $table->integer('qty');
            $table->string('nama_barang');
            $table->string('nama_pegawai');
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
