@extends('layouts.app')

@section('title', 'Koin Kene - Transaksi')

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

  <!-- Main content -->
  <main class="flex-1 p-8 space-y-8">
    <div>
      <h1 class="text-2xl font-bold text-[#123458]">Koin Kene - Transaksi</h1>
      <p class="text-sm text-gray-600 mt-2">Hallo, Welcome Back!</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Card Input Transaksi -->
      <div class="bg-[#E5E5E5] rounded-xl shadow-md p-6 md:col-span-1 text-[#123458]">
        <h2 class="text-lg font-semibold mb-4">Input Transaksi</h2>

        <form method="POST" action="{{ route('transaksi.store') }}" class="space-y-4">
          @csrf
          <!-- Jenis Transaksi -->
          <div>
            <label class="block text-sm font-medium">Jenis Transaksi</label>
            <select name="jenis" class="w-full px-3 py-2 border rounded-md text-sm bg-white text-[#123458]">
              <option value="">-- Pilih Jenis --</option>
              <option value="Pemasukan">Pemasukan</option>
              <option value="Pengeluaran">Pengeluaran</option>
            </select>
          </div>

          <!-- Kategori -->
          <div>
            <label class="block text-sm font-medium">Kategori</label>
            <input type="text" name="kategori" class="w-full px-3 py-2 border rounded-md text-sm bg-white text-[#123458]" placeholder="Contoh: Donasi, Gaji, Operasional">
          </div>

          <!-- Tanggal -->
          <div>
            <label class="block text-sm font-medium">Tanggal</label>
            <input type="date" name="tanggal" class="w-full px-3 py-2 border rounded-md text-sm bg-white text-[#123458]">
          </div>

          <!-- Nominal -->
          <div>
            <label class="block text-sm font-medium">Jumlah Uang</label>
            <input type="number" name="nominal" class="w-full px-3 py-2 border rounded-md text-sm bg-white text-[#123458]" placeholder="Rp">
          </div>

          <!-- Deskripsi -->
          <div>
            <label class="block text-sm font-medium">Deskripsi</label>
            <textarea name="deskripsi" class="w-full px-3 py-2 border rounded-md text-sm bg-white text-[#123458]" placeholder="Detail transaksi..."></textarea>
          </div>

          <!-- Tombol Simpan -->
          <button type="submit" class="px-4 py-2 bg-[#123458] text-white text-sm rounded-md hover:bg-[#0f2e4c]">
            Simpan
          </button>
        </form>
      </div>

      <!-- Riwayat Transaksi -->
      <div class="bg-[#E5E5E5] rounded-xl shadow-md p-6 md:col-span-2 text-[#123458]">
        <h2 class="text-lg font-semibold mb-4">Riwayat Transaksi</h2>
        <table class="min-w-full text-sm text-left">
          <thead class="bg-[#123458] text-white">
            <tr>
              <th class="px-4 py-2">Tanggal</th>
              <th class="px-4 py-2">Jenis</th>
              <th class="px-4 py-2">Kategori</th>
              <th class="px-4 py-2">Nominal</th>
              <th class="px-4 py-2">Deskripsi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($transaksi as $item)
              <tr class="border-t border-[#123458]/30">
                <td class="px-4 py-2">{{ $item->tanggal }}</td>
                <td class="px-4 py-2">{{ $item->jenis }}</td>
                <td class="px-4 py-2">{{ $item->kategori }}</td>
                <td class="px-4 py-2">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                <td class="px-4 py-2">{{ $item->deskripsi }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-4 py-6 text-center text-[#123458]/70">Belum ada transaksi.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>
@endsection