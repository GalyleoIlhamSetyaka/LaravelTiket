<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananTable extends Migration
{
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pemesanan')->constrained('pemesanan')->onDelete('cascade');
            $table->string('kode_pemesanan')->unique();
            $table->foreignId('id_pgj')->constrained('pengunjung');
            $table->string('nama_pgj');
            $table->string('email_pgj');
            $table->string('nomor_pgj');
            $table->integer('jumlah_orang');
            $table->decimal('harga', 10, 2);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
}