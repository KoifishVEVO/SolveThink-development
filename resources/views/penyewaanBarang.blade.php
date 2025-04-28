@extends('layouts.dashboard')

@section('title')
    penyewaanBarang
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
            background-color: #2B2684;
            /* Color from screenshot header */
            border-color: #2B2684;
        }

        .modal-color {
            background-color: #2B2684;
            /* Modal Header/Button Color */
            border-color: #2B2684;
        }

        .batal-btn {
            border-color: #2B2684;
            color: #2B2684;
        }



        /* buttons */
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

        .btn-filter {
            background-color: #A9B5DF !important;
            color: white !important;
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

        .delete-text {
            color: #858796;
            /* Subdued text color for confirmation */
        }

        /* Adjust button spacing and alignment if needed */
        .aksi-buttons .btn {
            margin-right: 5px;
            /* Add some space between buttons */
        }

        .aksi-buttons .btn:last-child {
            margin-right: 0;
        }

        /* Style for bukti buttons */
        .btn-bukti {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: white;
            color: #1b2e91;
            /* Biru tua */
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

        .btn-bukti-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* Style for rental status */

        .status-badge {
            display: inline-flex;
            font-size: 0.75rem;
            padding: 0.3em 0.6em;
            border-radius: 0.25rem;
            font-weight: 600;
            gap: 6px;
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;

        }

        .status-berlangsung .status-dot {
            background-color: #f4b400;
            /* Yellow-orange */
        }

        .status-selesai .status-dot {
            background-color: #00c853;
            /* Green */
        }


        .status-berlangsung {
            color: #f4b400
        }

        .status-selesai {

            color: #00c853;
            /* Dark green text */

        }

        /* mobile style */
        @media (max-width: 767.98px) {
            /* Target mobile screens */

            /* --- Make specific modals fullscreen --- */
            /* ADD #rincianPenjualanModal to the list */
            #addAssetModal .modal-dialog,
            #rincianAssetModal .modal-dialog,
            #updateAssetModal .modal-dialog,
            #rincianPenjualanModal .modal-dialog {
                /* Added */
                max-width: 100%;
                width: 100%;
                height: 100%;
                margin: 0;
                position: fixed;
                /* Position relative to viewport */
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                transform: none !important;
                /* Override potential centering transforms */
                /* Remove the centered class effect */
                display: flex;
                align-items: normal;
                justify-content: normal;
            }

            /* ADD #rincianPenjualanModal to the list */
            #addAssetModal .modal-content,
            #rincianAssetModal .modal-content,
            #updateAssetModal .modal-content,
            #rincianPenjualanModal .modal-content {
                /* Added */
                height: 100%;
                /* Fill the dialog height */
                border-radius: 0;
                /* No rounded corners */
                border: none;
                /* No border */
                display: flex;
                /* Use flexbox for layout */
                flex-direction: column;
                /* Stack header/body/footer */
                flex: 1;
                /* Allow content to fill dialog */
            }

            /* Allow modal body to scroll */
            /* ADD #rincianPenjualanModal to the list */
            #addAssetModal .modal-body,
            #rincianAssetModal .modal-body,
            #updateAssetModal .modal-body,
            #rincianPenjualanModal .modal-body {
                /* Added */
                overflow-y: auto;
                /* Enable vertical scroll */
                flex-grow: 1;
                /* Allow body to take available vertical space */
                padding: 1.5rem;
                /* Adjusted padding for mobile */
            }

            /* --- Keep delete modal default (no changes needed here) --- */
            #deleteAssetModal .modal-dialog {
                /* ... styles as before ... */
            }

            #deleteAssetModal .modal-content {
                /* ... styles as before ... */
            }

            #deleteAssetModal .modal-body {
                /* ... styles as before ... */
            }

            /* --- Specific Styles for Rincian ASSET Modal Mobile (KEEP SEPARATE unless layout is identical) --- */
            /* These styles likely DON'T apply to rincianPenjualanModal based on the image provided */
            #rincianAssetModal .modal-body {
                /* Styles for centering image etc. */
                /* display: flex; ... etc */
            }

            #rincianAssetModal .modal-body>div:first-child {
                /* Image container */
            }

            #rincianAssetModal .modal-body>div.ml-4 {
                /* Details container */
            }

            /* --- Footer Button Styling (Apply to rincianPenjualanModal too) --- */
            /* ADD #rincianPenjualanModal to the list */
            #rincianAssetModal .modal-footer,
            #rincianPenjualanModal .modal-footer,
            #filterPenyewaanModal .modal-footer {
                /* Added */
                justify-content: center !important;
                /* Center the footer button(s) */
                border-top: none;
                /* Remove top border */
                padding: 2rem;
                /* Add some padding */
                margin-top: auto;
                /* Push footer to bottom in flex column */
            }

            /* ADD #rincianPenjualanModal to the list */
            #rincianAssetModal .modal-footer .btn,
            #rincianPenjualanModal .modal-footer .btn,
            #filterPenyewaanModal .modal-footer .btn {
                /* Added */
                width: 90%;
                /* Make button wide */
                max-width: 400px;
                /* Limit max width */
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                font-size: 1rem;
                /* Ensure readable font size */
            }

            /* --- Form Modals Fullscreen adjustments (KEEP SEPARATE) --- */
            #addAssetModal .modal-dialog,
            #updateAssetModal .modal-dialog {
                /* ... */
            }

            #addAssetModal .modal-content,
            #updateAssetModal .modal-content {
                /* ... */
            }

            #addAssetModal form,
            #updateAssetModal form {
                /* ... */
            }

            #addAssetModal .modal-body,
            #updateAssetModal .modal-body {
                /* ... */
            }

            #addAssetModal .modal-footer,
            #updateAssetModal .modal-footer {
                /* ... */
            }

            #updateAssetModal .modal-footer {
                /* ... */
            }

            #addAssetModal .modal-footer .btn,
            #updateAssetModal .modal-footer .btn {
                /* ... */
            }

            /* --- Dropdown options styling (KEEP SEPARATE) --- */
            .searchable-dropdown .dropdown-options-container {
                /* ... */
            }

            #filterPenyewaanModal .modal-footer {
                justify-content: center !important;
                border-top: none;
                padding: 1.5rem 1rem;
                margin-top: auto;
            }

            #filterPenyewaanModal .modal-footer .btn {
                width: 50%;
                /* Biar dua tombol sejajar */
                max-width: none;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                font-size: 1rem;
            }

            #filterPenyewaanModal .modal-footer .batal-btn {
                width: 50%;
                /* Biar dua tombol sejajar */
                max-width: none;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                font-size: 1rem;
            }

            /* Tambahkan gap di antara tombol */
            #filterPenyewaanModal .modal-footer .d-flex {
                gap: 0.5rem;
            }

        }

        /* End of @media query */

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
            padding: 6px 18px;
        }

        /* Searchable Dropdown Styles (as provided) */
        .custom-search-select-container {
            position: relative;
            font-family: sans-serif;
            /* Or your preferred font */
        }

        .selected-value {
            padding: 0.375rem 2.25rem 0.375rem 0.75rem;
            /* Adjusted padding for Bootstrap arrow space */
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            background-color: #fff;
            cursor: pointer;
            display: block;
            width: 100%;
            box-sizing: border-box;
            min-height: calc(1.5em + 0.75rem + 2px);
            /* Match BS select height */
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
            color: #6c757d;
            /* Bootstrap's placeholder color */
        }


        /* Remove the custom ::after arrow */
        /* .selected-value::after { ... } */
        /* REMOVED */

        .selected-value:focus,
        .custom-search-select-container.open .selected-value {
            border-color: #86b7fe;
            /* BS focus color */
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            /* BS focus shadow */
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
            z-index: 1051;
            /* Ensure it's above modal content but potentially below modal itself if needed */
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .dropdown-list-container.show {
            display: block;
        }

        .search-box {
            padding: 0.375rem 0.75rem;
            width: calc(100% - 16px);
            /* Account for margin */
            box-sizing: border-box;
            border: 1px solid #ced4da;
            outline: none;
            margin: 8px;
            border-radius: 0.25rem;
            line-height: 1.5;
        }

        .options-list {
            list-style: none;
            padding: 0 0 5px 0;
            /* Add padding bottom */
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
        .options-list li.highlighted {
            /* Added .highlighted for potential keyboard nav */
            background-color: #e9ecef;
            /* BS hover color */
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
            border: 1px solid #1a237e;
            /* Border biru */
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


    {{-- begin page content --}}
    <div class="container-fluid">

        {{-- Page Heading --}}
        <h1 class="h3 mb-2 mt-4 heading-text font-weight-bold">PENYEWAAN BARANG</h1>
        <p class="mb-4 heading-text font-weight-bold">Tabel Penyewaan Barang adalah tabel yang menunjukkan data penyewaan
            dalam rentang periode tertentu</p>

        {{-- DataTales Example --}}
        <div class="card shadow mb-4">
            <div class="card-header py-5 card-color"> {{-- Adjusted padding --}}
                <h6 class="m-0 font-weight-bold text-white">Data Tabel Penyewaan Barang</h6>
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
                                            {{-- @TODO: Check request('limit') to set selected option --}}
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
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
                                        {{-- @TODO: Point action to the correct route for penyewaanBarang search --}}
                                        <form id="searchForm" method="GET" action="{{-- route('penyewaan_barang.index') --}}"
                                            class="d-inline">
                                            <input type="search" name="search" value="{{-- request()->search --}}"
                                                class="form-control form-control-sm d-inline-block" style="width: auto;"
                                                aria-controls="dataTable" placeholder="">
                                            {{-- Add hidden input for limit if needed --}}
                                            {{-- <input type="hidden" name="limit" value="{{ request()->limit ?? 10 }}"> --}}
                                        </form>
                                    </label>

                                    {{-- Filter Button (Placeholder) --}}
                                    {{-- @TODO: Link button to Filter Modal or implement filter logic --}}
                                    <button class="btn btn-filter btn-sm ml-2 px-3 py-2" data-toggle="modal"
                                        data-target="#filterPenyewaanModal">Filter</button>

                                    {{-- Tambah Button --}}

                                    {{-- <button class="btn btn-success btn-sm ml-2" data-toggle="modal" data-target="#addPenyewaanModal">Tambah</button> --}}
                                </div>
                            </div>
                        </div>

                        {{-- Table Row --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                    role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>ID</th>
                                            <th>Informasi Penyewa</th>
                                            <th>Detail Transaksi</th>
                                            <th>Detail Pembayaran</th>
                                            <th>Detail Sewa</th> {{-- New Column --}}
                                            <th>Pengiriman</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        {{-- Placeholder: Loop through $penyewaan data from backend --}}
                                        {{-- Example Dummy Data (Replace with @foreach loop and actual data) --}}

                                        @forelse ($penyewaan as $item)
                                            <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                                <td>{{ $loop->iteration }}</td>
                                                {{-- Correct ID based on pagination --}}
                                                <td>
                                                    <strong>{{ $item['nama_penyewa'] }}</strong><br>
                                                    <small>{{ $item['alamat_penyewa'] }}</small>
                                                </td>
                                                <td>
                                                    <strong>{{ $item['penyewaan'] }}</strong><br>
                                                    <small>{{ $item['total_harga'] }}</small>
                                                </td>
                                                <td class="text-center" style="min-width: 130px;"> {{-- Ensure enough width for buttons --}}
                                                    {{-- Bukti Pembayaran Button --}}
                                                    <div class = "btn-bukti-container">
                                                        @if ($item['bukti_pembayaran_penyewa'])
                                                            <a href="https://rental.solvethink.id/api/penyewaan-komponen-solvethink/{{ $item['bukti_pembayaran_penyewa'] }}"
                                                                target="_blank" class="btn btn-sm btn-bukti">
                                                                <i class="fas fa-receipt"></i> Bukti Pembayaran
                                                            </a>
                                                        @else
                                                            <button class="btn btn-sm btn-bukti disabled" disabled>
                                                                <i class="fas fa-receipt"></i> (Belum Ada)
                                                            </button>
                                                        @endif
                                                        {{-- Bukti KTM/KTP Button --}}
                                                        @if ($item['bukti_identitas_penyewa'])
                                                            <a href="https://rental.solvethink.id/api/penyewaan-komponen-solvethink/{{ $item['bukti_identitas_penyewa'] }}"
                                                                target="_blank" class="btn btn-sm btn-bukti">
                                                                <i class="fas fa-id-card"></i> Bukti KTM/KTP
                                                            </a>
                                                        @else
                                                            <button class="btn btn-sm btn-bukti disabled" disabled>
                                                                <i class="fas fa-id-card"></i> (Belum Ada)
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $item['tanggal_penyewaan'] }}<br> {{-- Assuming tanggal_mulai contains start date --}}
                                                    <small>
                                                        @php
                                                            $jumlahMinggu = [];
                                                            preg_match_all(
                                                                '/Jumlah Minggu: (\d+)/',
                                                                $item['penyewaan'],
                                                                $matches,
                                                            );
                                                            if (isset($matches[1])) {
                                                                $jumlahMinggu = $matches[1];
                                                            }
                                                            $totalMinggu = array_sum($jumlahMinggu);
                                                        @endphp

                                                        {{ $totalMinggu }} Minggu</small><br>

                                                    @php

                                                        $statusClass = 'status-berlangsung';
                                                        if (strtolower($item['status_penyewaan'] ?? '') == 'selesai') {
                                                            $statusClass = 'status-selesai';
                                                        }

                                                    @endphp

                                                    <span class="badge status-badge {{ $statusClass }}">
                                                        <span class="status-dot"></span>
                                                        {{ $item['status_penyewaan'] ?? 'N/A' }}
                                                    </span>

                                                </td>
                                                <td>{{ $item['pengambilan_barang_penyewa'] }}</td>
                                                <td class="px-3 text-center aksi-buttons">
                                                    {{-- Action Buttons --}}
                                                    <div class="d-inline-block">
                                                        {{-- Rincian Button --}}
                                                        {{-- @TODO: Populate data-* attributes with actual data from $item for penyewaan --}}
                                                        <button class="btn btn-sm rincian-btn m-1"
                                                            data-id="{{ $item['id'] }}"
                                                            data-penyewa="{{ $item['nama_penyewa'] }}"
                                                            data-no="{{ $item['no_penyewa'] }}"
                                                            data-alamat="{{ $item['alamat_penyewa'] }}"
                                                            data-penyewaan="{{ $item['penyewaan'] }}"
                                                            data-totalharga="{{ $item['total_harga'] }}"
                                                            data-tanggal="{{ $item['tanggal_penyewaan'] }}"
                                                            data-jumlahminggu="{{ $totalMinggu }}"
                                                            data-status="{{ $item['status_penyewaan'] }}"
                                                            data-buktipembayaran="{{ $item['bukti_pembayaran_penyewa'] }}"
                                                            data-buktiidentitas="{{ $item['bukti_identitas_penyewa'] }}"
                                                            data-pengambilan="{{ $item['pengambilan_barang_penyewa'] }}"
                                                            data-toggle="modal" data-target="#rincianPenyewaanModal">

                                                            Rincian
                                                        </button>

                                                        {{-- Update Button --}}
                                                        {{-- @TODO: Populate data-* attributes and set correct update URL for penyewaan --}}
                                                        <button class="btn btn-sm btn-warning m-1 btn-update"
                                                            data-id="{{ $item['id'] }}"
                                                            data-penyewa="{{ $item['nama_penyewa'] }}"
                                                            {{-- Add other fields to pre-fill the update form --}} data-url="{{-- route('penyewaan_barang.update', $item->id) --}}"
                                                            {{-- Placeholder URL --}} data-toggle="modal"
                                                            data-target="{{-- #updatePenyewaanModal --}}">
                                                            Update
                                                        </button>

                                                        {{-- Hapus Button --}}

                                                        {{-- <button class="btn btn-sm btn-danger m-1 btn-delete"
                                                            data-id="{{ $item->id }}"
                                                            data-info="Penyewaan ID {{ $item->id }} oleh {{ $item->nama_penyewa }}"
                                                            data-url=""
                                                            data-toggle="modal"
                                                            data-target="#deletePenyewaanModal">
                                                        Hapus
                                                    </button> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No data available in table</td>
                                                {{-- Updated colspan --}}
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Pagination Row --}}
                        {{-- Make sure the $penyewaan variable is a Paginator instance from your Controller --}}
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

    <div class="modal fade" id="addPenyewaanModal" tabindex="-1" aria-labelledby="addPenyewaanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Consider modal size --}}
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="addPenyewaanModalLabel">Tambah Penyewaan Barang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                {{-- @TODO: Set correct route for storing data --}}
                <form action="{{-- route('penyewaan_barang.store') --}}" method="POST" id="addPenyewaanForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- Add form fields for: --}}
                        {{-- Informasi Penyewa (Nama, Alamat, Kontak?) --}}
                        {{-- Detail Transaksi (Barang selection, Harga Sewa) --}}
                        {{-- Detail Pembayaran (Metode, Upload Bukti Bayar, Upload Bukti KTM/KTP) --}}
                        {{-- Detail Sewa (Tanggal Mulai, Tanggal Akhir/Durasi) --}}
                        {{-- Pengiriman (Metode, Alamat, Status?) --}}
                        <p>Placeholder for Add Penyewaan Form Fields...</p>
                        {{-- Example Fields --}}
                        <div class="form-group">
                            <label for="add-nama-penyewa">Nama Penyewa</label>
                            <input type="text" class="form-control" id="add-nama-penyewa" name="nama_penyewa"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="add-tanggal-mulai">Tanggal Mulai Sewa</label>
                            <input type="date" class="form-control" id="add-tanggal-mulai" name="tanggal_mulai"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="add-bukti-ktm">Upload Bukti KTM/KTP</label>
                            <input type="file" class="form-control-file" id="add-bukti-ktm" name="bukti_ktm"
                                accept="image/*,application/pdf">
                        </div>
                        {{-- Add other fields here --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline batal-btn rounded-3 mx-2"
                            data-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn modal-color text-white font-weight-bold rounded-3">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--
    masih placeholder, blm diimplementasi
        <div class="modal-content">
            <div class="modal-header modal-color text-white">
                <h5 class="modal-title" id="updatePenyewaanModalLabel">Update Penyewaan Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="#" method="POST" id="updatePenyewaanForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="update-penyewaan-id">
                <div class="modal-body">

                    <p>Placeholder for Update Penyewaan Form Fields...</p>

                    <div class="form-group">
                        <label for="update-nama-penyewa">Nama Penyewa</label>
                        <input type="text" class="form-control" id="update-nama-penyewa" name="nama_penyewa" required>
                    </div>
                     <div class="form-group">
                        <label for="update-status-sewa">Status Sewa</label>
                        <select class="form-control" id="update-status-sewa" name="status_sewa">
                            <option value="Berlangsung">Berlangsung</option>
                            <option value="Selesai">Selesai</option>

                        </select>
                    </div>
                    <div class="form-group">
                         <label>Bukti KTM/KTP Saat Ini</label>
                         <div id="update-current-ktm"></div>
                         <label for="update-bukti-ktm">Ganti Bukti KTM/KTP (Opsional)</label>
                         <input type="file" class="form-control-file" id="update-bukti-ktm" name="bukti_ktm" accept="image/*,application/pdf">
                     </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline batal-btn rounded-3 me-2" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn modal-color text-white font-weight-bold rounded-3">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
--}}
    <div class="modal fade" id="deletePenyewaanModal" tabindex="-1" aria-labelledby="deletePenyewaanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="deletePenyewaanModalLabel">Hapus Penyewaan Barang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                {{-- @TODO: Action URL is set dynamically via JS --}}
                <form action="#" method="POST" id="deletePenyewaanForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p class="text-center delete-text mb-1">Anda yakin ingin menghapus data penyewaan ini?</p>
                        <p class="text-center font-weight-bold" id="delete-penyewaan-info"></p> {{-- Populated by JS --}}
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-outline batal-btn rounded-3 me-2"
                            data-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn modal-color text-white font-weight-bold rounded-3">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rincianPenyewaanModal" tabindex="-1" aria-labelledby="rincianPenyewaanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="rincianPenyewaanModalLabel">Rincian Penyewaan Barang</h5>

                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Informasi Penyewa</h6>
                            <p class="mb-1"><strong>Nama:</strong> <span id="rincian-nama-penyewa"></span></p>
                            <p class="mb-1"><strong>No. WA:</strong> <span id="rincian-telp-penyewa"></span></p>
                            <p class="mb-1"><strong>Alamat:</strong> <span id="rincian-alamat-penyewa"></span></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Detail Sewa</h6>
                            <p class="mb-1"><strong>Tanggal Penyewaan:</strong> <span id="rincian-tgl-penyewaan"></span>
                            </p>
                            <p class="mb-1"><strong>Waktu Sewa:</strong> <span id="rincian-waktu-sewa"></span></p>
                            <p class="mb-1">
                                <strong>Status:</strong>
                                <span id="rincian-status-sewa" class="ml-2 status-badge">(Status not loaded)</span>
                                {{-- Example structure, berbasis logika table
                                if (status === 'Selesai') {
                                    $('#rincian-status-sewa').text('Selesai').removeClass('status-berlangsung').addClass('status-selesai');
                                } else {
                                    $('#rincian-status-sewa').text('Berlangsung').removeClass('status-selesai').addClass('status-berlangsung');
                                }
                            --}}
                            </p>
                        </div>
                    </div>



                    {{-- Pembeyaran dan sewa --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>Detail Transaksi</h6>
                            <p class="mb-1"><strong>Nama Barang:</strong> <span id="rincian-barang-disewa"></span></p>
                            <p class="mb-1"><strong>Total Harga:</strong> <span id="rincian-harga-sewa"></span></p>
                        </div>
                        <div class="col-md-6">
                            <h6>Pengiriman</h6>
                            <p class="mb-1"><strong>Metode Pengiriman:</strong> <span id="rincian-metode-kirim"></span>
                            </p>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <h6>Detail Pembayaran</h6>
                            <div class="mb-2">

                                <div id="rincian-bukti-bayar-container" class="d-inline-block ml-2">
                                    <span class="text-muted">(Data not loaded)</span>
                                    {{-- Example Blade Logic
                                    pakai class btn-bukti again buat styling
                                    <div class="btn-bukti-container d-inline-block">
                                    @if ($item->bukti_pembayaran_url)
                                        <a href="#" target="_blank" class="btn btn-sm btn-bukti">
                                            <i class="fas fa-receipt"></i> Lihat Bukti
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-bukti disabled" disabled>
                                            <i class="fas fa-receipt"></i> (Belum Ada)
                                        </button>
                                    @endif
                                    </div>
                                --}}
                                </div>
                            </div>
                            <div>

                                <div id="rincian-bukti-ktm-container" class="d-inline-block ml-2">
                                    <span class="text-muted">(Data not loaded)</span>
                                    {{-- Example Blade Logic
                                    Pakai class btn buktinya for styling
                                    <div class="btn-bukti-container d-inline-block">
                                    @if ($item->bukti_ktm_url)
                                        <a href="#" target="_blank" class="btn btn-sm btn-bukti">
                                            <i class="fas fa-id-card"></i> Lihat Bukti
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-bukti disabled" disabled>
                                            <i class="fas fa-id-card"></i> (Belum Ada)
                                        </button>
                                    @endif
                                    </div>
                                --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: none;">
                    <button type="button" class="btn modal-color text-white font-weight-bold rounded-3"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="filterPenyewaanModal" tabindex="-1" aria-labelledby="filterPenyewaanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                {{-- Header with specific color and BS5 close button --}}
                <div class="modal-header text-white" style="background-color: #1a237e; border-bottom: none;">
                    <h5 class="modal-title" id="filterPenyewaanModalLabel">Filter</h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                {{-- Point form to the correct index route with GET method --}}
                {{-- Added ID to form for potential JS targeting --}}
                <form action="" method="GET" id="filterPenyewaanForm">
                    <div class="modal-body">

                        {{-- Periode Filter (Searchable Dropdown) --}}
                        {{-- *** Use a NEW unique container ID *** --}}
                        <div class="custom-search-select-container mb-3" id="custom-penyewaan-periode-container">
                            <label for="filter-periode-penyewaan" class="form-label">Periode</label>
                            {{-- Changed 'for' attribute slightly for clarity if needed --}}
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
                            {{-- *** Ensure this select ID is unique OR corresponds to the JS call *** --}}
                            <select class="original-select-hidden" id="filter-periode-penyewaan" name="periode">
                                <option value="" selected>- Pilih Periode -</option>
                                {{-- Add specific period options here --}}
                                <option value="periode01" {{ request('periode') == 'periode01' ? 'selected' : '' }}>
                                    Periode 01</option>
                                <option value="periode02" {{ request('periode') == 'periode02' ? 'selected' : '' }}>
                                    Periode 02</option>
                                <option value="periode03" {{ request('periode') == 'periode03' ? 'selected' : '' }}>
                                    Periode 03</option>
                                {{-- Add all your actual periode options for this filter --}}
                            </select>
                        </div>

                        {{-- Metode Pengiriman Filter --}}
                        <div class="mb-3">
                            <label class="form-label d-block">Metode Pengiriman</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="metode_pengiriman"
                                    id="penyewaanPengirimanDefault" value="default"
                                    {{ request('metode_pengiriman', 'default') == 'default' ? 'checked' : '' }}>
                                <label class="form-check-label" for="penyewaanPengirimanDefault">Default</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="metode_pengiriman"
                                    id="penyewaanPengirimanTakeaway" value="takeaway"
                                    {{ request('metode_pengiriman') == 'takeaway' ? 'checked' : '' }}>
                                <label class="form-check-label" for="penyewaanPengirimanTakeaway">Take-away</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="metode_pengiriman"
                                    id="penyewaanPengirimanDiantar" value="diantar"
                                    {{ request('metode_pengiriman') == 'diantar' ? 'checked' : '' }}>
                                <label class="form-check-label" for="penyewaanPengirimanDiantar">Diantar</label>
                            </div>
                        </div>

                        {{-- Status Filter --}}
                        <div class="mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_sewa"
                                    id="penyewaanStatusDefault" value="default"
                                    {{ request('status_sewa', 'default') == 'default' ? 'checked' : '' }}>
                                <label class="form-check-label" for="penyewaanStatusDefault">Default</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_sewa"
                                    id="penyewaanStatusSelesai" value="Selesai"
                                    {{ request('status_sewa') == 'Selesai' ? 'checked' : '' }}>
                                <label class="form-check-label" for="penyewaanStatusSelesai">Selesai</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status_sewa"
                                    id="penyewaanStatusBerlangsung" value="Berlangsung"
                                    {{ request('status_sewa') == 'Berlangsung' ? 'checked' : '' }}>
                                <label class="form-check-label" for="penyewaanStatusBerlangsung">Berlangsung</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer mt-4" style="border-top: none;">
                        {{-- Buttons matching the image --}}
                        <div class="d-flex w-100 gap-2 justify-content-end">
                            <button type="button" class="btn batal-btn " data-dismiss="modal"
                                style="border: 1px solid #1a237e; color: #1a237e;">Batal</button>
                            <button type="submit" class="btn simpan-btn text-white ml-2"
                                style="background-color: #1a237e;">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.rincian-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Set semua data dari tombol ke modal
                    document.getElementById('rincian-nama-penyewa').textContent = this.dataset
                        .penyewa || '-';
                    document.getElementById('rincian-telp-penyewa').textContent = this.dataset
                        .no || '-';
                    document.getElementById('rincian-alamat-penyewa').textContent = this.dataset
                        .alamat || '-';
                    document.getElementById('rincian-tgl-penyewaan').textContent = this.dataset
                        .tanggal || '-';
                    document.getElementById('rincian-waktu-sewa').textContent = (this.dataset
                        .jumlahminggu || '-') + ' Minggu';
                    document.getElementById('rincian-status-sewa').textContent = this.dataset
                        .status || '-';
                    document.getElementById('rincian-barang-disewa').textContent = this.dataset
                        .penyewaan || '-';
                    document.getElementById('rincian-harga-sewa').textContent = this.dataset
                        .totalharga || '-';
                    document.getElementById('rincian-metode-kirim').textContent = this.dataset
                        .pengambilan || '-';


                    // Bukti pembayaran
                    const buktiBayarContainer = document.getElementById(
                        'rincian-bukti-bayar-container');
                    if (this.dataset.buktipembayaran && this.dataset.buktipembayaran !== '-') {
                        buktiBayarContainer.innerHTML = `
                <a href="${this.dataset.buktipembayaran}" target="_blank" class="btn btn-sm btn-bukti">
                    <i class="fas fa-receipt"></i> Lihat Bukti
                </a>
            `;
                    } else {
                        buktiBayarContainer.innerHTML = `
                <button class="btn btn-sm btn-bukti disabled" disabled>
                    <i class="fas fa-receipt"></i> (Belum Ada)
                </button>
            `;
                    }

                    // Bukti identitas (KTP/KTM)
                    const buktiKtmContainer = document.getElementById(
                        'rincian-bukti-ktm-container');
                    if (this.dataset.buktiidentitas && this.dataset.buktiidentitas !== '-') {
                        buktiKtmContainer.innerHTML = `
                <a href="${this.dataset.buktiidentitas}" target="_blank" class="btn btn-sm btn-bukti">
                    <i class="fas fa-id-card"></i> Lihat Bukti
                </a>
            `;
                    } else {
                        buktiKtmContainer.innerHTML = `
                <button class="btn btn-sm btn-bukti disabled" disabled>
                    <i class="fas fa-id-card"></i> (Belum Ada)
                </button>
            `;
                    }

                    // Update warna status (opsional bonus)
                    const statusElement = document.getElementById('rincian-status-sewa');
                    statusElement.classList.remove('status-berlangsung', 'status-selesai');
                    if (this.dataset.status === 'Selesai') {
                        statusElement.classList.add('status-selesai');
                    } else {
                        statusElement.classList.add('status-berlangsung');
                    }
                });
            });


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
                            // Skip placeholder for the searchable list
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
                    closeAllDropdowns(containerId); // Close other open dropdowns first
                    const isOpen = dropdownContainer.classList.toggle('show');
                    container.classList.toggle('open', isOpen); // Add .open class to container
                    if (isOpen) {
                        searchBox.value = ''; // Reset search
                        listItems.forEach(li => li.style.display = ''); // Reset filter
                        searchBox.focus();
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
                        originalSelect.value = value; // Update the hidden select
                        if (index !== undefined) originalSelect.selectedIndex = parseInt(index, 10);
                        syncDisplayWithSelect(); // Update the visible display
                        if (dropdownContainer) dropdownContainer.classList.remove('show'); // Close dropdown
                        container.classList.remove('open');
                        originalSelect.dispatchEvent(new Event('change', {
                            bubbles: true
                        })); // Trigger change event
                    }
                });

                // --- Handle searching/filtering ---
                searchBox.addEventListener('input', () => {
                    const searchTerm = searchBox.value.toLowerCase().trim();
                    listItems.forEach(li => {
                        const itemText = li.textContent.toLowerCase();
                        li.style.display = (searchTerm === '' || itemText.includes(searchTerm)) ?
                            '' : 'none';
                    });
                });

                // --- Sync display if original select changes programmatically ---
                originalSelect.addEventListener('change', syncDisplayWithSelect);

                // --- Initial setup ---
                populateOptionsList();
                syncDisplayWithSelect();

                // --- Reset on Modal Close ---
                const modal = container.closest('.modal');
                if (modal) {
                    modal.addEventListener('hidden.bs.modal', function() {
                        if (originalSelect.options.length > 0) {
                            let placeholderIndex = 0;
                            for (let i = 0; i < originalSelect.options.length; i++) {
                                if (originalSelect.options[i].value === "") {
                                    placeholderIndex = i;
                                    break;
                                }
                            }
                            originalSelect.selectedIndex = placeholderIndex;
                        }
                        syncDisplayWithSelect();
                        if (searchBox) searchBox.value = '';
                        listItems.forEach(li => li.style.display = '');
                        if (dropdownContainer) dropdownContainer.classList.remove('show');
                        container.classList.remove('open');

                        // Optional: Reset radio buttons in *this specific modal* on close
                        const form = document.getElementById(
                            'filterPenyewaanForm'); // Target this modal's form
                        if (form) {
                            // Reset Metode Pengiriman
                            const metodeDefaultRadio = form.querySelector(
                                'input[name="metode_pengiriman"][value="default"]');
                            if (metodeDefaultRadio) metodeDefaultRadio.checked =
                                true; // Or set your desired default

                            // Reset Status
                            const statusDefaultRadio = form.querySelector(
                                'input[name="status_sewa"][value="default"]');
                            if (statusDefaultRadio) statusDefaultRadio.checked =
                                true; // Or set your desired default
                        }
                    });
                }
            } // End of setupSearchableDropdown function

            // --- Close all dropdowns function ---
            function closeAllDropdowns(excludeContainerId = null) {
                document.querySelectorAll('.custom-search-select-container .dropdown-list-container.show').forEach(
                    dropdown => {
                        const currentContainer = dropdown.closest('.custom-search-select-container');
                        if (!excludeContainerId || (currentContainer && currentContainer.id !==
                                excludeContainerId)) {
                            dropdown.classList.remove('show');
                            if (currentContainer) currentContainer.classList.remove('open');
                        }
                    });
            }

            setupSearchableDropdown('custom-penyewaan-periode-container', 'filter-periode-penyewaan');



        });
    </script>
@endsection
