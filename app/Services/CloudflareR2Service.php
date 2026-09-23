<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CloudflareR2Service
{
    /**
     * Upload public asset (news image, gallery, child profile) to r2_public.
     */
    public function uploadPublic(UploadedFile $file, string $directory = 'berita'): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($directory, $filename, 'r2_public');

        return $path ?: '';
    }

    /**
     * Upload private document (donation proof) to r2_private.
     */
    public function uploadPrivate(UploadedFile $file, string $directory = 'bukti-transfer'): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($directory, $filename, 'r2_private');

        return $path ?: '';
    }

    /**
     * Generate temporary pre-signed URL for viewing private donation proof.
     */
    public function getPrivateTemporaryUrl(string $path, int $minutes = 10): string
    {
        if (!Storage::disk('r2_private')->exists($path)) {
            return '';
        }

        return Storage::disk('r2_private')->temporaryUrl(
            $path,
            now()->addMinutes($minutes)
        );
    }

    /**
     * Get public URL for assets in public bucket.
     */
    public function getPublicUrl(string $path): string
    {
        return Storage::disk('r2_public')->url($path);
    }
}
