<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('jenis', ['Pemasukan', 'Pengeluaran']);
            $table->string('kategori', 100);
            $table->date('tanggal');
            $table->decimal('nominal', 15, 2);
            $table->text('deskripsi')->nullable();
            $table->decimal('saldo_akhir', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};