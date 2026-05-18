<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RthData extends Model
{
    protected $table = 'luasan_rth_dprkpps';

    protected $fillable = [
        'tipologi',
        'zona',
        'kode',
        'luas',
        'bobot',
        'luas_x_bobot',
        'fhbi',
        'jumlah',
    ];

    protected $casts = [
        'luas' => 'double',
        'bobot' => 'double',
        'luas_x_bobot' => 'double',
        'fhbi' => 'double',
        'jumlah' => 'double',
    ];

    public function getTipologiLabelAttribute(): string
    {
        return match ($this->tipologi) {
            'A' => 'Tipologi A (Publik)',
            'B' => 'Tipologi B (Privat)',
            'C' => 'Tipologi C (Badan Air)',
            default => 'Tipologi ' . $this->tipologi,
        };
    }
}
