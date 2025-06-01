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
            $table->text('alamat_deskripsi');
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            $table->integer('kapasitas_maksimal');
            $table->decimal('berat_maksimal', 8, 2);
            $table->integer('kapasitas_saat_ini')->default(0);
            $table->decimal('berat_saat_ini', 8, 2)->default(0);
            $table->enum('status', ['Normal','Penuh','Berat Berlebih','Offline']);
            $table->timestamp('terakhir_diperbarui')->useCurrent();
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
