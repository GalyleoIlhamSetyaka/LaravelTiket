<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengunjungTable extends Migration
{
    public function up()
    {
        Schema::create('pengunjung', function (Blueprint $table) {
            $table->id('id_pgj');
            $table->string('nomor_pgj');
            $table->string('nama_pgj');
            $table->string('email_pgj');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengunjung');
    }
}