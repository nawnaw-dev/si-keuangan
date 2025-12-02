<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // Halaman utama laporan
    public function index()
    {
        // default kosong
        $transaksiBulanan = [];
        $totalPemasukan = 0;
        $totalPengeluaran = 0;

        return view('laporan', compact('transaksiBulanan', 'totalPemasukan', 'totalPengeluaran'));
    }

    // Generate laporan berdasarkan bulan & tahun
    public function generate(Request $request)
    {
        $periode = $request->input('periode'); // format: YYYY-MM
        [$tahun, $bulan] = explode('-', $periode);

        $transaksiBulanan = Transaksi::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->orderBy('tanggal', 'asc')
            ->get();

        $totalPemasukan = $transaksiBulanan->where('jenis', 'Pemasukan')->sum('nominal');
        $totalPengeluaran = $transaksiBulanan->where('jenis', 'Pengeluaran')->sum('nominal');

        // hitung saldo akhir per transaksi
        $saldo = 0;
        foreach ($transaksiBulanan as $item) {
            if ($item->jenis === 'Pemasukan') {
                $saldo += $item->nominal;
            } else {
                $saldo -= $item->nominal;
            }
            $item->saldo_akhir = $saldo;
        }

        return view('laporan', compact('transaksiBulanan', 'totalPemasukan', 'totalPengeluaran'));
    }

    // Export laporan ke PDF
    public function export(Request $request)
    {
        $periode = $request->input('periode') ?? date('Y-m');
        [$tahun, $bulan] = explode('-', $periode);

        $transaksiBulanan = Transaksi::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->orderBy('tanggal', 'asc')
            ->get();

        $totalPemasukan = $transaksiBulanan->where('jenis', 'Pemasukan')->sum('nominal');
        $totalPengeluaran = $transaksiBulanan->where('jenis', 'Pengeluaran')->sum('nominal');

        $saldo = 0;
        foreach ($transaksiBulanan as $item) {
            if ($item->jenis === 'Pemasukan') {
                $saldo += $item->nominal;
            } else {
                $saldo -= $item->nominal;
            }
            $item->saldo_akhir = $saldo;
        }

        $pdf = PDF::loadView('laporan_pdf', compact('transaksiBulanan', 'totalPemasukan', 'totalPengeluaran'));
        return $pdf->download('laporan-keuangan-'.$periode.'.pdf');
    }
}
