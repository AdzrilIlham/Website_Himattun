<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'konten',
        'thumbnail_path',
        'penulis',
        'status',
        'dipublikasikan_pada',
    ];

    protected $casts = [
        'dipublikasikan_pada' => 'datetime',
    ];
}
