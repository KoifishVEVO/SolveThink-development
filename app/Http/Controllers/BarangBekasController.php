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

        AsetBarangBekas::create([
            'nama_barang' => $request->nama_barang,
            'gambar_barang' => $imagePath,
            'harga_jual_barang' => $request->harga_jual_barang,
            'total_barang' => $request->total_barang,
        ]);

        return redirect()->route('aset_barang_bekas.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = AsetBarangBekas::find($id);
        return view('aset_barang.edit', compact('barang'));
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
            'total_barang' => 'required|integer',
            'gambar_barang' => 'image|mimes:jpeg,png,jpg',
        ]);

        $barang = AsetBarangBekas::findOrFail($id);

        if ($request->hasFile('gambar_barang')) {
            if ($barang->gambar_barang && Storage::disk('public')->exists($barang->gambar_barang)) {
                Storage::disk('public')->delete($barang->gambar_barang);
            }

            $file = $request->file('gambar_barang');
            $newFileName = 'barang_bekas_' . time() . '.' . $file->getClientOriginalExtension();
            $imagePath = storage_path('app/public/uploads/' . $newFileName);

            $image = imagecreatefromstring(file_get_contents($file));

            imagejpeg($image, $imagePath, 75);

            $barang->gambar_barang = 'uploads/' . $newFileName;
        }

        $barang->nama_barang = $request->nama_barang;
        $barang->harga_jual_barang = $request->harga_jual_barang;
        $barang->total_barang = $request->total_barang;

        $barang->save();

        return redirect()->route('aset_barang_bekas.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        $barang = AsetBarangBekas::find($id);

        if ($barang->gambar_barang) {
            unlink(public_path('storage/' . $barang->gambar_barang));
        }

        $barang->delete();
        return redirect()->route('aset_barang_bekas.index')->with('success', 'Barang berhasil dihapus');
    }
}
