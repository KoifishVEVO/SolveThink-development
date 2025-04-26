@extends('layouts.dashboard')

@section('title')
    RincianBarangBekas
@endsection

@section('styles')
@endsection

@section('content')
    <style>
        .heading-text {
            color: #272780 !important;
            font-weight: bold !important;
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

        .card-color {
            background-color: #272780 !important;

        }

        /* Stok barang control */
        .stock-control-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .stock-control {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 30px;
            /* <-- REDUCED from 40px */
            /* min-width: 120px; /* You might adjust or remove this if needed */
            border: 1px solid #ccc;
            border-radius: 8px;
            /* <-- Slightly reduced radius */
            overflow: hidden;
            width: fit-content;
        }

        ..edstock-control .btn-minus {
            background-color: #272780;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stock-control .btn-plus {
            background-color: #272780;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stock-control .btn-minus {
            border-top-left-radius: 999px;
            border-bottom-left-radius: 999px;
        }

        .stock-control .btn-plus {
            border-top-right-radius: 999px;
            border-bottom-right-radius: 999px;
        }

        .stock-control .btn {
            padding: 0.25rem 0.5rem;
            /* Smaller padding for + / - buttons */
            line-height: 1;
            /* Adjust line height */
            flex-shrink: 0;
            /* Prevent buttons from shrinking */
        }

        .stock-quantity {
            margin: 0 0.5rem;
            /* Space around the number */
            font-weight: bold;
            min-width: 25px;
            /* Adjusted min-width */
            text-align: center;
            line-height: 30px;
            /* Match new button height */
            font-size: 0.9rem;
            /* Optional: adjust font size */
        }

        .table tbody td.stock-column,
        .table tbody td.action-column {
            vertical-align: middle;
            /* Vertically center content */
        }

        .stock-column,
        .stock-column-container {
            text-align: center;
        }

        .table tbody td.action-column .d-flex {
            flex-wrap: nowrap !important;
            /* Prevent action buttons from wrapping if possible */
            justify-content: center;
        }

        /* for the updown thing, havent figured it out */
        .entries {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding: 6px 30px 6px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            background-color: white;
            width: 80px;
            font-size: 14px;
        }


        .modal-color {
            background-color: #272780 !important;
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



        /* Dropdown */

        /* --- Custom Searchable Dropdown Styles --- */
        .searchable-dropdown {
            position: relative;
            /* Needed for positioning the options */
        }

        /* Style for the element that displays the selected value and toggles the dropdown */
        .dropdown-select-display {
            padding: 0.375rem 2.25rem 0.375rem 0.75rem;
            /* Adjust padding for arrow */
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            background-color: #fff;
            cursor: pointer;
            display: block;
            /* Make it block level like a select */
            position: relative;
            /* For the arrow */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            height: calc(1.5em + 0.75rem + 2px);
            /* Match form-control height */
            line-height: 1.5;
            /* Match form-control line-height */
        }

        /* Add a dropdown arrow */
        .dropdown-select-display::after {
            content: '';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: solid black;
            border-width: 0 2px 2px 0;
            display: inline-block;
            padding: 3px;
            transform: translateY(-50%) rotate(45deg);
            -webkit-transform: translateY(-50%) rotate(45deg);
        }

        /* Container for the search box and options list */
        .dropdown-options-container {
            display: none;
            /* Hidden by default */
            position: absolute;
            background-color: white;
            border: 1px solid #ced4da;
            border-top: none;
            /* Avoid double border */
            border-radius: 0 0 0.25rem 0.25rem;
            width: 100%;
            z-index: 1051;
            /* Ensure it's above modal content but potentially below modal itself if needed */
            max-height: 200px;
            /* Limit height and allow scrolling */
            overflow-y: auto;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        /* Make options container visible when dropdown is open */
        .searchable-dropdown.open .dropdown-options-container {
            display: block;
        }

        /* Style for the search input area */
        .dropdown-search-wrapper {
            padding: 5px 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            /* Light background for search */
        }

        .dropdown-search-wrapper .search-icon {
            margin-right: 8px;
            color: #6c757d;
            /* Icon color */
        }

        .dropdown-search-input {
            width: 100%;
            border: none;
            outline: none;
            padding: 5px 0;
            /* Minimal padding */
            background-color: transparent;
            /* Inherit wrapper background */
            font-size: 0.9em;
        }

        /* Style for the list holding the options */
        .dropdown-options-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* Style for individual options */
        .dropdown-options-list li {
            padding: 8px 15px;
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dropdown-options-list li:hover {
            background-color: #e9ecef;
            /* Hover effect */
        }

        .dropdown-options-list li.selected {
            background-color: #007bff;
            /* Highlight selected */
            color: white;
        }

        .dropdown-options-list li.hidden {
            display: none;
            /* Hide filtered-out options */
        }

        /* Keep original select hidden but available for JS */
        .original-select-hidden {
            position: absolute;
            left: -9999px;
            /* Move off-screen */
            opacity: 0;
            pointer-events: none;
            /* Prevent interaction */
            height: 0;
            width: 0;
        }

        /* Additional styles for consistent modal appearance */
        .drop-zone {
            background-color: #272780;
            color: white;
            border-radius: 5px;
            padding: 40px 20px;
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
        }

        /* Button styling */
        .btn-modal-color {
            background-color: #272780;
            color: white;
        }

        /* Text styling for delete modal */
        .delete-text {
            color: #272780;
            font-weight: bold;
        }

        /* Bold heading for all modals */
        .modal-title {
            font-weight: bold;
        }

        .btn-success {
            background-color: #00B634 !important;
        }

        .table thead th {
            border: 1px solid black !important;
            border-color: #DEDDDD !important;
        }

        .table tbody td {
            border-left: 1px solid black !important;
            border-right: 1px solid black !important;
            border-top: none !important;
            border-bottom: none !important;
            border-color: #DEDDDD !important;
        }

        .batal-btn {
            color: #272780 !important;
            border-color: #272780 !important;
        }
        @media (max-width: 767.98px) {
            /* Target mobile screens */
            

            /* --- Make specific modals fullscreen --- */
            #addAssetModal .modal-dialog,
            #rincianAssetModal .modal-dialog,
            #updateAssetModal .modal-dialog {
                
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
            }

            #addAssetModal .modal-content,
            #rincianAssetModal .modal-content,
            #updateAssetModal .modal-content {
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
            }

            /* Allow modal body to scroll */
            #addAssetModal .modal-body,
            #rincianAssetModal .modal-body,
            #updateAssetModal .modal-body {
                overflow-y: auto;
                /* Enable vertical scroll */
                flex-grow: 1;
                /* Allow body to take available vertical space */
            }

            /* --- Keep delete modal default (override any general .modal styles if needed) --- */
            #deleteAssetModal .modal-dialog {
                max-width: 500px;
                /* Bootstrap default */
                height: auto;
                margin: 1.75rem auto;
                /* Default centering margin */
                position: relative;
                /* Reset positioning */
                top: auto;
                left: auto;
                bottom: auto;
                right: auto;
                /* Reset position */
            }

            #deleteAssetModal .modal-content {
                height: auto;
                border-radius: 0.3rem;
                /* Bootstrap default */
                border: 1px solid rgba(0, 0, 0, .2);
                /* Bootstrap default */
                display: block;
                /* Reset flex */
            }

            #deleteAssetModal .modal-body {
                overflow-y: visible;
                /* Reset scroll */
                flex-grow: 0;
                /* Reset flex grow */
            }

            /* --- Specific Styles for Rincian Modal Mobile (based on image) --- */
            #rincianAssetModal .modal-body {
                display: flex;
                /* Re-apply flex */
                flex-direction: column;
                /* Stack vertically */
                align-items: center;
                /* Center items horizontally */
                padding-top: 2rem;
                /* Add some top padding */
                padding-bottom: 2rem;
                /* Add some bottom padding */
            }

            #rincianAssetModal .modal-body>div:first-child {
                /* Image container */
                width: 75%;
                /* Adjust width */
                max-width: 300px;
                /* Limit max size */
                height: auto;
                aspect-ratio: 1 / 1;
                /* Keep it square-ish */
                margin-bottom: 2rem;
                /* Space below image */
            }

            #rincianAssetModal .modal-body>div.ml-4 {
                /* Details container */
                margin-left: auto !important;
                /* Remove margin */
                width: 100%;
                text-align: left;

            }

            #rincianAssetModal .modal-footer {
                justify-content: center !important;
                /* Center the footer button */
                border-top: none;
                /* Remove top border */
            }

            #rincianAssetModal .modal-footer .btn {
                width: 80%;
                /* Make button wider */
                max-width: 300px;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }

            #addAssetModal .modal-dialog,
            #updateAssetModal .modal-dialog {
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            /* Shared Modal Content Styling */
            #addAssetModal .modal-content,
            #updateAssetModal .modal-content {
                display: flex;
                flex-direction: column;
                flex: 1 1 auto;
            }

            /* Shared Form Styling */
            #addAssetModal form,
            #updateAssetModal form {
                display: flex;
                flex-direction: column;
                flex: 1 1 auto;
                height: 100%;
            }

            /* Shared Modal Body Styling */
            #addAssetModal .modal-body,
            #updateAssetModal .modal-body {
                flex: 1 1 auto;
                overflow-y: auto;
                padding-top: 2rem;
                padding-bottom: 2rem;
            }

            /* Shared Modal Footer Styling */
            #addAssetModal .modal-footer,
            #updateAssetModal .modal-footer {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                border-top: none;
                padding: 5px;
                margin-top: auto;
            }

            /* Optional: Add a little space at the bottom for update modal only */
            #updateAssetModal .modal-footer {
                margin-bottom: 20px;
            }

            /* Shared Button Styling */
            #addAssetModal .modal-footer .btn,
            #updateAssetModal .modal-footer .btn {
                flex: 1;
                max-width: none;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }


            /* Style Dropdown options for mobile */
            .searchable-dropdown .dropdown-options-container {
                /* Position it fixed if needed, or just ensure width */
                width: calc(100% - 2px);
                /* Account for border */
                left: 1px;
                max-height: 150px;
                /* Maybe shorter on mobile */
            }
        }


        /* Searchable Dropdown */
        /* Container for the custom dropdown */
        .custom-search-select-container {
            position: relative;
            font-family: sans-serif; /* Or your preferred font */
        }

        /* The visible part showing the selected value */
        .selected-value {
            padding: 0.375rem 2rem 0.375rem 0.75rem; 
            border: 1px solid #ced4da; 
            border-radius: 0.25rem;
            background-color: #fff;
            cursor: pointer;
            display: block;
            width: 100%;
            box-sizing: border-box;
            min-height: calc(1.5em + 0.75rem + 2px);
            line-height: 1.5;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            user-select: none;
            position: relative; 
        }

       
        .selected-value::after {
            content: '';
            position: absolute;
            right: 0.75rem; /* Position arrow on the right */
            top: 50%;
            transform: translateY(-50%);
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #555; /* Arrow color */
            pointer-events: none; /* Ensure arrow doesn't block clicks */
        }

        
        .selected-value:focus,
        .custom-search-select-container.open .selected-value { /* Style when dropdown is open */
            border-color: #007bff; /* Blue border color */
            outline: 0;
            /* Keep shadow or remove if you prefer the simpler blue border */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }


        /* The dropdown box containing search and list */
        .dropdown-list-container {
            display: none;
            position: absolute;
            top: calc(100% + 2px); /* !FIX! Position slightly below with a small gap */
            left: 0;
            right: 0;
            border: 1px solid #ced4da; /* !FIX! Full border around the dropdown */
            background-color: #fff;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1051;
            border-radius: 0.25rem; /* !FIX! Apply border radius to the whole dropdown */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            /* Removed margin-top: -1px and border-top: none */
        }

        /* Make dropdown visible when .show class is added */
        .dropdown-list-container.show {
            display: block;
        }

        /* Search input inside the dropdown */
        .search-box {
            padding: 0.375rem 0.75rem;
            width: calc(100% - 16px); /* !FIX! Account for margin */
            box-sizing: border-box;
            border: 1px solid #ced4da; /* !FIX! Full border like a standard input */
            outline: none;
            margin: 8px; /* !FIX! Add margin for spacing */
            border-radius: 0.25rem; /* !FIX! Add border-radius */
            /* Removed border: none and border-bottom */
        }

        /* List of options */
        .options-list {
            list-style: none;
            padding: 0;
            margin: 0;
            /* !FIX! Add padding top if search box has margin, or adjust search box margin */
            padding-top: 0; /* Adjust if needed */
            padding-bottom: 5px; /* Add some space at the bottom */
        }

        /* Individual option item */
        .options-list li {
            padding: 0.5rem 0.75rem; /* Keep padding as is, looks okay */
            cursor: pointer;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            line-height: 1.5; /* !FIX! Ensure consistent line height */
        }

        /* Hover/Highlight effect for options */
        .options-list li:hover,
        .options-list li.highlighted {
            background-color: #f8f9fa; /* !FIX! Slightly lighter grey for hover */
            color: #16181b; /* !FIX! Ensure text is readable on hover */
        }

        /* Style for hidden original select */
        .original-select-hidden {
            display: none !important;
        }
    </style>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 mt-4 heading-text font-weight-bold">ASSET BARANG BEKAS</h1>
        <p class="mb-4 heading-text font-weight-bold">Tabel asset barang baru adalah tabel yang berisikan informasi terkait
            barang baru</p>

        <!-- DataTables Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-5 card-color">
                <h6 class="m-0 font-weight-bold text-white">Data Tabel Asset Barang Baru</h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row mb-3">
                            <!-- Show entries -->
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="dataTable_length">
                                    <label>Show
                                        <select id="showEntries" name="dataTable_length"
                                            class="custom-select custom-select-sm form-control form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries
                                    </label>
                                </div>
                            </div>

                            <!-- Search box -->
                            <div class="col-sm-12 col-md-6">
                                <div id="dataTable_filter" class="dataTables_filter d-flex justify-content-md-end">
                                    <label class="mr-2">Search:
                                        <form id="searchForm" method="GET" action="{{ route('aset_barang_bekas.index') }}"
                                            class="d-inline">
                                            <input type="search" name="search" value="{{ request('search') }}"
                                                class="form-control form-control-sm d-inline" placeholder="Cari barang..."
                                                aria-controls="dataTable">
                                        </form>
                                    </label>
                                    <button class="btn btn-success btn-sm ml-2" data-toggle="modal"
                                        data-target="#addAssetModal">Tambah</button>
                                </div>
                            </div>
                        </div>

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Gambar Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Harga Barang</th>
                                            <th>Stok Barang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach ($barang as $item)
                                            <tr>
                                                <!-- ID -->
                                                <td>{{ $loop->iteration }}</td>

                                                <!-- Gambar -->
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('storage/uploads/' . $item->namaBarang->gambar_barang) }}"
                                                            alt="Gambar" class="img-fluid"
                                                            style="max-width: 100px; height: auto;">
                                                    </div>
                                                </td>

                                                <!-- Nama -->
                                                <td>{{ $item->namaBarang->nama_barang }}</td>

                                                <!-- Jenis -->
                                                <td>{{ $item->jenis_barang ?? '-' }}</td>

                                                <!-- Harga -->
                                                <td>Rp {{ number_format($item->harga_jual_barang, 0, ',', '.') }}</td>

                                                <!-- Stok -->
                                                <td class="text-center stock-column">
                                                    <div class="stock-control-container">
                                                        <div class="stock-control">
                                                            <!-- Minus Button -->
                                                            <button class="btn-kurangi" data-id="{{ $item->id }}"
                                                                data-nama="{{ $item->id_nama_barang }}"
                                                                data-gambar="{{ $item->id_gambar_barang }}"
                                                                data-harga="{{ $item->harga_jual_barang }}"
                                                                data-jenis="{{ $item->jenis_barang }}">
                                                                <i class="fa fa-minus"></i>
                                                            </button>

                                                            <!-- Stock Number -->
                                                            <span class="stock-quantity"
                                                                data-stock-id="{{ $item->id }}">
                                                                {{ $item->jumlah }}
                                                            </span>

                                                            <!-- Plus Button -->
                                                            <button class="btn-tambah" data-id="{{ $item->id }}"
                                                                data-nama="{{ $item->namaBarang->id }}"
                                                                data-harga="{{ $item->harga_jual_barang }}"
                                                                data-jenis="{{ $item->jenis_barang }}">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>

                                                <!-- Aksi -->
                                                <td class="action-column">
                                                    <div class="d-flex flex-nowrap justify-content-center">
                                                        <!-- Rincian -->
                                                        <button class="btn btn-sm rincian-btn m-1"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->namaBarang->nama_barang }}"
                                                            data-harga="{{ $item->harga_jual_barang }}"
                                                            data-jenis="{{ $item->jenis_barang }}"
                                                            data-gambar="{{ asset('storage/' . $item->namaBarang->gambar_barang) }}"
                                                            data-desc="{{ $item->namaBarang->deskripsi }}"
                                                            data-toggle="modal" data-target="#rincianAssetModal"
                                                            title="Rincian">
                                                            
                                                            Rincian
                                                        </button>

                                                        <!-- Update -->
                                                        <button class="btn btn-sm btn-warning m-1 btn-update"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->namaBarang->id }}"
                                                            data-harga="{{ $item->harga_jual_barang }}"
                                                            data-jenis="{{ $item->jenis_barang }}"
                                                            data-gambar="{{ asset('storage/' . $item->gambar_barang) }}"
                                                            data-url="{{ route('aset_barang_bekas.update', $item->id) }}"
                                                            data-toggle="modal" data-target="#updateAssetModal"
                                                            title="Update">
                                                            Update

                                                        </button>

                                                        <!-- Hapus -->
                                                        <button class="btn btn-sm btn-danger m-1 btn-delete"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->namaBarang->nama_barang }}"
                                                            data-url="{{ route('aset_barang_bekas.destroy', $item->id) }}"
                                                            data-toggle="modal" data-target="#deleteAssetModal"
                                                            title="Hapus">
                                                            Hapus

                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- pagination -->
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" role="status" aria-live="polite">
                                    Showing {{ $barang->firstItem() }} to {{ $barang->lastItem() }} of
                                    {{ $barang->total() }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination justify-content-end">
                                        {{-- Tombol Previous --}}
                                        <li
                                            class="paginate_button page-item {{ $barang->onFirstPage() ? 'disabled' : '' }}">
                                            <a href="{{ $barang->previousPageUrl() ?? '#' }}"
                                                class="page-link">Previous</a>
                                        </li>

                                        {{-- Nomor Halaman --}}
                                        @for ($i = 1; $i <= $barang->lastPage(); $i++)
                                            <li
                                                class="paginate_button page-item {{ $i == $barang->currentPage() ? 'active' : '' }}">
                                                <a href="{{ $barang->url($i) }}"
                                                    class="page-link">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        {{-- Tombol Next --}}
                                        <li
                                            class="paginate_button page-item {{ $barang->hasMorePages() ? '' : 'disabled' }}">
                                            <a href="{{ $barang->nextPageUrl() ?? '#' }}" class="page-link">Next</a>
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
    </div>





    <!-- Modal -->
    <!-- Add Asset Modal -->
    <div class="modal fade" id="addAssetModal" tabindex="-1" role="dialog" aria-labelledby="addAssetLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="addAssetLabel">Tambah Asset Barang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('aset_barang_bekas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <!-- Other Inputs -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="add-nama-barang">Nama Barang</label>
                            <select name="nama_barang" id="nama_barang_select_add" class="original-select-hidden" required>
                                <option value="">Pilih Nama Barang...</option>
                                @foreach ($data_nama_barang as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>

                            <div class="custom-search-select-container" id="custom_nama_barang_add_container">
                                <div class="selected-value" data-target-select="add-nama-barang" tabindex="0">Pilih Nama Barang...</div>
                                <div class="dropdown-list-container">
                                    <input type="text" class="search-box" placeholder="Cari...">
                                    <ul class="options-list">
                                        </ul>
                                </div>
                            </div>
                        </div>

                        <label class="font-weight-bold">Harga Jual Barang</label>
                        <input type="number" name="harga_jual_barang" class="form-control mb-3" required>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="add-nama-barang">Jenis Barang</label>
                        
                            <!-- Hidden Original Select -->
                            <select name="jenis_barang" id="jenis_barang_select_add" class="original-select-hidden" required>
                                <option value="" disabled selected>Pilih Jenis Barang...</option>
                                <option value="Sensor">Sensor</option>
                                <option value="Microcontroller">Microcontroller</option>
                                <option value="Actuator">Actuator</option>
                                <option value="Power">Power</option>
                                <option value="Equipment">Equipment</option>
                            </select>
                        
                            <!-- Custom Searchable Dropdown -->
                            <div class="custom-search-select-container" id="custom_jenis_barang_add_container">
                                <div class="selected-value" data-target-select="add-nama-barang" tabindex="0">Pilih Jenis Barang...</div>
                                <div class="dropdown-list-container">
                                    <input type="text" class="search-box" placeholder="Cari...">
                                    <ul class="options-list"></ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-muted font-weight-bold batal-btn"
                            data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn modal-color text-white font-weight-bold">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Rincian Asset Modal -->
    <div class="modal fade" id="rincianAssetModal" tabindex="-1" aria-labelledby="rincianAssetLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="rincianAssetLabel">Rincian Asset Barang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex p-4">
                    <!-- Image container -->
                    <div class="modal-color position-relative"
                        style="width: 250px; height: 250px;  border-radius: 5px; overflow: hidden;">
                        <div id="rincian-default-view"
                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; width: 100%; height: 100%;">
                            <i class="fa fa-image fa-3x" style="color: white;"></i>
                        </div>

                        <!-- image  -->
                        <div id="rincian-image-view"
                            style="display: none; height: 100%; width: 100%; position: relative;">
                            <img id="rincian-preview-img" src="" alt="Preview"
                                style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                    </div>

                    <div class="ml-4">
                        <p class="mb-4">
                            <strong style="color: #555; font-size: 16px;">id Barang</strong><br>
                            <span style="color: #777; font-size: 14px;" id="rincian-id">nomor id barang</span>
                        </p>
                        <p class="mb-4">
                            <strong style="color: #555; font-size: 16px;">Nama Barang</strong><br>
                            <span style="color: #777; font-size: 14px;" id="rincian-nama">nama barang</span>
                        </p>
                        <p class="mb-4">
                            <strong style="color: #555; font-size: 16px;">Jenis Barang</strong><br>
                            <span style="color: #777; font-size: 14px;" id="rincian-jenis">jumlah stok barang</span>
                        </p>
                        <p class="mb-3">
                            <strong style="color: #555; font-size: 16px;">Link Deskripsi</strong><br>

                            <a href="#" {{-- Href will be set by JavaScript --}} id="rincian-link-deskripsi" target="_blank"
                                {{-- Opens the link in a new tab --}} class="text-primary" style="display: none;" {{-- Hide initially if no link --}}
                                rel="noopener noreferrer">
                                Link
                                <i class="fas fa-external-link-alt fa-xs"></i>
                            </a>
                            {{-- Text to show if no link is available --}}
                            <span id="rincian-no-link" class="text-muted" style="display: none;">(Tidak ada link)</span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn modal-color text-white font-weight-bold"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Asset Modal -->
    <div class="modal fade" id="updateAssetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title">Update Asset Barang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="update-id">

                    <!-- Modal Body -->
                    <div class="modal-body">

                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="update-nama">Nama Barang</label>
                            <select name="nama_barang" id="update-nama" class="original-select-hidden" required>
                                <option value="">Pilih Nama Barang...</option>
                                @foreach ($data_nama_barang as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>

                            <div class="custom-search-select-container" id="custom-update-nama-container">
                                <div class="selected-value" data-target-select="update-nama" tabindex="0">Pilih Nama Barang...</div>
                                <div class="dropdown-list-container">
                                    <input type="text" class="search-box" placeholder="Cari...">
                                    <ul class="options-list"></ul>
                                </div>
                            </div>
                        </div>

                        <label class="font-weight-bold">Harga Jual Barang</label>
                        <input type="number" name="harga_jual_barang" id="update-harga" class="form-control mb-3"
                            required>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="jenis_barang">Jenis Barang</label>
                            <select name="jenis_barang" id="update-jenis" class="original-select-hidden" required>
                                <option value="">Pilih Nama Barang...</option>
                                <option value="Sensor">Sensor</option>
                                <option value="Microcontroller">Microcontroller</option>
                                <option value="Actuator">Actuator</option>
                                <option value="Power">Power</option>
                                <option value="Equipment">Equipment</option>
                                <!-- Tambahkan opsi lainnya di sini -->
                            </select>

                            <div class="custom-search-select-container" id="custom-update-jenis-container">
                                <div class="selected-value" data-target-select="update-jenis" tabindex="0">Pilih Jenis Barang...</div>
                                <div class="dropdown-list-container">
                                    <input type="text" class="search-box" placeholder="Cari...">
                                    <ul class="options-list"></ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn font-weight-bold border px-3 batal-btn mr-4"
                            data-dismiss="modal">Batal</button>

                        <button type="submit" class="btn modal-color text-white font-weight-bold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Asset Modal -->
    <div class="modal fade" id="deleteAssetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- header -->
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title">Hapus Asset Barang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <form action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="delete-id">

                    <!-- body -->
                    <div class="modal-body">
                        <p class="delete-text text-center">Konfirmasi Hapus Data Asset Barang</p>
                        <p class="text-center" id="delete-item-name"></p>
                    </div>

                    <!-- footer -->
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-link text-muted font-weight-bold batal-btn"
                            data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn modal-color text-white font-weight-bold">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Oke'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: true
            });
        </script>
    @endif


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    
            // --- Search Form Enter Key ---
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const searchForm = document.getElementById('searchForm');
                        if (searchForm) {
                            searchForm.submit();
                        } else {
                            console.warn("Search form with ID 'searchForm' not found.");
                        }
                    }
                });
            } else {
                console.warn("Search input element not found.");
            }
    
            // --- Custom Searchable Dropdown Logic ---
    
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
                let listItems = [];
    
                if (!selectedValueDiv || !dropdownContainer || !searchBox || !optionsList) {
                    console.warn(`Missing elements within custom dropdown container: #${containerId}`);
                    return;
                }
    
                function populateOptionsList() {
                    optionsList.innerHTML = '';
                    listItems = [];
                    Array.from(originalSelect.options).forEach(option => {
                        const li = document.createElement('li');
                        li.textContent = option.textContent;
                        li.dataset.value = option.value;
                        if (!option.value) { // Handle placeholder
                            li.classList.add('placeholder-option');
                        }
                        optionsList.appendChild(li);
                        // Only add actual options (with values) to the searchable listItems
                        if (option.value) {
                            listItems.push(li);
                        }
                    });
                }
                populateOptionsList();
    
                function syncDisplayWithSelect() {
                    if (!originalSelect || !selectedValueDiv) return;
    
                    const selectedOption = originalSelect.options[originalSelect.selectedIndex];
                    if (selectedOption) {
                        selectedValueDiv.textContent = selectedOption.textContent;
                        if (!selectedOption.value || selectedOption.disabled) { // Check for empty value or disabled placeholder
                            selectedValueDiv.classList.add('placeholder-selected');
                        } else {
                            selectedValueDiv.classList.remove('placeholder-selected');
                        }
                    } else {
                        // Fallback if somehow no option is selected (shouldn't usually happen with a valid select)
                        selectedValueDiv.textContent = 'Select...'; // Or get placeholder text
                        selectedValueDiv.classList.add('placeholder-selected');
                    }
                }
                syncDisplayWithSelect(); // Initial sync
    
                // --- Event Listeners for the Dropdown ---
    
                selectedValueDiv.addEventListener('click', (event) => {
                    event.stopPropagation(); // Prevent document click listener from closing it immediately
                    closeAllDropdowns(containerId); // Close others before opening this one
                    dropdownContainer.classList.toggle('show');
                    if (dropdownContainer.classList.contains('show')) {
                        searchBox.value = ''; // Clear search on open
                        listItems.forEach(li => li.style.display = ''); // Show all items
                        searchBox.focus(); // Focus search box
                    }
                });
    
                optionsList.addEventListener('click', (event) => {
                    if (event.target.tagName === 'LI' && event.target.dataset.value) {
                        // An actual option was clicked
                        selectedValueDiv.textContent = event.target.textContent;
                        originalSelect.value = event.target.dataset.value;
                        dropdownContainer.classList.remove('show');
                        selectedValueDiv.classList.remove('placeholder-selected'); // Ensure placeholder class removed
                        // Crucially, trigger the change event on the original select
                        originalSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    } else if (event.target.tagName === 'LI' && !event.target.dataset.value) {
                        // Placeholder option was clicked (optional: reset or just close)
                        // To reset:
                        // originalSelect.selectedIndex = 0; // Assuming placeholder is first
                        // syncDisplayWithSelect();
                        // originalSelect.dispatchEvent(new Event('change', { bubbles: true }));
                        dropdownContainer.classList.remove('show'); // Just close
                    }
                });
    
                searchBox.addEventListener('input', () => {
                    const searchTerm = searchBox.value.toLowerCase().trim();
                    listItems.forEach(li => {
                        const itemText = li.textContent.toLowerCase();
                        // Show if search term is empty OR if item text includes the search term
                        li.style.display = (searchTerm === '' || itemText.includes(searchTerm)) ? '' : 'none';
                    });
                });
    
                // Listen for changes on the original select (e.g., if set programmatically)
                originalSelect.addEventListener('change', syncDisplayWithSelect);
    
                // --- Modal Reset Logic (Specific to Add Modal in this example) ---
                // Adapt if needed for other modals or use a different reset trigger
                const modal = container.closest('.modal');
                if (modal && modal.id === 'addAssetModal') { // Target only the Add modal for this reset
                    if (typeof $ !== 'undefined') { // Check if jQuery is available
                        $(modal).on('hidden.bs.modal', function() {
                            // Reset the original select to its first option (usually placeholder)
                            if (originalSelect.options.length > 0) {
                                originalSelect.selectedIndex = 0;
                            }
                            // Sync the display DIV with the reset select
                            syncDisplayWithSelect();
                            // Clear the search box
                            searchBox.value = '';
                            // Ensure all list items are visible again
                            listItems.forEach(li => li.style.display = '');
                            // Ensure the dropdown is closed
                            dropdownContainer.classList.remove('show');
                        });
                    } else {
                        console.warn('jQuery not found. Modal reset for custom dropdowns might not work automatically on close.');
                        // Add vanilla JS alternative if needed, perhaps listening to the modal's close button/backdrop click
                    }
                }
            }
    
            /** Closes all open custom dropdowns, optionally excluding one */
            function closeAllDropdowns(excludeContainerId = null) {
                document.querySelectorAll('.custom-search-select-container .dropdown-list-container.show').forEach(dropdown => {
                    const currentContainer = dropdown.closest('.custom-search-select-container');
                    // If no exclusion ID is provided, OR if an exclusion ID is provided and it doesn't match the current dropdown's container
                    if (!excludeContainerId || (currentContainer && currentContainer.id !== excludeContainerId)) {
                        dropdown.classList.remove('show');
                    }
                });
            }
    
            // Close dropdowns if clicking outside
            document.addEventListener('click', (event) => {
                // Check if the click was outside ANY custom dropdown container
                if (!event.target.closest('.custom-search-select-container')) {
                    closeAllDropdowns();
                }
            });
    
            // --- Initialize All Searchable Dropdowns on the Page ---
            // !! IMPORTANT: Ensure your ADD modal also has the corresponding HTML structure and IDs !!
            setupSearchableDropdown('custom_nama_barang_add_container', 'nama_barang_select_add'); // Assumed ID for Add modal
            setupSearchableDropdown('custom_jenis_barang_add_container', 'jenis_barang_select_add'); // Assumed ID for Add modal
            setupSearchableDropdown('custom-update-nama-container', 'update-nama'); // ID from your Update modal HTML
            setupSearchableDropdown('custom-update-jenis-container', 'update-jenis'); // ID from your Update modal HTML
    
    
            // --- Modal Button Event Listeners ---
    
            // Tombol Rincian - Isi otomatis modal dengan data
            document.querySelectorAll('.rincian-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const nama = this.dataset.nama;
                    // const harga = this.dataset.harga; // Harga not shown in Rincian modal in provided HTML/JS
                    const jenis = this.dataset.jenis;
                    const gambar = this.dataset.gambar;
                    const desc = this.dataset.desc; // Description link
    
                    const rincianModal = document.getElementById('rincianAssetModal');
                    if (!rincianModal) return;
    
                    // Get elements inside the specific modal instance
                    const idElement = rincianModal.querySelector('#rincian-id');
                    const namaElement = rincianModal.querySelector('#rincian-nama');
                    const jenisElement = rincianModal.querySelector('#rincian-jenis');
                    const linkElement = rincianModal.querySelector('#rincian-link-deskripsi');
                    const noLinkText = rincianModal.querySelector('#rincian-no-link');
                    const rincianImageView = rincianModal.querySelector('#rincian-image-view');
                    const rincianDefaultView = rincianModal.querySelector('#rincian-default-view');
                    const rincianPreviewImg = rincianModal.querySelector('#rincian-preview-img');
    
                    // Use jQuery to hook into Bootstrap's modal shown event ensures elements are ready
                    // Make sure jQuery is loaded before this script
                    if (typeof $ !== 'undefined') {
                        $(rincianModal).off('shown.bs.modal').on('shown.bs.modal', function() {
                            // Populate data *after* the modal is shown
                            if (idElement) idElement.innerText = id || 'N/A';
                            if (namaElement) namaElement.innerText = nama || 'N/A';
                            if (jenisElement) jenisElement.innerText = jenis || 'N/A';
    
                            // Handle description link
                            if (linkElement && noLinkText) {
                                if (desc) {
                                    linkElement.href = desc;
                                    linkElement.style.display = 'inline';
                                    noLinkText.style.display = 'none';
                                } else {
                                    linkElement.style.display = 'none';
                                    linkElement.removeAttribute('href'); // Clear old href
                                    noLinkText.style.display = 'inline';
                                }
                            }
    
                            // Handle image preview
                            if (rincianPreviewImg && rincianImageView && rincianDefaultView) {
                                if (gambar) {
                                    rincianPreviewImg.src = gambar;
                                    rincianImageView.style.display = 'block';
                                    rincianDefaultView.style.display = 'none';
                                } else {
                                    rincianPreviewImg.src = ''; // Clear previous image
                                    rincianImageView.style.display = 'none';
                                    rincianDefaultView.style.display = 'flex';
                                }
                            }
                        });
                         // Trigger the modal show (if not already handled by data-toggle attributes)
                        // $(rincianModal).modal('show'); // Usually Bootstrap handles this via data-attributes
                    } else {
                         // Fallback if jQuery is not available - populate directly, might have timing issues
                         console.warn("jQuery not defined, using direct population for Rincian modal.");
                         if (idElement) idElement.innerText = id || 'N/A';
                         if (namaElement) namaElement.innerText = nama || 'N/A';
                         // ... (populate other fields similarly) ...
                    }
                });
            });
    
            // Tombol Update - Isi otomatis modal (Refactored for Custom Dropdowns)
            document.querySelectorAll('.btn-update').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const namaBarangId = this.dataset.nama; // Expecting the ID/value for the select
                    const harga = this.dataset.harga;
                    const jenisBarangValue = this.dataset.jenis; // Expecting the value for the select
                    const gambar = this.dataset.gambar; // Assuming gambar URL is passed if available
                    const url = this.dataset.url; // Form action URL
    
                    console.log(`Update Button Data: id=${id}, namaId=${namaBarangId}, harga=${harga}, jenisValue=${jenisBarangValue}, url=${url}, gambar=${gambar}`);
    
                    const updateModalElement = document.getElementById('updateAssetModal');
                    if (!updateModalElement) {
                        console.error("Update modal element (#updateAssetModal) not found!");
                        return;
                    }
    
                    // Find elements within the specific modal instance
                    const updateForm = updateModalElement.querySelector('form');
                    const idInput = updateModalElement.querySelector('#update-id');
                    const namaSelect = updateModalElement.querySelector('#update-nama'); // The original hidden select
                    const hargaInput = updateModalElement.querySelector('#update-harga');
                    const jenisSelect = updateModalElement.querySelector('#update-jenis'); // The original hidden select
                    const previewImg = updateModalElement.querySelector('#update-preview-img'); // Assumed ID for update preview
                    const previewWrapper = updateModalElement.querySelector('#update-image-preview'); // Assumed ID for update preview wrapper
                    const uploadView = updateModalElement.querySelector('#update-button-view'); // Assumed ID for update upload view
    
                    // --- Populate Standard Fields ---
                    if (updateForm) updateForm.action = url || '#'; // Set form action
                    if (idInput) idInput.value = id || '';
                    if (hargaInput) hargaInput.value = harga || '';
    
                    // --- Populate Custom Dropdowns ---
                    if (namaSelect) {
                        namaSelect.value = namaBarangId || ""; // Set the value of the original select
                        console.log(`Set update-nama value to: ${namaSelect.value}`);
                        // !! Crucial: Dispatch change event AFTER setting value to trigger syncDisplayWithSelect !!
                        namaSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    } else {
                        console.error('Original select element with ID "update-nama" not found in modal.');
                    }
    
                    if (jenisSelect) {
                        jenisSelect.value = jenisBarangValue || ""; // Set the value of the original select
                        console.log(`Set update-jenis value to: ${jenisSelect.value}`);
                        // !! Crucial: Dispatch change event AFTER setting value to trigger syncDisplayWithSelect !!
                        jenisSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    } else {
                        console.error('Original select element with ID "update-jenis" not found in modal.');
                    }
    
                    // --- Handle Image Preview (Assuming similar structure as Rincian/previous script) ---
                    // !! Add these elements to your Update modal HTML if they don't exist !!
                    // Example:
                    // <div id="update-image-preview" style="display: none; margin-bottom: 1rem;">
                    //     <img id="update-preview-img" src="" alt="Preview" style="max-width: 100%; height: auto; max-height: 150px;">
                    // </div>
                    // <div id="update-button-view" style="display: flex;"> //      <input type="file" name="gambar_barang" class="form-control">
                    // </div>
                    if (previewImg && previewWrapper && uploadView) {
                        if (gambar) {
                            previewImg.src = gambar;
                            previewWrapper.style.display = 'block';
                            uploadView.style.display = 'none'; // Hide upload if there's a current image
                        } else {
                            previewImg.src = '';
                            previewWrapper.style.display = 'none';
                            uploadView.style.display = 'flex'; // Show upload if no current image
                        }
                    } else {
                        console.warn("Image preview elements (#update-preview-img, #update-image-preview, #update-button-view) not found in update modal.");
                    }
                });
            });
    
            // Tombol Delete - Isi otomatis modal dan set form action
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const nama = this.dataset.nama; // Use the display name for confirmation
                    const url = this.dataset.url;
    
                    const deleteModal = document.getElementById('deleteAssetModal');
                    if (!deleteModal) return;
    
                    const itemNameElement = deleteModal.querySelector('#delete-item-name');
                    const deleteForm = deleteModal.querySelector('form');
                    const deleteIdInput = deleteModal.querySelector('#delete-id'); // Optional hidden ID input
    
                    if (itemNameElement) {
                        itemNameElement.innerText = `Apakah kamu yakin ingin menghapus "${nama || 'item ini'}"?`;
                    }
                    if (deleteForm) {
                        deleteForm.action = url || '#';
                    }
                    if (deleteIdInput) { // If you have a hidden input for ID in the delete form
                        deleteIdInput.value = id || '';
                    }
                });
            });
    
            // --- Fetch API Event Listeners (using Event Delegation) ---
    
            document.addEventListener("click", function(event) {
                // Tombol Tambah Sama (Add Same Item)
                if (event.target.closest(".btn-tambah")) {
                    let button = event.target.closest(".btn-tambah");
                    let data = {
                        // Ensure these data attributes exist on your .btn-tambah buttons
                        nama_barang: button.getAttribute("data-nama"), // Should be the ID/Value from the select
                        harga_jual_barang: parseInt(button.getAttribute("data-harga")),
                        jenis_barang: button.getAttribute("data-jenis"), // Should be the Value
                        _token: "{{ csrf_token() }}" // Assumes Blade template engine
                    };
    
                    // Verify data before sending
                    if (!data.nama_barang || isNaN(data.harga_jual_barang) || !data.jenis_barang) {
                        console.error("Missing data attributes on 'Tambah Sama' button:", button);
                        alert("Gagal menambahkan: Data tidak lengkap pada tombol.");
                        return;
                    }
    
                    fetch("{{ route('aset_barang_bekas.storeSame') }}", { // Route for the *new* page
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": data._token,
                                "Accept": "application/json" // Important for Laravel validation errors
                            },
                            body: JSON.stringify(data)
                        })
                        .then(async (response) => {
                            const result = await response.json();
                            if (!response.ok) {
                                let errorMessages = "Terjadi kesalahan.";
                                if (response.status === 422 && result.errors) { // Laravel Validation Error
                                    errorMessages = Object.values(result.errors).flat().join("\n");
                                } else if (result.message) { // Other JSON error messages
                                    errorMessages = result.message;
                                }
                                alert("Gagal menambahkan barang:\n" + errorMessages);
                                throw new Error(result.message || "Request failed");
                            }
                            return result; // Return result for potential further processing if needed
                        })
                        .then(() => {
                            location.reload(); // Reload on success
                        })
                        .catch(error => {
                            console.error("Error adding same item:", error);
                            // Alert was already shown in the first .then block for known errors
                        });
                }
    
                // Tombol Kurangi (Delete One Item)
                if (event.target.closest(".btn-kurangi")) {
                let button = event.target.closest(".btn-kurangi");
                let namaBarang = button.getAttribute("data-nama"); // Should be the ID/Value
                let gambarBarang = button.getAttribute("data-gambar"); // Get gambar if needed by backend
                let hargaJualBarang = button.getAttribute("data-harga");
                let jenisBarang = button.getAttribute("data-jenis");

                // Add console logs for debugging data from the button
                console.log("Kurangi Button Clicked:");
                console.log("  data-nama:", namaBarang);
                console.log("  data-gambar:", gambarBarang); // May or may not be present/needed
                console.log("  data-harga:", hargaJualBarang);
                console.log("  data-jenis:", jenisBarang);


                if (!namaBarang) {
                    console.error("Missing data-nama attribute on 'Kurangi' button:", button);
                    alert("Gagal mengurangi: Data nama barang tidak ditemukan pada tombol.");
                    return;
                }

                // Construct the URL for the 'aset_barang_bekas' route
                let deleteUrl = "{{ route('aset_barang_bekas.deleteOne', ':nama_barang') }}";
                deleteUrl = deleteUrl.replace(':nama_barang', encodeURIComponent(namaBarang));
                console.log("Delete URL:", deleteUrl); // Log the final URL

                fetch(deleteUrl, {
                        method: "POST", // Using POST with _method override
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}" 
                        },
                        body: JSON.stringify({
                            _method: "DELETE",
                            gambar_barang: namaBarang, // Sending namaBarang as gambar_barang value
                            harga_jual_barang: hargaJualBarang,
                            jenis_barang: jenisBarang
                        })
                    })
                    .then(response => {
                        console.log("Raw Response Status:", response.status); // Log status
                        if (!response.ok) {
                             return response.text().then(text => {
                                 console.error("Server Error Response Text:", text);
                                 throw new Error("HTTP error " + response.status + ": " + text);
                             });
                        }

                        const contentType = response.headers.get("content-type");
                        if (contentType && contentType.includes("application/json")) {
                            return response.json();
                        } else {
                             console.log("Response OK but not JSON. Content-Type:", contentType);
                             return { success: true, message: "Operation successful (non-JSON response)." };
                        }
                    })
                    .then(result => {
                        console.log("Parsed Result:", result); // Log the parsed result
                        if (!result.success) {
                            alert(result.message || "Terjadi kesalahan.");
                        } else {
                            location.reload(); 
                        }
                    })
                    .catch(error => {
                        console.error("Error deleting item:", error);
  
                        alert("Terjadi kesalahan dalam penghapusan barang.\n" + (error.message.startsWith("HTTP error") ? error.message : ""));
                    });
            }
            });
    
        }); // End DOMContentLoaded
    </script>
@endsection
