<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class penyewaanBarangController extends Controller
{
    public function index()
    {
        $response = Http::get('https://rental.solvethink.id/api/penyewaan-komponen-solvethink');
        $data = $response->json();

        $penyewaan = collect($data['data']);

        return view('penyewaanBarang', compact('penyewaan'));
    }
}
