<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // semua transaksi user
        $laporan = Transaksi::where('user_id', $userId)->get();

        // transaksi bulan ini
        $transaksiBulanan = Transaksi::where('user_id', $userId)
            ->whereYear('tanggal', now()->year)
            ->whereMonth('tanggal', now()->month)
            ->get();

        // ringkasan
        $totalPemasukan = $laporan->where('jenis', 'Pemasukan')->sum('nominal');
        $totalPengeluaran = $laporan->where('jenis', 'Pengeluaran')->sum('nominal');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // periode laporan
        $periode = now()->format('Y-m-01');

        return view('laporan', compact(
            'laporan',
            'transaksiBulanan',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoAkhir',
            'periode'
        ));
    }

    public function generate()
    {
        return $this->index(); // biar tidak duplikasi kode
    }

    public function exportPDF()
    {
        $userId = Auth::id();
        $laporan = Transaksi::where('user_id', $userId)->get();

        $transaksiBulanan = Transaksi::where('user_id', $userId)
            ->whereYear('tanggal', now()->year)
            ->whereMonth('tanggal', now()->month)
            ->get();

        $totalPemasukan = $laporan->where('jenis', 'Pemasukan')->sum('nominal');
        $totalPengeluaran = $laporan->where('jenis', 'Pengeluaran')->sum('nominal');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // ✅ WAJIB ADA
        $periode = now()->format('Y-m-01');

        $pdf = Pdf::loadView('laporan_pdf', compact(
            'laporan',
            'transaksiBulanan',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoAkhir',
            'periode'
        ));

        return $pdf->download('laporan.pdf');
    }
}