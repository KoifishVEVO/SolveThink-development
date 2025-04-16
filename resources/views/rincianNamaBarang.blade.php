@extends('layouts.dashboard')

@section('title')
    RincianNamaBarang
@endsection

@section('styles')
@endsection

@section('content')
    <style>
        /* --- Base Styles (from second block) --- */
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
            /* margin-right: 0 !important; // Cleaned up syntax error */
        }

        .rincian-btn:hover {
            background-color: #A9B5DF !important;
            color: white !important;
            border-color: #A9B5DF !important;
        }

        .card-color {
            background-color: #272780 !important;
        }

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
            color: white !important;
            /* Ensure text is white */
        }

        .modal-color .close {
            /* Style close button on dark header */
            color: white !important;
            opacity: 0.75;
            text-shadow: none;
            /* Remove default shadow if any */
        }

        .modal-color .close:hover {
            opacity: 1;
        }

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

        .btn-modal-color {
            /* Specific button class */
            background-color: #272780;
            color: white;
            font-weight: bold;
            /* Make consistent */
        }

        .btn-modal-color:hover {
            background-color: #1a1a5c;
            /* Darker shade on hover */
            color: white;
        }

        .delete-text {
            color: #272780;
            font-weight: bold;
        }

        .modal-title {
            font-weight: bold;
        }

        .btn-success {
            background-color: #00B634 !important;
        }

        .table thead th {
            border: 1px solid #DEDDDD !important;
            /* Use consistent border color */
        }

        .table tbody td {
            border-left: 1px solid #DEDDDD !important;
            border-right: 1px solid #DEDDDD !important;
            border-top: none !important;
            border-bottom: 1px solid #DEDDDD !important;
            /* Add bottom border for separation */
            vertical-align: middle;
            /* Align content vertically */
        }

        .table tbody tr:last-child td {
            border-bottom: 1px solid #DEDDDD !important;
            /* Ensure last row has border */
        }

        /* Pagination */
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

        .dataTables_paginate .pagination .page-link {
            border: none !important;
            color: #272780;
            background-color: transparent;
            padding: 0.5rem 0.85rem;
            transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out;
        }

        .dataTables_paginate .pagination .page-item:not(.active):not(.disabled) .page-link:hover {
            background-color: #e9ecef;
            color: #272780;
        }

        .dataTables_paginate .pagination .page-link:focus {
            box-shadow: none;
        }

        .dataTables_paginate .pagination .page-item.active .page-link {
            background-color: #272780 !important;
            color: #fff !important;
        }

        .dataTables_paginate .pagination .page-item.disabled .page-link {
            color: #adb5bd !important;
            background-color: transparent !important;
        }

        .batal-btn {
            /* Style for Cancel buttons */
            color: #272780 !important;
            border: 1px solid #272780 !important;
            background-color: #fff !important;
            font-weight: bold;
            /* Make consistent */
        }

        .batal-btn:hover {
            background-color: #f8f9fa !important;
            /* Slight hover */
        }

        /* --- End Base Styles --- */

        #addNamaBarangModal .modal-dialog {
            max-width: 550px;
            /* Adjust width as needed, image looks slightly wider than default */
        }

        #addNamaBarangModal .modal-body {
            padding: 1.5rem 2rem;
            /* Add some horizontal padding */
        }

        #addNamaBarangModal .form-label,
        #addNamaBarangModal label.font-weight-bold {
            color: #495057;
            /* Standard Bootstrap label color */
            font-weight: bold !important;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            /* Slightly smaller label */
        }

        #addNamaBarangModal #add-nama-barang-upload-area {
            /* Size for web view - make it smaller */
            width: 400px;
            /* Adjust as needed */
            height: 100px;
            /* Adjust as needed - make it square or rectangular */
            background-color: #272780 !important;
            border: none !important;
            border-radius: 5px !important;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
            /* Center the box horizontally and add margin below */
            cursor: pointer;
            position: relative;
            /* Needed for positioning content inside */
            overflow: hidden;
            /* Contain the preview image */
        }

        #addNamaBarangModal #add-nama-barang-upload-area i.fa-image {
            font-size: 2.5rem;
            /* Adjust icon size if needed */
            color: white;
            margin: 0;
        }

        #addNamaBarangModal #add-nama-barang-upload-area img#preview-img {
            /* Styles for the preview image inside the upload area */
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            /* Scale image nicely */
        }

        /* Filename text (optional styling) */
        #addNamaBarangModal #add-nama-barang-filename {
            font-size: 0.8rem;
            text-align: center;
            color: #6c757d;
            word-break: break-all;
            /* Prevent long filenames from breaking layout */
        }

        /* Ensure preview div is hidden by default */
        /* Not needed anymore as preview is inside upload area */
        /* #addNamaBarangModal #add-nama-barang-preview { */
        /* display: none; */
        /* } */

        #addNamaBarangModal .modal-body .form-control {
            margin-bottom: 1rem;
            /* Space below input */
        }

        #addNamaBarangModal .modal-footer {
            justify-content: flex-end;
            /* Align buttons to the right for web view */
            padding: 1rem 2rem;
            /* Match body horizontal padding */
            gap: 0.5rem;
            /* Add a small gap between buttons */
        }

        #addNamaBarangModal .modal-footer .btn {
            width: auto;
            /* Buttons take their natural width */
            padding: 0.5rem 1rem;
            /* Standard button padding */
            font-size: 0.9rem;
            font-weight: bold;
            /* Keep consistent */
        }


        /* --- Mobile Styles --- */
        @media (max-width: 767.98px) {

            /* --- GENERAL FULLSCREEN SETUP for Add/Rincian/Update Modals --- */
            /* Ensure all relevant IDs are included */

            #addNamaBarangModal .modal-dialog,
            #rincianNamaBarangModal .modal-dialog,
            #updateNamaBarangModal .modal-dialog {
                max-width: 100%;
                width: 100%;
                height: 100%;
                margin: 0;
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                transform: none !important;
                display: flex;
                flex-direction: column;
            }

            #addNamaBarangModal .modal-content,
            #rincianNamaBarangModal .modal-content,
            #updateNamaBarangModal .modal-content {
                height: 100%;
                border-radius: 0;
                border: none;
                display: flex;
                flex-direction: column;
                flex: 1 1 auto;
                background-color: #fff;
            }

            /* Make sure form inside fullscreen modals expands */

            #addNamaBarangModal form,
            #updateNamaBarangModal form {
                display: flex;
                flex-direction: column;
                height: 100%;
                flex: 1 1 auto;
            }

            #addNamaBarangModal .modal-body,
            #rincianNamaBarangModal .modal-body,
            #updateNamaBarangModal .modal-body {
                overflow-y: auto;
                flex-grow: 1;
                padding: 1.5rem;
            }

            #addNamaBarangModal .modal-footer,
            #rincianNamaBarangModal .modal-footer,
            #updateNamaBarangModal .modal-footer {
                margin-top: auto;
                border-top: none;
                background-color: #fff;
                padding: 1rem;
                flex-shrink: 0;
            }

            #addNamaBarangModal .modal-body {
                padding: 1.5rem;
                /* Consistent padding */
            }

            /* Style labels like the image */
            #addNamaBarangModal .modal-body label.form-label,
            /* Target "Upload Foto Barang" label */
            #addNamaBarangModal .modal-body label.font-weight-bold

            /* Target "Nama Barang" label */
                {
                display: block;
                margin-bottom: 0.5rem;
                color: #6c757d;
                /* Greyish color from image */
                font-size: 0.9rem;
                font-weight: bold !important;
                /* Ensure boldness */
            }

            /* Style the image upload area like the image */
            #addNamaBarangModal #add-nama-barang-upload-area {
                width: 200px;
                height: 300px;
                background-color: #272780 !important;
                /* Match header/button color */
                border: none !important;
                /* Image doesn't show a border */
                border-radius: 5px !important;
                /* Match rounding */
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
                /* Space below */
                cursor: pointer;
                position: relative;
                /* Needed if you add preview inside later */
                overflow: hidden;
                /* Needed if you add preview inside later */
            }

            #addNamaBarangModal #add-nama-barang-upload-area i.fa-image {
                font-size: 2.5rem;

                color: white;
                margin: 0;
            }

            /* Keep the separate preview area hidden initially */
            #addNamaBarangModal #add-nama-barang-preview {

                /* Ensure it stays hidden */
            }

            #addNamaBarangModal .modal-body .form-control {
                margin-bottom: 1rem;
                /* Spacing below input */
            }

            /* Add consistent spacing for form groups */
            #addNamaBarangModal .modal-body .form-group {
                margin-bottom: 1.5rem;
                /* Space between groups */
            }

            /* Style footer buttons like the image */
            #addNamaBarangModal .modal-footer {
                display: flex;
                justify-content: space-between;
                /* Space buttons apart */
                align-items: center;
                padding: 1rem;
                /* Footer padding */
                border-top: none;
                /* No line above footer in fullscreen */
                background-color: #fff;
                /* White footer background */
                flex-shrink: 0;
            }

            #addNamaBarangModal .modal-footer .btn {
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

            /* Ensure correct styling for the specific buttons */
            #addNamaBarangModal .modal-footer .batal-btn {
                /* Base .batal-btn styles already apply */
            }

            #addNamaBarangModal .modal-footer .modal-color {
                /* Base .modal-color styles already apply */
                color: white !important;
                /* Ensure text is white */
            }

            /* --- Specific Styles for Rincian (Show) Modal Mobile --- */
            #rincianNamaBarangModal .modal-body {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding-top: 2rem;
                padding-bottom: 2rem;
            }

            #rincianNamaBarangModal .modal-body>div:first-child {
                /* Image container */
                width: 80%;
                max-width: 280px;
                height: auto;
                aspect-ratio: 1 / 1;
                background-color: #272780;
                /* Match modal-color */
                border: 2px dashed #ccc;
                border-radius: 5px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 2rem;
                flex-shrink: 0;
                overflow: hidden;
                /* Ensure image inside is contained */
            }

            #rincianNamaBarangModal #rincian-default-view,
            /* Placeholder view */
            #rincianNamaBarangModal #rincian-image-view {
                /* Image view */
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #rincianNamaBarangModal #rincian-image-view img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
            }

            #rincianNamaBarangModal #rincian-default-view i {
                color: white;
                /* Ensure icon is white */
                font-size: 3rem;
                /* Adjust icon size */
            }

            #rincianNamaBarangModal .modal-body>div:nth-child(2) {
                /* Details container */
                margin-left: 0 !important;
                padding-left: 0 !important;
                width: 80%;
                max-width: 280px;
                text-align: left;
            }

            #rincianNamaBarangModal .modal-body>div:nth-child(2) p {
                margin-bottom: 1rem;
            }

            #rincianNamaBarangModal .modal-body>div:nth-child(2) strong {
                font-size: 0.9rem;
                color: #6c757d;
                display: block;
                margin-bottom: 0.25rem;
            }

            #rincianNamaBarangModal .modal-body>div:nth-child(2) span {
                font-size: 1rem;
                color: #333;
            }

            #rincianNamaBarangModal .modal-footer {
                justify-content: center !important;
            }

            #rincianNamaBarangModal .modal-footer .btn {
                /* Single button takes more width */
                width: 90%;
                max-width: 350px;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                font-size: 1rem;
                font-weight: bold;
                /* Make consistent */
            }

            /* --- End Specific Rincian Mobile Styles --- */


            /* --- Specific Styles for Update Modal Mobile --- */
            #tam #addNamaBarangModal form,
            #updateNamaBarangModal form {
                /* Ensure form takes full height */
                display: flex;
                flex-direction: column;
                height: 100%;
                flex: 1 1 auto;
            }

            #addNamaBarangModal .modal-body,
            #updateNamaBarangModal .modal-body {

                /* Default padding applied above */
                /* Add specific styles for image row if needed */
                #updateNamaBarangModal .modal-body .row.align-items-center {
                    margin-bottom: 1.5rem;
                }

                #updateNamaBarangModal #update-image-placeholder {
                    width: 80px;
                    height: 80px;
                }

                #updateNamaBarangModal #update-image-placeholder i {
                    font-size: 2rem;
                }

                #updateNamaBarangModal .col p#update-current-filename {
                    font-size: 0.9rem;
                    word-break: break-all;
                }

                #updateNamaBarangModal .col button.btn-sm {
                    font-size: 0.8rem;
                    padding: 0.2rem 0.5rem;
                }
            }

            #addNamaBarangModal .modal-footer,
            #updateNamaBarangModal .modal-footer {
                display: flex;
                justify-content: space-between;
                /* Space out buttons */
                align-items: center;
            }

            #addNamaBarangModal .modal-footer .btn,
            #updateNamaBarangModal .modal-footer .btn {
                /* Two buttons share width */
                width: calc(50% - 0.5rem);
                /* Adjust gap as needed */
                margin: 0;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                font-size: 1rem;
                font-weight: bold;
                /* Make consistent */
            }

            /* --- End Specific Update Mobile Styles --- */


            /* --- Keep Delete Modal Default (matched to deleteAssetModal) --- */
            #deleteNamaBarangModal .modal-dialog {
                max-width: 500px;
                /* Match Bootstrap default like deleteAssetModal */
                height: auto;
                margin: 1.75rem auto;
                /* Default centering */
                position: relative;
                top: auto;
                left: auto;
                bottom: auto;
                right: auto;
            }

            #deleteNamaBarangModal .modal-content {
                height: auto;
                border-radius: 0.3rem;
                /* Bootstrap default */
                border: 1px solid rgba(0, 0, 0, .2);
                display: block;
                background-color: #fff;
            }

            #deleteNamaBarangModal .modal-body {
                overflow-y: visible;
                flex-grow: 0;
                padding: 1.5rem;
                text-align: center;
            }

            #deleteNamaBarangModal .modal-footer {
                justify-content: center;
                padding: 1rem;
                border-top: 1px solid #dee2e6;
                background-color: #fff;
                display: flex;
                gap: 1rem;
                flex-shrink: 1;
            }

            #deleteNamaBarangModal .modal-footer .btn {
                flex: 0 1 auto;
                padding: 0.5rem 1rem;
                width: auto;
                max-width: 45%;
                font-weight: bold;
            }


            #addNamaBarangModal .modal-dialog {
                height: 100%;
                /* Ensure full height */
                margin: 0;
                max-width: 100%;
            }

            #addNamaBarangModal .modal-content {
                height: 100%;
                /* Make content fill the modal */
                display: flex;
                flex-direction: column;
                /* Stack header, body, footer vertically */
                border-radius: 0;
                border: none;
            }

            #addNamaBarangModal form {
                flex: 1 1 auto;
                display: flex;
                flex-direction: column;
            }

            #addNamaBarangModal .modal-body {
                flex-grow: 1;
                overflow-y: auto;
                padding: 1.5rem;
            }

            #addNamaBarangModal .modal-footer {
                margin-top: auto;
                padding: 1rem;
                border-top: none;
                background-color: #fff;
            }

            /* --- End Delete Modal Styles --- */
            /* --- Mobile Fullscreen for Tambah Asset Modal --- */


        }

        /* --- End Mobile Styles --- */
    </style>

    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <div class="container-fluid">

        <h1 class="h3 mb-2 mt-4 heading-text">RINCIAN NAMA BARANG</h1>
        <p class="mb-4 heading-text">Tabel rincian nama barang adalah tabel yang berisikan barang-barang yang ada</p>

        <div class="card shadow mb-4">
            <div class="card-header py-5 card-color"> {{-- Adjusted padding --}}
                <h6 class="m-0 font-weight-bold text-white">Data Tabel Nama Barang</h6> {{-- Updated Card Title --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        {{-- Top Controls Row --}}
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="dataTable_length">
                                    <label>Show
                                        <select id="showEntries" name="dataTable_length" aria-controls="dataTable"
                                            class="custom-select custom-select-sm form-control form-control-sm"
                                            style="width: auto; display: inline-block;">
                                            {{-- Placeholder: Link value to backend query limit --}}
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="dataTable_filter"
                                    class="dataTables_filter d-flex justify-content-md-end align-items-center">
                                    <label class="mr-2 mb-0">Search:
                                        {{-- Placeholder: Link form to backend search --}}
                                        <form id="searchForm" method="GET" action="{{ route('nama_barang.index') }}"
                                            class="d-inline">
                                            {{-- Placeholder Action --}}
                                            <input type="search" name="search" value="{{ request()->search }}"
                                                class="form-control
                                                form-control-sm d-inline"
                                                aria-controls="dataTable" placeholder="">
                                        </form>
                                    </label>
                                    {{-- Link button to Add Modal --}}
                                    <button class="btn btn-success btn-sm ml-2" data-toggle="modal"
                                        data-target="#addNamaBarangModal">Tambah</button>
                                </div>
                            </div>
                        </div>

                        {{-- Table Row --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Gambar Barang</th>
                                            <th>Nama Barang</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">

                                        @foreach ($barang as $b)
                                            <tr>
                                                <td>{{ $b->id }}</td>
                                                <td>
                                                    {{-- Image Placeholder --}}
                                                    <div class="image-placeholder">
                                                        <img src="{{ asset('storage/uploads/' . $b->gambar_barang) }}"
                                                            alt="Gambar" class="img-fluid"
                                                            style="max-width: 100px; height: auto;">
                                                    </div>
                                                </td>
                                                <td>{{ $b->nama_barang }}</td>
                                                <td class="px-3 text-center">
                                                    <div class="d-inline-block">
                                                        {{-- Rincian Button --}}
                                                        <button class="btn btn-sm rincian-btn m-1"
                                                            data-id="{{ $b->id }}" {{-- Placeholder id --}}
                                                            data-nama="{{ $b->nama_barang }}" {{-- Placeholder name --}}
                                                            {{-- Add data-gambar if you have it --}} data-toggle="modal"
                                                            data-gambar="{{ asset('storage/uploads/' . $b->gambar_barang) }}"
                                                            data-target="#rincianNamaBarangModal" {{-- Target Rincian Modal --}}>
                                                            <i class="fa fa-eye"></i> Rincian
                                                        </button>
                                                        {{-- Update Button --}}
                                                        <button class="btn btn-sm btn-warning m-1 btn-update"
                                                            data-id="{{ $b->id }}" {{-- Placeholder id --}}
                                                            data-nama="{{ $b->nama_barang }}" {{-- Placeholder name --}}
                                                            data-url="{{ route('nama_barang.update', $b->id) }}"
                                                            data-gambar="{{ asset('storage/uploads/' . $b->gambar_barang) }}"
                                                            {{-- Placeholder URL for update --}} data-toggle="modal"
                                                            data-target="#updateNamaBarangModal" {{-- Target Update Modal --}}>
                                                            Update
                                                        </button>
                                                        {{-- Hapus Button --}}
                                                        <button class="btn btn-sm btn-danger m-1 btn-delete"
                                                            data-id="{{ $b->id }}" {{-- Placeholder id --}}
                                                            data-nama="{{ $b->nama_barang }}" {{-- Placeholder name --}}
                                                            data-url="{{ route('nama_barang.destroy', $b->id) }}"
                                                            {{-- Placeholder URL for delete --}} data-toggle="modal"
                                                            data-target="#deleteNamaBarangModal" {{-- Target Delete Modal --}}>
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

                        {{-- Pagination Row --}}
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

                                        {{-- Nomor halaman --}}
                                        @foreach ($barang->getUrlRange(1, $barang->lastPage()) as $page => $url)
                                            <li
                                                class="paginate_button page-item {{ $barang->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        {{-- Tombol Next --}}
                                        <li
                                            class="paginate_button page-item {{ !$barang->hasMorePages() ? 'disabled' : '' }}">
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



    <!-- Modals -->

    <!-- add -->
    <div class="modal fade" id="addNamaBarangModal" tabindex="-1" aria-labelledby="addNamaBarangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="addNamaBarangModalLabel">Tambah Nama Barang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('nama_barang.store') }}" method="POST" id="addNamaBarangForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        {{-- Upload Foto Barang Section --}}
                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">Upload Foto Barang</label>
                            <div id="add-nama-barang-upload-area"
                                class="modal-color rounded-3 d-flex align-items-center justify-content-center mb-2"
                                onclick="document.getElementById('add-nama-barang-gambar-input').click();">

                                <img src="#" alt="Preview" class="img-thumbnail d-none img-fluid"
                                    id="preview-img">

                                <i class="fa fa-image fa-3x text-white" id="add-default-icon"></i>
                            </div>
                            <input type="file" class="d-none" id="add-nama-barang-gambar-input" name="gambar_barang"
                                accept="image/*">
                            {{-- Show filename (Optional) --}}
                            <p class="mt-1 mb-0 text-muted small text-center" id="add-nama-barang-filename"></p>

                            {{-- skrg preview di uploadarea --}}
                            {{-- <div id="add-nama-barang-preview" class="mt-2 text-center" style="display: none;"> --}}
                            {{--     <img src="#" alt="Preview" class="img-thumbnail" id="preview-img"/> --}}
                            {{--     <p class="mt-1 mb-0 text-muted small" id="add-nama-barang-filename"></p> --}}
                            {{-- </div> --}}
                        </div>

                        {{-- Nama Barang Input --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="add-nama-barang">Nama Barang</label>
                            <input type="text" name="nama_barang" id="add-nama-barang" class="form-control"
                                placeholder="Masukkan Nama Barang..." required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline batal-btn rounded-3 me-2"
                            data-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn modal-color text-white font-weight-bold rounded-3">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- update -->
    <div class="modal fade" id="updateNamaBarangModal" tabindex="-1" aria-labelledby="updateNamaBarangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="updateNamaBarangModalLabel">Update Nama Barang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <form action="#" method="POST" id="updateNamaBarangForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="update-nama-barang-id">

                    <div class="modal-body">

                        {{-- Foto Barang Section --}}
                        <div class="form-group mb-4">
                            <label class="form-label fw-bold">Foto Barang</label>
                            <div class="row align-items-center">

                                <div class="col-auto"> {{-- Use col-auto to fit content --}}
                                    <div id="update-image-placeholder"
                                        class="modal-color rounded-3 d-flex align-items-center justify-content-center position-relative"
                                        style="width: 100px; height: 100px; cursor: pointer; border-radius: 5px;"
                                        onclick="document.getElementById('update-nama-barang-gambar-input').click();">
                                        {{-- Make placeholder clickable --}}

                                        {{-- Default Icon (Initially Visible) --}}
                                        <i class="fa fa-box fa-3x text-white" id="update-default-icon"></i>

                                        {{-- Image Preview (Initially Hidden) --}}
                                        <img id="update-preview-img" src="#" alt="Preview"
                                            class="img-fluid rounded-3"
                                            style="display: none; width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </div>

                                {{-- Filename and Change Button Column --}}
                                <div class="col">
                                    {{-- Placeholder for current filename (Set via JS) --}}
                                    <p id="update-current-filename" class="mb-2 fw-semibold">Nama file saat ini</p>
                                    <button type="button" class="btn btn-sm modal-color text-white rounded-3"
                                        onclick="document.getElementById('update-nama-barang-gambar-input').click();">
                                        Ganti
                                    </button>
                                    {{-- Hidden File Input - Triggered by clicking placeholder or Ganti button --}}
                                    <input type="file" class="d-none" id="update-nama-barang-gambar-input"
                                        name="gambar_barang" accept="image/*">
                                </div>
                            </div>
                            {{-- Optional: Display selected new file name --}}
                            <div id="update-new-filename-display" class="mt-2 text-muted small" style="display: none;">
                            </div>
                        </div>

                        {{-- Nama Barang Input Section --}}
                        <div class="form-group mb-3">
                            <label class="font-weight-bold" for="update-nama-barang">Nama Barang</label>
                            <input type="text" name="nama_barang" id="update-nama-barang" class="form-control"
                                placeholder="Masukkan Nama Barang..." required>
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

    <!-- delete -->
    <div class="modal fade" id="deleteNamaBarangModal" tabindex="-1" aria-labelledby="deleteNamaBarangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="deleteNamaBarangModalLabel">Hapus Nama Barang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                {{-- Placeholder: action is set via JS --}}
                <form action="#" method="POST" id="deleteNamaBarangForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p class="text-center delete-text mb-1">Konfirmasi Hapus Nama barang</p>
                        <p class="text-center font-weight-bold" id="delete-nama-barang-name"></p>
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

    <!-- show -->
    <div class="modal fade" id="rincianNamaBarangModal" tabindex="-1" aria-labelledby="rincianNamaBarangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Make slightly larger if needed --}}
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="rincianNamaBarangModalLabel">Rincian Nama Barang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <!-- Body -->
                <div class="modal-body d-flex px-4 py-4">
                    <!-- Image Area -->
                    <div
                        style="width: 260px; height: 260px; background-color: #2B2684; border: 2px dashed #ccc; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                        <div id="rincian-default-view" style="text-align: center;">
                            <i class="fa fa-cube fa-3x" style="color: white;"></i>
                        </div>
                        <div id="rincian-image-view" style="display: none; height: 100%; width: 100%;">
                            <img id="rincian-preview-img" src="" alt="Preview"
                                style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                    </div>

                    <!-- Text Details -->
                    <div class="pl-4">
                        <p class="mb-4">
                            <strong style="color: #6c757d;">id Barang</strong><br>
                            <span class="text-muted" id="rincian-id-barang">nomor id barang</span>
                        </p>
                        <p>
                            <strong style="color: #6c757d;">Nama Barang</strong><br>
                            <span class="text-muted" id="rincian-nama-barang">nama barang</span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn modal-color text-white font-weight-bold rounded-3"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 1500 // Mengatur waktu untuk menutup alert secara otomatis (dalam milidetik)
                    });
                </script>
            @endif
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('add-nama-barang-gambar-input');
        const previewImg = document.getElementById('preview-img');
        const fileNameLabel = document.getElementById('add-nama-barang-filename');
        const defaultIcon = document.getElementById('add-default-icon');

        input.addEventListener('change', function(event) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('d-none');
                    defaultIcon.classList.add('d-none');
                    fileNameLabel.textContent = input.files[0].name;
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                previewImg.src = '#';
                previewImg.classList.add('d-none');
                defaultIcon.classList.remove('d-none');
                fileNameLabel.textContent = '';
            }
        });

        // Reset on modal hide
        $('#addNamaBarangModal').on('hidden.bs.modal', function() {
            input.value = '';
            previewImg.src = '#';
            previewImg.classList.add('d-none');
            defaultIcon.classList.remove('d-none');
            fileNameLabel.textContent = '';
        });

        const rincianButtons = document.querySelectorAll('.rincian-btn');

        rincianButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const gambar = this.getAttribute('data-gambar');

                document.getElementById('rincian-id-barang').textContent = id;
                document.getElementById('rincian-nama-barang').textContent = nama;

                const defaultView = document.getElementById('rincian-default-view');
                const imageView = document.getElementById('rincian-image-view');
                const previewImg = document.getElementById('rincian-preview-img');

                if (gambar) {
                    previewImg.src = gambar;
                    imageView.style.display = 'block';
                    defaultView.style.display = 'none';
                } else {
                    imageView.style.display = 'none';
                    defaultView.style.display = 'block';
                }
            });
        });

        const deleteButtons = document.querySelectorAll('.btn-delete');
        const deleteForm = document.getElementById('deleteNamaBarangForm');
        const deleteNameDisplay = document.getElementById('delete-nama-barang-name');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const namaBarang = this.getAttribute('data-nama');
                const actionUrl = this.getAttribute('data-url');

                deleteForm.setAttribute('action', actionUrl);
                deleteNameDisplay.textContent = namaBarang;
            });
        });

        const updateButtons = document.querySelectorAll('.btn-update');
        const updateForm = document.getElementById('updateNamaBarangForm');
        const updateNamaBarangInput = document.getElementById('update-nama-barang');
        const updateImagePreview = document.getElementById('update-preview-img');
        const updateCurrentFilename = document.getElementById('update-current-filename');
        const updateFileInput = document.getElementById('update-nama-barang-gambar-input');
        const updateDefaultIcon = document.getElementById('update-default-icon');

        updateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const idBarang = this.getAttribute('data-id');
                const namaBarang = this.getAttribute('data-nama');
                const imageUrl = this.getAttribute('data-gambar');
                const actionUrl = this.getAttribute('data-url');

                // Set form action URL
                updateForm.setAttribute('action', actionUrl);

                // Fill in the current data
                updateNamaBarangInput.value = namaBarang;
                updateCurrentFilename.textContent = imageUrl ? imageUrl.split('/').pop() :
                    'Tidak ada gambar';

                // Show current image or placeholder
                if (imageUrl) {
                    updateImagePreview.style.display = 'block';
                    updateImagePreview.src = imageUrl;
                    updateDefaultIcon.style.display = 'none';
                } else {
                    updateImagePreview.style.display = 'none';
                    updateDefaultIcon.style.display = 'block';
                }
            });
        });

        // When user selects a new file
        updateFileInput.addEventListener('change', function(e) {
            const fileName = e.target.files[0].name;
            document.getElementById('update-new-filename-display').textContent = fileName;
            document.getElementById('update-new-filename-display').style.display = 'block';

            // Display the new image preview
            const reader = new FileReader();
            reader.onload = function(e) {
                updateImagePreview.style.display = 'block';
                updateImagePreview.src = e.target.result;
                updateDefaultIcon.style.display = 'none';
            };
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
