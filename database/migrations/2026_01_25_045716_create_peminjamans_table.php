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
        Schema::create('peminjamans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users');
        $table->foreignId('barang_id')->constrained('barangs');
        $table->integer('jumlah_pinjam');
        $table->date('tgl_pinjam');
        $table->date('tgl_kembali');
        // Status sesuai coretan: Waiting (Ajuan), Approved (Diterima), Rejected (Ditolak), Returned (Selesai)
        $table->enum('status', ['waiting', 'approved', 'rejected', 'returned'])->default('waiting');
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
