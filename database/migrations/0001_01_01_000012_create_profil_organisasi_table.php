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
        Schema::create('profil_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_organisasi');
            $table->string('logo_path')->nullable();
            $table->longText('sejarah')->nullable();
            $table->longText('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->text('struktur_organisasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_organisasi');
    }
};
