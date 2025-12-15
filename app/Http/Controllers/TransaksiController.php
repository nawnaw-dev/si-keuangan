<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // ✅ Menampilkan halaman transaksi
    public function index()
    {
        $userId = Auth::id();

        $transaksi = Transaksi::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transaksi', compact('transaksi'));
    }

    // ✅ Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Pemasukan,Pengeluaran',
            'kategori' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'nominal' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
        ]);

        $userId = Auth::id();

        // ✅ Ambil saldo terakhir user
        $saldoSebelumnya = Transaksi::where('user_id', $userId)
            ->latest('tanggal')
            ->first()?->saldo_akhir ?? 0;

        // ✅ Hitung saldo akhir baru
        $saldoAkhir = $request->jenis === 'Pemasukan'
            ? $saldoSebelumnya + $request->nominal
            : $saldoSebelumnya - $request->nominal;

        // ✅ Simpan transaksi
        Transaksi::create([
            'user_id'   => $userId,
            'jenis'     => $request->jenis,
            'kategori'  => $request->kategori,
            'tanggal'   => $request->tanggal,
            'nominal'   => $request->nominal,
            'deskripsi' => $request->deskripsi,
            'saldo_akhir' => $saldoAkhir,
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil disimpan!');
    }

    // ✅ Menghapus transaksi
    public function destroy($id)
    {
        $userId = Auth::id();

        $transaksi = Transaksi::where('user_id', $userId)->findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}
