<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class penjualanBarangController extends Controller
{
    public function index()
    {
        $response = Http::withoutVerifying()->get('https://sale.solvethink.id/api/penjualan-komponen-solvethink');
            $data = $response->json();

            $penjualan = collect($data['data']);

        return view('penjualanBarang', compact('penjualan'));
    }

    public function updatePenjualan(Request $request, $id)
    {
        $formData = $request->except(['_token', 'id']);
        $formData['_method'] = 'PUT';

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');

            $response = Http::attach(
                'bukti_pembayaran',
                file_get_contents($file),
                $file->getClientOriginalName()
            )->post("https://sale.solvethink.id/api/penjualan-komponen-solvethink/{$id}", $formData);
        } else {
            $response = Http::post("https://sale.solvethink.id/api/penjualan-komponen-solvethink/{$id}", $formData);
        }

        if ($response->successful()) {
            return response()->json(['message' => 'Update berhasil!']);
        } else {
            return response()->json(['message' => 'Gagal update', 'error' => $response->body()], $response->status());
        }
    }
}
