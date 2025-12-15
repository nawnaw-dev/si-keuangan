<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $transaksi = Transaksi::where('user_id', $userId)->get();

        // arahkan ke views/transaksi.blade.php
        return view('transaksi', compact('transaksi'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'kategori' => 'nullable|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $saldoSebelumnya = Transaksi::where('user_id', $userId)->latest('tanggal')->first()?->saldo_akhir ?? 0;

        $transaksi = new Transaksi();
        $transaksi->user_id = $userId;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->jenis = $request->jenis;
        $transaksi->kategori = $request->kategori;
        $transaksi->nominal = $request->nominal;
        $transaksi->deskripsi = $request->deskripsi;
        $transaksi->saldo_akhir = $request->jenis === 'Pemasukan'
            ? $saldoSebelumnya + $request->nominal
            : $saldoSebelumnya - $request->nominal;

        $transaksi->save();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        $transaksi = Transaksi::where('user_id', $userId)->findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}