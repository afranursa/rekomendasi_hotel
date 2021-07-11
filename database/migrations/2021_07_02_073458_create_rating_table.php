<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->string('id_rating')->primary();
            $table->string('username');
            $table->foreign('username')->references('username')->on('users');
            $table->string('id_hotel');
            $table->foreign('id_hotel')->references('id_hotel')->on('hotel');
            $table->double('angka_rating');
            $table->double('fasilitas');
            $table->double('kenyamanan');
            $table->double('harga');
            $table->double('letak');
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
        Schema::dropIfExists('rating');
    }
}
