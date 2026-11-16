<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang benar di database
    protected $table = 'peminjamans';

    
protected $fillable = [
    'user_id',
    'nama_peminjam',
    'nama_barang',
    'tanggal_pinjam',
    'tanggal_kembali',
    'jam_mulai',
    'jam_selesai',
    'keperluan',
    'status',
];

}