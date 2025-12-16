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

    // Simpan data kwitansi
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengirim' => 'required|string|max:100',
            'nama_penerima' => 'required|string|max:100',
            'tanggal'       => 'required|date',
            'keterangan'    => 'required|string',
            'nominal'       => 'required|numeric|min:0',
        ]);

        // Simpan ke DB
        $kwitansi = Kwitansi::create($validated);

        // Balik ke halaman kwitansi + simpan id untuk tombol Download PDF
        return redirect()
            ->route('kwitansi.index')
            ->with('kwitansi_id', $kwitansi->id);
    }

    // Download PDF Kwitansi
    public function exportPdf($id)
    {
        $kwitansi = Kwitansi::findOrFail($id);

        $pdf = Pdf::loadView('kwitansi_pdf', compact('kwitansi'));
        return $pdf->download('kwitansi-' . $kwitansi->id . '.pdf');
    }
}
