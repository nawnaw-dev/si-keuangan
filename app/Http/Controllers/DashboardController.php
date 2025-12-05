<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->format('m'));
        
        $userId = Auth::id();

        // Ambil transaksi bulan ini
        $transaksiThisMonth = Transaksi::where('user_id', $userId)
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->get();
        
        // Hitung total
        $totalPemasukan = $transaksiThisMonth->where('jenis', 'Pemasukan')->sum('nominal');
        $totalPengeluaran = $transaksiThisMonth->where('jenis', 'Pengeluaran')->sum('nominal');
        $totalSaldo = $totalPemasukan - $totalPengeluaran;
        
        // Hitung persentase vs bulan sebelumnya
        $previousMonth = Carbon::createFromDate($year, $month, 1)->subMonth();
        $transaksiPreviousMonth = Transaksi::where('user_id', $userId)
            ->whereYear('tanggal', $previousMonth->year)
            ->whereMonth('tanggal', $previousMonth->month)
            ->get();
        
        $prevPemasukan = $transaksiPreviousMonth->where('jenis', 'Pemasukan')->sum('nominal');
        $prevPengeluaran = $transaksiPreviousMonth->where('jenis', 'Pengeluaran')->sum('nominal');
        
        $pemasukanPercentage = $prevPemasukan > 0 
            ? round((($totalPemasukan - $prevPemasukan) / $prevPemasukan) * 100, 1)
            : 0;
        
        $pengeluaranPercentage = $prevPengeluaran > 0 
            ? round((($totalPengeluaran - $prevPengeluaran) / $prevPengeluaran) * 100, 1)
            : 0;
        
        return view('dashboard', compact(
            'totalSaldo', 
            'totalPemasukan', 
            'totalPengeluaran',
            'pemasukanPercentage',
            'pengeluaranPercentage',
            'year',
            'month'
        ));
    }
}
