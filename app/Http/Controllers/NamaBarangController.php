<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NamaBarang;

class NamaBarangController extends Controller
{
    public function index()
    {
        $barang = NamaBarang::all();
        return view('rincianNamaBarang', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'gambar_barang' => 'nullable|image',
        ]);

        $fileName = null;

        if ($request->hasFile('gambar_barang')) {
            $file = $request->file('gambar_barang');
            $originalExtension = $file->getClientOriginalExtension();

            $namaBarangSlug = preg_replace('/\s+/', '_', strtolower($request->nama_barang));
            $timestamp = time();
            $fileName = $namaBarangSlug . '_' . $timestamp . '.' . $originalExtension;

            $destinationPath = public_path('storage/uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            if ($file->getSize() > 2 * 1024 * 1024) {
                $image = imagecreatefromstring(file_get_contents($file));
                ob_start();
                if ($originalExtension === 'png') {
                    imagepng($image, null, 9);
                } else {
                    imagejpeg($image, null, 75);
                }
                $compressedImage = ob_get_clean();

                file_put_contents($destinationPath . '/' . $fileName, $compressedImage);
                imagedestroy($image);
            } else {
                $file->move($destinationPath, $fileName);
            }
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
            'gambar_barang' => 'nullable|image', // max 2MB
        ]);

        $fileName = $barang->gambar_barang; // Menggunakan gambar lama jika tidak ada gambar baru

        if ($request->hasFile('gambar_barang')) {
            // Hapus file lama
            if ($fileName && file_exists(public_path('uploads/' . $fileName))) {
                unlink(public_path('uploads/' . $fileName));
            }

            $file = $request->file('gambar_barang');
            $originalImage = imagecreatefromstring(file_get_contents($file)); // Membaca gambar
            $imageSize = getimagesize($file); // Mendapatkan dimensi gambar
            $maxSize = 2 * 1024 * 1024; // Maksimal 2MB

            // Mengecek ukuran file, jika lebih dari 2MB, kita akan resize gambar
            if (filesize($file) > $maxSize) {
                // Resize gambar sesuai dengan rasio untuk memastikan tetap proporsional
                $width = $imageSize[0];
                $height = $imageSize[1];

                $newWidth = 1024; // Atur lebar gambar maksimal
                $newHeight = (int) ($height * $newWidth / $width); // Menjaga rasio gambar

                $resizedImage = imagescale($originalImage, $newWidth, $newHeight);

                // Menyimpan gambar yang telah di-resize ke folder uploads
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                imagejpeg($resizedImage, public_path('storage/uploads/' . $fileName), 80); // Menyimpan dengan kualitas 80
                imagedestroy($resizedImage); // Menghancurkan gambar yang telah di-resize
            } else {
                // Jika ukuran gambar sudah sesuai, langsung simpan gambar seperti biasa
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/uploads'), $fileName);
            }

            imagedestroy($originalImage); // Menghancurkan gambar asli setelah digunakan
        }

        // Update data barang
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'gambar_barang' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Barang berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $barang = NamaBarang::findOrFail($id);

        if ($barang->gambar_barang && file_exists(public_path('storage/uploads/' . $barang->gambar_barang))) {
            unlink(public_path('storage/uploads/' . $barang->gambar_barang));
        }

        $barang->delete();

        return redirect()->back()->with('success', 'Barang dihapus.');
    }
}
