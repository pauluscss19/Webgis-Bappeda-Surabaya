<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemografiRw extends Model
{
    protected $table = 'demografi_rw';

    protected $fillable = [
        'kecamatan',
        'kelurahan',
        'rw',
        'gabung',
        'jumlah_kk',
        'jumlah_jiwa',
    ];

    /**
     * Scope to filter by kelurahan and kecamatan
     */
    public function scopeForWilayah($query, string $kecamatan, string $kelurahan)
    {
        return $query->where('kecamatan', $kecamatan)->where('kelurahan', $kelurahan);
    }
}
