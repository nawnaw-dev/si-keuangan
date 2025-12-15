@extends('layouts.app')

@section('title', 'Koin Kene - Dashboard')

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
  <main class="flex-1 p-8">
    <!-- Header dengan dropdown tahun dan bulan -->
    <div class="mb-8 flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-bold text-[#123458]">Koin Kene - Dashboard</h1>
        <p class="text-sm text-gray-600 mt-2">Hallo, Welcome Back!</p>
      </div>
      <!-- Dropdown tahun + bulan -->
      <div class="flex items-center gap-3">
        <!-- Tahun -->
        <select 
          name="year" 
          class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#123458] focus:border-[#123458]"
        >
          @for ($y = 2020; $y <= 2030; $y++)
            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
          @endfor
        </select>

        <!-- Bulan -->
        <select 
          name="month" 
          class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#123458] focus:border-[#123458]"
        >
          @foreach ([
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
          ] as $num => $name)
            <option value="{{ $num }}" {{ $num == $month ? 'selected' : '' }}>{{ $name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <!-- Row: Income kiri, Saving + Expend kanan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
      <!-- Saldo -->
      <div class="bg-[#D9D9D9] rounded-xl p-6 shadow-md min-h-[340px] flex flex-col justify-between">
        <h2 class="text-lg font-semibold text-[#123458]">Total Saldo</h2>
        <div class="flex flex-col justify-center flex-1">
          <p class="text-3xl font-bold text-gray-800">
            Rp.{{ number_format($totalSaldo, 0, ',', '.') }}
          </p>
          <p class="text-sm text-gray-600 mt-2">
            {{ $pemasukanPercentage }}% Vs previous period
          </p>
        </div>
      </div>

      <!-- Kanan: Pemasukan + Pengeluaran -->
      <div class="flex flex-col gap-6">
        <div class="bg-[#D9D9D9] rounded-xl p-6 shadow-md min-h-[160px]">
          <h2 class="text-lg font-semibold text-[#123458]">Total Pemasukan</h2>
          <p class="text-2xl font-bold text-gray-800 mt-3">
            Rp.{{ number_format($totalPemasukan, 0, ',', '.') }}
          </p>
          <p class="text-sm text-gray-600 mt-2">
            {{ $pemasukanPercentage }}% Vs previous period
          </p>
        </div>
        <div class="bg-[#D9D9D9] rounded-xl p-6 shadow-md min-h-[160px]">
          <h2 class="text-lg font-semibold text-[#123458]">Total Pengeluaran</h2>
          <p class="text-2xl font-bold text-gray-800 mt-3">
            Rp.{{ number_format($totalPengeluaran, 0, ',', '.') }}
          </p>
          <p class="text-sm text-gray-600 mt-2">
            {{ $pengeluaranPercentage }}% Vs previous period
          </p>
        </div>
      </div>
    </div>

    <!-- Bottom row: catatan+grafik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
      <!-- Tambah Catatan Card -->
      <div x-data="{ notes: [], newNote: '', showInput: false }" 
           class="bg-[#D9D9D9] rounded-xl p-6 shadow-md min-h-[160px] flex flex-col justify-between">
        <div>
          <h2 class="text-lg font-semibold text-[#123458]">Tambah Catatan</h2>
          <p class="text-sm text-gray-600 mt-2">Tambah catatan untuk keuangan anda di sini</p>
        </div>
        <!-- Tombol Add -->
        <button @click="showInput = true" class="self-start mt-4 px-4 py-1 bg-[#123458] text-white text-sm rounded-md hover:bg-[#0f2e4c]">
          + Add
        </button>
        <!-- Form input catatan -->
        <div x-show="showInput" class="mt-4 w-full">
          <textarea x-model="newNote" placeholder="Tulis catatan di sini..." class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#123458] focus:border-[#123458]"></textarea>
          <div class="flex gap-2 mt-2">
            <button @click="if(newNote.trim()){ notes.push(newNote); newNote=''; showInput=false }" class="px-4 py-1 bg-[#2770BE] text-white text-sm rounded-md hover:bg-[#1f5ca0]">
              Simpan
            </button>
            <button @click="newNote=''; showInput=false" class="px-4 py-1 bg-gray-400 text-white text-sm rounded-md hover:bg-gray-500">
              Batal
            </button>
          </div>
        </div>
        <!-- Daftar catatan -->
        <ul class="mt-4 space-y-2">
          <template x-for="(note, index) in notes" :key="index">
            <li class="flex justify-between items-start bg-white rounded-md px-3 py-2 text-sm text-gray-800 shadow-sm">
              <span x-text="note"></span>
              <button @click="notes.splice(index, 1)" class="text-red-500 hover:text-red-700 text-xs ml-4">Hapus</button>
            </li>
          </template>
        </ul>
      </div>

      <!-- Card Reminder --> <div x-data="{ reminders: [], newReminder: '', showInput: false }" class="bg-[#D9D9D9] rounded-xl p-6 shadow-md min-h-[160px] flex flex-col justify-between"> <!-- Header --> <div> <h2 class="text-lg font-semibold text-[#123458]">Reminder Keuangan</h2> <p class="text-sm text-gray-600 mt-2">Tambahkan pengingat penting di sini</p> </div> <!-- Tombol Add --> <button @click="showInput = true" class="self-start mt-4 px-4 py-1 bg-[#123458] text-white text-sm rounded-md hover:bg-[#0f2e4c]"> + Add </button> <!-- Form input reminder --> <div x-show="showInput" class="mt-4 w-full"> <input type="text" x-model="newReminder" placeholder="Tulis reminder (misal: Bayar listrik 5 Desember)" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#123458] focus:border-[#123458]" > <div class="flex gap-2 mt-2"> <button @click="if(newReminder.trim()){ reminders.push(newReminder); newReminder=''; showInput=false }" class="px-4 py-1 bg-[#2770BE] text-white text-sm rounded-md hover:bg-[#1f5ca0]"> Simpan </button> <button @click="newReminder=''; showInput=false" class="px-4 py-1 bg-gray-400 text-white text-sm rounded-md hover:bg-gray-500"> Batal </button> </div> </div> <!-- Daftar reminder --> <ul class="mt-4 space-y-2"> <template x-for="(reminder, index) in reminders" :key="index"> <li class="flex justify-between items-start bg-white rounded-md px-3 py-2 text-sm text-gray-800 shadow-sm"> <span x-text="reminder"></span> <button @click="reminders.splice(index, 1)" class="text-red-500 hover:text-red-700 text-xs ml-4"> Hapus </button> </li> </template> </ul> </div> </div>
       @endsection