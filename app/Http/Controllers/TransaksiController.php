<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->get();
        
        return view('transaksi', compact('transaksi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'kategori' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'nominal' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string'
        ]);

        // Hitung saldo akhir
        $lastTransaction = Transaksi::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->first();
        
        $lastSaldo = $lastTransaction ? $lastTransaction->saldo_akhir : 0;
        
        if ($validated['jenis'] === 'Pemasukan') {
            $saldoAkhir = $lastSaldo + $validated['nominal'];
        } else {
            $saldoAkhir = $lastSaldo - $validated['nominal'];
        }

        Transaksi::create([
            'user_id' => auth()->id(),
            'jenis' => $validated['jenis'],
            'kategori' => $validated['kategori'],
            'tanggal' => $validated['tanggal'],
            'nominal' => $validated['nominal'],
            'deskripsi' => $validated['deskripsi'],
            'saldo_akhir' => $saldoAkhir
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }
}