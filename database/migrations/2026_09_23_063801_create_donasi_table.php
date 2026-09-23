<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kampanye_id')->nullable()->constrained('kampanye')->nullOnDelete();
            $table->string('nama_donatur');
            $table->string('no_whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->decimal('nominal', 15, 2);
            $table->string('metode_pembayaran')->default('Transfer Manual');
            $table->string('bukti_transfer_path');
            $table->text('pesan_doa')->nullable();
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamp('diverifikasi_pada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
};
