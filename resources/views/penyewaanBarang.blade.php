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
            #rincianPenjualanModal .modal-dialog,
            #rincianPenyewaanModal .modal-dialog,
            #updatePenyewaanModal .modal-dialog {
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
            #rincianPenyewaanModal .modal-content,
            #updatePenyewaanModal .modal-content {
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
            #rincianPenyewaanModal .modal-body,
            #updatePenyewaanModal .modal-body {
                padding: 1.5rem;
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
            #filterPenyewaanModal .modal-footer,
            #updatePenyewaanModal .modal-footer,
            #rincianPenyewaanModal .modal-footer {
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
            #filterPenyewaanModal .modal-footer .btn,
            #updatePenyewaanModal .modal-footer .btn,
            #rincianPenyewaanModal .modal-footer .btn {
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
                                            <th>Informasi Penyewa</th>
                                            <th>Detail Transaksi</th>
                                            <th>Detail Pembayaran</th>
                                            <th>Detail Sewa</th> {{-- New Column --}}
                                            <th>Pengiriman</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">


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
                                                            <a href="https://rental.solvethink.id/storage/{{ $item['bukti_pembayaran_penyewa'] }}"
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
                                                            <a href="https://rental.solvethink.id/storage/{{ $item['bukti_identitas_penyewa'] }}"
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
                                                            data-target="#updatePenyewaanModal ">
                                                            Update
                                                        </button>

                                                        {{-- Hapus Button --}}
                                                        <button class="btn btn-sm btn-danger m-1"
                                                            data-id="{{ $item['id'] }}"
                                                            data-penyewa="{{ $item['nama_penyewa'] }}"
                                                            data-url="https://rental.solvethink.id/api/penyewaan-komponen-solvethink/{{ $item['id'] }}"
                                                            onclick="deletePenyewaan(this)">
                                                            Delete
                                                        </button>
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

    <div class="modal fade" id="updatePenyewaanModal" tabindex="-1" aria-labelledby="updatePenyewaanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="updatePenyewaanModalLabel">Update Penyewaan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="POST" id="updatePenyewaanForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="update-penyewaan-id">
                    <div class="modal-body">
                        <div class="row">
                            {{-- Left Column --}}
                            <div class="col-md-6">
                                <p class="font-weight-bold mb-2">Informasi Penyewa</p>
                                <div class="form-group">
                                    <label for="update-penyewaan-no-wa">No. WA</label>
                                    <input type="text" class="form-control" id="update-penyewaan-no-wa"
                                        name="no_wa" required>
                                </div>
                                <div class="form-group">
                                    <label for="update-penyewaan-nama-penyewa">Nama Penyewa</label>
                                    <input type="text" class="form-control" id="update-penyewaan-nama-penyewa"
                                        name="nama_penyewa" required>
                                </div>
                                <div class="form-group">
                                    <label for="update-penyewaan-alamat-penyewa">Alamat Penyewa</label>
                                    <textarea class="form-control" id="update-penyewaan-alamat-penyewa" name="alamat_penyewa" rows="3"></textarea>
                                </div>

                                <p class="font-weight-bold mb-2 mt-3">Detail Transaksi</p>
                                <div class="form-group">
                                    <label for="update-penyewaan-total-harga">Total Harga</label>
                                    <input type="text" class="form-control" id="update-penyewaan-total-harga"
                                        name="total_harga" required> {{-- Consider type="number" --}}
                                </div>
                                <div class="form-group">
                                    <label for="update-penyewaan-nama-barang">Nama Barang</label>
                                    <select class="form-control" id="update-penyewaan-nama-barang" name="nama_barang"
                                        required>
                                        <option value="">-Pilih Nama Barang-</option>
                                        {{-- Populate with options dynamically --}}
                                    </select>
                                </div>
                            </div>

                            {{-- Right Column --}}
                            <div class="col-md-6">
                                <p class="font-weight-bold mb-2">Detail Pembayaran</p>
                                {{-- Bukti Pembayaran Upload --}}
                                <div class="form-group mb-3">
                                    <div class="d-flex align-items-center mb-1 p-2">
                                        <div id="update-bukti-bayar-preview-area"
                                            class="modal-color rounded d-flex align-items-center justify-content-center mr-2"
                                            style="width: 60px; height: 60px; position: relative; cursor: pointer;"
                                            onclick="triggerUpdateBuktiBayarInput()">
                                            <i class="fa fa-image fa-2x text-white"
                                                id="update-bukti-bayar-default-icon"></i>
                                            <img src="#" alt="Bukti Bayar" id="update-bukti-bayar-preview-img"
                                                style="width: 100%; height: 100%; object-fit: cover; display: none; position: absolute; top:0; left:0;">
                                        </div>
                                        <div class="file-info flex-grow-1">
                                            <span id="update-bukti-bayar-filename"
                                                class="font-weight-bold d-block text-truncate"
                                                style="max-width: 150px;">Bukti_Pembayaran#1.jpg</span>
                                            <small id="update-bukti-bayar-status" class="text-success">Successfully
                                                Uploaded!</small>
                                        </div>
                                        <button type="button" class="btn btn-sm  modal-color text-white ml-auto"
                                            onclick="triggerUpdateBuktiBayarInput()">Ganti</button>
                                    </div>
                                    <input type="file" class="d-none" id="update-bukti-bayar-input"
                                        name="bukti_pembayaran" accept="image/*,application/pdf">
                                </div>

                                {{-- Bukti KTM/KTP Upload --}}
                                <div class="form-group mb-3">
                                    <div class="d-flex align-items-center mb-1 p-2 ">
                                        <div id="update-bukti-ktm-preview-area"
                                            class="modal-color rounded d-flex align-items-center justify-content-center mr-2"
                                            style="width: 60px; height: 60px; position: relative; cursor: pointer;"
                                            onclick="triggerUpdateBuktiKtmInput()">
                                            <i class="fa fa-image fa-2x text-white"
                                                id="update-bukti-ktm-default-icon"></i>
                                            <img src="#" alt="Bukti KTM" id="update-bukti-ktm-preview-img"
                                                style="width: 100%; height: 100%; object-fit: cover; display: none; position: absolute; top:0; left:0;">
                                        </div>
                                        <div class="file-info flex-grow-1">
                                            <span id="update-bukti-ktm-filename"
                                                class="font-weight-bold d-block text-truncate"
                                                style="max-width: 150px;">Bukti_KTM_KTP#1.jpg</span>
                                            <small id="update-bukti-ktm-status" class="text-success">Successfully
                                                Uploaded!</small>
                                        </div>
                                        <button type="button" class="btn btn-sm modal-color text-white ml-auto"
                                            onclick="triggerUpdateBuktiKtmInput()">Ganti</button>
                                    </div>
                                    <input type="file" class="d-none" id="update-bukti-ktm-input" name="bukti_ktm"
                                        accept="image/*,application/pdf">
                                </div>


                                <p class="font-weight-bold mb-2 mt-3">Detail Sewa</p>
                                <div class="form-group">
                                    <label for="update-tanggal-penyewaan">Tanggal Penyewaan</label>
                                    <input type="date" class="form-control" id="update-tanggal-penyewaan"
                                        name="tanggal_penyewaan" required>
                                </div>
                                <div class="form-group">
                                    <label for="update-waktu-sewa">Waktu Sewa</label>
                                    <input type="text" class="form-control" id="update-waktu-sewa" name="waktu_sewa"
                                        placeholder="Contoh: 2 Minggu" required>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="ml-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_sewa"
                                                id="update-status-selesai" value="Selesai">
                                            <label class="form-check-label" for="update-status-selesai">Selesai</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_sewa"
                                                id="update-status-berlangsung" value="Berlangsung" checked>
                                            <label class="form-check-label"
                                                for="update-status-berlangsung">Berlangsung</label>
                                        </div>
                                    </div>
                                </div>

                                <p class="font-weight-bold mb-2 mt-3">Pengiriman</p>
                                <div class="form-group">
                                    <label>Metode Pengiriman</label>
                                    <div class="ml-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="metode_pengiriman_penyewaan" id="update-penyewaan-take-away"
                                                value="take_away" checked>
                                            <label class="form-check-label"
                                                for="update-penyewaan-take-away">Take-away</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="metode_pengiriman_penyewaan" id="update-penyewaan-diantar"
                                                value="diantar">
                                            <label class="form-check-label" for="update-penyewaan-diantar">Diantar</label>
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
                                <span id="rincian-status-sewa" class="ml-2 status-badge">
                                    <span class="status-dot"></span>
                                    (Status not loaded)
                                </span>
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
                    const statusText = this.dataset.status || '-';
                    document.getElementById('rincian-status-sewa').innerHTML = `
    <span class="status-dot"></span> ${statusText}
`;
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

        function deletePenyewaan(button) {
            const id = button.getAttribute('data-id');
            const pembeli = button.getAttribute('data-penyewa');
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


        // Update, pictures
        document.addEventListener('DOMContentLoaded', function() {

            // --- Helper function for managing file upload UI ---
            function setupFileUpload(inputId, previewAreaId, defaultIconId, previewImgId, filenameId, statusId,
                initialPromptText = "No file chosen") {
                const inputElement = document.getElementById(inputId);
                const previewAreaElement = document.getElementById(previewAreaId); // Clickable area
                const defaultIconElement = document.getElementById(defaultIconId);
                const previewImgElement = document.getElementById(previewImgId);
                const filenameElement = document.getElementById(filenameId);
                const statusElement = document.getElementById(statusId);

                function showPreview(file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImgElement.src = e.target.result;
                        previewImgElement.style.display = 'block';
                        if (defaultIconElement) defaultIconElement.style.display = 'none';
                        if (filenameElement) filenameElement.textContent = file.name;
                        if (statusElement) {
                            statusElement.textContent = 'Successfully Uploaded!';
                            statusElement.className = 'text-success small';
                        }
                    }
                    reader.readAsDataURL(file);
                }

                function resetUploader(existingImageUrl = null, existingImageName = null) {
                    inputElement.value = ''; // Clear file input
                    if (existingImageUrl && existingImageName) {
                        previewImgElement.src = existingImageUrl;
                        previewImgElement.style.display = 'block';
                        if (defaultIconElement) defaultIconElement.style.display = 'none';
                        if (filenameElement) filenameElement.textContent = existingImageName;
                        if (statusElement) {
                            statusElement.textContent = 'Current file loaded.';
                            statusElement.className = 'text-muted small';
                        }
                    } else {
                        previewImgElement.src = '#';
                        previewImgElement.style.display = 'none';
                        if (defaultIconElement) defaultIconElement.style.display = 'block';
                        if (filenameElement) filenameElement.textContent = initialPromptText;
                        if (statusElement) {
                            statusElement.textContent = 'No file selected.';
                            statusElement.className = 'text-muted small';
                        }
                    }
                }

                if (inputElement) {
                    inputElement.addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            showPreview(file);
                        } else {
                            // If user cancels file selection, optionally reset to original or show "no file"
                            // For now, let's assume if data was loaded, it remains, else it shows "no file"
                            // This might need refinement based on exact UX desired
                        }
                    });
                }
                return {
                    resetUploader,
                    showPreview
                }; // Expose reset and showPreview for external use if needed
            }

            // Setup for Bukti Pembayaran
            const buktiBayarUploader = setupFileUpload(
                'update-bukti-bayar-input',
                'update-bukti-bayar-preview-area',
                'update-bukti-bayar-default-icon',
                'update-bukti-bayar-preview-img',
                'update-bukti-bayar-filename',
                'update-bukti-bayar-status',
                'Bukti Pembayaran' // Initial text for filename span
            );
            window.triggerUpdateBuktiBayarInput = function() {
                document.getElementById('update-bukti-bayar-input').click();
            }

            // Setup for Bukti KTM/KTP
            const buktiKtmUploader = setupFileUpload(
                'update-bukti-ktm-input',
                'update-bukti-ktm-preview-area',
                'update-bukti-ktm-default-icon',
                'update-bukti-ktm-preview-img',
                'update-bukti-ktm-filename',
                'update-bukti-ktm-status',
                'Bukti KTM/KTP' // Initial text for filename span
            );
            window.triggerUpdateBuktiKtmInput = function() {
                document.getElementById('update-bukti-ktm-input').click();
            }


            // --- Logic to populate and show the updatePenyewaanModal ---
            $('#updatePenyewaanModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var penyewaanId = button.data('id'); // Extract info like data-id="..."
                var modal = $(this);

                // @TODO: AJAX call to fetch penyewaan data by penyewaanId
                // For demonstration, using placeholder data:
                var existingData = {
                    id: penyewaanId,
                    no_wa: '08987654321',
                    nama_penyewa: 'Jane Doe',
                    alamat_penyewa: 'Jl. Merdeka No. 45',
                    total_harga: '250000',
                    nama_barang_id: 'barang_2', // Placeholder
                    bukti_pembayaran_url: null, // 'path/to/bukti_bayar.jpg', or null
                    bukti_pembayaran_filename: null, // 'bukti_bayar.jpg',
                    bukti_ktm_url: 'assets/img/ktm_placeholder.png', // Placeholder path for existing KTM
                    bukti_ktm_filename: 'ktm_jane_doe.jpg',
                    tanggal_penyewaan: '2025-06-15',
                    waktu_sewa: '1 Minggu',
                    status_sewa: 'Berlangsung', // 'Selesai' or 'Berlangsung'
                    metode_pengiriman: 'diantar' // 'take_away' or 'diantar'
                };

                modal.find('#update-penyewaan-id').val(existingData.id);
                modal.find('#update-penyewaan-no-wa').val(existingData.no_wa);
                modal.find('#update-penyewaan-nama-penyewa').val(existingData.nama_penyewa);
                modal.find('#update-penyewaan-alamat-penyewa').val(existingData.alamat_penyewa);
                modal.find('#update-penyewaan-total-harga').val(existingData.total_harga);
                modal.find('#update-penyewaan-nama-barang').val(existingData
                    .nama_barang_id); // Make sure this option exists
                modal.find('#update-tanggal-penyewaan').val(existingData.tanggal_penyewaan);
                modal.find('#update-waktu-sewa').val(existingData.waktu_sewa);

                // Set radio buttons for status_sewa
                if (existingData.status_sewa === 'Selesai') {
                    modal.find('#update-status-selesai').prop('checked', true);
                } else {
                    modal.find('#update-status-berlangsung').prop('checked', true);
                }

                // Set radio buttons for metode_pengiriman
                if (existingData.metode_pengiriman === 'diantar') {
                    modal.find('#update-penyewaan-diantar').prop('checked', true);
                } else {
                    modal.find('#update-penyewaan-take-away').prop('checked', true);
                }

                // Load existing file previews
                buktiBayarUploader.resetUploader(existingData.bukti_pembayaran_url, existingData
                    .bukti_pembayaran_filename);
                buktiKtmUploader.resetUploader(existingData.bukti_ktm_url, existingData.bukti_ktm_filename);

                // Update form action URL if needed
                // modal.find('#updatePenyewaanForm').attr('action', '/penyewaan/update/' + existingData.id);
            });

            $('#updatePenyewaanModal').on('hidden.bs.modal', function() {
                // Reset file inputs when modal is closed to avoid issues if reopened
                // This will reset to the initial "no file chosen" or default icon state.
                // If you need to retain the *original* loaded data state, more complex logic is needed.
                buktiBayarUploader.resetUploader();
                buktiKtmUploader.resetUploader();
                // You might also want to reset other form fields or clear them
                // $(this).find('form')[0].reset(); // This would clear all fields
            });


        });
    </script>
@endsection
