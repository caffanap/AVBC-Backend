<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('angkatan_id')->nullable();
            $table->foreign('angkatan_id')->references('id')->on('angkatans')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->date('tanggal_buka');
            $table->date('tanggal_tutup');
            $table->string('link_wa');
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
        Schema::dropIfExists('pendaftarans');
    }
}
