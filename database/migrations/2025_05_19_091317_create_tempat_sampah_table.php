<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tempat_sampah', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // nama tempat, misal TPS A
            $table->string('lokasi'); // alamat atau titik koordinat
            $table->float('kapasitas_maks'); // dalam liter atau kg
            $table->float('persentase_isi')->default(0); // nilai 0-100
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_sampah');
    }
};
