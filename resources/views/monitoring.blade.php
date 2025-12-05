@extends('layouts.app')

@section('title', 'Monitoring Saldo')

@section('content')
<div class="min-h-screen bg-white flex">
  <aside class="w-64 bg-gradient-to-b from-[#123458] to-[#2770BE] text-white p-8 flex flex-col">
    <h2 class="text-2xl font-bold mb-8">Koin Kene</h2>
    
    <!-- Menu atas -->
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

  <!-- Main Content -->
  <main class="flex-1 p-8">

    <!-- HEADER -->
    <div class="mb-8">
      <h1 class="text-2xl font-bold text-[#123458]">Monitoring Saldo</h1>
      <p class="text-sm text-gray-600 mt-1">{{ now()->format('d F Y') }}</p>
    </div>

    <!-- 4 Kartu Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

      <div class="bg-white rounded-xl shadow p-5 border border-gray-200">
        <p class="text-sm text-gray-500">Total Saldo</p>
        <p class="text-2xl font-bold text-black mt-1">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
      </div>

      <div class="bg-white rounded-xl shadow p-5 border border-gray-200">
        <p class="text-sm text-gray-500">Total Pemasukan</p>
        <p class="text-2xl font-bold text-black mt-1">Rp {{ number_format($pemasukan, 0, ',', '.') }}</p>
      </div>

      <div class="bg-white rounded-xl shadow p-5 border border-gray-200">
        <p class="text-sm text-gray-500">Total Pengeluaran</p>
        <p class="text-2xl font-bold text-black mt-1">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</p>
      </div>

      <div class="bg-white rounded-xl shadow p-5 border border-gray-200">
        <p class="text-sm text-gray-500">Jumlah Transaksi</p>
        <p class="text-2xl font-bold text-black mt-1">{{ $jumlahTransaksi }}</p>
      </div>

    </div>

    <!-- Daftar Transaksi -->
    <div class="bg-white rounded-xl shadow p-6 border border-gray-200">

      <h2 class="text-lg font-semibold text-[#123458] mb-4">
        Daftar Transaksi Terbaru
      </h2>

      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-gray-300 bg-gray-50">
            <th class="py-2 px-4 text-left">Tanggal</th>
            <th class="py-2 px-4 text-left">Jenis</th>
            <th class="py-2 px-4 text-left">Kategori</th>
            <th class="py-2 px-4 text-left">Nominal</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($transaksiTerbaru as $item)
          <tr class="border-b border-gray-200">
            <td class="py-3 px-4 text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
            <td class="py-3 px-4">
              <span class="px-2 py-1 rounded text-xs {{ $item->jenis === 'Pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $item->jenis }}
              </span>
            </td>
            <td class="py-3 px-4 text-gray-700">{{ $item->kategori }}</td>
            <td class="py-3 px-4 font-semibold {{ $item->jenis === 'Pemasukan' ? 'text-green-600' : 'text-red-600' }}">
              Rp {{ number_format($item->nominal, 0, ',', '.') }}
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="py-6 text-center text-gray-500">Belum ada transaksi.</td>
          </tr>
          @endforelse
        </tbody>
      </table>

    </div>

  </main>
</div>
@endsection