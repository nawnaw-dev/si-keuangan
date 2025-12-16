@extends('layouts.app')

@section('title', 'Cetak Kwitansi')

@section('content')
<div class="min-h-screen bg-white flex">
  <!-- Sidebar -->
  <aside class="w-64 bg-gradient-to-b from-[#123458] to-[#2770BE] text-white p-8 flex flex-col">
    <h2 class="text-2xl font-bold mb-8">Koin Kene</h2>
    
    <!-- Menu atas -->
    <nav class="space-y-7">
      <a href="{{ route('dashboard') }}" class="block font-medium hover:text-blue-200">Dashboard</a>
      <a href="{{ route('transaksi.index') }}" class="block font-medium hover:text-blue-200">Transaksi</a>
      <a href="{{ route('laporan.index') }}" class="block font-medium hover:text-blue-200">Laporan Keuangan</a>
      <a href="{{ route('kwitansi.index') }}" class="block font-medium hover:text-blue-200">Cetak Kuitansi</a>
    </nav>

    <nav class="space-y-4 mt-auto">
      <a href="#" class="block font-medium hover:text-blue-200">Pengaturan</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="block font-medium text-red-200 hover:text-red-100 w-full text-left">
          Logout
        </button>
      </form>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8">
     <div>
    <h1 class="text-2xl font-bold text-[#123458]">Koin Kene - Dashboard</h1>
    <p class="text-sm text-gray-600 mt-2">Butuh Kuitansi? Cetak disini aja!</p>
  </div>
    
    
    <!-- Form -->
    <div class="w-full flex justify-center mt-6">
      <div class="w-full max-w-xl bg-gray-100 rounded-xl p-10 shadow-lg border border-gray-200">
      
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
<div class="mt-8 flex justify-center">
  <div class="flex gap-4 w-full max-w-md">

    <button type="submit"
      class="flex-1 py-3 rounded-xl text-white font-semibold text-sm shadow-md"
      style="background: linear-gradient(90deg,#6D28D9,#7C3AED);">
      Cetak Kwitansi
    </button>

    @if(session('kwitansi_id'))
  <a href="{{ route('kwitansi.pdf', session('kwitansi_id')) }}"
     class="flex-1 py-3 rounded-xl text-gray-800 font-semibold text-sm text-center
            bg-gray-200 hover:bg-gray-300 transition shadow">
    Download PDF
  </a>
@else
  <button type="button" disabled
    class="flex-1 py-3 rounded-xl text-gray-400 font-semibold text-sm
           bg-gray-100 cursor-not-allowed shadow">
    Download PDF
  </button>
@endif
  </div>
</div>
</form>
    </div>
</div>
  </main>
</div>
@endsection