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

        .simpan-btn {}

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

        .btn-filter {
            background-color: #A9B5DF !important;
            color: white !important;
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

        /* Style for Bukti Pembayaran button */
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

        /* mobile style */
        @media (max-width: 767.98px) {
            /* Target mobile screens */

            /* --- Make specific modals fullscreen --- */
            /* ADD #rincianPenjualanModal to the list */
            #addAssetModal .modal-dialog,
            #rincianAssetModal .modal-dialog,
            #updateAssetModal .modal-dialog,
            #rincianPenjualanModal .modal-dialog,
            #updatePenjualanModal .modal-dialog {
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
            #rincianPenjualanModal .modal-content,
            #updatePenjualanModal .modal-content {
                /* Added */
                overflow-y: auto;
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
            #rincianPenjualanModal .modal-body,
            #updatePenjualanModal .modal-body {
                /* Added */
                /* overflow-y: auto; */
                /* Enable vertical scroll */
                /* flex-grow: 1; */
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
            #filterPenjualanModal .modal-footer,
            #updatePenjualanModal .modal-footer {
                display: flex;
                justify-content: center;
                /* Space buttons apart */
                align-items: center;
                padding: 1rem;
                /* Footer padding */
                border-top: none;
                /* No line above footer in fullscreen */
                background-color: #fff;
                /* White footer background */
                flex-shrink: 0;
                gap: 0.5rem;
                /* Gap between buttons */
            }

            /* ADD #rincianPenjualanModal to the list */
            #rincianAssetModal .modal-footer .btn,
            #rincianPenjualanModal .modal-footer .btn,
            #filterPenjualanModal .modal-footer .btn,
            #updatePenjualanModal .modal-footer .btn {
                width: calc(50% - 0.5rem);
                /* Buttons share width with a gap */
                margin: 0;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                font-size: 1rem;
                font-weight: bold;
                border-radius: 5px !important;
                /* Match rounding */
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

            #filterPenjualanModal .modal-footer {
                justify-content: center !important;
                border-top: none;
                padding: 1.5rem 1rem;
                margin-top: auto;
            }

            #filterPenjualanModal .modal-footer .btn {
                width: 50%;
                /* Biar dua tombol sejajar */
                max-width: none;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                font-size: 1rem;
            }

            #filterPenjualanModal .modal-footer .batal-btn {
                width: 50%;
                /* Biar dua tombol sejajar */
                max-width: none;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                font-size: 1rem;
            }

            /* Tambahkan gap di antara tombol */
            #filterPenjualanModal .modal-footer .d-flex {
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


        /* Dropdown */
        .custom-search-select-container {
            position: relative;
            display: inline-block;
            /* Or block if you want it to take full width */
            /* min-width: 200px; /* Adjust as needed */
        }

        .custom-search-select-container .selected-value {
            /* background-color: #fff; */
            /* Match your form-control style */
            /* border: 1px solid #ced4da; */
            /* Match your form-control style */
            /* padding: .375rem .75rem; */
            /* Match your form-control style */
            /* border-radius: .25rem; */
            /* Match your form-control style */
            background-image: none !important;
            appearance: none !important;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Add down arrow using pseudo-element */
        .custom-search-select-container .selected-value::after {
            content: '\25BC';
            /* Unicode for down arrow */
            font-size: 0.8em;
            margin-left: 8px;
            color: #6c757d;
            /* Bootstrap's secondary text color */
        }

        .custom-search-select-container.open .selected-value::after {
            content: '\25B2';
            /* Unicode for up arrow when open */
        }


        .custom-search-select-container .placeholder-selected {
            color: #6c757d;
            /* Bootstrap's muted color for placeholder */
        }

        .custom-search-select-container .dropdown-list-container {
            overflow-x: hidden;
            overflow-y: auto;
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-top: none;
            border-radius: 0 0 .25rem .25rem;
            z-index: 1050;
            width: 100%;
            max-height: 200px;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
        }

        .custom-search-select-container .dropdown-list-container.show {
            display: block;
            border-top: 1px solid #ced4da;
            /* Add border top when shown */
        }

        .custom-search-select-container.open .dropdown-list-container {
            /* Remove border top from selected value if it's part of the container */
            /* For form-control style, the border top is handled by selected-value */
        }


        .custom-search-select-container .search-box {
            width: calc(100% - 1.5rem);
            /* Adjust padding */
            padding: .375rem .75rem;
            border: none;
            /* Search box border can be removed if container has one */
            border-bottom: 1px solid #eee;
            /* Separator line */
            box-sizing: border-box;
            /* Ensure padding doesn't make it wider */
        }

        .custom-search-select-container .search-box:focus {
            outline: none;
        }


        .custom-search-select-container .options-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .custom-search-select-container .options-list li {
            text-align: left;
            padding: 8px 12px;
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .custom-search-select-container .options-list li:hover {
            background-color: #f0f0f0;
        }

        .custom-search-select-container .options-list li.placeholder-option {
            color: #6c757d;
            font-style: italic;
        }


        .original-select-hidden {
            display: none !important;
            /* Ensure it's completely hidden */
        }

        #pilih-periode-table-filter-container .selected-value {
            height: calc(1.5em + .5rem + 2px);
            /* Match form-control-sm height */
            padding: .25rem .5rem;
            /* Match form-control-sm padding */
            font-size: .875rem;
            /* Match form-control-sm font-size */
            line-height: 1.5;
            /* Match form-control-sm line-height */
            /* border-radius: .2rem; */
            /* Match form-control-sm border-radius */
        }
    </style>

    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> {{-- Use asset() helper for proper path --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- Updated Font Awesome link --}}


    {{-- begin page content --}}
    <div class="container-fluid">

        {{-- Page Heading --}}
        <h1 class="h3 mb-2 mt-4 heading-text font-weight-bold">PENJUALAN BARANG</h1>
        <p class="mb-4 heading-text font-weight-bold">Tabel Penjualan Barang adalah tabel yang menunjukkan data penjualan
            dalam rentang periode tertentu</p>

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
                                            <option value="10" {{-- @TODO: Check request('limit') == 10 ? 'selected' : '' --}}>10</option>
                                            <option value="25" {{-- @TODO: Check request('limit') == 25 ? 'selected' : '' --}}>25</option>
                                            <option value="50" {{-- @TODO: Check request('limit') == 50 ? 'selected' : '' --}}>50</option>
                                            <option value="100" {{-- @TODO: Check request('limit') == 100 ? 'selected' : '' --}}>100</option>
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
                                        <form id="searchForm" method="GET" action="{{-- route('penjualan_barang.index') --}}"
                                            class="d-inline">
                                            <input type="search" name="search" value="{{-- request()->search --}}"
                                                class="form-control form-control-sm d-inline-block" style="width: auto;"
                                                aria-controls="dataTable" placeholder="">
                                            {{-- Add hidden input for limit if needed --}}
                                            {{-- <input type="hidden" name="limit" value="{{ request()->limit ?? 10 }}"> --}}
                                        </form>
                                    </label>

                                    {{-- Custom Searchable Dropdown for Periode Filter --}}
                                    <div class="custom-search-select-container ml-2"
                                        id="pilih-periode-table-filter-container" style="min-width: 180px;">
                                        {{-- This div will display the selected value and trigger the dropdown --}}
                                        <div class="selected-value form-control form-control-sm" tabindex="0">-Pilih
                                            Periode-</div>
                                        {{-- This container holds the search box and the options list --}}
                                        <div class="dropdown-list-container">
                                            <input type="text" class="search-box form-control form-control-sm"
                                                placeholder="Cari Periode...">
                                            <ul class="options-list">
                                                {{-- Options will be populated by JavaScript --}}
                                            </ul>
                                        </div>
                                        {{-- The original select is hidden but holds the actual form value & is used by JS --}}
                                        {{-- This select will be part of the main page form that gets submitted --}}
                                        <select class="original-select-hidden" id="pilih-periode-table-filter"
                                            name="periode">
                                            <option value="" selected>-Pilih Periode-</option>
                                            {{-- Example Periode Options - Populate these from your backend or JS --}}
                                            {{-- @foreach ($periodes as $periode) --}}
                                            {{-- <option value="{{ $periode->id }}" {{ request('periode') == $periode->id ? 'selected' : '' }}>{{ $periode->nama }}</option> --}}
                                            {{-- @endforeach --}}
                                            <option value="periode01"
                                                {{ request('periode') == 'periode01' ? 'selected' : '' }}>Periode 01
                                            </option>
                                            <option value="periode02"
                                                {{ request('periode') == 'periode02' ? 'selected' : '' }}>Periode 02
                                            </option>
                                            <option value="all" {{ request('periode') == 'all' ? 'selected' : '' }}>Semua
                                                Periode</option>
                                        </select>
                                    </div>
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
                                            <th>Informasi Pembeli</th>
                                            <th>Detail Transaksi</th>
                                            <th>Detail Pembayaran</th>
                                            <th>Pengiriman</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">

                                        @forelse ($penjualan as $item)
                                            <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                                <td>{{ $loop->iteration }}</td>

                                                {{-- Informasi Pembeli --}}
                                                <td>
                                                    <strong>{{ $item['nama_pembeli'] }}</strong><br>
                                                    <small>{{ $item['alamat_pembeli'] }}</small>
                                                </td>

                                                {{-- Detail Transaksi --}}
                                                <td>
                                                    <strong>{{ $item['pembelian'] }}</strong><br>
                                                    <small>Rp
                                                        {{ number_format($item['total_harga'], 0, ',', '.') }}</small><br>
                                                    <small>{{ $item['tanggal_pembelian'] }}</small>
                                                </td>

                                                {{-- Detail Pembayaran --}}
                                                <td class="text-center" style="min-width: 130px;">
                                                    <div class="btn-bukti-container">
                                                        {{-- Bukti Pembayaran --}}
                                                        @if (!empty($item['bukti_pembayaran_pembeli']))
                                                            <a href="{{ 'https://sale.solvethink.id/storage/' . $item['bukti_pembayaran_pembeli'] }}"
                                                                target="_blank" class="btn btn-sm btn-bukti">
                                                                <i class="fas fa-receipt"></i> Bukti Pembayaran
                                                            </a>
                                                        @else
                                                            <button class="btn btn-sm btn-bukti disabled" disabled>
                                                                <i class="fas fa-receipt"></i> (Belum Ada)
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>

                                                {{-- Pengiriman --}}
                                                <td>
                                                    {{ $item['pengambilan_barang_pembeli'] }}
                                                </td>

                                                {{-- Aksi --}}
                                                <td class="px-3 text-center aksi-buttons">
                                                    <div class="d-inline-block">
                                                        {{-- Rincian Button --}}
                                                        <button class="btn btn-sm rincian-btn m-1"
                                                            data-id="{{ $item['id'] }}"
                                                            data-nama-pembeli="{{ $item['nama_pembeli'] }}"
                                                            data-telp-pembeli="{{ $item['no_pembeli'] ?? '-' }}"
                                                            data-alamat-pembeli="{{ $item['alamat_pembeli'] ?? '-' }}"
                                                            data-metode-pengiriman="{{ $item['pengambilan_barang_pembeli'] ?? '-' }}"
                                                            data-barang-dijual="{{ $item['pembelian'] ?? '-' }}"
                                                            data-total-harga="{{ $item['total_harga'] ?? 0 }}"
                                                            data-tanggal-transaksi="{{ $item['tanggal_pembelian'] ?? '-' }}"
                                                            data-bukti-url="{{ $item['bukti_pembayaran_pembeli'] ? 'https://sale.solvethink.id/storage/bukti_pembayaran/' . $item['bukti_pembayaran_pembeli'] : '' }}"
                                                            data-toggle="modal" data-target="#rincianPenjualanModal">
                                                            Rincian
                                                        </button>

                                                        {{-- <button class="btn btn-sm btn-warning m-1 btn-update"
                                                            data-id="{{ $item['id'] }}"
                                                            data-pembeli="{{ $item['nama_pembeli'] }}" data-url=""
                                                            data-toggle="modal" data-target="#updatePenjualanModal">
                                                            Update
                                                        </button> --}}
                                                        <button class="btn btn-sm btn-danger m-1"
                                                            data-id="{{ $item['id'] }}"
                                                            data-pembeli="{{ $item['nama_pembeli'] }}"
                                                            data-url="https://sale.solvethink.id/api/penjualan-komponen-solvethink/{{ $item['id'] }}"
                                                            onclick="deletePenjualan(this)">
                                                            Delete
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


    <div class="modal fade" id="updatePenjualanModal" tabindex="-1" aria-labelledby="updatePenjualanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="updatePenjualanModalLabel">Update Penjualan Barang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="POST" id="updatePenjualanForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="update-penjualan-id">
                    <div class="modal-body">
                        <div class="row">
                            {{-- Left Column --}}
                            <div class="col-md-6">
                                <input type="hidden" id="update-nama-barang" name="pembelian">
                                <p class="font-weight-bold mb-2">Informasi Pembeli</p>
                                <div class="form-group">
                                    <label for="update-no-wa">No. WA</label>
                                    <input type="text" class="form-control" id="update-no-wa" name="no_pembeli"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="update-nama-penyewa">Nama Pembeli</label>
                                    <input type="text" class="form-control" id="update-nama-penyewa"
                                        name="nama_pembeli" required>
                                </div>
                                <div class="form-group">
                                    <label for="update-alamat-penyewa">Alamat Pembeli</label>
                                    <textarea class="form-control" id="update-alamat-penyewa" name="alamat_pembeli" rows="3"></textarea>
                                </div>

                                <p class="font-weight-bold mb-2 mt-3">Detail Transaksi</p>
                                <div class="form-group">
                                    <label for="update-total-harga">Total Harga</label>
                                    <input type="text" class="form-control" id="update-total-harga"
                                        name="total_harga" required> {{-- Consider using type="number" --}}
                                </div>
                                <div class="form-group">
                                    <label for="update-tanggal-pembelian">Tanggal Pembelian</label>
                                    <input type="date" class="form-control" id="update-tanggal-pembelian"
                                        name="tanggal_pembelian" required>
                                </div>
                            </div>

                            {{-- Right Column --}}
                            <div class="col-md-6">
                                <p class="font-weight-bold mb-2">Detail Pembayaran</p>
                                <div class="form-group mb-3">
                                    {{-- Container that changes layout --}}
                                    <div id="update-upload-section-container"
                                        class="d-flex align-items-center mb-2 p-2 rounded ">

                                        {{-- 1. Clickable Area / Becomes Preview Box --}}
                                        {{-- Initially shows icon, then thumbnail and "Ganti" button --}}
                                        <div id="update-image-upload-preview-area"
                                            class="modal-color rounded d-flex align-items-center justify-content-center mr-2"
                                            style="width: 100px; height: 100px; position: relative; cursor: pointer;"
                                            onclick="triggerUpdateFileInput()">
                                            {{-- Default Icon (Centered) --}}
                                            <i class="fa fa-image fa-3x text-white" id="update-default-icon"></i>
                                            {{-- The actual preview image (hidden initially) --}}
                                            <img src="#" alt="Preview Bukti" id="update-preview-img-element"
                                                style="width: 100%; height: 100%; object-fit: cover; display: none; position: absolute; top:0; left:0;">
                                        </div>

                                        {{-- 2. File Info Area (Or "Ganti" button logic) --}}
                                        <div id="update-file-info-area" class="file-info flex-grow-1 align-items-center">
                                            {{-- This part changes based on whether an image is loaded --}}
                                            <div id="update-file-details" class="d-none"> {{-- Shown when file is selected --}}
                                                <div class="d-flex align-items-center">

                                                    <div>
                                                        <span id="update-bukti-pembayaran-filename"
                                                            class="font-weight-bold d-block text-truncate"
                                                            style="max-width: 150px;">Bukti_Pembayaran.jpg</span>
                                                        <small class="text-success">Successfully Uploaded!</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="update-initial-upload-prompt"> {{-- Shown initially or if no image --}}
                                                <span class="text-muted">Upload Bukti Pembayaran</span>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm modal-color text-white ml-auto"
                                            id="update-ganti-btn" onclick="triggerUpdateFileInput()">Ganti</button>
                                    </div>
                                    {{-- Hidden File Input --}}
                                    <input type="file" class="d-none" id="update-bukti-pembayaran-input"
                                        name="bukti_pembayaran" accept="image/*">
                                </div>


                                <p class="font-weight-bold mb-2 mt-4">Pengiriman</p>
                                <div class="form-group">
                                    <label>Metode Pengiriman</label>
                                    <div class="ml-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="metode_pengiriman"
                                                id="update-take-away" value="take_away" checked>
                                            <label class="form-check-label" for="update-take-away">Take-away</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="metode_pengiriman"
                                                id="update-diantar" value="diantar">
                                            <label class="form-check-label" for="update-diantar">Diantar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline batal-btn rounded-3 me-2"
                            data-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn modal-color text-white font-weight-bold rounded-3">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="rincianPenjualanModal" tabindex="-1" aria-labelledby="rincianPenjualanModalLabel"
        aria-hidden="true">
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
                            <p class="mb-1"><strong>Alamat Pembeli</strong> : <span id="rincian-alamat-penjual"></span>
                            </p>
                        </div>

                        <div class="col-md-5">
                            <h6 class="font-weight-bold mb-3">Pengiriman</h6>
                            <p class="mb-1"><strong>Metode Pengiriman</strong> : <span
                                    id="rincian-metode-penjual">-</span></p>
                        </div>
                    </div>



                    <div class="row mb-4"> {{-- Middle row for Transaksi --}}
                        <div class="col-md-12"> {{-- Full width for this section --}}
                            <h6 class="font-weight-bold mb-3 ">Detail Transaksi</h6>
                            <p class="mb-1"><strong>Nama Barang</strong> : <span id="rincian-pj-barang">-</span></p>
                            <p class="mb-1"><strong>Total Harga</strong> : <span id="rincian-pj-harga">-</span></p>
                            <p class="mb-1"><strong>Tanggal Pembelian</strong> : <span id="rincian-pj-tanggal">-</span>
                            </p>
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
                    <button type="button" class="btn modal-color text-white font-weight-bold rounded-3 px-2 mr-2"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="filterPenjualanModal" tabindex="-1" aria-labelledby="filterPenjualanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #1a237e; border-bottom: none;">
                    {{-- Specific dark blue color like the image, remove border --}}
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
                                <option value="periode01" {{ request('periode') == 'periode01' ? 'selected' : '' }}>
                                    Periode 01</option>
                                <option value="periode02" {{ request('periode') == 'periode02' ? 'selected' : '' }}>
                                    Periode 02</option>
                                <option value="periode03" {{ request('periode') == 'periode03' ? 'selected' : '' }}>
                                    Periode 03</option>
                                <option value="periode04_long_name_example"
                                    {{ request('periode') == 'periode04_long_name_example' ? 'selected' : '' }}>Periode 04
                                    With A Very Long Name Example</option>
                                {{-- Add all your actual periode options --}}
                            </select>
                        </div>

                        {{-- Metode Pengiriman Filter --}}
                        <div class="mb-5">
                            <label class="form-label d-block">Metode Pengiriman</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="metode_pengiriman"
                                    id="pengirimanDefault" value="default"
                                    {{ request('metode_pengiriman', 'default') == 'default' ? 'checked' : '' }}>
                                <label class="form-check-label" for="pengirimanDefault">Default</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="metode_pengiriman"
                                    id="pengirimanTakeaway" value="takeaway"
                                    {{ request('metode_pengiriman') == 'takeaway' ? 'checked' : '' }}>
                                <label class="form-check-label" for="pengirimanTakeaway">Take-away</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="metode_pengiriman"
                                    id="pengirimanDiantar" value="diantar"
                                    {{ request('metode_pengiriman') == 'diantar' ? 'checked' : '' }}>
                                <label class="form-check-label" for="pengirimanDiantar">Diantar</label>
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
             * @param {boolean} autoSubmitForm - Whether to submit the parent form on change.
             * @param {string} formIdToSubmit - The ID of the form to submit (if autoSubmitForm is true).
             */
            function setupSearchableDropdown(containerId, originalSelectId, autoSubmitForm = false, formIdToSubmit =
                null) {
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
                let listItems = [];

                function populateOptionsList() {
                    optionsList.innerHTML = '';
                    listItems = [];
                    Array.from(originalSelect.options).forEach((option, index) => {
                        const li = document.createElement('li');
                        li.textContent = option.textContent;
                        li.dataset.value = option.value;
                        li.dataset.index = index;

                        // Do not add the initial placeholder to the visual list if it has no value
                        // but ensure it can be selected to clear the filter.
                        // For this on-page filter, we might always want the placeholder visible.
                        optionsList.appendChild(li);
                        listItems.push(li);
                    });
                }

                function syncDisplayWithSelect() {
                    if (!originalSelect || !selectedValueDiv) return;
                    const selectedOption = originalSelect.options[originalSelect.selectedIndex];
                    if (selectedOption) {
                        selectedValueDiv.textContent = selectedOption.textContent;
                        selectedValueDiv.classList.toggle('placeholder-selected', !selectedOption.value);
                    } else {
                        selectedValueDiv.textContent = '-Pilih Periode-'; // Default
                        selectedValueDiv.classList.add('placeholder-selected');
                    }
                }

                selectedValueDiv.addEventListener('click', (event) => {
                    event.stopPropagation();
                    if (!dropdownContainer || !searchBox) return;
                    closeAllDropdowns(containerId);
                    const isOpen = dropdownContainer.classList.toggle('show');
                    container.classList.toggle('open', isOpen);
                    if (isOpen) {
                        searchBox.value = '';
                        listItems.forEach(li => li.style.display = '');
                        searchBox.focus();
                    }
                });

                document.addEventListener('click', (event) => {
                    if (container && !container.contains(event.target)) {
                        if (dropdownContainer) dropdownContainer.classList.remove('show');
                        container.classList.remove('open');
                    }
                });

                optionsList.addEventListener('click', (event) => {
                    if (event.target.tagName === 'LI' && event.target.dataset.value !== undefined) {
                        const value = event.target.dataset.value;
                        const index = event.target.dataset.index;

                        if (index !== undefined) {
                            originalSelect.selectedIndex = parseInt(index, 10);
                        }
                        syncDisplayWithSelect();
                        if (dropdownContainer) dropdownContainer.classList.remove('show');
                        container.classList.remove('open');

                        originalSelect.dispatchEvent(new Event('change', {
                            bubbles: true
                        }));

                        if (autoSubmitForm && formIdToSubmit) {
                            const formToSubmit = document.getElementById(formIdToSubmit);
                            if (formToSubmit) {
                                // Update hidden periode input in searchForm before submitting
                                const hiddenPeriodeInput = document.getElementById(
                                    'hidden-periode-search-form');
                                if (hiddenPeriodeInput) {
                                    hiddenPeriodeInput.value = originalSelect.value;
                                }
                                const hiddenLimitInput = document.getElementById(
                                    'hidden-limit-search-form');
                                if (hiddenLimitInput) {
                                    hiddenLimitInput.value = document.getElementById('showEntries').value;
                                }
                                formToSubmit.submit();
                            } else {
                                console.warn(`Form to submit not found: #${formIdToSubmit}`);
                            }
                        }
                    }
                });

                searchBox.addEventListener('input', () => {
                    const searchTerm = searchBox.value.toLowerCase().trim();
                    listItems.forEach(li => {
                        const itemText = li.textContent.toLowerCase();
                        li.style.display = (searchTerm === '' || itemText.includes(searchTerm)) ?
                            '' : 'none';
                    });
                });

                originalSelect.addEventListener('change', syncDisplayWithSelect);

                populateOptionsList();
                syncDisplayWithSelect();

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
                    });
                }
            }

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

            // --- Initialize the "Pilih Periode" dropdown for the table filter ---
            // The third argument `true` enables auto-submit, and the fourth is the ID of the form to submit.
            setupSearchableDropdown('pilih-periode-table-filter-container', 'pilih-periode-table-filter', true,
                'searchForm');

            // --- Handle "Show Entries" Change ---
            const showEntriesSelect = document.getElementById('showEntries');
            if (showEntriesSelect) {
                showEntriesSelect.addEventListener('change', function() {
                    const limit = this.value;
                    const searchForm = document.getElementById('searchForm');
                    if (searchForm) {
                        // Update the hidden limit input within the search form
                        const hiddenLimitInput = document.getElementById('hidden-limit-search-form');
                        if (hiddenLimitInput) {
                            hiddenLimitInput.value = limit;
                        }
                        // Also ensure the periode is included if selected
                        const periodeSelect = document.getElementById('pilih-periode-table-filter');
                        const hiddenPeriodeInput = document.getElementById('hidden-periode-search-form');
                        if (periodeSelect && hiddenPeriodeInput) {
                            hiddenPeriodeInput.value = periodeSelect.value;
                        }
                        searchForm.submit();
                    }
                });
            }
            // Update the hidden limit input with the current value on page load
            const initialLimit = showEntriesSelect ? showEntriesSelect.value : '10';
            const hiddenLimitSearchInput = document.getElementById('hidden-limit-search-form');
            if (hiddenLimitSearchInput) {
                hiddenLimitSearchInput.value = initialLimit;
            }


            // Ensure the selected "Show Entries" and "Periode" are reflected if page reloads with query parameters
            const urlParams = new URLSearchParams(window.location.search);
            const limitParam = urlParams.get('limit');
            const periodeParam = urlParams.get('periode');

            if (limitParam && showEntriesSelect) {
                showEntriesSelect.value = limitParam;
            }

            const periodeFilterSelect = document.getElementById('pilih-periode-table-filter');
            if (periodeParam && periodeFilterSelect) {
                periodeFilterSelect.value = periodeParam;
                // Manually trigger sync for the custom dropdown if value is set programmatically after page load
                // This might be handled by the `syncDisplayWithSelect` if `setupSearchableDropdown` runs after this block
                // or if originalSelect.addEventListener('change', syncDisplayWithSelect) fires.
                // However, explicit sync after setting value is safer if there are timing issues.
                const event = new Event('change');
                periodeFilterSelect.dispatchEvent(event);
            }
        });



        document.addEventListener('DOMContentLoaded', function() {

            // Helper function to format currency (simple version) - reuse if needed elsewhere
            function formatRupiah(angka) {
                // Ensure angka is treated as a number
                const num = Number(angka) || 0;
                let number_string = num.toString(), // Use the number's string representation
                    split = number_string.split(','), // Not really needed for integers
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                // No decimals typically for Rupiah display unless needed
                // rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return 'Rp ' + rupiah;
            }

            // --- Listener for Rincian PENJUALAN Modal ---
            const tableBodyPenjualan = document.getElementById('table-body');
            if (tableBodyPenjualan) {
                tableBodyPenjualan.addEventListener('click', function(event) {
                    // Target the specific button class for PENJUALAN
                    const button = event.target.closest('.rincian-btn');
                    if (!button) {
                        return; // Exit if not a rincian penjualan button click
                    }

                    const data = button.dataset; // Get data from the clicked button

                    // --- Select target elements in the Rincian PENJUALAN Modal ---
                    const modal = document.getElementById(
                        'rincianPenjualanModal'); // Target the correct modal
                    if (!modal) return; // Exit if modal not found

                    const namaPembeliEl = modal.querySelector('#rincian-nama-penjual');
                    const telpPembeliEl = modal.querySelector('#rincian-telp-penjual');
                    const alamatPembeliEl = modal.querySelector('#rincian-alamat-penjual');
                    const metodePengirimanEl = modal.querySelector(
                        '#rincian-metode-penjual'); // Note: ID reused, check if correct
                    const barangDijualEl = modal.querySelector('#rincian-pj-barang');
                    const totalHargaEl = modal.querySelector('#rincian-pj-harga');
                    const tanggalPembelianEl = modal.querySelector('#rincian-pj-tanggal');
                    const buktiBayarContainer = modal.querySelector('#rincian-bukti-bayar-container');

                    // --- Populate modal fields ---
                    if (namaPembeliEl) namaPembeliEl.textContent = data.namaPembeli || '-';
                    if (telpPembeliEl) telpPembeliEl.textContent = data.telpPembeli || '-';
                    if (alamatPembeliEl) alamatPembeliEl.textContent = data.alamatPembeli || '-';
                    if (metodePengirimanEl) metodePengirimanEl.textContent = data.metodePengiriman || '-';
                    if (barangDijualEl) barangDijualEl.textContent = data.barangDijual || '-';
                    if (totalHargaEl) totalHargaEl.textContent = formatRupiah(data.totalHarga ||
                        0); // Format the price
                    if (tanggalPembelianEl) tanggalPembelianEl.textContent = data.tanggalTransaksi || '-';

                    // --- Populate Bukti Pembayaran ---
                    if (buktiBayarContainer) {
                        const buktiUrl = data.buktiUrl; // Get the full URL passed from Blade
                        if (buktiUrl) {
                            buktiBayarContainer.innerHTML = `
                    <a href="${buktiUrl}" target="_blank" class="btn btn-sm btn-bukti">
                        <i class="fas fa-receipt"></i> Bukti Pembayaran
                    </a>`;
                        } else {
                            buktiBayarContainer.innerHTML = `
                    <button class="btn btn-sm btn-bukti disabled" disabled>
                        <i class="fas fa-receipt"></i> (Belum Ada)
                    </button>`;
                        }
                    }

                    // Modal is triggered by data-bs attributes on the button
                }); // End click listener for Penjualan
            } // End if tableBodyPenjualan exists

            // --- Listener for Rincian PENYEWAAN Modal (Keep the previous one if needed) ---
            const tableBodyPenyewaan = document.getElementById(
                'table-body'); // Assuming original ID was for Penyewaan
            if (tableBodyPenyewaan) {
                tableBodyPenyewaan.addEventListener('click', function(event) {
                    // Use the original class for the rental buttons
                    const button = event.target.closest('.rincian-btn');
                    if (!button) return;
                    // ... (rest of the populating logic for rincianPenyewaanModal as provided before) ...
                    console.log("Populating Penyewaan Modal for ID:", button.dataset.id);
                });
            }

            // Add other listeners (Update, Delete etc.) if necessary

        });


        //update image
        document.addEventListener('DOMContentLoaded', function() {
            // --- Elements for Update Modal Bukti Pembayaran ---
            const updateImageInput = document.getElementById('update-bukti-pembayaran-input');
            const updateUploadPreviewArea = document.getElementById(
                'update-image-upload-preview-area'); // The clickable div
            const updateDefaultIcon = document.getElementById('update-default-icon');
            const updatePreviewImageElement = document.getElementById('update-preview-img-element');
            const updateFileInfoArea = document.getElementById(
                'update-file-info-area'); // Parent of details and prompt
            const updateFileDetails = document.getElementById(
                'update-file-details'); // Specific div for filename and success msg
            const updateFileNameDisplay = document.getElementById('update-bukti-pembayaran-filename');
            const updateInitialPrompt = document.getElementById('update-initial-upload-prompt');
            const updateGantiButton = document.getElementById('update-ganti-btn'); // Ganti button

            // Function to trigger file input for the update modal
            window.triggerUpdateFileInput = function() {
                updateImageInput.click();
            }

            // --- Function to show preview for Update Modal ---
            function showUpdatePreview(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    updatePreviewImageElement.src = e.target.result;
                    updatePreviewImageElement.style.display = 'block';
                    updateDefaultIcon.style.display = 'none'; // Hide icon

                    updateFileNameDisplay.textContent = file.name;
                    updateFileDetails.classList.remove('d-none'); // Show file details
                    updateInitialPrompt.classList.add('d-none'); // Hide initial prompt

                    // Optional: Change "Ganti" button text or style if needed
                }
                reader.readAsDataURL(file);
            }

            // --- Function to reset uploader for Update Modal (e.g., if you add a "remove" button) ---
            // Or when loading existing data that has no image.
            function resetUpdateUploader(existingImageUrl = null, existingImageName = null) {
                if (existingImageUrl) {
                    updatePreviewImageElement.src = existingImageUrl;
                    updatePreviewImageElement.style.display = 'block';
                    updateDefaultIcon.style.display = 'none';

                    updateFileNameDisplay.textContent = existingImageName || 'Gambar termuat';
                    updateFileDetails.classList.remove('d-none');
                    updateInitialPrompt.classList.add('d-none');
                } else {
                    updatePreviewImageElement.src = '#';
                    updatePreviewImageElement.style.display = 'none';
                    updateDefaultIcon.style.display = 'block'; // Show icon

                    updateFileNameDisplay.textContent = '';
                    updateFileDetails.classList.add('d-none'); // Hide file details
                    updateInitialPrompt.classList.remove('d-none'); // Show initial prompt
                }
                updateImageInput.value = ''; // Clear the file input
            }

            // --- Event Listener for Update Modal File Input ---
            if (updateImageInput) {
                updateImageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        showUpdatePreview(file);
                    }
                });
            }

            // --- Logic to populate and show the update modal ---
            // This is a simplified example. You'll fetch actual data.
            $('#updatePenjualanModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal
                var penjualanId = button.data('id');

                // Lakukan request AJAX untuk mengambil data penjualan berdasarkan ID
                $.ajax({
                    url: 'https://sale.solvethink.id/api/penjualan-komponen-solvethink/' +
                        penjualanId,
                    method: 'GET',
                    success: function(response) {
                        if (response.success) {
                            var existingData = response.data;
                            var modal = $('#updatePenjualanModal');

                            modal.find('#update-penjualan-id').val(existingData.id);
                            modal.find('#update-no-wa').val(existingData.no_pembeli);
                            modal.find('#update-nama-penyewa').val(existingData.nama_pembeli);
                            modal.find('#update-alamat-penyewa').val(existingData
                                .alamat_pembeli);
                            modal.find('#update-total-harga').val(existingData.total_harga);
                            modal.find('#update-nama-barang').val(existingData.pembelian);
                            modal.find('#update-tanggal-pembelian').val(existingData
                                .tanggal_pembelian);

                            // Radio button untuk pengambilan barang
                            if (existingData.pengambilan_barang_pembeli === 'Pesanan Diantar') {
                                modal.find('#update-diantar').prop('checked', true);
                            } else {
                                modal.find('#update-take-away').prop('checked', true);
                            }

                            // Gambar bukti pembayaran
                            if (existingData.bukti_pembayaran_pembeli) {
                                resetUpdateUploader(
                                    '/storage/' + existingData.bukti_pembayaran_pembeli,
                                    existingData.bukti_pembayaran_pembeli.split('/').pop()
                                );
                            } else {
                                resetUpdateUploader(); // Reset jika tidak ada gambar
                            }
                            // Set URL action pada form
                            // $('#updatePenjualanForm').attr('action',
                            //     'https://sale.solvethink.id/api/penjualan-komponen-solvethink/' +
                            //     existingData.id);

                            // Set action URL jika dibutuhkan (optional)
                            // modal.find('#updatePenjualanForm').attr('action', '/api/penjualanBarang/' + existingData.id);
                        } else {
                            alert('Gagal mengambil data penjualan');
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat mengambil data: ' + xhr.responseText);
                    }
                });
            });

            document.getElementById('updatePenjualanForm').addEventListener('submit', function(e) {
                e.preventDefault(); // penting agar tidak reload

                const form = e.target;
                const id = document.getElementById('update-penjualan-id').value;

                const formData = new FormData(form);
                formData.append('_method', 'PUT');

                console.log('Isi FormData:');
                for (let [key, value] of formData.entries()) {
                    console.log(key, value);
                }

                fetch(`https://sale.solvethink.id/api/penjualan-komponen-solvethink/${id}`, {
                        method: 'POST',
                        // headers: {
                        //     'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        // },
                        body: formData,
                        credentials: 'omit',
                    })
                    .then(async response => {
                        if (!response.ok) {
                            const errorData = await response.json();
                            throw new Error(errorData.message || 'Gagal memperbarui data.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert('Data berhasil diperbarui!');
                        $('#updatePenjualanModal').modal('hide');
                        location.reload();
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Terjadi kesalahan: ' + error.message);
                    });
            });






            // Optional: Reset preview when the update modal is hidden
            $('#updatePenjualanModal').on('hidden.bs.modal', function() {
                // Reset to the state before any new file was selected during this modal session
                // This is tricky if you want to revert to the *original* data's image.
                // For now, this just clears the input. You might need more sophisticated logic
                // to reload the original image if a new one was selected but not saved.
                resetUpdateUploader(); // Or reload with original data if you have it stored
            });

        });

        function deletePenjualan(button) {
            const id = button.getAttribute('data-id');
            const pembeli = button.getAttribute('data-pembeli');
            const url = button.getAttribute('data-url');

            // Konfirmasi sebelum menghapus
            Swal.fire({
                title: `Hapus data?`,
                text: `Data penjualan dari ${pembeli} akan dihapus.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': 'Bearer YOUR_ACCESS_TOKEN_HERE', // Ganti token jika perlu
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Data berhasil dihapus.',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                return response.json().then(data => {
                                    throw new Error(data.message || 'Gagal menghapus data');
                                });
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire('Error!', error.message, 'error');
                        });
                }
            });
        }
    </script>
@endsection
