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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tempat_sampah')
            ->constrained('tempat_sampah', 'id')
            ->onDelete('cascade');
            $table->enum('jenis_notifikasi', ['Kapasitas Penuh','Berat Berlebih','Jadwal Pengangkutan','Tempat Sampah Offline']);
            $table->text('pesan');
            $table->timestamp('waktu_notifikasi')->useCurrent();
            $table->boolean('status_baca')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
