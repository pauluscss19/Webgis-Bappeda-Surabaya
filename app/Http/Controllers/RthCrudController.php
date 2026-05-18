<?php

namespace App\Http\Controllers;

use App\Models\RthData;
use Illuminate\Http\Request;

class RthCrudController extends Controller
{
    public function index(Request $request)
    {
        $query = RthData::query();

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('zona', 'like', "%{$search}%")
                  ->orWhere('kode', 'like', "%{$search}%")
                  ->orWhere('tipologi', 'like', "%{$search}%");
            });
        }

        if ($tipologi = $request->query('tipologi')) {
            $query->where('tipologi', $tipologi);
        }

        $query->orderBy('tipologi', 'asc')->orderBy('luas', 'desc');
        $data = $query->paginate(10)->appends($request->query());

        // Data ringkasan
        $allData = RthData::all();
        $summary = [
            'total_data'  => $allData->count(),
            'total_luas'  => $allData->sum('luas'),
            'luas_a'      => $allData->where('tipologi', 'A')->sum('luas'),
            'luas_b'      => $allData->where('tipologi', 'B')->sum('luas'),
            'luas_c'      => $allData->where('tipologi', 'C')->sum('luas'),
        ];

        // Data chart pie
        $chartData = [
            'series' => [
                round($summary['luas_a'], 2),
                round($summary['luas_b'], 2),
                round($summary['luas_c'], 2),
            ],
            'labels' => ['Tipologi A (Publik)', 'Tipologi B (Privat)', 'Tipologi C (Badan Air)'],
        ];

        return view('pages.crud.rth.index', compact('data', 'summary', 'chartData'));
    }

    public function create()
    {
        return view('pages.crud.rth.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipologi' => 'required|string|size:1|in:A,B,C',
            'zona' => 'required|string|max:255',
            'kode' => 'nullable|string|max:50',
            'luas' => 'required|numeric|min:0',
            'bobot' => 'nullable|numeric|min:0',
            'luas_x_bobot' => 'nullable|numeric|min:0',
            'fhbi' => 'nullable|numeric|min:0',
            'jumlah' => 'nullable|numeric|min:0',
        ]);

        RthData::create($validated);

        return redirect()->route('rth.index')
            ->with('success', 'Data RTH berhasil ditambahkan!');
    }

    public function show(RthData $rth)
    {
        return redirect()->route('rth.index');
    }

    public function edit(RthData $rth)
    {
        return view('pages.crud.rth.edit', compact('rth'));
    }

    public function update(Request $request, RthData $rth)
    {
        $validated = $request->validate([
            'tipologi' => 'required|string|size:1|in:A,B,C',
            'zona' => 'required|string|max:255',
            'kode' => 'nullable|string|max:50',
            'luas' => 'required|numeric|min:0',
            'bobot' => 'nullable|numeric|min:0',
            'luas_x_bobot' => 'nullable|numeric|min:0',
            'fhbi' => 'nullable|numeric|min:0',
            'jumlah' => 'nullable|numeric|min:0',
        ]);

        $rth->update($validated);

        return redirect()->route('rth.index')
            ->with('success', 'Data RTH berhasil diperbarui!');
    }

    public function destroy(RthData $rth)
    {
        $rth->delete();

        return redirect()->route('rth.index')
            ->with('success', 'Data RTH berhasil dihapus!');
    }
}
