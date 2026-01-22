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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('nama_file');
            $table->enum('kategori', ['logo', 'ad_art', 'administrasi', 'surat_template', 'panduan_lain'])->default('panduan_lain');
            $table->text('deskripsi')->nullable();
            $table->string('file_path');
            $table->integer('download_count')->default(0);
            $table->timestamps();

            $table->index('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
