<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    use HasFactory;

    protected $table = 'kwitansis'; // default Laravel

    protected $fillable = [
        'nama_pengirim',
        'nama_penerima',
        'tanggal',
        'keterangan',
        'nominal',
    ];
}
