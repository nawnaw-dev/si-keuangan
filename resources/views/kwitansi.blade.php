@extends('layouts.app')

@section('title', 'Cetak Kwitansi')

@section('content')
<div class="min-h-screen bg-white flex">
  <!-- Sidebar -->
  <aside class="w-64 bg-gradient-to-b from-[#123458] to-[#2770BE] text-white p-8 flex flex-col">
    <h2 class="text-2xl font-bold mb-8">Koin Kene</h2>
    
    <!-- Menu atas -->
    <nav class="space-y-7">
      <a href="#" class="block font-medium hover:text-blue-200">Dashboard</a>
      <a href="{{ route('transaksi.index') }}" class="block font-medium hover:text-blue-200">Transaksi</a>
      <a href="#" class="block font-medium hover:text-blue-200">Laporan Keuangan</a>
      <a href="#" class="block font-medium hover:text-blue-200">Cetak Kuitansi</a>
      <a href="#" class="block font-medium hover:text-blue-200">Monitoring Saldo</a>
    </nav>

    <!-- Menu bawah -->
    <nav class="space-y-4 mt-auto">
      <a href="#" class="block font-medium hover:text-blue-200">Pengaturan</a>
      <a href="#" class="block font-medium text-red-200 hover:text-red-100">Logout</a>
    </nav>
  </aside>
  
  <!-- Main Content -->
  <main class="flex-1 p-8">

    
    
    <!-- Form -->
    <div class="bg-gray-100 rounded-xl p-10 shadow-lg border border-gray-200 max-w-3xl mx-auto">
      
      <form action="{{ route('kwitansi.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="mb-10 text-center">
          <h1 class="text-4xl font-bold text-[#123458]">Cetak Kwitansi</h1>
        </div>
        
    <div class="flex flex-col gap-2">
        <label class="font-semibold text-[#123458]">Nama Pengirim :</label>
        <input type="text" name="nama_pengirim"
               class="w-full bg-gray-200 p-4 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
               placeholder="Masukkan nama pengirim">
    </div>

    <div class="flex flex-col gap-2">
        <label class="font-semibold text-[#123458]">Nama Penerima :</label>
        <input type="text" name="nama_penerima"
               class="w-full bg-gray-200 p-4 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
               placeholder="Masukkan nama penerima">
    </div>

    <div class="flex flex-col gap-2">
        <label class="font-semibold text-[#123458]">Tanggal :</label>
        <input type="date" name="tanggal"
               class="w-full bg-gray-200 p-4 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </div>

    <div class="flex flex-col gap-2">
        <label class="font-semibold text-[#123458]">Keterangan :</label>
        <textarea name="keterangan" rows="3"
                  class="w-full bg-gray-200 p-4 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                  placeholder="Masukkan keterangan"></textarea>
    </div>

    <div class="flex flex-col gap-2">
        <label class="font-semibold text-[#123458]">Nominal :</label>
        <input type="number" name="nominal"
               class="w-full bg-gray-200 p-4 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
               placeholder="Masukkan nominal">
    </div>

    <!-- Buttons -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
        <button type="submit"
                class="bg-purple-600 py-3 rounded-xl text-white text-base font-semibold hover:bg-purple-700 transition w-full">
            Cetak Kwitansi
        </button>

        <a href="#"
           class="bg-gray-300 py-3 rounded-xl text-base font-semibold text-center hover:bg-gray-400 transition w-full">
            Download PDF
        </a>
    </div>

</form>
    </div>

  </main>
</div>
@endsection
