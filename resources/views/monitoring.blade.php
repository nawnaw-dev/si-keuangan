@extends('layouts.app')

@section('title', 'Monitoring Saldo')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-[#123458]">Monitoring Saldo</h1>
    <p class="text-sm text-gray-600 mt-1">30 November 2025</p>
</div>

{{-- Kartu Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

    <div class="bg-white rounded-xl shadow p-5 border border-gray-200">
        <p class="text-sm text-gray-500">Total Saldo</p>
        <p class="text-2xl font-bold text-black mt-1">Rp 15.000.000</p>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border border-gray-200">
        <p class="text-sm text-gray-500">Total Pemasukan</p>
        <p class="text-2xl font-bold text-black mt-1">Rp 15.000.000</p>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border border-gray-200">
        <p class="text-sm text-gray-500">Total Pengeluaran</p>
        <p class="text-2xl font-bold text-black mt-1">Rp 15.000.000</p>
    </div>

    <div class="bg-white rounded-xl shadow p-5 border border-gray-200">
        <p class="text-sm text-gray-500">Jumlah Transaksi</p>
        <p class="text-2xl font-bold text-black mt-1">15</p>
    </div>

</div>

{{-- Daftar Transaksi --}}
<div class="bg-white rounded-xl shadow p-6 mt-10 border border-gray-200">

    <h2 class="text-lg font-semibold text-[#123458] mb-4">
        Daftar Transaksi Terbaru
    </h2>

    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-300 bg-gray-50">
                <th class="py-2 px-1 text-left">Tanggal</th>
                <th class="py-2 px-1 text-left">Nama</th>
                <th class="py-2 px-1 text-left">Kategori</th>
                <th class="py-2 px-1 text-left">Nominal</th>
            </tr>
        </thead>

        <tbody>
            {{-- Baris dummy 5x --}}
            @for ($i = 0; $i < 5; $i++)
            <tr class="border-b border-gray-200">
                <td class="py-3 text-gray-500">—</td>
                <td class="py-3 text-gray-500">—</td>
                <td class="py-3 text-gray-500">—</td>
                <td class="py-3 text-gray-500">—</td>
            </tr>
            @endfor
        </tbody>
    </table>

</div>

@endsection
