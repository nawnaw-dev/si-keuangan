<h1 style="text-align:center; color:#123458;">Laporan Keuangan Bulan {{ date('F Y', strtotime($periode)) }}</h1>

<h3>Total Pemasukan: Rp {{ number_format($totalPemasukan,0,',','.') }}</h3>
<h3>Total Pengeluaran: Rp {{ number_format($totalPengeluaran,0,',','.') }}</h3>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <thead style="background:#123458; color:white;">
    <tr>
      <th>Tanggal</th>
      <th>Jenis</th>
      <th>Nominal</th>
      <th>Deskripsi</th>
      <th>Saldo Akhir</th>
    </tr>
  </thead>
  <tbody>
    @foreach($transaksiBulanan as $item)
      <tr>
        <td>{{ $item->tanggal }}</td>
        <td>{{ $item->jenis }}</td>
        <td>Rp {{ number_format($item->nominal,0,',','.') }}</td>
        <td>{{ $item->deskripsi }}</td>
        <td>Rp {{ number_format($item->saldo_akhir,0,',','.') }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
