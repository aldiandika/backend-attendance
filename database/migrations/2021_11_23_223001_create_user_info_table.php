<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nama_pegawai');
            $table->string('jabatan_fungsional');
            $table->string('jabatan_struktural');
            $table->integer('jatah_izin');
            $table->integer('jumlah_izin');
            $table->integer('jumlah_alpha');
            $table->integer('jumlah_hadir');
            $table->string('role');
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
        Schema::dropIfExists('user_infos');
    }
}
