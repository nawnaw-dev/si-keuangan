<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'jenis',
        'kategori',
        'tanggal',
        'nominal',
        'deskripsi',
        'saldo_akhir'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'decimal:2',
        'saldo_akhir' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}