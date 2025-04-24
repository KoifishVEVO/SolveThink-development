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
                                {{-- @TODO: Link button to Filter Modal or implement filter logic --}}
                                <button class="btn btn-filter btn-sm ml-2" data-toggle="modal" data-target="#filterPenjualanModal">Filter</button>

                                {{-- Tambah Button --}}
                                {{-- @TODO: Link button to Add Modal --}}
                                <button class="btn btn-success btn-sm ml-2" data-toggle="modal" data-target="#addPenjualanModal">Tambah</button>
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
                                                    <button class="btn btn-sm btn-danger m-1 btn-delete"
                                                            data-id="{{ $item->id }}"
                                                            data-info="Penjualan ID {{ $item->id }} oleh {{ $item->nama_pembeli }}" {{-- Info for confirmation modal --}}
                                                            data-url="{{-- route('penjualan_barang.destroy', $item->id) --}}" {{-- Placeholder URL --}}
                                                            data-toggle="modal"
                                                            data-target="#deletePenjualanModal">
                                                        Hapus
                                                    </button>
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
                    {{-- Make sure the $penjualan variable is a Paginator instance from your Controller --}}
                    <div class="row">
                         <div class="col-sm-12 col-md-5">
                             <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                 {{-- Showing {{ $penjualan->firstItem() }} to {{ $penjualan->lastItem() }} of {{ $penjualan->total() }} entries --}}
                                  Showing {{ $penjualan->firstItem() ?? 0 }} to {{ $penjualan->lastItem() ?? 0 }} of {{ $penjualan->total() }} entries {{-- Handle empty data --}}
                             </div>
                         </div>
                         <div class="col-sm-12 col-md-7">
                             <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                 {{-- Render pagination links, append search query if exists --}}
                                 {{-- {{ $penjualan->appends(request()->query())->links('pagination::bootstrap-4') }} --}}
                                  {{-- Use the dummy paginator for display --}}
                                  {{ $penjualan->links('pagination::bootstrap-4') }}
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
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Adjust size as needed --}}
        <div class="modal-content">
            <div class="modal-header modal-color text-white">
                <h5 class="modal-title" id="rincianPenjualanModalLabel">Rincian Penjualan Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{-- @TODO: Structure the details display. Use JS to populate this from data-* attributes --}}
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Pembeli</h6>
                        <p><strong>Nama:</strong> <span id="rincian-nama-pembeli"></span></p>
                        <p><strong>Alamat:</strong> <span id="rincian-alamat-pembeli"></span></p>
                        {{-- Add more fields as needed --}}
                    </div>
                    <div class="col-md-6">
                        <h6>Detail Transaksi</h6>
                        <p><strong>Barang:</strong> <span id="rincian-barang"></span></p>
                        <p><strong>Total Harga:</strong> <span id="rincian-harga"></span></p>
                        <p><strong>Tanggal:</strong> <span id="rincian-tanggal"></span></p>
                         {{-- Add more fields as needed --}}
                    </div>
                </div>
                 <hr>
                 <div class="row">
                     <div class="col-md-6">
                         <h6>Detail Pembayaran</h6>
                         <p><strong>Bukti Bayar:</strong> <span id="rincian-bukti-bayar"></span></p> {{-- Link or Status --}}
                     </div>
                     <div class="col-md-6">
                         <h6>Pengiriman</h6>
                         <p><strong>Metode:</strong> <span id="rincian-metode-kirim"></span></p>
                     </div>
                 </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn modal-color text-white font-weight-bold rounded-3" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

 <div class="modal fade" id="filterPenjualanModal" tabindex="-1" aria-labelledby="filterPenjualanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-color text-white">
                <h5 class="modal-title" id="filterPenjualanModalLabel">Filter Penjualan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
             {{-- @TODO: Point form to index route with GET method --}}
            <form action="{{-- route('penjualan_barang.index') --}}" method="GET">
                <div class="modal-body">
                    {{-- @TODO: Add filter fields (e.g., date range, status, buyer) --}}
                    <p>Placeholder for Filter Fields (e.g., Date Range, Status)</p>
                    <div class="form-group">
                        <label for="filter-start-date">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="filter-start-date" name="start_date" value="{{-- request('start_date') --}}">
                    </div>
                     <div class="form-group">
                        <label for="filter-end-date">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="filter-end-date" name="end_date" value="{{-- request('end_date') --}}">
                    </div>
                    {{-- Add other filter inputs --}}
                </div>
                <div class="modal-footer">
                    {{-- Link to clear filters (redirect to index without filter params) --}}
                     <a href="{{-- route('penjualan_barang.index') --}}" class="btn btn-outline-secondary rounded-3 me-2">Clear</a>
                    <button type="button" class="btn btn-outline batal-btn rounded-3 me-2" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn modal-color text-white font-weight-bold rounded-3">Apply Filter</button>
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