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
        Schema::create('pengajuan_sk_ipnus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('nama');
            $table->string('no_hp');
            $table->string('asal');

            $table->string('surat_permhonan_pengesahan');
            $table->string('berita_acara_hasil_konferensi');
            $table->string('berita_acara_penyusunan_pengurus');
            $table->string('lampiran_susunan_pengurus');
            $table->string('surat_rekomendasi_mwcnu_prnu');
            $table->string('surat_rekomendasi_pac')->nullable();
            $table->string('cv');
            $table->string('biodata');
            $table->string('surat_pernyataan');
            $table->string('hasil_konferensi');
            $table->string('lpj');
            $table->string('profil');

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
        Schema::dropIfExists('pengajuan_sk_ipnus');
    }
};
