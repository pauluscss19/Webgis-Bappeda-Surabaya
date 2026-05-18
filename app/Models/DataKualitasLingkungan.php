<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataKualitasLingkungan extends Model
{
    protected $table = 'data_kualitas_lingkungan';

    protected $fillable = [
        'lokasi',
        'kecamatan',
        'kelurahan',
        'jenis_uji',
        'parameter_uji',
        'nilai_hasil',
        'satuan',
        'baku_mutu',
        'status',
        'tanggal_uji',
        'tahun',
        'sumber_data',
        'keterangan',
    ];

    protected $casts = [
        'nilai_hasil' => 'double',
        'baku_mutu' => 'double',
        'tahun' => 'integer',
        'tanggal_uji' => 'date',
    ];

    /**
     * Label jenis uji yang mudah dibaca
     */
    public function getJenisUjiLabelAttribute(): string
    {
        return match ($this->jenis_uji) {
            'air_sungai' => 'Air Sungai',
            'air_laut' => 'Air Laut',
            'udara_ambien' => 'Udara Ambien',
            'tanah' => 'Tanah',
            'kebisingan' => 'Kebisingan',
            default => ucfirst($this->jenis_uji ?? '-'),
        };
    }

    /**
     * Label status berwarna
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'memenuhi' => 'Memenuhi',
            'tidak_memenuhi' => 'Tidak Memenuhi',
            'belum_diuji' => 'Belum Diuji',
            default => '-',
        };
    }
}
