<?php

use Illuminate\Auth\Events\Verified;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftar_mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_vendor')->unsigned()->nullable();
            $table->foreign('id_vendor')->references('id_vendor')->on('level');
            $table->bigInteger('no_daftar')->unsigned()->nullable();
            $table->string('nama')->nullable();
            $table->string('jenis_kelamin');
            $table->string('asal_sekolah');
            $table->string('pilihan_1');
            $table->string('pilihan_2');
            $table->string('jalur');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_receipt');
    }
}
