<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnakAsuh extends Model
{
    use HasFactory;

    protected $table = 'anak_asuh';

    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'jenis_kelamin',
        'tanggal_lahir',
        'pendidikan_terakhir',
        'status_asuhan',
        'foto_path',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
