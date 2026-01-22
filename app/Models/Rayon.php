<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rayon extends Model
{
    protected $table = 'rayons';

    protected $fillable = [
        'name',
        'korwil_id',
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

    public function korwil(): BelongsTo
    {
        return $this->belongsTo(Korwil::class);
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
