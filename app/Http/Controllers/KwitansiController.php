<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kwitansi;
use Barryvdh\DomPDF\Facade\Pdf;

class KwitansiController extends Controller
{
    // Menampilkan form cetak kwitansi
    public function index()
    {
        return view('kwitansi');
    }

    // Simpan data & cetak kwitansi
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengirim' => 'required',
            'nama_penerima' => 'required',
            'tanggal'       => 'required|date',
            'keterangan'    => 'required',
            'nominal'       => 'required|numeric',
        ]);

        // $kwitansi = Kwitansi::create($request->all());

        return redirect()->back()->with('success', 'Kwitansi berhasil dibuat!');
    }

    // Download PDF Kwitansi
    public function exportPdf($id)
    {
        // $kwitansi = Kwitansi::findOrFail($id);

        $pdf = Pdf::loadView('pdf.kwitansi', compact('kwitansi'));
        return $pdf->download('kwitansi-'.$kwitansi->id.'.pdf');
    }
}
