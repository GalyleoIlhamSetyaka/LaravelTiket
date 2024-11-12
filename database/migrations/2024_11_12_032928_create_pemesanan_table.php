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
            $table->foreignId('visitor_id')->constrained('pengunjung');
            $table->timestamps();
        });
    }
};
