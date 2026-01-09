<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // BONUS: filter berdasarkan status / tipe
        $query = Kamar::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        $kamars = $query->get();

        return view('kamar.index', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kamar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar'   => 'required|string|max:10|unique:kamar,nomor_kamar',
            'tipe'          => 'required|in:standard,deluxe,vip',
            'harga_bulanan' => 'required|numeric|min:1',
            'fasilitas'     => 'required|string',
            'status'        => 'required|in:tersedia,terisi',
        ]);

        Kamar::create($request->all());

        return redirect()
            ->route('kamar.index')
            ->with('success', 'Data kamar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('kamar.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kamar = Kamar::findOrFail($id);

        $request->validate([
            'nomor_kamar'   => 'required|string|max:10|unique:kamar,nomor_kamar,' . $kamar->id,
            'tipe'          => 'required|in:standard,deluxe,vip',
            'harga_bulanan' => 'required|numeric|min:1',
            'fasilitas'     => 'required|string',
            'status'        => 'required|in:tersedia,terisi',
        ]);

        $kamar->update($request->all());

        return redirect()
            ->route('kamar.index')
            ->with('success', 'Data kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        if ($kamar->kontrakSewa()->exists()) {
            return back()->with('error', 'Kamar tidak bisa dihapus karena sudah memiliki riwayat sewa!');
        }
        $kamar->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus');
    }
}


