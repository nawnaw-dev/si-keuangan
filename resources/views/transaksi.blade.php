@extends('layouts.app')

@section('title', 'Koin Kene - Transaksi')

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
    <main class="flex-1 p-8 space-y-8 ml-64" x-data="{ deleteModal: false, deleteId: null }">
    <div>
      <h1 class="text-2xl font-bold text-[#123458]">Koin Kene - Transaksi</h1>
      <p class="text-sm text-gray-600 mt-2">Hallo, {{ Auth::user()->name }}! Welcome Back!</p>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
      <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
           class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        <span class="block sm:inline">{{ session('success') }}</span>
        <button @click="show = false" class="absolute top-0 right-0 px-4 py-3">
          <span class="text-2xl">&times;</span>
        </button>
      </div>
    @endif

    @if(session('error'))
      <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
           class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
        <span class="block sm:inline">{{ session('error') }}</span>
        <button @click="show = false" class="absolute top-0 right-0 px-4 py-3">
          <span class="text-2xl">&times;</span>
        </button>
      </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Card Input Transaksi -->
      <div class="bg-[#E5E5E5] rounded-xl shadow-md p-6 md:col-span-1 text-[#123458]">
        <h2 class="text-lg font-semibold mb-4">Input Transaksi</h2>

        <form method="POST" action="{{ route('transaksi.store') }}" class="space-y-4">
          @csrf
          
          <div>
            <label class="block text-sm font-medium">Jenis Transaksi</label>
            <select name="jenis" required class="w-full px-3 py-2 border rounded-md text-sm bg-white text-[#123458]">
              <option value="">-- Pilih Jenis --</option>
              <option value="Pemasukan">Pemasukan</option>
              <option value="Pengeluaran">Pengeluaran</option>
            </select>
            @error('jenis')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-sm font-medium">Kategori</label>
            <input type="text" name="kategori" required class="w-full px-3 py-2 border rounded-md text-sm bg-white text-[#123458]" placeholder="Contoh: Donasi, Gaji, Operasional">
            @error('kategori')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-sm font-medium">Tanggal</label>
            <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 border rounded-md text-sm bg-white text-[#123458]">
            @error('tanggal')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-sm font-medium">Jumlah Uang</label>
            <input type="number" name="nominal" required min="0" step="0.01" class="w-full px-3 py-2 border rounded-md text-sm bg-white text-[#123458]" placeholder="Rp">
            @error('nominal')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-sm font-medium">Deskripsi</label>
            <textarea name="deskripsi" required class="w-full px-3 py-2 border rounded-md text-sm bg-white text-[#123458]" placeholder="Detail transaksi..."></textarea>
            @error('deskripsi')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <button type="submit" class="w-full px-4 py-2 bg-[#123458] text-white text-sm rounded-md hover:bg-[#0f2e4c]">
            Simpan Transaksi
          </button>
        </form>
      </div>

      <!-- Riwayat Transaksi -->
      <div class="bg-[#E5E5E5] rounded-xl shadow-md p-6 md:col-span-2 text-[#123458]">
        <h2 class="text-lg font-semibold mb-4">Riwayat Transaksi</h2>
        
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm text-left">
            <thead class="bg-[#123458] text-white">
              <tr>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Jenis</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Nominal</th>
                <th class="px-4 py-2">Deskripsi</th>
                <th class="px-4 py-2 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($transaksi as $item)
                <tr class="border-t border-[#123458]/30 hover:bg-white/50">
                  <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                  <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded text-xs {{ $item->jenis === 'Pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                      {{ $item->jenis }}
                    </span>
                  </td>
                  <td class="px-4 py-2">{{ $item->kategori }}</td>
                  <td class="px-4 py-2 font-semibold {{ $item->jenis === 'Pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                    Rp {{ number_format($item->nominal, 0, ',', '.') }}
                  </td>
                  <td class="px-4 py-2">{{ Str::limit($item->deskripsi, 30) }}</td>
                  <td class="px-4 py-2">
                    <div class="flex gap-2 justify-center">
                      <button @click="deleteModal = true; deleteId = {{ $item->id }}" 
                              class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                        Hapus
                      </button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="px-4 py-6 text-center text-[#123458]/70">Belum ada transaksi.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div x-show="deleteModal" 
         x-cloak
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
         @click.self="deleteModal = false">
      <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4" @click.stop>
        <h3 class="text-lg font-bold text-[#123458] mb-4">Konfirmasi Hapus</h3>
        <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus transaksi ini? Tindakan ini tidak dapat dibatalkan.</p>
        
        <div class="flex gap-3 justify-end">
          <button @click="deleteModal = false" 
                  class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
            Batal
          </button>
          <form :action="'/transaksi/' + deleteId" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
              Hapus
            </button>
          </form>
        </div>
      </div>
    </div>
  </main>
</div>

<style>
  [x-cloak] { display: none !important; }
</style>
@endsection