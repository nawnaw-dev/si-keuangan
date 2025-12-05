<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $totalPemasukan = 0;
        $totalPengeluaran = 0;
        $transaksiBulanan = collect();
        
        return view('laporan', compact('totalPemasukan', 'totalPengeluaran', 'transaksiBulanan'));
    }

    public function generate(Request $request)
    {
        $periode = $request->get('periode'); // Format: YYYY-MM
        
        if (!$periode) {
            return redirect()->route('laporan.index');
        }
        
        $date = Carbon::createFromFormat('Y-m', $periode);
        
        $transaksiBulanan = Transaksi::where('user_id', auth()->id())
            ->whereYear('tanggal', $date->year)
            ->whereMonth('tanggal', $date->month)
            ->orderBy('tanggal', 'asc')
            ->get();
        
        $totalPemasukan = $transaksiBulanan->where('jenis', 'Pemasukan')->sum('nominal');
        $totalPengeluaran = $transaksiBulanan->where('jenis', 'Pengeluaran')->sum('nominal');
        
        return view('laporan', compact('totalPemasukan', 'totalPengeluaran', 'transaksiBulanan'));
    }

    public function exportPDF()
    {
        // TODO: Implementasi export PDF menggunakan library seperti DomPDF
        return redirect()->route('laporan.index')
            ->with('info', 'Fitur export PDF akan segera tersedia');
    }
}