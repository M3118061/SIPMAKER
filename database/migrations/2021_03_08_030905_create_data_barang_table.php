<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_barang', function (Blueprint $table) {
            $table->bigIncrements('id_barang');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->foreignId('id_jenis')
                  ->references('id_jenis')
                  ->on('jenis_barang')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreignId('id_satuan')
                  ->references('id_satuan')
                  ->on('satuan_barang')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_barang');
    }
}
