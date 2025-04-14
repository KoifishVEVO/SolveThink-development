<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;


class PeriodeController extends Controller
{
     public function index()
    {
        $periodes = Periode::all();
        return view('periode', compact('periodes'));
    }

    public function create()
    {
        return view('periode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Periode::create($request->all());

        return redirect()->route('periode.index')->with('success', 'Periode berhasil ditambahkan!');
    }

    public function show(Periode $periode)
    {
        return view('periode', compact('periode'));
    }

    public function edit(Periode $periode)
    {
        return view('periode', compact('periode'));
    }

    public function update(Request $request, Periode $periode)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $periode->update($request->all());

        return redirect()->route('periode')->with('success', 'Periode berhasil diperbarui!');
    }

    public function destroy(Periode $periode)
    {
        $periode->delete();
        return redirect()->route('periode.index')->with('success', 'Periode berhasil dihapus!');
    }
}
