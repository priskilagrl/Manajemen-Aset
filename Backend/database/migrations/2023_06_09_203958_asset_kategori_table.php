<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_kategori', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('kategori_id');
            $table->timestamps();

            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_kategori');
    }
};
