<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // lebih aman daripada Auth::user()->id
        $transaksi = Transaksi::where('user_id', $userId)->get();

        return view('transaksi.index', compact('transaksi'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'nominal' => 'required|numeric|min:0',
        ]);

        $transaksi = new Transaksi();
        $transaksi->user_id = $userId;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->jenis = $request->jenis;
        $transaksi->nominal = $request->nominal;

        // Hitung saldo akhir
        $saldoSebelumnya = Transaksi::where('user_id', $userId)->latest('tanggal')->first()?->saldo_akhir ?? 0;
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