<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->date('order_date');
            $table->integer('num_people');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('visitor_id'); // Ubah menjadi unsignedBigInteger
            $table->string('proof_of_payment')->nullable();
            $table->timestamps();

            // Tambahkan foreign key secara terpisah
            $table->foreign('visitor_id')
                  ->references('id')
                  ->on('pengunjung')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
};