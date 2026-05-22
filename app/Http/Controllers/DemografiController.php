<?php

namespace App\Http\Controllers;

use App\Models\DemografiRw;
use Illuminate\Http\JsonResponse;

class DemografiController extends Controller
{
    /**
     * GET /api/demografi
     * 
     * Mengembalikan data demografi per kelurahan (agregasi dari semua RW).
     * Format: array of { kelurahan, kecamatan, total_kk, total_jiwa }
     * Digunakan sebagai bobot MCE di frontend.
     */
    public function index(): JsonResponse
    {
        $data = DemografiRw::query()
            ->selectRaw('UPPER(kecamatan) as kecamatan, UPPER(kelurahan) as kelurahan, SUM(jumlah_kk) as total_kk, SUM(jumlah_jiwa) as total_jiwa, COUNT(*) as jumlah_rw')
            ->groupBy('kecamatan', 'kelurahan')
            ->orderBy('kecamatan')
            ->orderBy('kelurahan')
            ->get();

        return response()->json([
            'data' => $data,
            'total_kelurahan' => $data->count(),
            'total_kk' => $data->sum('total_kk'),
            'total_jiwa' => $data->sum('total_jiwa'),
        ])->header('Cache-Control', 'public, max-age=3600');
    }

    /**
     * GET /api/demografi/detail
     * 
     * Mengembalikan data demografi per RW (detail lengkap).
     */
    public function detail(): JsonResponse
    {
        $data = DemografiRw::query()
            ->select('kecamatan', 'kelurahan', 'rw', 'gabung', 'jumlah_kk', 'jumlah_jiwa')
            ->orderBy('kecamatan')
            ->orderBy('kelurahan')
            ->orderBy('rw')
            ->get();

        return response()->json([
            'data' => $data,
            'total_rows' => $data->count(),
        ])->header('Cache-Control', 'public, max-age=3600');
    }
}
