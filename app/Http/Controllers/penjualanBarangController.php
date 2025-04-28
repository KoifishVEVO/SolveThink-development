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
}
