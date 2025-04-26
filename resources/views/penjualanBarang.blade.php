@extends('layouts.dashboard')

@section('title')
    penjualanBarang
@endsection

@section('styles')
@endsection

@section('content')

<style>
    .heading-text {
            color: #272780 !important;
            font-weight: bold !important;
        }
    .card-color {
        background-color: #2B2684; /* Color from screenshot header */
        border-color: #2B2684;
    }
    .modal-color {
         background-color: #2B2684; /* Modal Header/Button Color */
         border-color: #2B2684;
    }
    .batal-btn {
        border-color: #2B2684;
        color: #2B2684;
    }
    .batal-btn:hover {
        background-color: #2B2684;
        color: white;
    }
    .btn-success {
            background-color: #00B634 !important;
        }
    .rincian-btn {
            background-color: transparent !important;
            color: #A9B5DF !important;
            border: 2px solid #A9B5DF !important;
            font-weight: normal !important;
            border-radius: 5px !important;
            padding: 0.25rem 0.5rem !important;
            line-height: 1.5 !important;
            white-space: nowrap !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .btn-kurangi,
        .btn-tambah {
            background-color: #272780;
            color: white;
            font-size: 1rem;
            /* <-- REDUCED from 1.2rem */
            font-weight: bold;
            width: 35px;
            /* <-- OPTIONAL: Reduced width */
            height: 30px;
            /* <-- REDUCED from 40px */
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            box-sizing: border-box;
            transition: background-color 0.3s ease;
            line-height: 1;
            /* Helps center icons vertically */
            cursor: pointer;
            /* Add pointer cursor */
        }

        .btn-kurangi {
            /* Match container radius on the left */
            border-radius: 8px 0 0 8px;
        }

        .btn-tambah {
            /* Match container radius on the right */
            border-radius: 0 8px 8px 0;
        }


.rincian-btn i {
            font-size: 16px !important;
            margin-right: 0 !important;/
        }

        .rincian-btn:hover {
            background-color: #A9B5DF !important;
            color: white !important;
            border-color: #A9B5DF !important;
        }
        .btn-filter{
            background-color: #A9B5DF !important;
            color: white !important;
        }
    
    .delete-text {
        color: #858796; /* Subdued text color for confirmation */
    }
     /* Adjust button spacing and alignment if needed */
    .aksi-buttons .btn {
         margin-right: 5px; /* Add some space between buttons */
    }
    .aksi-buttons .btn:last-child {
         margin-right: 0;
    }
    /* Style for Bukti Pembayaran button */
    .btn-bukti {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: white;
        color: #1b2e91; /* Biru tua */
        border: 2px solid #1b2e91;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: 0.2s ease-in-out;
    }

    .btn-bukti i {
        font-size: 1rem;
    }

    .btn-bukti:hover {
        background-color: #f0f4ff; 
        border-color: #1b2e91;
        color: #1b2e91;
        text-decoration: none;
    }


    /* Pagination */

        /* Style the main pagination container */
        .dataTables_paginate .pagination {
            border: 1px solid #272780;
            border-radius: 0.3rem;
            display: inline-flex;
            overflow: hidden;
            margin-bottom: 0;
        }


        .dataTables_paginate .pagination .page-item+.page-item .page-link {
            margin-left: 0;
        }

        /* Style individual links (default state) */
        .dataTables_paginate .pagination .page-link {
            border: black !important;
            color: #272780;
            background-color: transparent;
            padding: 0.5rem 0.85rem;
            transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out;
        }

        /* Hover state for non-active, non-disabled links */
        .dataTables_paginate .pagination .page-item:not(.active):not(.disabled) .page-link:hover {
            background-color: #e9ecef;
            color: #272780;
        }

        /* Remove default focus outline if desired */
        .dataTables_paginate .pagination .page-link:focus {
            box-shadow: none;
        }

        /* Active page style */
        .dataTables_paginate .pagination .page-item.active .page-link {
            background-color: #272780 !important;
            color: #fff !important;
            border: none !important;
        }

        /* Disabled page style (Previous/Next) */
        .dataTables_paginate .pagination .page-item.disabled .page-link {
            color: #adb5bd !important;
            background-color: transparent !important;
            border: none !important;
        }

        .batal-btn {
            color: #272780 !important;
            border-color: #272780 !important;
        }
</style>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> {{-- Use asset() helper for proper path --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> {{-- Updated Font Awesome link --}}


{{-- begin page content --}}
<div class="container-fluid">

    {{-- Page Heading --}}
    <h1 class="h3 mb-2 mt-4 heading-text font-weight-bold">PENJUALAN BARANG</h1>
    <p class="mb-4 heading-text font-weight-bold">Tabel Penjualan Barang adalah tabel yang menunjukkan data penjualan dalam rentang periode tertentu</p>

    {{-- DataTales Example --}}
    <div class="card shadow mb-4">
        <div class="card-header py-5 card-color"> {{-- Adjusted padding --}}
            <h6 class="m-0 font-weight-bold text-white">Data Tabel Penjualan Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    {{-- Top Controls Row: Show Entries, Search, Filter, Tambah --}}
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-12 col-md-auto"> {{-- Adjust columns for responsiveness --}}
                            <div class="dataTables_length" id="dataTable_length">
                                <label class="mb-0">Show
                                    <select id="showEntries" name="dataTable_length" aria-controls="dataTable"
                                            class="custom-select custom-select-sm form-control form-control-sm"
                                            style="width: auto; display: inline-block;">
                                        {{-- Placeholder: Link value to backend query limit --}}
                                        {{-- @TODO: Add JS to handle entry limit change and reload data --}}
                                        <option value="10" {{-- @TODO: Check request('limit') == 10 ? 'selected' : '' --}} >10</option>
                                        <option value="25" {{-- @TODO: Check request('limit') == 25 ? 'selected' : '' --}} >25</option>
                                        <option value="50" {{-- @TODO: Check request('limit') == 50 ? 'selected' : '' --}} >50</option>
                                        <option value="100" {{-- @TODO: Check request('limit') == 100 ? 'selected' : '' --}} >100</option>
                                    </select> entries
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md"> {{-- Takes remaining space --}}
                            <div id="dataTable_filter"
                                 class="dataTables_filter d-flex justify-content-md-end align-items-center">
                                 {{-- Search Form --}}
                                <label class="mr-2 mb-0">Search:
                                    {{-- Placeholder: Link form to backend search --}}
                                    {{-- @TODO: Point action to the correct route for penjualanBarang search --}}
                                    <form id="searchForm" method="GET" action="{{-- route('penjualan_barang.index') --}}" class="d-inline">
                                        <input type="search" name="search" value="{{-- request()->search --}}"
                                               class="form-control form-control-sm d-inline-block" style="width: auto;"
                                               aria-controls="dataTable" placeholder="">
                                        {{-- Add hidden input for limit if needed --}}
                                        {{-- <input type="hidden" name="limit" value="{{ request()->limit ?? 10 }}"> --}}
                                    </form>
                                </label>

                                {{-- Filter Button (Placeholder) --}}
                                
                                <button class="btn btn-filter btn-sm ml-2" data-toggle="modal" data-target="#filterPenjualanModal">Filter</button>

                                {{-- Tambah Button --}}
                                
                                {{-- <button class="btn btn-success btn-sm ml-2" data-toggle="modal" data-target="#addPenjualanModal">Tambah</button> --}}
                            </div>
                        </div>
                    </div>

                    {{-- Table Row --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>ID</th>
                                        <th>Informasi Pembeli</th>
                                        <th>Detail Transaksi</th>
                                        <th>Detail Pembayaran</th>
                                        <th>Pengiriman</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    {{-- Placeholder: Loop through $penjualan data from backend --}}
                                    {{-- Example Dummy Data (Replace with @foreach loop) --}}
                                    @php
                                        // Dummy data for demonstration
                                        $dummyPenjualan = [
                                            (object)['id' => 1, 'nama_pembeli' => 'INI NAMA PEMBELI', 'alamat_pembeli' => 'XXXXXXXXXXX', 'barang_dijual' => 'BARANG YANG DIJUAL', 'total_harga' => 'RPXXXXXX', 'tanggal_transaksi' => 'DD/MM/YYYY', 'bukti_pembayaran_url' => '#', 'metode_pengiriman' => 'Metode Pengiriman'],
                                            (object)['id' => 2, 'nama_pembeli' => 'INI NAMA PEMBELI', 'alamat_pembeli' => 'XXXXXXXXXXX', 'barang_dijual' => 'BARANG YANG DIJUAL', 'total_harga' => 'RPXXXXXX', 'tanggal_transaksi' => 'DD/MM/YYYY', 'bukti_pembayaran_url' => '#', 'metode_pengiriman' => 'Metode Pengiriman'],
                                            (object)['id' => 3, 'nama_pembeli' => 'INI NAMA PEMBELI', 'alamat_pembeli' => 'XXXXXXXXXXX', 'barang_dijual' => 'BARANG YANG DIJUAL', 'total_harga' => 'RPXXXXXX', 'tanggal_transaksi' => 'DD/MM/YYYY', 'bukti_pembayaran_url' => null, 'metode_pengiriman' => 'Metode Pengiriman'], // Example without payment proof
                                            (object)['id' => 4, 'nama_pembeli' => 'INI NAMA PEMBELI', 'alamat_pembeli' => 'XXXXXXXXXXX', 'barang_dijual' => 'BARANG YANG DIJUAL', 'total_harga' => 'RPXXXXXX', 'tanggal_transaksi' => 'DD/MM/YYYY', 'bukti_pembayaran_url' => '#', 'metode_pengiriman' => 'Metode Pengiriman'],
                                            (object)['id' => 5, 'nama_pembeli' => 'INI NAMA PEMBELI', 'alamat_pembeli' => 'XXXXXXXXXXX', 'barang_dijual' => 'BARANG YANG DIJUAL', 'total_harga' => 'RPXXXXXX', 'tanggal_transaksi' => 'DD/MM/YYYY', 'bukti_pembayaran_url' => '#', 'metode_pengiriman' => 'Metode Pengiriman'],
                                            (object)['id' => 6, 'nama_pembeli' => 'INI NAMA PEMBELI', 'alamat_pembeli' => 'XXXXXXXXXXX', 'barang_dijual' => 'BARANG YANG DIJUAL', 'total_harga' => 'RPXXXXXX', 'tanggal_transaksi' => 'DD/MM/YYYY', 'bukti_pembayaran_url' => '#', 'metode_pengiriman' => 'Metode Pengiriman'],
                                        ];
                                         // Dummy Pagination Data (Replace with actual $penjualan variable from controller)
                                         $penjualan = new \Illuminate\Pagination\LengthAwarePaginator($dummyPenjualan, count($dummyPenjualan), 10, 1); // Example: 6 items, 10 per page, current page 1
                                    @endphp

                                    @forelse ($penjualan as $item)
                                        <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                            <td>{{ $loop->iteration + $penjualan->firstItem() - 1 }}</td> {{-- Correct ID based on pagination --}}
                                            <td>
                                                <strong>{{ $item->nama_pembeli }}</strong><br>
                                                <small>{{ $item->alamat_pembeli }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $item->barang_dijual }}</strong><br>
                                                <small>{{ $item->total_harga }}</small><br>
                                                <small>{{ $item->tanggal_transaksi }}</small>
                                            </td>
                                            <td class="text-center">
                                                {{-- Placeholder: Link to view payment proof if available --}}
                                                @if($item->bukti_pembayaran_url)
                                                    <a href="{{ $item->bukti_pembayaran_url }}" target="_blank" class="btn btn-sm btn-bukti">
                                                        <i class="fas fa-receipt"></i> Bukti Pembayaran
                                                    </a>
                                                @else
                                                    <span class="text-muted small">(Belum Ada)</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->metode_pengiriman }}</td>
                                            <td class="px-3 text-center aksi-buttons">
                                                {{-- Action Buttons --}}
                                                <div class="d-inline-block">
                                                    {{-- Rincian Button --}}
                                                    {{-- @TODO: Populate data-* attributes with actual data from $item --}}
                                                    <button class="btn btn-sm rincian-btn m-1"
                                                            data-id="{{ $item->id }}"
                                                            data-pembeli="{{ $item->nama_pembeli }}"
                                                            {{-- Add other necessary data attributes --}}
                                                            data-toggle="modal"
                                                            data-target="#rincianPenjualanModal">
                                                            
                                                        Rincian
                                                    </button>

                                                    {{-- Update Button --}}
                                                     {{-- @TODO: Populate data-* attributes and set correct update URL --}}
                                                    <button class="btn btn-sm btn-warning m-1 btn-update"
                                                            data-id="{{ $item->id }}"
                                                            data-pembeli="{{ $item->nama_pembeli }}"
                                                            {{-- Add other fields to pre-fill the update form --}}
                                                            data-url="{{-- route('penjualan_barang.update', $item->id) --}}" {{-- Placeholder URL --}}
                                                            data-toggle="modal"
                                                            data-target="#updatePenjualanModal">
                                                        Update
                                                    </button>

                                                    {{-- Hapus Button --}}
                                                     {{-- @TODO: Populate data-* attributes and set correct delete URL --}}
                                                    {{-- <button class="btn btn-sm btn-danger m-1 btn-delete"
                                                            data-id="{{ $item->id }}"
                                                            data-info="Penjualan ID {{ $item->id }} oleh {{ $item->nama_pembeli }}" 
                                                            data-url="" 
                                                            data-toggle="modal"
                                                            data-target="#deletePenjualanModal">
                                                        Hapus
                                                    </button> --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No data available in table</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination Row --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" role="status" aria-live="polite">
                                Showing 1 to 10 of 50 entries
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers">
                                <ul class="pagination justify-content-end">
                                    <!-- Previous Button -->
                                    <li class="paginate_button page-item disabled">
                                        <a href="#" class="page-link">Previous</a>
                                    </li>
                    
                                    <!-- Page Numbers -->
                                    <li class="paginate_button page-item active">
                                        <a href="#" class="page-link">1</a>
                                    </li>
                                    <li class="paginate_button page-item">
                                        <a href="#" class="page-link">2</a>
                                    </li>
                                    <li class="paginate_button page-item">
                                        <a href="#" class="page-link">3</a>
                                    </li>
                                    <li class="paginate_button page-item">
                                        <a href="#" class="page-link">4</a>
                                    </li>
                                    <li class="paginate_button page-item">
                                        <a href="#" class="page-link">5</a>
                                    </li>
                    
                                    <!-- Next Button -->
                                    <li class="paginate_button page-item">
                                        <a href="#" class="page-link">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


{{-- modals --}}

<div class="modal fade" id="addPenjualanModal" tabindex="-1" aria-labelledby="addPenjualanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Consider modal size --}}
        <div class="modal-content">
            <div class="modal-header modal-color text-white">
                <h5 class="modal-title" id="addPenjualanModalLabel">Tambah Penjualan Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            {{-- @TODO: Set correct route for storing data --}}
            <form action="{{-- route('penjualan_barang.store') --}}" method="POST" id="addPenjualanForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    {{-- Add form fields for: --}}
                    {{-- Informasi Pembeli (Nama, Alamat, Kontak?) --}}
                    {{-- Detail Transaksi (Barang selection, Jumlah, Harga, Tanggal) --}}
                    {{-- Detail Pembayaran (Metode Pembayaran, Status Pembayaran, Upload Bukti?) --}}
                    {{-- Pengiriman (Metode Pengiriman, Alamat Pengiriman, Status Pengiriman?) --}}
                    <p>Placeholder for Add Penjualan Form Fields...</p>
                     {{-- Example Field --}}
                     <div class="form-group">
                         <label for="add-nama-pembeli">Nama Pembeli</label>
                         <input type="text" class="form-control" id="add-nama-pembeli" name="nama_pembeli" required>
                     </div>
                     {{-- Add other fields here --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline batal-btn rounded-3 me-2" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn modal-color text-white font-weight-bold rounded-3">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updatePenjualanModal" tabindex="-1" aria-labelledby="updatePenjualanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Consider modal size --}}
        <div class="modal-content">
            <div class="modal-header modal-color text-white">
                <h5 class="modal-title" id="updatePenjualanModalLabel">Update Penjualan Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            {{-- @TODO: Action URL is set dynamically via JS --}}
            <form action="#" method="POST" id="updatePenjualanForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="update-penjualan-id"> {{-- To store the ID of the item being updated --}}
                <div class="modal-body">
                    {{-- Add form fields similar to Add Modal, pre-filled via JS --}}
                    <p>Placeholder for Update Penjualan Form Fields...</p>
                     {{-- Example Field --}}
                     <div class="form-group">
                         <label for="update-nama-pembeli">Nama Pembeli</label>
                         <input type="text" class="form-control" id="update-nama-pembeli" name="nama_pembeli" required>
                     </div>
                     {{-- Add other fields here --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline batal-btn rounded-3 me-2" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn modal-color text-white font-weight-bold rounded-3">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deletePenjualanModal" tabindex="-1" aria-labelledby="deletePenjualanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-color text-white">
                <h5 class="modal-title" id="deletePenjualanModalLabel">Hapus Penjualan Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            {{-- @TODO: Action URL is set dynamically via JS --}}
            <form action="#" method="POST" id="deletePenjualanForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p class="text-center delete-text mb-1">Anda yakin ingin menghapus data penjualan ini?</p>
                    <p class="text-center font-weight-bold" id="delete-penjualan-info"></p> {{-- Populated by JS --}}
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline batal-btn rounded-3 me-2" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn modal-color text-white font-weight-bold rounded-3">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="rincianPenjualanModal" tabindex="-1" aria-labelledby="rincianPenjualanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Large size --}}
        <div class="modal-content">
            <div class="modal-header modal-color text-white">
                {{-- Title matches the image header style --}}
                <h5 class="modal-title font-weight-bold" id="rincianPenjualanModalLabel">Rincian Penjualan</h5>
                {{-- Use data-bs-dismiss for Bootstrap 5 if needed, data-dismiss is for BS4 --}}
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" style="font-size: 0.9rem;"> {{-- Padding and font size --}}

                <div class="row mb-4"> {{-- Top row for Pembeli and Pengiriman --}}
                    <div class="col-md-7">
                        <h6 class="font-weight-bold mb-3 ">Informasi Pembeli</h6>
                        <p class="mb-1"><strong>Nama Pembeli</strong> : <span id="rincian-nama-penjual"></span></p>
                        <p class="mb-1"><strong>No. WA</strong> : <span id="rincian-telp-penjual"></span></p>
                        <p class="mb-1"><strong>Alamat Pembeli</strong> : <span id="rincian-alamat-penjual"></span></p>
                    </div>

                    <div class="col-md-5">
                        <h6 class="font-weight-bold mb-3">Pengiriman</h6>
                        <p class="mb-1"><strong>Metode Pengiriman</strong> : <span id="rincian-metode-penjual">-</span></p>
                    </div>
                </div>

             

                <div class="row mb-4"> {{-- Middle row for Transaksi --}}
                     <div class="col-md-12"> {{-- Full width for this section --}}
                        <h6 class="font-weight-bold mb-3 ">Detail Transaksi</h6>
                        <p class="mb-1"><strong>Nama Barang</strong> : <span id="rincian-pj-barang">-</span></p>
                        <p class="mb-1"><strong>Total Harga</strong> : <span id="rincian-pj-harga">-</span></p>
                        <p class="mb-1"><strong>Tanggal Pembelian</strong> : <span id="rincian-pj-tanggal">-</span></p>
                    </div>
                </div>

          

                <div class="row"> {{-- Bottom row for Pembayaran --}}
                     <div class="col-md-12">
                        <h6 class="font-weight-bold mb-3">Detail Pembayaran</h6>
                        {{-- Container where the button or text will be placed by JS --}}
                         <div id="rincian-bukti-bayar-container">
                            {{-- Default text, will be replaced by JS --}}
                            <span class="text-muted small">(Belum Ada Bukti)</span>
                         </div>
                    </div>
                </div>

            </div> {{-- End modal-body --}}
            <div class="modal-footer">
                {{-- Footer button matches style in image --}}
                <button type="button" class="btn modal-color text-white font-weight-bold rounded-3 px-4" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterPenjualanModal" tabindex="-1" aria-labelledby="filterPenjualanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-color text-white" style=""> 
                <h5 class="modal-title" id="filterPenjualanModalLabel">Filter</h5> {{-- Changed Title --}}
            </div>
          
            <form action="" method="GET">
                <div class="modal-body">
                    {{-- Periode Filter --}}
                    <div class="mb-3"> {{-- Use mb-3 for spacing in BS5 --}}
                        <label for="filter-periode" class="form-label">Periode</label>
                        <select class="form-select" id="filter-periode" name="periode">
                            <option value="" selected>- Pilih Periode -</option>
                            {{-- Add other period options here e.g. --}}
                            <option value="periode01" {{ request('periode') == 'periode01' ? 'selected' : '' }}>Periode 01</option>
                            <option value="periode02" {{ request('periode') == 'periode02' ? 'selected' : '' }}>Periode 02</option>
                        </select>
                    </div>

                    {{-- Metode Pengiriman Filter --}}
                    <div class="mb-3">
                        <label class="form-label d-block">Metode Pengiriman</label> {{-- d-block ensures label is on its own line --}}
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="metode_pengiriman" id="pengirimanDefault" value="default" {{ request('metode_pengiriman', 'default') == 'default' ? 'checked' : '' }}> {{-- Example: Default checked --}}
                            <label class="form-check-label" for="pengirimanDefault">Default</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="metode_pengiriman" id="pengirimanTakeaway" value="takeaway" {{ request('metode_pengiriman') == 'takeaway' ? 'checked' : '' }}>
                            <label class="form-check-label" for="pengirimanTakeaway">Take-away</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="metode_pengiriman" id="pengirimanDiantar" value="diantar" {{ request('metode_pengiriman') == 'diantar' ? 'checked' : '' }}>
                            <label class="form-check-label" for="pengirimanDiantar">Diantar</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                
                 

                    {{-- Buttons matching the image --}}
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button> {{-- Changed class, text --}}
                    <button type="submit" class="btn modal-color text-white" style="">Simpan</button> {{-- Changed text, kept modal-color assumption --}}
                </div>
            </form>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>

</script>

</script>
@endsection