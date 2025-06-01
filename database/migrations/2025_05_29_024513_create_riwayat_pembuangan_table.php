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
        Schema::create('riwayat_pembuangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tempat_sampah')
                ->constrained('tempat_sampah', 'id')
                ->onDelete('cascade');
            $table->timestamp('waktu_pembuangan')->useCurrent();
            $table->decimal('berat_sampah_dibuang', 8, 2)->nullable();
            $table->string('jenis_sampah', 50)->nullable();
            $table->foreignId('id_pengguna_pembuang')
                    ->nullable()
                    ->constrained('users', 'id')
                    ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pembuangan');
    }
};
