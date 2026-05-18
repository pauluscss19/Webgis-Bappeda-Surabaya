<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSampah extends Model
{
    protected $table = 'data_sampah';

    protected $fillable = [
        'kecamatan',
        'kelurahan',
        'volume_sampah_ton',
        'sampah_terangkut_ton',
        'sampah_diolah_ton',
        'sampah_tidak_terkelola_ton',
        'jumlah_tps',
        'jumlah_bank_sampah',
        'sumber_data',
        'tahun',
        'keterangan',
    ];

    protected $casts = [
        'volume_sampah_ton' => 'double',
        'sampah_terangkut_ton' => 'double',
        'sampah_diolah_ton' => 'double',
        'sampah_tidak_terkelola_ton' => 'double',
        'jumlah_tps' => 'integer',
        'jumlah_bank_sampah' => 'integer',
        'tahun' => 'integer',
    ];

    /**
     * Hitung persentase pengelolaan sampah
     */
    public function getPersentaseTerkelolaAttribute(): float
    {
        if ($this->volume_sampah_ton <= 0) return 0;
        return round(($this->sampah_terangkut_ton + $this->sampah_diolah_ton) / $this->volume_sampah_ton * 100, 2);
    }
}
