<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SKPengajuan extends Model
{
    protected $table = 'sk_pengajuan';

    protected $fillable = [
        'tipe',
        'nama',
        'alamat',
        'pondok',
        'rayon_id',
        'korwil_id',
        'file_pendukung',
        'status',
        'catatan_revisi',
        'submitted_by',
        'approved_by',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
        ];
    }

    public function rayon(): BelongsTo
    {
        return $this->belongsTo(Rayon::class);
    }

    public function korwil(): BelongsTo
    {
        return $this->belongsTo(Korwil::class);
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRevised($query)
    {
        return $query->where('status', 'revised');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
