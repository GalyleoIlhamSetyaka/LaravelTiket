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
            $table->foreignId('order_id')->constrained('pemesanan');
            $table->decimal('amount', 10, 2);
            $table->string('proof_of_transfer');
            $table->timestamps();
        });
    }
};
