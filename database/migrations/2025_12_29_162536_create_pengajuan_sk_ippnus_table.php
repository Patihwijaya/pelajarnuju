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
        Schema::create('pengajuan_sk_ippnus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('nama');
            $table->string('no_hp');
            $table->string('asal');

            $table->string('surat_permohonan_pengesahan');
            $table->string('berita_acara_surat_keputusan_konferensi');
            $table->string('berita_acara_penyusunan_pengurus_oleh_tim_formatur');
            $table->string('berita_acara_penyusunan_pengurus_oleh_pengurus_harian');
            $table->string('susunan_pengurus_lengkap');
            $table->string('foto_kartu_identitas_pengurus_harian_dan_ketua_lembaga');
            $table->string('surat_rekomendasi_mwcnu_atau_prnu');
            $table->string('surat_rekomendasi_pimpinan_lembaga_pendidikan')->nullable();
            $table->string('surat_rekomendasi_pac_ippnu')->nullable();

            $table->enum('status', ['diproses', 'dikembalikan', 'diterima'])->default('diproses');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_sk_ippnus');
    }
};
