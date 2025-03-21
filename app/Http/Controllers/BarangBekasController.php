<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsetBarangBekas;

class BarangBekasController extends Controller
{
    public function index()
    {
        $barang = AsetBarangBekas::all();
        return view('aset_barang.index', compact('barang'));
    }

    public function create()
    {
        return view('aset_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga_jual_barang' => 'required|integer',
            'total_barang' => 'required|integer',
        ]);

        $imagePath = $request->file('gambar_barang')->store('uploads', 'public');

        AsetBarangBekas::create([
            'nama_barang' => $request->nama_barang,
            'gambar_barang' => $imagePath,
            'harga_jual_barang' => $request->harga_jual_barang,
            'total_barang' => $request->total_barang,
        ]);

        return redirect()->route('aset_barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = AsetBarangBekas::find($id);
        return view('aset_barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'harga_jual_barang' => 'required|integer',
            'total_barang' => 'required|integer',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $barang = AsetBarangBekas::find($id);

        if ($request->hasFile('gambar_barang')) {
            $imagePath = $request->file('gambar_barang')->store('uploads', 'public');
            $barang->gambar_barang = $imagePath;
        }

        $barang->nama_barang = $request->nama_barang;
        $barang->harga_jual_barang = $request->harga_jual_barang;
        $barang->total_barang = $request->total_barang;

        $barang->save();

        return redirect()->route('aset_barang.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        $barang = AsetBarangBekas::find($id);

        if ($barang->gambar_barang) {
            unlink(public_path('storage/' . $barang->gambar_barang));
        }

        $barang->delete();
        return redirect()->route('aset_barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
