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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_resi')->unique();
            $table->string('nama_pelanggan');
            $table->string('no_hp');
            $table->text('alamat');
            
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('total_harga', 15, 2);
            $table->text('catatan')->nullable();
            
            // File Uploads Tahap 1
            $table->string('file_desain');
            $table->string('foto_ktp');
            
            // Pembayaran Tahap 2 (Bisa kosong di awal)
            $table->string('metode_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            
            // Status baru ditambahkan
            $table->enum('status', ['menunggu_pembayaran', 'pending', 'diproses', 'selesai'])->default('menunggu_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
