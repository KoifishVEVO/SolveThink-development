<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NamaBarang;

class NamaBarangController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'gambar_barang' => 'nullable|image|max:2048', // max 2MB
        ]);

        $fileName = null;

        if ($request->hasFile('gambar_barang')) {
            $file = $request->file('gambar_barang');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
        }

        NamaBarang::create([
            'nama_barang' => $request->nama_barang,
            'gambar_barang' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Barang ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $barang = NamaBarang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|string',
            'gambar_barang' => 'nullable|image|max:2048',
        ]);

        $fileName = $barang->gambar_barang;

        if ($request->hasFile('gambar_barang')) {
            // Hapus file lama
            if ($fileName && file_exists(public_path('uploads/' . $fileName))) {
                unlink(public_path('uploads/' . $fileName));
            }

            $file = $request->file('gambar_barang');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'gambar_barang' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Barang diperbarui.');
    }

    public function destroy($id)
    {
        $barang = NamaBarang::findOrFail($id);

        if ($barang->gambar_barang && file_exists(public_path('uploads/' . $barang->gambar_barang))) {
            unlink(public_path('uploads/' . $barang->gambar_barang));
        }

        $barang->delete();

        return redirect()->back()->with('success', 'Barang dihapus.');
    }
}
