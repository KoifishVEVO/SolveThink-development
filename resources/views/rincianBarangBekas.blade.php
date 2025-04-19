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
    font-size: 1rem;   /* <-- REDUCED from 1.2rem */
    font-weight: bold;
    width: 35px;       /* <-- OPTIONAL: Reduced width */
    height: 30px;      /* <-- REDUCED from 40px */
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    box-sizing: border-box;
    transition: background-color 0.3s ease;
    line-height: 1; /* Helps center icons vertically */
    cursor: pointer; /* Add pointer cursor */
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
    min-height: 30px; /* <-- REDUCED from 40px */
    /* min-width: 120px; /* You might adjust or remove this if needed */
    border: 1px solid #ccc;
    border-radius: 8px; /* <-- Slightly reduced radius */
    overflow: hidden;
    width: fit-content;
}

        ..edstock-control .btn-minus{
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
    margin: 0 0.5rem; /* Space around the number */
    font-weight: bold;
    min-width: 25px;  /* Adjusted min-width */
    text-align: center;
    line-height: 30px; /* Match new button height */
    font-size: 0.9rem; /* Optional: adjust font size */
}

        .table tbody td.stock-column,
        .table tbody td.action-column {
            vertical-align: middle;
            /* Vertically center content */
        }
        .stock-column, .stock-column-container{
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
            border: 2px dashed #ccc;
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
                                            <th>Harga Jual Barang</th>
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
                                                        <button class="btn-kurangi"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->id_nama_barang }}"
                                                            data-gambar="{{ $item->id_gambar_barang }}"
                                                            data-harga="{{ $item->harga_jual_barang }}"
                                                            data-jenis="{{ $item->jenis_barang }}">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                        
                                                        <!-- Stock Number -->
                                                        <span class="stock-quantity" data-stock-id="{{ $item->id }}">
                                                            {{ $item->jumlah }}
                                                        </span>
                        
                                                        <!-- Plus Button -->
                                                        <button class="btn-tambah"
                                                            data-id="{{ $item->id }}"
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
                                                            data-toggle="modal" data-target="#rincianAssetModal"
                                                            title="Rincian">
                                                            <i class="fa fa-eye"></i> 
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
                                                            data-toggle="modal"
                                                            data-target="#deleteAssetModal"
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
                            <select name="nama_barang" id="add-nama-barang" class="form-control" required>
                                @foreach ($data_nama_barang as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="font-weight-bold">Harga Jual Barang</label>
                        <input type="number" name="harga_jual_barang" class="form-control mb-3" required>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="add-nama-barang">Jenis Barang</label>
                            <select name="jenis_barang" id="add-nama-barang" class="form-control" required>
                                <option value="" disabled selected>Pilih Jenis Barang...</option>
                                <option value="Sensor">Sensor</option>
                                <option value="Actuator">Actuator</option>
                                <option value="Power">Power</option>
                                <option value="Equipment">Equipment</option>
                            </select>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link text-muted font-weight-bold"
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
                        style="width: 250px; height: 250px; border: 2px dashed #ccc; border-radius: 5px; overflow: hidden;">
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
                            
                            <a href="#" {{-- Href will be set by JavaScript --}}
                               id="rincian-link-deskripsi"
                               target="_blank"  {{-- Opens the link in a new tab --}}
                               class="text-primary" 
                               style="display: none;" {{-- Hide initially if no link --}}
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
                            <select name="nama_barang" id="update-nama" class="form-control" required>
                                @foreach ($data_nama_barang as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="font-weight-bold">Harga Jual Barang</label>
                        <input type="number" name="harga_jual_barang" id="update-harga" class="form-control mb-3"
                            required>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="jenis_barang">Jenis Barang</label>
                            <select name="jenis_barang" id="update-jenis" class="form-control" required>
                                <option value="">Pilih Nama Barang...</option>
                                <option value="Sensor">Sensor</option>
                                <option value="Actuator">Actuator</option>
                                <option value="Power">Power</option>
                                <option value="Equipment">Equipment</option>
                                <!-- Tambahkan opsi lainnya di sini -->
                            </select>
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
                        <button type="button" class="btn btn-link text-muted font-weight-bold"
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
        document.querySelector('input[name="search"]').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('searchForm').submit();
            }
        });

        // Tombol Rincian - Isi otomatis modal dengan data
        document.querySelectorAll('.rincian-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const harga = this.dataset.harga;
                const jenis = this.dataset.jenis;
                const gambar = this.dataset.gambar;

                // console.log(stok)

                $('#rincianAssetModal').on('shown.bs.modal', function() {
                    // Isi data ke modal setelah modal benar-benar ditampilkan
                    document.getElementById('rincian-id').innerText = id;
                    document.getElementById('rincian-nama').innerText = nama;
                    document.getElementById('rincian-jenis').innerText = jenis;

                    // Preview gambar
                    const rincianImageView = document.getElementById('rincian-image-view');
                    const rincianDefaultView = document.getElementById('rincian-default-view');
                    const rincianPreviewImg = document.getElementById('rincian-preview-img');

                    if (gambar) {
                        rincianPreviewImg.src = gambar;
                        rincianImageView.style.display = 'block';
                        rincianDefaultView.style.display = 'none';
                    } else {
                        rincianImageView.style.display = 'none';
                        rincianDefaultView.style.display = 'flex';
                    }
                });
            })
        });



        // Tombol Delete - Isi otomatis modal dan set form action
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const url = this.dataset.url;

                // Tampilkan nama di modal
                document.getElementById('delete-item-name').innerText =
                    `Apakah kamu yakin ingin menghapus "${nama}"?`;

                // Set form action
                const deleteForm = document.querySelector('#deleteAssetModal form');
                deleteForm.action = url;

                // Set ID hidden (opsional, kalau diperlukan)
                document.getElementById('delete-id').value = id;
            });
        });


        // Tombol Update - Isi otomatis modal
        document.querySelectorAll('.btn-update').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const harga = this.dataset.harga;
                const jenis = this.dataset.jenis;
                const gambar = this.dataset.gambar;
                const url = this.dataset.url;

                console.log(jenis)
                document.getElementById('update-id').value = id;
                const selectNama = document.getElementById('update-nama');
                selectNama.value = nama;

                document.getElementById('update-harga').value = harga;
                document.getElementById('update-jenis').value = jenis;

                document.querySelector('#updateAssetModal form').action = url;

                const previewImg = document.getElementById('update-preview-img');
                const previewWrapper = document.getElementById('update-image-preview');
                const uploadView = document.getElementById('update-button-view');

                if (gambar) {
                    previewImg.src = gambar;
                    previewWrapper.style.display = 'block';
                    uploadView.style.display = 'none';
                } else {
                    previewWrapper.style.display = 'none';
                    uploadView.style.display = 'flex';
                }
            });
        });

        document.addEventListener("click", function(event) {
            if (event.target.closest(".btn-tambah")) {
                let button = event.target.closest(".btn-tambah");

                let data = {
                    nama_barang: button.getAttribute("data-nama"),
                    harga_jual_barang: parseInt(button.getAttribute("data-harga")),
                    jenis_barang: button.getAttribute("data-jenis"),
                    _token: "{{ csrf_token() }}"
                };

                fetch("{{ route('aset_barang_bekas.storeSame') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": data._token,
                            "Accept": "application/json" // <--- ini penting biar Laravel balikin JSON saat error
                        },
                        body: JSON.stringify(data)
                    })
                    .then(async (response) => {
                        const result = await response.json();

                        if (!response.ok) {
                            // Tangani error validasi Laravel
                            if (result.errors) {
                                let errorMessages = Object.values(result.errors).flat().join("\n");
                                alert("Gagal menambahkan barang:\n" + errorMessages);
                            } else {
                                alert("Terjadi kesalahan tak dikenal.");
                            }
                            throw new Error("Validation failed");
                        }

                        // Kalau sukses, reload
                        location.reload();
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
            }
        });

        document.addEventListener("click", function(event) {
            if (event.target.closest(".btn-kurangi")) {
                let button = event.target.closest(".btn-kurangi");
                let namaBarang = button.getAttribute("data-nama");
                let gambarBarang = button.getAttribute("data-gambar");
                let hargaJualBarang = button.getAttribute("data-harga");
                let jenisBarang = button.getAttribute("data-jenis");

                console.log(namaBarang)
                console.log(gambarBarang)
                console.log(hargaJualBarang)
                console.log(jenisBarang)

                fetch("{{ route('aset_barang_bekas.deleteOne', ':nama_barang') }}".replace(':nama_barang',
                        encodeURIComponent(namaBarang)), {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            _method: "DELETE",
                            gambar_barang: namaBarang,
                            harga_jual_barang: hargaJualBarang,
                            jenis_barang: jenisBarang
                        })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error("HTTP error " + response.status);
                        return response
                            .json(); // error "<!DOCTYPE" bisa dihindari kalau ini error di atas jalan duluan
                    })
                    .then(result => {
                        if (!result.success) {
                            alert(result.message || "Terjadi kesalahan.");
                        } else {
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Terjadi kesalahan dalam penghapusan barang.");
                    });
            }
        });
    </script>
@endsection
