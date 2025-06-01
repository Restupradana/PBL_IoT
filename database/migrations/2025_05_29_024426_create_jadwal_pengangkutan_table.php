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
        Schema::create('jadwal_pengangkutan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tempat_sampah')
            ->constrained('tempat_sampah', 'id')
            ->onDelete('cascade');
            $table->foreignId('id_petugas')
                    ->constrained('users', 'id')
                    ->onDelete('cascade');
            $table->date('tanggal_pengangkutan');
            $table->enum('status_pengangkutan', ['Terjadwal','Selesai','Dibatalkan']);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pengangkutan');
    }
};
