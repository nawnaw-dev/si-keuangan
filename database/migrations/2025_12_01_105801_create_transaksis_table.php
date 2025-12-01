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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');       // Pemasukan / Pengeluaran
            $table->string('kategori');    // Donasi, Sponsor, Gaji, Operasional, dll
            $table->date('tanggal');       // Tanggal transaksi
            $table->integer('nominal');    // Jumlah uang
            $table->text('deskripsi');     // Detail transaksi
            $table->timestamps();          // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};