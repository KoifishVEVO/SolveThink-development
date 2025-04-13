@extends('layouts.dashboard')

@section('title')
    RincianBarangBaru
@endsection

@section('styles')
@endsection

@section('content')
    <style>
        /* --- Default (Desktop) Styles for Rincian Modal --- */
        #rincianAssetModal .modal-dialog {
            /* Uses modal-lg class for width (800px default) */
            /* Centering is handled by Bootstrap */
        }

        #rincianAssetModal .modal-content {
            /* Standard modal appearance */
        }

        #rincianAssetModal .modal-body {
            display: flex;
            /* Horizontal layout by default */
            flex-direction: row;
            align-items: flex-start;
            /* Align image and text block top */
            padding: 1.5rem;
            /* Adjust padding as needed */
        }

        #rincianAssetModal .modal-body>div:first-child {
            /* Image container */
            background-color: #272780;
            /* Ensure background color */
            border: 2px dashed #ccc;
            /* Keep border */
            border-radius: 5px;
            /* Keep radius */
            position: relative;
            /* For positioning content inside */
            display: flex;
            /* For centering placeholder */
            justify-content: center;
            align-items: center;
            overflow: hidden;
            /* Ensure image fits */
            /* No margin-bottom needed for desktop */
        }

        #rincianAssetModal .modal-body>div.ml-4 {
            /* Details container */
            flex-grow: 1;
            /* Take remaining space */
            margin-left: 1.5rem !important;
            /* Bootstrap ml-4 equivalent */
            text-align: left;
            /* Align text left */
        }

        #rincianAssetModal .modal-footer {

            justify-content: flex-end;
            /* Align button to the right */
            border-top: none;
        }

        #rincianAssetModal .modal-footer .btn {
            width: auto;
            /* Default button width */
            max-width: none;
            /* Reset max-width */
            padding: 0.375rem 0.75rem;
            /* Default Bootstrap padding */
        }

        /* --- End Default Rincian Modal Styles --- */
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
    </style>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </style>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 mt-4 heading-text font-weight-bold">ASSET BARANG BARU</h1>
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
                                        <form id="searchForm" method="GET" action="{{ route('aset_barang.index') }}"
                                            class="d-inline">
                                            <input type="search" name="search" value="{{ request('search') }}"
                                                class="form-control form-control-sm d-inline" aria-controls="dataTable">
                                        </form>
                                    </label>
                                    <button class="btn btn-success btn-sm ml-2" data-toggle="modal"
                                        data-target="#addAssetModal">Tambah</button>
                                </div>
                            </div>
                            {{-- <div class="col-sm-12 col-md-6">
                    <form method="GET" action="{{ route('aset_barang.index') }}" class="d-flex justify-content-md-end">
                        <label class="mr-2">Search:</label>
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Cari barang...">
                        <button type="submit" class="btn btn-success btn-sm ml-2">Cari</button>
                        <a href="{{ route('aset_barang.index') }}" class="btn btn-secondary btn-sm ml-2">Reset</a>
                    </form>
                </div> --}}
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
                                            <th>Harga Jual Barang</th>
                                            <th>Stok Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        <!-- Sample row -->
                                        @foreach ($barang as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('storage/' . $item->namaBarang->gambar_barang) }}"
                                                            alt="Gambar" class="img-fluid"
                                                            style="max-width: 100px; height: auto;">
                                                    </div>
                                                </td>
                                                <td>{{ $item->namaBarang->nama_barang }}</td>
                                                <td>Rp
                                                    {{ number_format($item->harga_jual_barang, 0, ',', '.') }}
                                                </td>
                                                <td>{{ $item->jumlah }}</td>
                                                <td>{{ $item->jenis_barang }}</td>
                                                <td class="px-3">

                                                    <div class="d-flex flex-wrap justify-content-center">
                                                        <button class="btn btn-sm btn-success m-1 btn-tambah"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->nama_barang }}"
                                                            data-harga="{{ $item->harga_jual_barang }}"
                                                            data-jenis="{{ $item->jenis_barang }}">
                                                            <i class="fa fa-plus"></i>
                                                        </button>

                                                        <button class="btn btn-sm btn-danger m-1 btn-kurangi"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->nama_barang }}">
                                                            <i class="fa fa-minus"></i>
                                                        </button>

                                                        <button class="btn btn-sm rincian-btn m-1"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->nama_barang }}"
                                                            data-harga="{{ $item->harga_jual_barang }}"
                                                            data-jenis="{{ $item->jenis_barang }}"
                                                            data-gambar="{{ asset('storage/' . $item->gambar_barang) }}"
                                                            data-toggle="modal" data-target="#rincianAssetModal">
                                                            <i class="fa fa-eye"></i> Rincian
                                                        </button>
                                                        <button class="btn btn-sm btn-warning m-1 btn-update"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->nama_barang }}"
                                                            data-harga="{{ $item->harga_jual_barang }}"
                                                            data-jenis="{{ $item->jenis_barang }}"
                                                            data-gambar="{{ asset('storage/' . $item->gambar_barang) }}"
                                                            data-url="{{ route('aset_barang.update', $item->id) }}"
                                                            data-toggle="modal" data-target="#updateAssetModal">
                                                            Update
                                                        </button>
                                                        <button class="btn btn-sm btn-danger m-1 btn-delete"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->nama_barang }}"
                                                            data-url="{{ route('aset_barang.destroy', $item->id) }}"
                                                            data-toggle="modal"
                                                            data-target="#deleteAssetModal">Hapus</button>
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

                <form action="{{ route('aset_barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Other Inputs -->
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="nama_barang">Nama Barang</label>
                            <select name="nama_barang" id="nama_barang" class="form-control" required>
                                @foreach ($data_nama_barang as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>


                        <label class="font-weight-bold">Harga Jual Barang</label>
                        <input type="number" name="harga_jual_barang" class="form-control mb-3" required>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="jenis_barang">Jenis Barang</label>
                            <select name="jenis_barang" id="jenis_barang" class="form-control" required>
                                <option value="">Pilih Jenis Barang...</option>
                                <option value="Sensor">Sensor</option>
                                <option value="Actuator">Actuator</option>
                                <option value="Power">Power</option>
                                <option value="Equipment">Equipment</option>
                                <!-- Tambahkan opsi lainnya di sini -->
                            </select>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn text-muted font-weight-bold batal-btn mr-4"
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
                            <span style="color: #777; font-size: 14px;" id="rincian-jenis">jenis barang</span>
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

                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="update-id">

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- image upload  -->
                        <div id="update-image-container" class="modal-color position-relative mb-4"
                            style="border: 2px dashed #ccc; border-radius: 5px; padding: 20px;
                                    background-color: #f8f9fa; height: 200px; overflow: hidden;
                                    cursor: pointer; position: relative; text-align: center;">


                            <div id="upload-button-view"
                                style="display: flex; flex-direction: column; align-items: center;
                                        justify-content: center; position: absolute; top: 50%; left: 50%;
                                        transform: translate(-50%, -50%); text-align: center; width: 100%;">
                                <i class="fa fa-image" style="font-size: 24px; margin-bottom: 10px; color: #FFFFFF"></i>
                                <div style="font-size: 16px; font-weight: bold; color: #FFFFFF">Click to Select Image</div>
                                <input type="file" id="updateFileInput" name="gambar_barang" style="display: none;"
                                    accept="image/*">
                            </div>

                            <!-- Image Preview -->
                            <div id="update-image-preview"
                                style="display: none; height: 200px; width: 100%; position: relative; padding: 0; margin-bottom: 4px;">
                                <img id="update-preview-img" src="" alt="Preview"
                                    style="height: 100%; width: 100%; object-fit: contain; position: absolute; top: -20px; left: 0;">
                                <!-- <h6 id="update-change-btn" class="position-absolute"
                                                                                                                                                                                                                                                                                                        style="top: 10px; right: 10px; cursor: pointer; z-index: 10; background-color: rgba(255,255,255,0.7); padding: 3px 6px; border-radius: 3px;">
                                                                                                                                                                                                                                                                                                        Click to Change Image
                                                                                                                                                                                                                                                                                                    </h6> -->
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="nama_barang">Nama Barang</label>
                            <select name="nama_barang" id="update-nama" class="form-control" required>
                                <option value="">Pilih Nama Barang...</option>
                                <option value="Sensor">Sensor</option>
                                <option value="Actuator">Actuator</option>
                                <option value="Power">Power</option>
                                <option value="Equipment">Equipment</option>
                                <!-- Tambahkan opsi lainnya di sini -->
                            </select>
                        </div>


                        <label class="font-weight-bold">Harga Jual Barang</label>
                        <input type="number" name="harga_jual_barang" id="update-harga" class="form-control mb-3"
                            required>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="jenis_barang">Nama Barang</label>
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
                        <button type="button" class="btn btn-link text-muted font-weight-bold batal-btn mr-4"
                            data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn modal-color text-white font-weight-bold">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
        // (search in modal)
        document.addEventListener('DOMContentLoaded', function() {

            function setupSearchableDropdown(containerSelector) {
                const container = document.querySelector(containerSelector);
                if (!container) return;

                const triggerButton = container.querySelector('.dropdown-toggle');
                const hiddenInput = container.querySelector('input[type="hidden"]');
                const dropdownMenu = container.querySelector('.dropdown-menu');
                const searchInput = container.querySelector('.search-input');
                const itemsList = container.querySelector('.dropdown-items-list');
                const selectedTextSpan = triggerButton.querySelector('.selected-text');

                // --- Filter items based on search input ---
                searchInput.addEventListener('input', function() {
                    const searchTerm = searchInput.value.toLowerCase();
                    const items = itemsList.querySelectorAll('.searchable-item');

                    items.forEach(item => {
                        const itemText = item.textContent.toLowerCase();
                        // Show/hide based on match. Skip the placeholder item.
                        if (item.dataset.value ===
                            "") { // Keep placeholder always visible or handle differently
                            // item.style.display = 'block'; // Or hide it: item.style.display = 'none';
                            return; // Skip filtering the placeholder
                        }

                        if (itemText.includes(searchTerm)) {
                            item.classList.remove('d-none'); // Use Bootstrap class for consistency
                        } else {
                            item.classList.add('d-none');
                        }
                    });
                });

                // --- Handle item selection ---
                itemsList.addEventListener('click', function(e) {
                    if (e.target.classList.contains('searchable-item')) {
                        e.preventDefault();
                        const selectedValue = e.target.dataset.value;
                        const selectedText = e.target.textContent;

                        // Update hidden input and visible text
                        hiddenInput.value = selectedValue;
                        selectedTextSpan.textContent = selectedText;

                        // Manually close dropdown (using Bootstrap's jQuery dependency here)
                        $(triggerButton).dropdown('toggle');

                        // Trigger change event for any other scripts listening
                        var event = new Event('change', {
                            bubbles: true
                        });
                        hiddenInput.dispatchEvent(event);
                    }
                });

                // --- Reset search when dropdown is shown ---
                // Need jQuery here because Bootstrap's dropdown events rely on it
                $(triggerButton).on('shown.bs.dropdown', function() {
                    searchInput.value = ''; // Clear search box
                    // Show all items except placeholder if needed
                    const items = itemsList.querySelectorAll('.searchable-item');
                    items.forEach(item => item.classList.remove('d-none'));
                    searchInput.focus(); // Focus search input
                });

                // Reset to placeholder text if hidden input is empty (useful for Update modal init)
                if (!hiddenInput.value && hiddenInput.required) { // Check if required and empty
                    const placeholderItem = itemsList.querySelector('.searchable-item[data-value=""]');
                    selectedTextSpan.textContent = placeholderItem ? placeholderItem.textContent : 'Pilih...';
                }
            }

            // Initialize for Add Modal
            setupSearchableDropdown('#addAssetModal .searchable-dropdown-container');

            // Initialize for Update Modal
            setupSearchableDropdown('#updateAssetModal .searchable-dropdown-container');


            // --- Populate Update Modal (Example - NEEDS to be in your 'show.bs.modal' event) ---
            $('#updateAssetModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var assetNamaValue = button.data('nama'); // Get the value (e.g., "Sensor")

                // Find the corresponding item text
                var selectedItemText = 'Pilih Nama Barang...'; // Default
                var itemLink = $(this).find('#update-nama-list .searchable-item[data-value="' +
                    assetNamaValue + '"]');
                if (itemLink.length) {
                    selectedItemText = itemLink.text();
                }

                // Set the hidden input value
                $(this).find('#update-nama-value').val(assetNamaValue);
                // Set the visible button text
                $(this).find('#update-nama-trigger .selected-text').text(selectedItemText);

                // Other update modal population logic (ID, price, stock, image)...
            });

            // --- Reset Add Modal state on close ---
            $('#addAssetModal').on('hidden.bs.modal', function() {
                const container = document.querySelector('#addAssetModal .searchable-dropdown-container');
                const hiddenInput = container.querySelector('input[type="hidden"]');
                const selectedTextSpan = container.querySelector('.selected-text');
                const placeholderItem = container.querySelector('.searchable-item[data-value=""]');

                hiddenInput.value = ""; // Clear hidden value
                selectedTextSpan.textContent = placeholderItem ? placeholderItem.textContent :
                    'Pilih...'; // Reset text

                // Also reset other form fields if not done by form.reset()
                $(this).find('form').trigger('reset'); // Reset other standard fields
            });

        });

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


        // Untuk modal "Tambah"
        document.getElementById("image-upload-container").addEventListener("click", function() {
            document.getElementById("fileInput").click();
        });

        // Preview gambar
        document.getElementById("fileInput").addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById("preview-img").src = event.target.result;
                    document.getElementById("image-preview").style.display = "block";
                    document.getElementById("upload-button-view").style.display = "none";
                };
                reader.readAsDataURL(file);
            }
        });

        // Untuk modal "Update"
        document.getElementById("update-image-container").addEventListener("click", function() {
            document.getElementById("updateFileInput").click();
        });

        document.getElementById("updateFileInput").addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById("update-preview-img").src = event.target.result;
                    document.getElementById("update-image-preview").style.display = "block";
                    document.getElementById("update-button-view").style.display = "none";
                };
                reader.readAsDataURL(file);
            }
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
                // Ambil data dari tombol
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const harga = this.dataset.harga;
                const jenis = this.dataset.jenis;
                const gambar = this.dataset.gambar;
                const url = this.dataset.url;

                // Isi form di modal
                document.getElementById('update-id').value = id;
                document.getElementById('update-nama').value = nama;
                document.getElementById('update-harga').value = harga;
                document.getElementById('update-jenis').value = jenis;

                // Set form action ke URL update
                document.querySelector('#updateAssetModal form').action = url;

                // Preview gambar
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
                    nama_barang: parseInt(button.getAttribute("data-nama")),
                    harga_jual_barang: parseInt(button.getAttribute("data-harga")),
                    jenis_barang: button.getAttribute("data-jenis"),
                    _token: "{{ csrf_token() }}"
                };

                fetch("{{ route('aset_barang.storeSame') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": data._token
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(() => location.reload())
                    .catch(error => console.error("Error:", error));
            }
        });

        document.addEventListener("click", function(event) {
            if (event.target.closest(".btn-kurangi")) {
                let button = event.target.closest(".btn-kurangi");
                let namaBarang = button.getAttribute("data-nama");

                fetch("{{ route('aset_barang.deleteOne', ':nama_barang') }}".replace(':nama_barang',
                        encodeURIComponent(namaBarang)), {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(response => response.json())
                    .then(() => location.reload())
                    .catch(error => console.error("Error:", error));
            }
        });
    </script>
@endsection
