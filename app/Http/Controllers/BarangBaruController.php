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
                'nama_barang' => 'required|string',
                'harga_jual_barang' => 'required|numeric',
                'total_barang' => 'required|integer',
                'gambar_barang' => 'required|string',
            ]);

            $barang = AsetBarangBaru::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Barang berhasil ditambahkan!',
                'data' => $barang
            ]);

    }


     public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg',
            'harga_jual_barang' => 'required|integer',
            'total_barang' => 'required|integer',
        ]);

        if ($request->hasFile('gambar_barang')) {
            $file = $request->file('gambar_barang');
            $newFileName = 'barang_bekas_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/uploads');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            list($width, $height) = getimagesize($file);
            $newWidth = 800; // Resize width
            $newHeight = ($height / $width) * $newWidth;

            $source = imagecreatefromjpeg($file);
            $imageResized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($imageResized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            imagejpeg($imageResized, $destinationPath . '/' . $newFileName, 75);

            imagedestroy($source);
            imagedestroy($imageResized);

            $imagePath = 'uploads/' . $newFileName;
        }

        AsetBarangBaru::create([
            'nama_barang' => $request->nama_barang,
            'gambar_barang' => $imagePath,
            'harga_jual_barang' => $request->harga_jual_barang,
            'total_barang' => $request->total_barang,
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
            'total_barang' => 'required|integer',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg',
        ]);

        $barang = AsetBarangBaru::findOrFail($id);
        $namaBarangLama = $barang->nama_barang;

        $barangList = AsetBarangBaru::where('nama_barang', $namaBarangLama)->get();

        $imagePath = null;

        if ($request->hasFile('gambar_barang')) {
            foreach ($barangList as $item) {
                if ($item->gambar_barang && Storage::disk('public')->exists($item->gambar_barang)) {
                    Storage::disk('public')->delete($item->gambar_barang);
                }
            }

            $file = $request->file('gambar_barang');
            $newFileName = 'barang_bekas_' . time() . '.' . $file->getClientOriginalExtension();
            $imagePath = 'uploads/' . $newFileName;

            $imageFullPath = storage_path('app/public/' . $imagePath);
            $image = imagecreatefromstring(file_get_contents($file));
            imagejpeg($image, $imageFullPath, 75);
        }

        foreach ($barangList as $item) {
            $item->nama_barang = $request->nama_barang;
            $item->harga_jual_barang = $request->harga_jual_barang;
            $item->total_barang = $request->total_barang;
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
