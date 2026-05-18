<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SarprasPeralatan extends Model
{
    protected $table = 'kebutuhan_bbm_peralatan_operasionals';

    protected $fillable = [
        'tipe_peralatan',
        'jenis_bbm',
        'jumlah_total',
        'jumlah_beroperasi',
        'jumlah_rusak',
        'jumlah_cadangan',
        'kebutuhan_per_unit_pertamax',
        'kebutuhan_per_unit_dexlite',
        'kebutuhan_1_tahun_pertamax',
        'kebutuhan_1_tahun_dexlite',
        'keterangan',
    ];

    protected $casts = [
        'jumlah_total' => 'integer',
        'jumlah_beroperasi' => 'integer',
        'jumlah_rusak' => 'integer',
        'jumlah_cadangan' => 'integer',
        'kebutuhan_per_unit_pertamax' => 'double',
        'kebutuhan_per_unit_dexlite' => 'double',
        'kebutuhan_1_tahun_pertamax' => 'double',
        'kebutuhan_1_tahun_dexlite' => 'double',
    ];
}
