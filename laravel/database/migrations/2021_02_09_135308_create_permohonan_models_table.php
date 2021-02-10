<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_permohonan', function (Blueprint $table) {
            $table->id('id_permohonan');
            $table->integer('id_pegawai');
            $table->date('tgl_permohonan');
            $table->integer('id_type_permohonan');
            $table->string('deskripsi');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('tb_permohonan');
    }
}
