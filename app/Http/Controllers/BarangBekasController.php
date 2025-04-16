<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function storeSame(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'harga_jual_barang' => 'required|integer',
            'jenis_barang' => 'nullable',
        ]);

        $barang = AsetBarangBekas::create([
            'id_nama_barang' => $request->nama_barang,
            'id_gambar_barang' => $request->nama_barang,
            'harga_jual_barang' => $request->harga_jual_barang,
            'jenis_barang' => $request->jenis_barang,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil ditambahkan!',
            'data' => $barang
        ]);

    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_barang' => 'required|max:255',
    //         'gambar_barang' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //         'harga_jual_barang' => 'required|integer',
    //         'total_barang' => 'required|integer',
    //     ]);

    //      if ($request->hasFile('gambar_barang')) {
    //         $file = $request->file('gambar_barang');
    //         $newFileName = 'barang_bekas_' . time() . '.' . $file->getClientOriginalExtension();
    //         $file->storeAs('uploads', $newFileName, 'public');
    //         $imagePath = 'uploads/' . $newFileName;
    //     }

    //     AsetBarangBekas::create([
    //         'nama_barang' => $request->nama_barang,
    //         'gambar_barang' => $imagePath,
    //         'harga_jual_barang' => $request->harga_jual_barang,
    //         'total_barang' => $request->total_barang,
    //     ]);

    //     return redirect()->route('aset_barang_bekas.index')->with('success', 'Barang berhasil ditambahkan');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_jual_barang' => 'required|integer',
            'jenis_barang' => 'required|string',
        ]);

        try {
            // Simpan data ke database
            AsetBarangBekas::create([
                'id_nama_barang' => $request->nama_barang,
                'id_gambar_barang' => $request->nama_barang,
                'harga_jual_barang' => $request->harga_jual_barang,
                'jenis_barang' => $request->jenis_barang,
            ]);

            return redirect()->route('aset_barang_bekas.index')->with('success', 'Barang berhasil ditambahkan');
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan saat menyimpan
            return redirect()->route('aset_barang_bekas.index')->with('error', 'Gagal menambahkan barang: ' . $e->getMessage());
        }
    }




    public function edit($id)
    {
        $barang = AsetBarangBekas::find($id);
        return view('aset_barang_bekas.edit', compact('barang'));
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'nama_barang' => 'required|max:255',
    //         'harga_jual_barang' => 'required|integer',
    //         'total_barang' => 'required|integer',
    //         'gambar_barang' => 'image|mimes:jpeg,png,jpg|max:2048',
    //     ]);

    //     $barang = AsetBarangBekas::findOrFail($id);

    //     if ($request->hasFile('gambar_barang')) {
    //         $file = $request->file('gambar_barang');
    //         $newFileName = 'barang_bekas_' . time() . '.' . $file->getClientOriginalExtension();
    //         $file->storeAs('uploads', $newFileName, 'public');
    //         $imagePath = 'uploads/' . $newFileName;
    //         $barang->gambar_barang = $imagePath;
    //     }

    //     $barang->nama_barang = $request->nama_barang;
    //     $barang->harga_jual_barang = $request->harga_jual_barang;
    //     $barang->total_barang = $request->total_barang;

    //     $barang->save();

    //     return redirect()->route('aset_barang_bekas.index')->with('success', 'Barang berhasil diupdate');
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'harga_jual_barang' => 'required|integer',
            'jenis_barang' => 'required|string',
        ]);

        $barang = AsetBarangBekas::findOrFail($id);

        $barangList = AsetBarangBekas::where('id_nama_barang', $barang->id_nama_barang)
            ->where('id_gambar_barang', $barang->id_gambar_barang)
            ->where('harga_jual_barang', $barang->harga_jual_barang)
            ->where('jenis_barang', $barang->jenis_barang)
            ->get();

        try {
            foreach ($barangList as $item) {
                $item->id_nama_barang = $request->nama_barang;
                $item->id_gambar_barang = $request->nama_barang;
                $item->harga_jual_barang = $request->harga_jual_barang;
                $item->jenis_barang = $request->jenis_barang;
                $item->save();
            }

            return redirect()->route('aset_barang_bekas.index')->with('success', 'Semua barang dengan data yang sama berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('aset_barang_bekas.index')->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $barang = AsetBarangBekas::findOrFail($id);

        $barangList = AsetBarangBekas::where('id_nama_barang', $barang->id_nama_barang)
            ->where('id_gambar_barang', $barang->id_gambar_barang)
            ->where('harga_jual_barang', $barang->harga_jual_barang)
            ->where('jenis_barang', $barang->jenis_barang)
            ->get();

        if ($barangList->isEmpty()) {
            return redirect()->route('aset_barang_bekas.index')->with('error', 'Tidak ada data yang cocok untuk dihapus.');
        }

        try {
            foreach ($barangList as $item) {
                $item->delete();
            }

            return redirect()->route('aset_barang_bekas.index')->with('success', 'Semua barang dengan data yang sama berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('aset_barang_bekas.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function deleteOne($id_nama_barang)
    {
        try {
            $gambar_barang = request('gambar_barang');
            $harga_jual_barang = request('harga_jual_barang');
            $jenis_barang = request('jenis_barang');

            $barang = AsetBarangBekas::where('id_nama_barang', $id_nama_barang)
                ->where('id_gambar_barang', $gambar_barang)
                ->where('harga_jual_barang', $harga_jual_barang)
                ->where('jenis_barang', $jenis_barang)
                ->first();

            if ($barang) {
                $barang->delete();
                return response()->json(['success' => true, 'message' => 'Barang berhasil dihapus!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Barang tidak ditemukan.'], 404);
            }
        } catch (\Exception $e) {
            \Log::error("Error deleteOne: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi error saat menghapus barang.'], 500);
        }
    }
}
