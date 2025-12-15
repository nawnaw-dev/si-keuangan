@extends('layouts.app')

@section('title', 'Koin Kene - Laporan Keuangan')

@section('content')
<div class="min-h-screen bg-white flex">

  <!-- Sidebar (fixed) -->
  <aside class="w-64 bg-gradient-to-b from-[#123458] to-[#2770BE] text-white p-8 flex flex-col 
         fixed inset-y-0 left-0">
    <h2 class="text-2xl font-bold mb-8">Koin Kene</h2>

    <nav class="space-y-7">
      <a href="{{ route('dashboard') }}" class="block font-medium hover:text-blue-200">Dashboard</a>
      <a href="{{ route('transaksi.index') }}" class="block font-medium hover:text-blue-200">Transaksi</a>
      <a href="{{ route('laporan.index') }}" class="block font-medium hover:text-blue-200">Laporan Keuangan</a>
      <a href="{{ route('kwitansi.index') }}" class="block font-medium hover:text-blue-200">Cetak Kuitansi</a>
      <a href="{{ route('monitoring.index') }}" class="block font-medium hover:text-blue-200">Monitoring Saldo</a>
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

  <!-- Main content -->
    <main class="flex-1 p-8 space-y-8 ml-64">
    <div>
      <h1 class="text-2xl font-bold text-[#123458]">Koin Kene - Laporan Keuangan</h1>
      <p class="text-sm text-gray-600 mt-2">Pilih bulan & tahun untuk melihat laporan</p>
    </div>

    <!-- Main Content: Date Picker + Generate + Export -->
    <div class="bg-[#D9D9D9] rounded-xl shadow-md p-6 text-[#123458]">
      <h2 class="text-lg font-semibold mb-4">Generate Laporan</h2>
      <form method="GET" action="{{ route('laporan.generate') }}" class="flex flex-wrap gap-4 items-center">
        <!-- Date Picker -->
        <div>
          <label class="block text-sm font-medium">Pilih Bulan</label>
          <input type="month" name="periode" class="px-3 py-2 border rounded-md bg-white text-[#123458]">
        </div>

        <!-- Tombol Generate -->
        <button type="submit" class="px-4 py-2 bg-[#123458] text-white text-sm rounded-md hover:bg-[#0f2e4c]">
          Generate Laporan
        </button>

        <!-- Export PDF -->
        <a href="{{ route('laporan.export') }}" class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
          Export PDF
        </a>
      </form>
    </div>

    <!-- Ringkasan Bulanan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-[#D9D9D9] rounded-xl shadow-md p-6 text-[#123458]">
        <h2 class="text-lg font-semibold mb-4">Total Pemasukan Bulanan</h2>
        <p class="text-2xl font-bold">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
      </div>
      <div class="bg-[#D9D9D9] rounded-xl shadow-md p-6 text-[#123458]">
        <h2 class="text-lg font-semibold mb-4">Total Pengeluaran Bulanan</h2>
        <p class="text-2xl font-bold">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
      </div>
    </div>

    <!-- Detail Transaksi -->
    <div class="bg-[#D9D9D9] rounded-xl shadow-md p-6 text-[#123458]">
      <h2 class="text-lg font-semibold mb-4">Detail Transaksi Bulanan</h2>
      <table class="min-w-full text-sm text-left">
        <thead class="bg-[#123458] text-white">
          <tr>
            <th class="px-4 py-2">Tanggal</th>
            <th class="px-4 py-2">Jenis</th>
            <th class="px-4 py-2">Nominal</th>
            <th class="px-4 py-2">Deskripsi</th>
            <th class="px-4 py-2">Saldo Akhir</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($transaksiBulanan as $item)
            <tr class="border-t border-[#123458]/30">
              <td class="px-4 py-2">{{ $item->tanggal }}</td>
              <td class="px-4 py-2">{{ $item->jenis }}</td>
              <td class="px-4 py-2">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
              <td class="px-4 py-2">{{ $item->deskripsi }}</td>
              <td class="px-4 py-2">Rp {{ number_format($item->saldo_akhir, 0, ',', '.') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-4 py-6 text-center text-[#123458]/70">Belum ada transaksi bulan ini.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>
</div>
@endsection