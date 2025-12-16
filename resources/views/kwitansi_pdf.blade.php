<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Kwitansi</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      color: #1f2937;
      margin: 0;
      padding: 24px;
    }

    .card {
      border: 1px solid #e5e7eb;
      border-radius: 14px;
      padding: 24px;
    }

    /* Header */
    .header {
      display: table;
      width: 100%;
      margin-bottom: 20px;
    }

    .header-left,
    .header-right {
      display: table-cell;
      vertical-align: top;
    }

    .header-left {
      width: 60%;
    }

    .brand {
      font-size: 18px;
      font-weight: bold;
      color: #123458;
      margin-bottom: 4px;
    }

    .subtitle {
      font-size: 11px;
      color: #6b7280;
    }

    .header-right {
      width: 40%;
      text-align: right;
    }

    .title {
      font-size: 26px;
      font-weight: bold;
      margin: 0;
      letter-spacing: 1px;
    }

    .no {
      font-size: 11px;
      color: #6b7280;
      margin-top: 6px;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th {
      text-align: left;
      padding: 10px;
      width: 30%;
      background: #f3f4f6;
      border: 1px solid #e5e7eb;
      font-weight: bold;
      color: #123458;
    }

    td {
      padding: 10px;
      border: 1px solid #e5e7eb;
    }

    /* Total */
    .total {
      margin-top: 18px;
      padding: 14px 16px;
      border-radius: 12px;
      background: #f9fafb;
      border: 1px solid #e5e7eb;
      display: table;
      width: 100%;
    }

    .total-left,
    .total-right {
      display: table-cell;
      vertical-align: middle;
    }

    .total-left {
      font-size: 12px;
      color: #6b7280;
    }

    .total-right {
      text-align: right;
      font-size: 20px;
      font-weight: bold;
      color: #6D28D9;
    }

    /* Footer */
    .note {
      margin-top: 18px;
      font-size: 10px;
      color: #6b7280;
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="card">

    <!-- Header -->
    <div class="header">
      <div class="header-left">
        <div class="brand">Koin Kene</div>
        <div class="subtitle">Bukti Transaksi / Kwitansi</div>
      </div>
      <div class="header-right">
        <div class="title">KWITANSI</div>
        <div class="no">No: {{ $kwitansi->id }}</div>
      </div>
    </div>

    <!-- Content -->
    <table>
      <tr>
        <th>Nama Pengirim</th>
        <td>{{ $kwitansi->nama_pengirim }}</td>
      </tr>
      <tr>
        <th>Nama Penerima</th>
        <td>{{ $kwitansi->nama_penerima }}</td>
      </tr>
      <tr>
        <th>Tanggal</th>
        <td>{{ \Carbon\Carbon::parse($kwitansi->tanggal)->format('d/m/Y') }}</td>
      </tr>
      <tr>
        <th>Keterangan</th>
        <td>{{ $kwitansi->keterangan }}</td>
      </tr>
    </table>

    <!-- Total -->
    <div class="total">
      <div class="total-left">Total Pembayaran</div>
      <div class="total-right">
        Rp {{ number_format($kwitansi->nominal, 0, ',', '.') }}
      </div>
    </div>

    <div class="note">
      Dokumen ini dibuat secara otomatis oleh sistem Koin Kene.
    </div>

  </div>

</body>
</html>
