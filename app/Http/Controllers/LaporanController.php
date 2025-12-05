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
        $laporan = Transaksi::where('user_id', $userId)->get();

        return view('laporan.index', compact('laporan'));
    }

    public function generate()
    {
        $userId = Auth::id();
        $laporan = Transaksi::where('user_id', $userId)->get();

        return view('laporan.generate', compact('laporan'));
    }

    public function exportPDF()
    {
        $userId = Auth::id();
        $laporan = Transaksi::where('user_id', $userId)->get();

        // contoh: generate PDF pakai dompdf
        $pdf = PDF::loadView('laporan.pdf', compact('laporan'));
        return $pdf->download('laporan.pdf');
    }
}
