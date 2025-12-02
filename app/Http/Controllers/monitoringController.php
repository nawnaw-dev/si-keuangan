<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class MonitoringController extends Controller
{
    public function index()
    {
        $pemasukan = Transaksi::where('jenis', 'Pemasukan')->sum('nominal');
        $pengeluaran = Transaksi::where('jenis', 'Pengeluaran')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        $jumlahTransaksi = Transaksi::count();
        $transaksiTerbaru = Transaksi::orderBy('tanggal', 'desc')->limit(5)->get();

        return view('monitoring.index', compact(
            'pemasukan',
            'pengeluaran',
            'saldo',
            'jumlahTransaksi',
            'transaksiTerbaru'
        ));
    }
}
