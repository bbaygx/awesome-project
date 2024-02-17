<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = ['user_id', 'judul_laporan', 'isi_laporan', 'lokasi_kejadian', 'kategori_laporan', 'tanggal_kejadian', 'lampiran'];
}
