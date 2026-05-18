<?php

namespace App\Http\Controllers;

use App\Models\DataSampah;
use Illuminate\Http\Request;

class DataSampahController extends Controller
{
    /**
     * Tampilkan daftar data sampah
     */
    public function index(Request $request)
    {
        $query = DataSampah::query();

        // Filter pencarian
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('kecamatan', 'like', "%{$search}%")
                  ->orWhere('kelurahan', 'like', "%{$search}%")
                  ->orWhere('sumber_data', 'like', "%{$search}%");
            });
        }

        // Filter tahun
        if ($tahun = $request->query('tahun')) {
            $query->where('tahun', $tahun);
        }

        // Sorting
        $sortBy = $request->query('sort', 'created_at');
        $sortDir = $request->query('dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $data = $query->paginate(10)->appends($request->query());

        // Data ringkasan
        $summary = [
            'total_data' => DataSampah::count(),
            'total_volume' => DataSampah::sum('volume_sampah_ton'),
            'total_terangkut' => DataSampah::sum('sampah_terangkut_ton'),
            'total_diolah' => DataSampah::sum('sampah_diolah_ton'),
            'total_tps' => DataSampah::sum('jumlah_tps'),
            'total_bank_sampah' => DataSampah::sum('jumlah_bank_sampah'),
        ];

        $tahunList = DataSampah::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('pages.crud.data-sampah.index', compact('data', 'summary', 'tahunList'));
    }

    /**
     * Form tambah data sampah
     */
    public function create()
    {
        return view('pages.crud.data-sampah.create');
    }

    /**
     * Simpan data sampah baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'volume_sampah_ton' => 'required|numeric|min:0',
            'sampah_terangkut_ton' => 'required|numeric|min:0',
            'sampah_diolah_ton' => 'required|numeric|min:0',
            'sampah_tidak_terkelola_ton' => 'required|numeric|min:0',
            'jumlah_tps' => 'required|integer|min:0',
            'jumlah_bank_sampah' => 'required|integer|min:0',
            'sumber_data' => 'nullable|string|max:255',
            'tahun' => 'required|integer|min:2000|max:2099',
            'keterangan' => 'nullable|string',
        ]);

        DataSampah::create($validated);

        return redirect()->route('data-sampah.index')
            ->with('success', 'Data sampah berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail data sampah (redirect ke index)
     */
    public function show(DataSampah $dataSampah)
    {
        return redirect()->route('data-sampah.index');
    }

    /**
     * Form edit data sampah
     */
    public function edit(DataSampah $dataSampah)
    {
        return view('pages.crud.data-sampah.edit', compact('dataSampah'));
    }

    /**
     * Update data sampah
     */
    public function update(Request $request, DataSampah $dataSampah)
    {
        $validated = $request->validate([
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'volume_sampah_ton' => 'required|numeric|min:0',
            'sampah_terangkut_ton' => 'required|numeric|min:0',
            'sampah_diolah_ton' => 'required|numeric|min:0',
            'sampah_tidak_terkelola_ton' => 'required|numeric|min:0',
            'jumlah_tps' => 'required|integer|min:0',
            'jumlah_bank_sampah' => 'required|integer|min:0',
            'sumber_data' => 'nullable|string|max:255',
            'tahun' => 'required|integer|min:2000|max:2099',
            'keterangan' => 'nullable|string',
        ]);

        $dataSampah->update($validated);

        return redirect()->route('data-sampah.index')
            ->with('success', 'Data sampah berhasil diperbarui!');
    }

    /**
     * Hapus data sampah
     */
    public function destroy(DataSampah $dataSampah)
    {
        $dataSampah->delete();

        return redirect()->route('data-sampah.index')
            ->with('success', 'Data sampah berhasil dihapus!');
    }
}
