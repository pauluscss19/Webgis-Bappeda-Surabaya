<?php

namespace App\Http\Controllers;

use App\Models\DataKualitasLingkungan;
use Illuminate\Http\Request;

class DataKualitasLingkunganController extends Controller
{
    /**
     * Tampilkan daftar data kualitas lingkungan
     */
    public function index(Request $request)
    {
        $query = DataKualitasLingkungan::query();

        // Filter pencarian
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('lokasi', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%")
                  ->orWhere('parameter_uji', 'like', "%{$search}%");
            });
        }

        // Filter jenis uji
        if ($jenisUji = $request->query('jenis_uji')) {
            $query->where('jenis_uji', $jenisUji);
        }

        // Filter status
        if ($status = $request->query('status')) {
            $query->where('status', $status);
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
            'total_data' => DataKualitasLingkungan::count(),
            'memenuhi' => DataKualitasLingkungan::where('status', 'memenuhi')->count(),
            'tidak_memenuhi' => DataKualitasLingkungan::where('status', 'tidak_memenuhi')->count(),
            'belum_diuji' => DataKualitasLingkungan::where('status', 'belum_diuji')->count(),
        ];

        $tahunList = DataKualitasLingkungan::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('pages.crud.kualitas-lingkungan.index', compact('data', 'summary', 'tahunList'));
    }

    /**
     * Form tambah data kualitas lingkungan
     */
    public function create()
    {
        return view('pages.crud.kualitas-lingkungan.create');
    }

    /**
     * Simpan data kualitas lingkungan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lokasi' => 'required|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'jenis_uji' => 'required|in:air_sungai,air_laut,udara_ambien,tanah,kebisingan',
            'parameter_uji' => 'required|string|max:255',
            'nilai_hasil' => 'nullable|numeric',
            'satuan' => 'nullable|string|max:50',
            'baku_mutu' => 'nullable|numeric',
            'status' => 'required|in:memenuhi,tidak_memenuhi,belum_diuji',
            'tanggal_uji' => 'nullable|date',
            'tahun' => 'required|integer|min:2000|max:2099',
            'sumber_data' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        DataKualitasLingkungan::create($validated);

        return redirect()->route('kualitas-lingkungan.index')
            ->with('success', 'Data kualitas lingkungan berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail data kualitas lingkungan (redirect ke index)
     */
    public function show(DataKualitasLingkungan $kualitasLingkungan)
    {
        return redirect()->route('kualitas-lingkungan.index');
    }

    /**
     * Form edit data kualitas lingkungan
     */
    public function edit(DataKualitasLingkungan $kualitasLingkungan)
    {
        return view('pages.crud.kualitas-lingkungan.edit', compact('kualitasLingkungan'));
    }

    /**
     * Update data kualitas lingkungan
     */
    public function update(Request $request, DataKualitasLingkungan $kualitasLingkungan)
    {
        $validated = $request->validate([
            'lokasi' => 'required|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'jenis_uji' => 'required|in:air_sungai,air_laut,udara_ambien,tanah,kebisingan',
            'parameter_uji' => 'required|string|max:255',
            'nilai_hasil' => 'nullable|numeric',
            'satuan' => 'nullable|string|max:50',
            'baku_mutu' => 'nullable|numeric',
            'status' => 'required|in:memenuhi,tidak_memenuhi,belum_diuji',
            'tanggal_uji' => 'nullable|date',
            'tahun' => 'required|integer|min:2000|max:2099',
            'sumber_data' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $kualitasLingkungan->update($validated);

        return redirect()->route('kualitas-lingkungan.index')
            ->with('success', 'Data kualitas lingkungan berhasil diperbarui!');
    }

    /**
     * Hapus data kualitas lingkungan
     */
    public function destroy(DataKualitasLingkungan $kualitasLingkungan)
    {
        $kualitasLingkungan->delete();

        return redirect()->route('kualitas-lingkungan.index')
            ->with('success', 'Data kualitas lingkungan berhasil dihapus!');
    }
}
