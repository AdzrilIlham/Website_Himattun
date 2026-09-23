<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kampanye extends Model
{
    use HasFactory;

    protected $table = 'kampanye';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'deskripsi',
        'target_dana',
        'dana_terkumpul',
        'tenggat_waktu',
        'banner_path',
        'status',
    ];

    protected $casts = [
        'target_dana'    => 'decimal:2',
        'dana_terkumpul' => 'decimal:2',
        'tenggat_waktu'  => 'date',
    ];

    public function donasi(): HasMany
    {
        return $this->hasMany(Donasi::class);
    }

    public function getPersentaseTercapaiAttribute(): float
    {
        if ($this->target_dana <= 0) {
            return 0.0;
        }

        return min(100.0, round(($this->dana_terkumpul / $this->target_dana) * 100, 1));
    }
}
