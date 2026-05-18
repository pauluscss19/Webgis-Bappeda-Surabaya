<?php

namespace App\Http\Controllers;

use App\Models\SarprasPeralatan;
use Illuminate\Http\Request;

class SarprasController extends Controller
{
    public function index(Request $request)
    {
        $query = SarprasPeralatan::query();

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('tipe_peralatan', 'like', "%{$search}%")
                  ->orWhere('jenis_bbm', 'like', "%{$search}%");
            });
        }

        $query->orderBy('jumlah_total', 'desc');
        $data = $query->paginate(10)->appends($request->query());

        // Data ringkasan
        $allData = SarprasPeralatan::all();
        $summary = [
            'total_data'       => $allData->count(),
            'total_unit'       => $allData->sum('jumlah_total'),
            'total_beroperasi' => $allData->sum('jumlah_beroperasi'),
            'total_rusak'      => $allData->sum('jumlah_rusak'),
        ];

        // Data chart
        $chartData = [
            'labels' => $allData->pluck('tipe_peralatan')->toArray(),
            'values' => $allData->pluck('jumlah_total')->map(fn($v) => (int) $v)->toArray(),
            'beroperasi' => $allData->pluck('jumlah_beroperasi')->map(fn($v) => (int) $v)->toArray(),
            'rusak' => $allData->pluck('jumlah_rusak')->map(fn($v) => (int) $v)->toArray(),
        ];

        return view('pages.crud.sarpras.index', compact('data', 'summary', 'chartData'));
    }

    public function create()
    {
        return view('pages.crud.sarpras.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe_peralatan' => 'required|string|max:255',
            'jenis_bbm' => 'nullable|string|max:255',
            'jumlah_total' => 'required|integer|min:0',
            'jumlah_beroperasi' => 'required|integer|min:0',
            'jumlah_rusak' => 'required|integer|min:0',
            'jumlah_cadangan' => 'nullable|integer|min:0',
            'kebutuhan_per_unit_pertamax' => 'nullable|numeric|min:0',
            'kebutuhan_per_unit_dexlite' => 'nullable|numeric|min:0',
            'kebutuhan_1_tahun_pertamax' => 'nullable|numeric|min:0',
            'kebutuhan_1_tahun_dexlite' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        SarprasPeralatan::create($validated);

        return redirect()->route('sarpras.index')
            ->with('success', 'Data sarpras berhasil ditambahkan!');
    }

    public function show(SarprasPeralatan $sarpra)
    {
        return redirect()->route('sarpras.index');
    }

    public function edit(SarprasPeralatan $sarpra)
    {
        return view('pages.crud.sarpras.edit', ['sarpras' => $sarpra]);
    }

    public function update(Request $request, SarprasPeralatan $sarpra)
    {
        $validated = $request->validate([
            'tipe_peralatan' => 'required|string|max:255',
            'jenis_bbm' => 'nullable|string|max:255',
            'jumlah_total' => 'required|integer|min:0',
            'jumlah_beroperasi' => 'required|integer|min:0',
            'jumlah_rusak' => 'required|integer|min:0',
            'jumlah_cadangan' => 'nullable|integer|min:0',
            'kebutuhan_per_unit_pertamax' => 'nullable|numeric|min:0',
            'kebutuhan_per_unit_dexlite' => 'nullable|numeric|min:0',
            'kebutuhan_1_tahun_pertamax' => 'nullable|numeric|min:0',
            'kebutuhan_1_tahun_dexlite' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $sarpra->update($validated);

        return redirect()->route('sarpras.index')
            ->with('success', 'Data sarpras berhasil diperbarui!');
    }

    public function destroy(SarprasPeralatan $sarpra)
    {
        $sarpra->delete();

        return redirect()->route('sarpras.index')
            ->with('success', 'Data sarpras berhasil dihapus!');
    }
}
