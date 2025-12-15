<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        return view('monitoring', [
            'saldo' => 0,
            'pemasukan' => 0,
            'pengeluaran' => 0,
            'jumlahTransaksi' => 0,
            'transaksiTerbaru' => collect()
        ]);
    }
}
