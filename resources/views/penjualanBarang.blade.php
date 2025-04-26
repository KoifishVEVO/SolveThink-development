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

    /* mobile style */
    @media (max-width: 767.98px) {
    /* Target mobile screens */

    /* --- Make specific modals fullscreen --- */
    /* ADD #rincianPenjualanModal to the list */
    #addAssetModal .modal-dialog,
    #rincianAssetModal .modal-dialog,
    #updateAssetModal .modal-dialog,
    #rincianPenjualanModal .modal-dialog { /* Added */
        max-width: 100%;
        width: 100%;
        height: 100%;
        margin: 0;
        position: fixed; /* Position relative to viewport */
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        transform: none !important; /* Override potential centering transforms */
        /* Remove the centered class effect */
        display: flex;
        align-items: normal;
        justify-content: normal;
    }

    /* ADD #rincianPenjualanModal to the list */
    #addAssetModal .modal-content,
    #rincianAssetModal .modal-content,
    #updateAssetModal .modal-content,
    #rincianPenjualanModal .modal-content { /* Added */
        height: 100%; /* Fill the dialog height */
        border-radius: 0; /* No rounded corners */
        border: none; /* No border */
        display: flex; /* Use flexbox for layout */
        flex-direction: column; /* Stack header/body/footer */
        flex: 1; /* Allow content to fill dialog */
    }

    /* Allow modal body to scroll */
    /* ADD #rincianPenjualanModal to the list */
    #addAssetModal .modal-body,
    #rincianAssetModal .modal-body,
    #updateAssetModal .modal-body,
    #rincianPenjualanModal .modal-body { /* Added */
        overflow-y: auto; /* Enable vertical scroll */
        flex-grow: 1; /* Allow body to take available vertical space */
        padding: 1.5rem; /* Adjusted padding for mobile */
    }

    /* --- Keep delete modal default (no changes needed here) --- */
    #deleteAssetModal .modal-dialog { /* ... styles as before ... */ }
    #deleteAssetModal .modal-content { /* ... styles as before ... */ }
    #deleteAssetModal .modal-body { /* ... styles as before ... */ }

    /* --- Specific Styles for Rincian ASSET Modal Mobile (KEEP SEPARATE unless layout is identical) --- */
    /* These styles likely DON'T apply to rincianPenjualanModal based on the image provided */
    #rincianAssetModal .modal-body {
        /* Styles for centering image etc. */
        /* display: flex; ... etc */
    }
    #rincianAssetModal .modal-body > div:first-child { /* Image container */ }
    #rincianAssetModal .modal-body > div.ml-4 { /* Details container */ }

    /* --- Footer Button Styling (Apply to rincianPenjualanModal too) --- */
    /* ADD #rincianPenjualanModal to the list */
    #rincianAssetModal .modal-footer,
    #rincianPenjualanModal .modal-footer,
    #filterPenjualanModal .modal-footer { /* Added */
        justify-content: center !important; /* Center the footer button(s) */
        border-top: none; /* Remove top border */
        padding: 2rem; /* Add some padding */
        margin-top: auto; /* Push footer to bottom in flex column */
    }

    /* ADD #rincianPenjualanModal to the list */
    #rincianAssetModal .modal-footer .btn,
    #rincianPenjualanModal .modal-footer .btn,
    #filterPenjualanModal .modal-footer .btn { /* Added */
        width: 90%; /* Make button wide */
        max-width: 400px; /* Limit max width */
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        font-size: 1rem; /* Ensure readable font size */
    }

    /* --- Form Modals Fullscreen adjustments (KEEP SEPARATE) --- */
    #addAssetModal .modal-dialog,
    #updateAssetModal .modal-dialog { /* ... */ }
    #addAssetModal .modal-content,
    #updateAssetModal .modal-content { /* ... */ }
    #addAssetModal form,
    #updateAssetModal form { /* ... */ }
    #addAssetModal .modal-body,
    #updateAssetModal .modal-body { /* ... */ }
    #addAssetModal .modal-footer,
    #updateAssetModal .modal-footer { /* ... */ }
    #updateAssetModal .modal-footer { /* ... */ }
    #addAssetModal .modal-footer .btn,
    #updateAssetModal .modal-footer .btn { /* ... */ }

    /* --- Dropdown options styling (KEEP SEPARATE) --- */
    .searchable-dropdown .dropdown-options-container { /* ... */ }

    #filterPenjualanModal .modal-footer {
        justify-content: center !important; 
        border-top: none;
        padding: 1.5rem 1rem;
        margin-top: auto;
    }

    #filterPenjualanModal .modal-footer .btn {
        width: 50%; /* Biar dua tombol sejajar */
        max-width: none;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        font-size: 1rem;
    }

    /* Tambahkan gap di antara tombol */
    #filterPenjualanModal .modal-footer .d-flex {
        gap: 0.5rem;
    }

} /* End of @media query */


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


        /* Searchable Dropdown Styles (as provided) */
        .custom-search-select-container {
            position: relative;
            font-family: sans-serif; /* Or your preferred font */
        }

        .selected-value {
            padding: 0.375rem 2.25rem 0.375rem 0.75rem; /* Adjusted padding for Bootstrap arrow space */
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            background-color: #fff;
            cursor: pointer;
            display: block;
            width: 100%;
            box-sizing: border-box;
            min-height: calc(1.5em + 0.75rem + 2px); /* Match BS select height */
            line-height: 1.5;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            user-select: none;
            position: relative;
            /* Mimic Bootstrap's dropdown arrow */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }

        /* Style for placeholder text */
        .selected-value.placeholder-selected {
            color: #6c757d; /* Bootstrap's placeholder color */
        }


        /* Remove the custom ::after arrow */
        /* .selected-value::after { ... } */ /* REMOVED */

        .selected-value:focus,
        .custom-search-select-container.open .selected-value {
            border-color: #86b7fe; /* BS focus color */
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25); /* BS focus shadow */
        }

        .dropdown-list-container {
            display: none;
            position: absolute;
            top: calc(100% + 2px);
            left: 0;
            right: 0;
            border: 1px solid #ced4da;
            background-color: #fff;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1051; /* Ensure it's above modal content but potentially below modal itself if needed */
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .dropdown-list-container.show {
            display: block;
        }

        .search-box {
            padding: 0.375rem 0.75rem;
            width: calc(100% - 16px); /* Account for margin */
            box-sizing: border-box;
            border: 1px solid #ced4da;
            outline: none;
            margin: 8px;
            border-radius: 0.25rem;
            line-height: 1.5;
        }

        .options-list {
            list-style: none;
            padding: 0 0 5px 0; /* Add padding bottom */
            margin: 0;
        }

        .options-list li {
            padding: 0.5rem 0.75rem;
            cursor: pointer;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            line-height: 1.5;
        }

        .options-list li:hover,
        .options-list li.highlighted { /* Added .highlighted for potential keyboard nav */
            background-color: #e9ecef; /* BS hover color */
            color: #000;
        }

        /* Style for hidden original select */
        .original-select-hidden {
            /* Make it take no space and not be visible/interactive */
            position: absolute;
            opacity: 0;
            pointer-events: none;
            height: 0;
            width: 0;
            margin: 0;
            padding: 0;
            border: 0;
            overflow: hidden;
        }


        /* Radio button */
        .form-check-input[type="radio"] {
            width: 18px;
            height: 18px;
            border: 1px solid #1a237e; /* Border biru */
            border-radius: 9999px;
            background-color: white;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
            cursor: pointer;
            position: relative;
        }

        /* Saat radio dipilih, isi dengan biru */
        .form-check-input[type="radio"]:checked {
            background-color: #1a237e;
            border: 2px solid #1a237e;
        }

        /* Buat bulatan kecil di tengah saat checked */


        /* Optional: hover effect sedikit */
        .form-check-input[type="radio"]:hover {
            box-shadow: 0 0 0 2px rgba(26, 35, 126, 0.3);
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
                                
                                <button class="btn btn-filter btn-sm ml-2 px-3 py-2" data-toggle="modal" data-target="#filterPenjualanModal">Filter</button>

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
                                                            data-target="{{-- #updatePenjualanModal --}}">
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
            
                <h5 class="modal-title font-weight-bold" id="rincianPenjualanModalLabel">Rincian Penjualan</h5>
              
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
                <button type="button" class="btn modal-color text-white font-weight-bold rounded-3 px-2 mr-2" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterPenjualanModal" tabindex="-1" aria-labelledby="filterPenjualanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #1a237e; border-bottom: none;"> {{-- Specific dark blue color like the image, remove border --}}
                <h5 class="modal-title" id="filterPenjualanModalLabel">Filter</h5>
            </div>

            <form action="" method="GET" id="filterPenjualanForm"> {{-- Added ID for potential reset --}}
                <div class="modal-body">

                    {{-- Periode Filter (Searchable Dropdown) --}}
                    <div class="custom-search-select-container mb-3" id="custom-periode-filter-container">
                        <label for="filter-periode" class="form-label">Periode</label>
                        {{-- This div will display the selected value and trigger the dropdown --}}
                        <div class="selected-value" tabindex="0">- Pilih Periode -</div>
                        {{-- This container holds the search box and the options list --}}
                        <div class="dropdown-list-container">
                            <input type="text" class="search-box" placeholder="Cari Periode...">
                            <ul class="options-list">
                                {{-- Options will be populated by JavaScript --}}
                            </ul>
                        </div>
                        {{-- The original select is hidden but holds the actual form value --}}
                        <select class="original-select-hidden" id="filter-periode" name="periode">
                            <option value="" selected>- Pilih Periode -</option>
                            {{-- Add other period options here e.g. --}}
                            {{-- Make sure you have the options here for the JS to pick up --}}
                            <option value="periode01" {{ request('periode') == 'periode01' ? 'selected' : '' }}>Periode 01</option>
                            <option value="periode02" {{ request('periode') == 'periode02' ? 'selected' : '' }}>Periode 02</option>
                            <option value="periode03" {{ request('periode') == 'periode03' ? 'selected' : '' }}>Periode 03</option>
                            <option value="periode04_long_name_example" {{ request('periode') == 'periode04_long_name_example' ? 'selected' : '' }}>Periode 04 With A Very Long Name Example</option>
                            {{-- Add all your actual periode options --}}
                        </select>
                    </div>

                    {{-- Metode Pengiriman Filter --}}
                    <div class="mb-5">
                        <label class="form-label d-block">Metode Pengiriman</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="metode_pengiriman" id="pengirimanDefault" value="default" {{ request('metode_pengiriman', 'default') == 'default' ? 'checked' : '' }}>
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
                <div class="modal-footer mt-4" style="border-top: none;"> 
                    {{-- Buttons matching the image --}}
                    <div class="d-flex w-100 gap-2">
                        <button type="button" class="btn batal-btn flex-grow-1" data-dismiss="modal" style="border: 1px solid #1a237e; color: #1a237e;">Batal</button>
                        <button type="submit" class="btn text-white flex-grow-1" style="background-color: #1a237e;">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
document.addEventListener('DOMContentLoaded', function() {

/**
 * Initializes a custom searchable dropdown.
 * @param {string} containerId - The ID of the main container div.
 * @param {string} originalSelectId - The ID of the original hidden select.
 */
function setupSearchableDropdown(containerId, originalSelectId) {
    const container = document.getElementById(containerId);
    if (!container) {
        console.warn(`Searchable dropdown container not found: #${containerId}`);
        return;
    }
    const originalSelect = document.getElementById(originalSelectId);
    if (!originalSelect) {
        console.warn(`Original select not found for searchable dropdown: #${originalSelectId}`);
        return;
    }

    const selectedValueDiv = container.querySelector('.selected-value');
    const dropdownContainer = container.querySelector('.dropdown-list-container');
    const searchBox = container.querySelector('.search-box');
    const optionsList = container.querySelector('.options-list');
    let listItems = []; // Holds the actual LIs that are not placeholders

    // --- Populate the custom list from the original select ---
    function populateOptionsList() {
        optionsList.innerHTML = ''; // Clear existing options
        listItems = []; // Reset list items array
        Array.from(originalSelect.options).forEach((option, index) => {
            const li = document.createElement('li');
            li.textContent = option.textContent;
            li.dataset.value = option.value;
            li.dataset.index = index; // Store original index

            if (!option.value) {
                // Optional: Don't add placeholder to the searchable list,
                // or style it differently if you want it selectable.
                // If you want it to be selectable to 'reset' the filter:
                // li.classList.add('placeholder-option');
                // optionsList.appendChild(li);
                // For now, we skip adding the placeholder to the dropdown list
            } else {
                optionsList.appendChild(li);
                listItems.push(li); // Add to the filterable list
            }
        });
    }

    // --- Sync the visible div with the hidden select's value ---
    function syncDisplayWithSelect() {
        if (!originalSelect || !selectedValueDiv) return;

        const selectedOption = originalSelect.options[originalSelect.selectedIndex];
        if (selectedOption) {
            selectedValueDiv.textContent = selectedOption.textContent;
            // Add/remove class for placeholder styling
            if (!selectedOption.value) {
                selectedValueDiv.classList.add('placeholder-selected');
            } else {
                selectedValueDiv.classList.remove('placeholder-selected');
            }
        } else {
            // Fallback if somehow no option is selected
            selectedValueDiv.textContent = 'Select...'; // Default text
            selectedValueDiv.classList.add('placeholder-selected');
        }
    }

    // --- Open/Close Dropdown ---
    selectedValueDiv.addEventListener('click', (event) => {
        event.stopPropagation(); // Prevent document click listener from closing immediately
        if (!dropdownContainer || !searchBox) return;

        // Close other open dropdowns first
        closeAllDropdowns(containerId);

        // Toggle this dropdown
        const isOpen = dropdownContainer.classList.toggle('show');
        container.classList.toggle('open', isOpen); // Add .open class to container

        if (isOpen) {
            // Reset search and filter when opening
            searchBox.value = '';
            listItems.forEach(li => li.style.display = '');
            searchBox.focus(); // Focus the search box
            // Position dropdown (optional, basic positioning is via CSS)
        }
    });

    // --- Close dropdown when clicking outside ---
    document.addEventListener('click', (event) => {
        if (container && !container.contains(event.target)) {
            if (dropdownContainer) dropdownContainer.classList.remove('show');
            container.classList.remove('open');
        }
    });

    // --- Handle selecting an option ---
    optionsList.addEventListener('click', (event) => {
        if (event.target.tagName === 'LI' && event.target.dataset.value !== undefined) {
            const value = event.target.dataset.value;
            const index = event.target.dataset.index;

            // Update the hidden select
            originalSelect.value = value;
            // A more robust way to set selectedIndex if values might not be unique
            if (index !== undefined) {
                originalSelect.selectedIndex = parseInt(index, 10);
            }


            // Update the visible display
            syncDisplayWithSelect();

            // Close the dropdown
            if (dropdownContainer) dropdownContainer.classList.remove('show');
             container.classList.remove('open');

            // Trigger change event on original select if needed for other scripts
            originalSelect.dispatchEvent(new Event('change', { bubbles: true }));
        }
    });

    // --- Handle searching/filtering ---
    searchBox.addEventListener('input', () => {
        const searchTerm = searchBox.value.toLowerCase().trim();
        listItems.forEach(li => {
            const itemText = li.textContent.toLowerCase();
            // Show if search term is empty or item text includes the search term
            li.style.display = (searchTerm === '' || itemText.includes(searchTerm)) ? '' : 'none';
        });
    });

    // --- Sync display if original select changes programmatically ---
    originalSelect.addEventListener('change', syncDisplayWithSelect);

    // --- Initial setup ---
    populateOptionsList(); // Create the list items
    syncDisplayWithSelect(); // Set initial display text

    // --- Reset on Modal Close (Optional but Recommended) ---
    // Find the modal this dropdown belongs to
    const modal = container.closest('.modal');
    if (modal) {
        // Using Bootstrap's native events (no jQuery needed)
        modal.addEventListener('hidden.bs.modal', function() {
            // Reset the select to its placeholder
            if (originalSelect.options.length > 0) {
                 // Find the placeholder option (usually the first one with value="")
                let placeholderIndex = 0;
                for(let i=0; i < originalSelect.options.length; i++) {
                    if (originalSelect.options[i].value === "") {
                        placeholderIndex = i;
                        break;
                    }
                }
                originalSelect.selectedIndex = placeholderIndex;
            }
            syncDisplayWithSelect(); // Update display

            // Reset search box and list visibility
            if (searchBox) searchBox.value = '';
            listItems.forEach(li => li.style.display = '');

            // Ensure dropdown is closed
            if (dropdownContainer) dropdownContainer.classList.remove('show');
             container.classList.remove('open');

            // Optional: Reset radio buttons if needed
            // const form = document.getElementById('filterPenjualanForm');
            // if (form) {
            //    const defaultRadio = form.querySelector('input[name="metode_pengiriman"][value="default"]');
            //    if (defaultRadio) defaultRadio.checked = true;
            // }
        });
    }
} // End of setupSearchableDropdown function

// --- Close all dropdowns function ---
function closeAllDropdowns(excludeContainerId = null) {
    document.querySelectorAll('.custom-search-select-container .dropdown-list-container.show').forEach(dropdown => {
        const currentContainer = dropdown.closest('.custom-search-select-container');
        if (!excludeContainerId || (currentContainer && currentContainer.id !== excludeContainerId)) {
            dropdown.classList.remove('show');
             if (currentContainer) currentContainer.classList.remove('open');
        }
    });
}

// --- Initialize the specific dropdown for the filter modal ---
setupSearchableDropdown('custom-periode-filter-container', 'filter-periode');

// --- Initialize any other searchable dropdowns you might have ---
// setupSearchableDropdown('custom_nama_barang_add_container', 'nama_barang_select_add');
// setupSearchableDropdown('custom_jenis_barang_add_container', 'jenis_barang_select_add');
// ... etc

});
</script>


@endsection