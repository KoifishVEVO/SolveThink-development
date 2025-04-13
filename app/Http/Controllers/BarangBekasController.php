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
                'harga_jual_barang' => 'required|numeric',
                'jenis_barang' => 'required|string',
                'gambar_barang' => 'required|string',
            ]);

            $barang = AsetBarangBekas::create($request->all());

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
            'nama_barang' => 'required|max:255',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg',
            'harga_jual_barang' => 'required|integer',
            'jenis_barang' => 'required|string',
        ]);

        if ($request->hasFile('gambar_barang')) {
            $file = $request->file('gambar_barang');
            $extension = $file->getClientOriginalExtension();
            $newFileName = 'barang_bekas_' . time() . '.' . $extension;
            $destinationPath = storage_path('app/public/uploads');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Ambil ukuran asli gambar
            list($width, $height) = getimagesize($file);
            $newWidth = 800;
            $newHeight = ($height / $width) * $newWidth;

            // Resize gambar sesuai formatnya
            if ($extension === 'png') {
                $source = imagecreatefrompng($file);
            } else {
                $source = imagecreatefromjpeg($file);
            }

            $imageResized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($imageResized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            $imagePath = 'uploads/' . $newFileName;
            $imageFullPath = $destinationPath . '/' . $newFileName;

            if ($extension === 'png') {
                imagepng($imageResized, $imageFullPath, 6);
            } else {
                imagejpeg($imageResized, $imageFullPath, 75);
            }

            imagedestroy($source);
            imagedestroy($imageResized);
        }

        AsetBarangBekas::create([
            'nama_barang' => $request->nama_barang,
            'gambar_barang' => $imagePath,
            'harga_jual_barang' => $request->harga_jual_barang,
            'jenis_barang' => $request->jenis_barang,
        ]);

        return redirect()->route('aset_barang_bekas.index')->with('success', 'Barang berhasil ditambahkan');
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
            'gambar_barang' => 'image|mimes:jpeg,png,jpg',
        ]);

        $barang = AsetBarangBekas::findOrFail($id);
        $namaBarangLama = $barang->nama_barang;

        $barangList = AsetBarangBekas::where('nama_barang', $namaBarangLama)->get();

        $imagePath = null;

        if ($request->hasFile('gambar_barang')) {
            foreach ($barangList as $item) {
                if ($item->gambar_barang && Storage::disk('public')->exists($item->gambar_barang)) {
                    Storage::disk('public')->delete($item->gambar_barang);
                }
            }

            $file = $request->file('gambar_barang');
            $extension = $file->getClientOriginalExtension();
            $newFileName = 'barang_bekas_' . time() . '.' . $extension;
            $destinationPath = storage_path('app/public/uploads');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            list($width, $height) = getimagesize($file);
            $newWidth = 800;
            $newHeight = ($height / $width) * $newWidth;

            if ($extension === 'png') {
                $source = imagecreatefrompng($file);
            } else {
                $source = imagecreatefromjpeg($file);
            }

            $imageResized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($imageResized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            $imagePath = 'uploads/' . $newFileName;
            $imageFullPath = $destinationPath . '/' . $newFileName;

            if ($extension === 'png') {
                imagepng($imageResized, $imageFullPath, 6);
            } else {
                imagejpeg($imageResized, $imageFullPath, 75);
            }

            imagedestroy($source);
            imagedestroy($imageResized);
        }

        // Update semua barang yang memiliki nama yang sama
        foreach ($barangList as $item) {
            $item->nama_barang = $request->nama_barang;
            $item->harga_jual_barang = $request->harga_jual_barang;
            $item->jenis_barang = $request->jenis_barang;
            if ($imagePath) {
                $item->gambar_barang = $imagePath;
            }
            $item->save();
        }

        return redirect()->route('aset_barang_bekas.index')->with('success', 'Semua barang dengan nama "' . $namaBarangLama . '" berhasil diperbarui');
    }


    public function destroy($id)
    {

        $barang = AsetBarangBekas::findOrFail($id);

        $namaBarang = $barang->nama_barang;

        $barangList = AsetBarangBekas::where('nama_barang', $namaBarang)->get();

        foreach ($barangList as $item) {
            if ($item->gambar_barang && file_exists(public_path('storage/' . $item->gambar_barang))) {
                unlink(public_path('storage/' . $item->gambar_barang));
            }
        }
        AsetBarangBekas::where('nama_barang', $namaBarang)->delete();

        return redirect()->route('aset_barang_bekas.index')->with('success', 'Semua barang dengan nama "' . $namaBarang . '" berhasil dihapus');
    }

    public function deleteOne($nama_barang)
    {
        $barangList = AsetBarangBekas::where('nama_barang', $nama_barang)->get();

        if ($barangList->isNotEmpty()) {
            $barang = $barangList->first();

            if ($barangList->count() == 1 && $barang->gambar_barang) {
                $gambarPath = public_path('storage/' . $barang->gambar_barang);
                if (file_exists($gambarPath)) {
                    unlink($gambarPath);
                }
            }

            $barang->delete();
        }

        return response()->json(['success' => true]);
    }
}
