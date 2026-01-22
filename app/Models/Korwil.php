<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Korwil extends Model
{
    protected $table = 'korwils';

    protected $fillable = [
        'name',
        'wilayah',
        'nomor_sk',
        'tanggal_sk',
        'description',
        'contact',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_sk' => 'date',
        ];
    }

    public function rayons(): HasMany
    {
        return $this->hasMany(Rayon::class);
    }

    public function anggota(): HasMany
    {
        return $this->hasMany(Anggota::class);
    }

    public function skPengajuan(): HasMany
    {
        return $this->hasMany(SKPengajuan::class);
    }

    public function scopeWithSK($query)
    {
        return $query->whereNotNull('nomor_sk');
    }
}
