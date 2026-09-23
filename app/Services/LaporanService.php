<?php

namespace App\Services;

use App\Models\Donasi;
use App\Models\Kampanye;
use Carbon\Carbon;

class LaporanService
{
    /**
     * Get summary metrics for admin dashboard.
     */
    public function getDashboardSummary(): array
    {
        return [
            'total_donasi_terverifikasi' => Donasi::where('status', 'verified')->sum('nominal'),
            'total_transaksi_verified'   => Donasi::where('status', 'verified')->count(),
            'total_donasi_pending'       => Donasi::where('status', 'pending')->count(),
            'kampanye_aktif'             => Kampanye::where('status', 'aktif')->count(),
        ];
    }

    /**
     * Filter verified donations for reporting and export.
     */
    public function getLaporanDonasi(?string $startDate = null, ?string $endDate = null, ?int $kampanyeId = null)
    {
        $query = Donasi::with('kampanye')->where('status', 'verified');

        if ($startDate) {
            $query->whereDate('created_at', '>=', Carbon::parse($startDate));
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', Carbon::parse($endDate));
        }

        if ($kampanyeId) {
            $query->where('kampanye_id', $kampanyeId);
        }

        return $query->latest()->get();
    }
}
