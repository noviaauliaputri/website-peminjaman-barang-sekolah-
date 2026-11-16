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
        Schema::table('peminjamans', function (Blueprint $table) {
            // Cek dulu, kalau kolom status belum ada baru dibuat
            if (!Schema::hasColumn('peminjamans', 'status')) {
                $table->string('status')->default('Dipinjam');
            }
            // Cek dulu, kalau kolom tanggal_kembali belum ada baru dibuat
            if (!Schema::hasColumn('peminjamans', 'tanggal_kembali')) {
                $table->date('tanggal_kembali')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            //
        });
    }
};
