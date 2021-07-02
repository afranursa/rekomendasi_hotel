<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_rating', function (Blueprint $table) {
            $table->string('id_detail_rating')->primary();
            $table->string('id_rating');
            $table->foreign('id_rating')->references('id_rating')->on('rating');
            $table->string('fasilitas');
            $table->string('kenyamanan');
            $table->string('harga');
            $table->string('letak');
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
        Schema::dropIfExists('detail_rating');
    }
}
