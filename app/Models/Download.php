<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Download extends Model
{
    protected $table = 'downloads';

    protected $fillable = [
        'nama_file',
        'kategori',
        'deskripsi',
        'file_path',
        'download_count',
    ];

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }

    public function fileExists()
    {
        return Storage::disk('public')->exists($this->file_path);
    }

    public function getFileSizeAttribute()
    {
        if ($this->fileExists()) {
            return Storage::disk('public')->size($this->file_path);
        }
        return 0;
    }

    public function getFormattedFileSizeAttribute()
    {
        $size = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        $size = max($size, 0);
        $pow = floor(($size ? log($size) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $size /= (1 << (10 * $pow));

        return round($size, 2) . ' ' . $units[$pow];
    }
}
