<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('konfirmasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->decimal('amount', 10, 2);
            $table->string('proof_of_transfer');
            $table->timestamps();

            $table->foreign('order_id')
                  ->references('id')
                  ->on('pemesanan')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('konfirmasi');
    }
};