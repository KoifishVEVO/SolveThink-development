<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;


class PeriodeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('showEntries', 5);

        $periodes = Periode::when($search, function ($query, $search) {
            $query->where('nama_periode', 'like', "%{$search}%");
        })->paginate($perPage)->appends(['search' => $search]); // default 10 per halaman

        return view('periode', compact('periodes', 'search'));
    }



    public function create()
    {
        return view('periode.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_periode' => 'required|string|max:255',
                'tanggal_mulai' => 'required|date',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            ]);

            Periode::create($request->all());

            return redirect()->route('periode.show')->with('success', 'Periode berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function show(Periode $periode)
    {
        return view('periode', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_periode' => 'required|string|max:255',
                'tanggal_mulai' => 'required|date',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            ]);

            $periode = Periode::findOrFail($id);
            $periode->update($request->all());

            return redirect()->route('periode.show')->with('success', 'Periode berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $ve) {
            return back()->withErrors($ve->validator->errors());
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Gagal memperbarui data: ' . $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();

        return redirect()->route('periode.show')->with('success', 'Periode berhasil dihapus!');
    }
}
