<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsetBarangBaru;
use Illuminate\Support\Facades\Storage;

class BarangBaruController extends Controller
{
    public function index()
    {
        $barang = AsetBarangBaru::all();
        return view('aset_barang.index', compact('barang'));
    }


    public function storeSame(Request $request)
    {
            $request->validate([
                'nama_barang' => 'required',
                'harga_jual_barang' => 'required|integer',
                'jenis_barang' => 'required|string',
            ]);

            AsetBarangBaru::create([
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


    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_jual_barang' => 'required|integer',
            'jenis_barang' => 'required|string',
        ]);

        // Simpan data ke database tanpa gambar
        AsetBarangBaru::create([
            'id_nama_barang' => $request->nama_barang,
            'id_gambar_barang' => $request->nama_barang,
            'harga_jual_barang' => $request->harga_jual_barang,
            'jenis_barang' => $request->jenis_barang,
        ]);

        return redirect()->route('aset_barang.index')->with('success', 'Barang berhasil ditambahkan');
    }



    public function edit($id)
    {
        $barang = AsetBarangBaru::findOrFail($id);
        return view('aset_barang_baru.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'harga_jual_barang' => 'required|integer',
            'jenis_barang' => 'required|string',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg',
        ]);

        $barang = AsetBarangBaru::findOrFail($id);
        $namaBarangLama = $barang->nama_barang;
        $barangList = AsetBarangBaru::where('nama_barang', $namaBarangLama)->get();

        $imagePath = null;

        if ($request->hasFile('gambar_barang')) {
            // Hapus gambar lama jika ada
            foreach ($barangList as $item) {
                if ($item->gambar_barang && Storage::disk('public')->exists($item->gambar_barang)) {
                    Storage::disk('public')->delete($item->gambar_barang);
                }
            }

            // Upload gambar baru
            $file = $request->file('gambar_barang');
            $extension = $file->getClientOriginalExtension();
            $newFileName = 'barang_baru_' . time() . '.' . $extension;
            $imagePath = 'uploads/' . $newFileName;

            // Simpan gambar sesuai formatnya
            $imageFullPath = storage_path('app/public/' . $imagePath);
            $image = imagecreatefromstring(file_get_contents($file));

            if ($extension === 'png') {
                imagepng($image, $imageFullPath, 6);
            } else {
                imagejpeg($image, $imageFullPath, 75);
            }

            imagedestroy($image);
        }

        // Update semua barang dengan nama yang sama
        foreach ($barangList as $item) {
            $item->nama_barang = $request->nama_barang;
            $item->harga_jual_barang = $request->harga_jual_barang;
            $item->jenis_barang = $request->jenis_barang;
            if ($imagePath) {
                $item->gambar_barang = $imagePath;
            }
            $item->save();
        }

        return redirect()->route('aset_barang.index')->with('success', 'Semua barang dengan nama "' . $namaBarangLama . '" berhasil diperbarui');
    }




   public function destroy($id)
    {

        $barang = AsetBarangBaru::findOrFail($id);

        $namaBarang = $barang->nama_barang;

        $barangList = AsetBarangBaru::where('nama_barang', $namaBarang)->get();

        foreach ($barangList as $item) {
            if ($item->gambar_barang && file_exists(public_path('storage/' . $item->gambar_barang))) {
                unlink(public_path('storage/' . $item->gambar_barang));
            }
        }
        AsetBarangBaru::where('nama_barang', $namaBarang)->delete();

        return redirect()->route('aset_barang.index')->with('success', 'Semua barang dengan nama "' . $namaBarang . '" berhasil dihapus');
    }

    public function deleteOne($nama_barang)
    {
        // Cari semua barang dengan nama yang sama
        $barangList = AsetBarangBaru::where('nama_barang', $nama_barang)->get();

        if ($barangList->isNotEmpty()) {
            $barang = $barangList->first(); // Ambil satu data untuk dihapus

            // Jika hanya ada satu data tersisa, hapus juga gambar
            if ($barangList->count() == 1 && $barang->gambar_barang) {
                $gambarPath = public_path('storage/' . $barang->gambar_barang);
                if (file_exists($gambarPath)) {
                    unlink($gambarPath); // Hapus gambar
                }
            }

            $barang->delete(); // Hapus satu data barang
        }

        return response()->json(['success' => true]);
    }
}
