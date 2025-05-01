@extends('layouts.dashboard')

@section('title')
    Periode
@endsection

@section('styles')
@endsection

@section('content')
    <style>
        .table {
            /* Remove default borders if using table-bordered */
            border: none;
            vertical-align: middle;
            /* Better vertical alignment */
        }

        /* Table Header Styling */
        .table thead th {
            font-weight: 600;
            /* Slightly bolder header text */
            color: #495057;
            /* Dark grey text */
            background-color: #fff;
            /* Ensure white background */
            border: 1px solid black !important;
            border-color: #DEDDDD !important;
            border-bottom: 2px solid #dee2e6 !important;
            /* Add thick bottom border */
            padding: 0.9rem;
            text-align: left;
            /* Default left align */
            white-space: nowrap;
            /* Prevent wrapping */
        }

        /* Table Body Styling */
        .table tbody tr {
            border-color: inherit;
            /* Reset border color inheritance */
            border-style: solid;
            border-width: 0;
            /* Remove default row borders */
            border-bottom-width: 1px;
            /* Add bottom border only */
        }

        .table tbody tr:last-child {
            border-bottom-width: 0;
            /* Remove bottom border for the last row */
        }

        .table tbody td {
            border: none !important;
            /* Remove all cell borders */
            padding: 0.75rem 0.9rem;
            /* Adjust padding */
            text-align: left;
            /* Default left align */
            color: #212529;
            /* Standard text color */
        }

        /* Center text in the last column (Aksi) header and cells */
        .table th:last-child,
        .table td:last-child {
            text-align: center;
        }

        /* Center image vertically and horizontally */
        .table td .img-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 60px;
            /* Ensure minimum height for alignment */
        }

        .table td .img-container img {
            max-height: 50px;
            /* Limit image height */
            max-width: 80px;
            /* Limit image width */
            width: auto;
            height: auto;
        }


        /* Action Button Styles */
        .btn-action-update {
            background-color: #ffc107 !important;
            /* Bootstrap warning yellow */
            color: #212529 !important;
            /* Dark text */
            border-color: #ffc107 !important;
            border-radius: 0.25rem;
            /* Standard rounding */
            padding: 0.25rem 0.6rem;
            /* Adjust padding */
            font-size: 0.8rem;
            /* Smaller font */
            margin: 0 2px;
            /* Small gap between buttons */
            font-weight: 500;
        }

        .btn-action-update:hover {
            background-color: #e0a800 !important;
            border-color: #d39e00 !important;
            color: #212529 !important;
        }

        .btn-action-delete {
            background-color: #dc3545 !important;
            /* Bootstrap danger red */
            color: #fff !important;
            border-color: #dc3545 !important;
            border-radius: 0.25rem;
            /* Standard rounding */
            padding: 0.25rem 0.6rem;
            /* Adjust padding */
            font-size: 0.8rem;
            /* Smaller font */
            margin: 0 2px;
            /* Small gap between buttons */
            font-weight: 500;
        }

        .btn-action-delete:hover {
            background-color: #c82333 !important;
            border-color: #bd2130 !important;
            color: #fff !important;
        }

        /* Ensure Tambah button remains green */
        .btn-success {
            background-color: #198754 !important;
            /* BS5 success green */
            border-color: #198754 !important;
            color: #fff !important;
        }

        .btn-success:hover {
            background-color: #157347 !important;
            border-color: #146c43 !important;
        }

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

        #addPeriodeModal .modal-dialog,
        #updatePeriodeModal .modal-dialog {
            max-width: 700px;
            /* You can adjust this value to make it wider or narrower */
            width: 90%;
        }


        /* Modal mobile view */
        @media (max-width: 767.98px) {
            /* Target mobile screens */

            /* --- Make Add/Update Periode Modals Fullscreen --- */

            /* Style the dialog container */
            #addPeriodeModal .modal-dialog,
            #updatePeriodeModal .modal-dialog {
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
                display: flex;
                /* Use flex for vertical layout */
                flex-direction: column;
                /* Stack header/body/footer */
            }

            #addPeriodeModal form,
            #updatePeriodeModal form {
                display: flex;
                flex-direction: column;
                flex: 1 1 auto;
                height: 100%;
            }

            /* Style the content area within the dialog */
            #addPeriodeModal .modal-content,
            #updatePeriodeModal .modal-content {
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
                flex: 1 1 auto;
                /* Allow content to grow/shrink */
            }

            /* Allow modal body to scroll */
            #addPeriodeModal .modal-body,
            #updatePeriodeModal .modal-body {
                overflow-y: auto;
                /* Enable vertical scroll */
                flex: 1 1 auto;
                /* Allow body to take available vertical space */
                padding-top: 1.5rem;
                /* Add some padding */
                padding-bottom: 1.5rem;
            }

            /* Style the footer */
            #addPeriodeModal .modal-footer,
            #updatePeriodeModal .modal-footer {
                display: flex;
                flex-direction: row;
                /* justify-content: space-between; */
                /* Use space-between or rely on button margins */
                align-items: center;
                border-top: none;
                /* Optional: remove top border */
                padding: 0.75rem;
                /* Adjust padding as needed */
                margin-top: auto;
                /* Push footer to bottom if body content is short */
                flex-shrink: 0;
                /* Prevent footer from shrinking */
            }

            /* Style the buttons within the footer */
            #addPeriodeModal .modal-footer .btn,
            #updatePeriodeModal .modal-footer .btn {
                flex: 1;
                /* Make both buttons take roughly equal space */
                /* max-width: none; */
                /* Allow buttons to fill space */
                /* Add margin between buttons if not using space-between */
                /* The me-2 class on your 'Batal' button already adds margin */
                padding-top: 0.75rem;
                /* Increase button padding for easier tapping */
                padding-bottom: 0.75rem;
                font-size: 1rem;
                /* Ensure readable font size */
            }

            /* --- Specific adjustments if needed --- */
            /* e.g., if Batal button needs slightly different flex behavior */
            /*
                                                                                                                                                                                                                                                                                                                                                                                                    #addPeriodeModal .modal-footer .batal-btn,
                                                                                                                                                                                                                                                                                                                                                                                                    #updatePeriodeModal .modal-footer .batal-btn {
                                                                                                                                                                                                                                                                                                                                                                                                        flex-grow: 0.8; // Example: Make cancel slightly smaller if desired
                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                    */

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

        /* calendar */
        /* Optional: Make Flatpickr calendar match theme colors */
        .flatpickr-calendar .flatpickr-day.selected {
            background: #272780;
            border-color: #272780;
        }

        /* Make input look less like it's disabled when readonly */
        input[readonly].form-control {
            background-color: #fff;
            /* Keep background white */
            cursor: default;
            /* Indicate it's not for typing */
        }

        /* Make icon clickable */
        .datepicker-trigger {
            cursor: pointer;
        }
    </style>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- Update heading text --}}
        <h1 class="h3 mb-2 mt-4 heading-text font-weight-bold">DATA PERIODE</h1>
        <p class="mb-4 heading-text font-weight-bold">Tabel data periode berisikan informasi terkait periode yang telah
            dibuat.</p>

        <div class="card shadow mb-4">
            <div class="card-header py-5 card-color">
                <h6 class="m-0 font-weight-bold text-white">Data Tabel Periode</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        {{-- Top Controls Row --}}
                        <div class="row mb-3">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="dataTable_length">
                                    <form method="GET" action="{{ route('periode.show') }}" id="showEntriesForm">
                                        <label>Show
                                            <select id="showEntries" name="showEntries" onchange="this.form.submit()"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                                @foreach ([5, 10, 30, 100] as $value)
                                                    <option value="{{ $value }}"
                                                        {{ request('showEntries', 3) == $value ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select> entries
                                        </label>
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    </form>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div id="dataTable_filter"
                                    class="dataTables_filter d-flex justify-content-md-end align-items-center">
                                    <form id="searchForm" method="GET" action="{{ route('periode.show') }}"
                                        class="form-inline">
                                        <label class="mr-2 mb-0">Search:</label>
                                        <input type="search" name="search" value="{{ request('search') }}"
                                            class="form-control form-control-sm" placeholder="Cari Periode...">
                                    </form>

                                    <button class="btn btn-success btn-sm ml-2" data-toggle="modal"
                                        data-target="#addPeriodeModal">Tambah</button>
                                </div>
                            </div>

                        </div>

                        {{-- Table Row --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Periode</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Akhir</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">

                                        @foreach ($periodes as $item)
                                            <tr>
                                                <td>{{ $item->nama_periode }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal_akhir)->format('d/m/Y') }}
                                                </td>
                                                <td class="px-3 text-center"> {{-- action buttons --}}
                                                    <div class="d-inline-block">
                                                        <button class="btn btn-sm btn-warning m-1 btn-update"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->nama_periode }}"
                                                            data-mulai="{{ $item->tanggal_mulai }}"
                                                            data-akhir="{{ $item->tanggal_akhir }}"
                                                            data-url="{{ route('periode.update', $item->id) }}"
                                                            data-toggle="modal" data-target="#updatePeriodeModal">
                                                            Update
                                                        </button>
                                                        <button class="btn btn-sm btn-danger m-1 btn-delete"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->nama_periode }}"
                                                            data-url="{{ route('periode.destroy', $item->id) }}"
                                                            data-target="#deletePeriodeModal" data-toggle="modal">
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

                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" role="status" aria-live="polite">
                                    Showing {{ $periodes->firstItem() }} to {{ $periodes->lastItem() }} of
                                    {{ $periodes->total() }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    <ul class="pagination justify-content-end">
                                        {{-- Tombol Previous --}}
                                        <li
                                            class="paginate_button page-item {{ $periodes->onFirstPage() ? 'disabled' : '' }}">
                                            <a href="{{ $periodes->previousPageUrl() ?? '#' }}"
                                                class="page-link">Previous</a>
                                        </li>

                                        {{-- Nomor Halaman --}}
                                        @for ($i = 1; $i <= $periodes->lastPage(); $i++)
                                            <li
                                                class="paginate_button page-item {{ $i == $periodes->currentPage() ? 'active' : '' }}">
                                                <a href="{{ $periodes->url($i) }}"
                                                    class="page-link">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        {{-- Tombol Next --}}
                                        <li
                                            class="paginate_button page-item {{ $periodes->hasMorePages() ? '' : 'disabled' }}">
                                            <a href="{{ $periodes->nextPageUrl() ?? '#' }}" class="page-link">Next</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>{{-- /.dataTables_wrapper --}}
                </div> {{-- /.table-responsive --}}
            </div> {{-- /.card-body --}}
        </div> {{-- /.card --}}

    </div> {{-- /.container-fluid --}}





    <!-- Modal -->

    <!-- add modal -->
    <div class="modal fade" id="addPeriodeModal" tabindex="-1" aria-labelledby="addPeriodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="addPeriodeModalLabel">Tambah Periode Baru</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                {{-- Replace # with your store route --}}
                <form action="{{ route('periode.store') }}" method="POST" id="addPeriodeForm">
                    @csrf
                    <div class="modal-body">
                        {{-- Nama Periode --}}
                        <div class="form-group mb-3">
                            <label for="add-nama-periode" class="form-label fw-bold">Nama Periode</label>
                            <input type="text" class="form-control rounded-3" id="add-nama-periode"
                                name="nama_periode" required>
                        </div>
                        {{-- Tanggal Mulai & Akhir --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="add-tanggal-mulai" class="form-label fw-bold">Tanggal Mulai</label>
                                    {{-- Wrap input and trigger for Flatpickr's 'wrap' option --}}
                                    <div class="input-group flatpickr" data-wrap="true" data-click-opens="false">
                                        <input type="text" class="form-control rounded-start-3"
                                            placeholder="DD/MM/YYYY" id="add-tanggal-mulai" name="tanggal_mulai" required
                                            readonly data-input> {{-- Added readonly, data-input --}}
                                        <span class="input-group-text rounded-end-3 datepicker-trigger" data-toggle>
                                            {{-- Added class, data-toggle --}}
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        {{-- Optional: Add clear button --}}
                                        {{-- <span class="input-group-text" data-clear><i class="fa fa-times"></i></span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="add-tanggal-akhir" class="form-label fw-bold">Tanggal Akhir</label>
                                    {{-- Wrap input and trigger for Flatpickr's 'wrap' option --}}
                                    <div class="input-group flatpickr" data-wrap="true" data-click-opens="false">
                                        <input type="date" class="form-control rounded-start-3"
                                            placeholder="DD/MM/YYYY" id="add-tanggal-akhir" name="tanggal_akhir" required
                                            readonly data-input> {{-- Added readonly, data-input --}}
                                        <span class="input-group-text rounded-end-3 datepicker-trigger" data-toggle>
                                            {{-- Added class, data-toggle --}}
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        {{-- Optional: Add clear button --}}
                                        {{-- <span class="input-group-text" data-clear><i class="fa fa-times"></i></span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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

    <!-- update modal -->
    <div class="modal fade" id="updatePeriodeModal" tabindex="-1" aria-labelledby="updatePeriodeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="updatePeriodeModalLabel">Update Periode</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{-- Form action is set dynamically via JavaScript --}}
                <form action="#" method="POST" id="updatePeriodeForm">
                    @csrf
                    @method('PUT')
                    {{-- Hidden input to store the ID of the periode being updated --}}
                    <input type="hidden" name="id" id="update-periode-id">

                    <div class="modal-body">
                        {{-- Nama Periode --}}
                        <div class="form-group mb-3">
                            <label for="update-nama-periode" class="form-label fw-bold">Nama Periode</label>
                            {{-- Input field for Nama Periode --}}
                            <input type="text" class="form-control rounded-3" {{-- Uses CSS for rounding --}}
                                id="update-nama-periode" name="nama_periode" required>
                        </div>

                        {{-- Tanggal Mulai & Tanggal Akhir Row --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="update-tanggal-mulai" class="form-label fw-bold">Tanggal Mulai</label>
                                    {{-- Wrap input and trigger for Flatpickr's 'wrap' option --}}
                                    <div class="input-group flatpickr" data-wrap="true" data-click-opens="false">
                                        <input type="text" class="form-control rounded-start-3"
                                            placeholder="DD/MM/YYYY" id="update-tanggal-mulai" name="tanggal_mulai"
                                            required readonly data-input> {{-- Added readonly, data-input --}}
                                        <span class="input-group-text rounded-end-3 datepicker-trigger" data-toggle>
                                            {{-- Added class, data-toggle --}}
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="update-tanggal-akhir" class="form-label fw-bold">Tanggal Akhir</label>
                                    {{-- Wrap input and trigger for Flatpickr's 'wrap' option --}}
                                    <div class="input-group flatpickr" data-wrap="true" data-click-opens="false">
                                        <input type="text" class="form-control rounded-start-3"
                                            placeholder="DD/MM/YYYY" id="update-tanggal-akhir" name="tanggal_akhir"
                                            required readonly data-input> {{-- Added readonly, data-input --}}
                                        <span class="input-group-text rounded-end-3 datepicker-trigger" data-toggle>
                                            {{-- Added class, data-toggle --}}
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> {{-- /.modal-body --}}

                    <div class="modal-footer">
                        {{-- Batal Button: uses .batal-btn class for styling --}}
                        <button type="button" class="btn btn-outline batal-btn rounded-3 me-2"
                            data-dismiss="modal">Batal</button>
                        {{-- Simpan Button: uses .modal-color for background --}}
                        <button type="submit"
                            class="btn modal-color text-white font-weight-bold rounded-3">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete modal -->
    <div class="modal fade" id="deletePeriodeModal" tabindex="-1" aria-labelledby="deletePeriodeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-color text-white">
                    <h5 class="modal-title" id="deletePeriodeModalLabel">Hapus Periode</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <form action="#" method="POST" id="deletePeriodeForm">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="id" id="delete-id">
                    <div class="modal-body">
                        <p class="delete-text text-center">Konfirmasi Hapus Periode</p>
                        <p class="text-center font-weight-bold" id="delete-periode-nama"></p>
                    </div>
                    <div class="modal-footer justify-content-center"> {{-- Buttons --}}
                        <button type="button" class="btn btn-outline batal-btn rounded-3 me-2"
                            data-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn modal-color text-white font-weight-bold rounded-3">Hapus</button>
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
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
            });
        </script>
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Configuration for Flatpickr
            const flatpickrConfig = {
                wrap: true, // Enables wrapping, allows trigger from external element
                clickOpens: false, // Disable opening picker on input click
                altFormat: "d/m/Y",
                dateFormat: "Y-m-d", // Set the date format to DD/MM/YYYY
                allowInput: false, // Double-ensure typing is disabled (use readonly on input too)
                // You can add more options here like locale, minDate, maxDate etc.
                // locale: "id" // Example for Indonesian locale (requires importing locale file)
            };

            // Initialize Flatpickr for all elements with class 'flatpickr'
            // Flatpickr automatically finds data-input, data-toggle, data-clear within the wrap element
            flatpickr(".flatpickr", flatpickrConfig);

            // --- Optional: Logic to pre-fill Update Modal ---
            // Make sure this runs *after* Flatpickr initialization if needed,
            // or better, within your existing 'show.bs.modal' event for #updatePeriodeModal
            $('#updatePeriodeModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal

                // Example: Assume dates are passed like data-tanggal-mulai="2025-04-10" (YYYY-MM-DD format)
                var tanggalMulaiDb = button.data('tanggal-mulai'); // Get value in YYYY-MM-DD
                var tanggalAkhirDb = button.data('tanggal-akhir'); // Get value in YYYY-MM-DD

                // Get Flatpickr instances for the update modal inputs
                var fpMulai = document.querySelector('#update-tanggal-mulai')._flatpickr;
                var fpAkhir = document.querySelector('#update-tanggal-akhir')._flatpickr;

                // Set the date using Flatpickr's API (it handles formatting)
                if (tanggalMulaiDb && fpMulai) {
                    fpMulai.setDate(tanggalMulaiDb, true); // 'true' triggers onChange if needed
                }
                if (tanggalAkhirDb && fpAkhir) {
                    fpAkhir.setDate(tanggalAkhirDb, true);
                }

                // ... rest of your update modal population logic (ID, name, etc.)
            });

            // --- Optional: Clear dates when Add modal is hidden ---
            $('#addPeriodeModal').on('hidden.bs.modal', function() {
                var fpMulaiAdd = document.querySelector('#add-tanggal-mulai')._flatpickr;
                var fpAkhirAdd = document.querySelector('#add-tanggal-akhir')._flatpickr;
                if (fpMulaiAdd) fpMulaiAdd.clear();
                if (fpAkhirAdd) fpAkhirAdd.clear();
                // Also reset other form fields
                $(this).find('form').trigger('reset');
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
                const stok = this.dataset.stok;
                const gambar = this.dataset.gambar;

                console.log(stok)

                $('#rincianAssetModal').on('shown.bs.modal', function() {
                    // Isi data ke modal setelah modal benar-benar ditampilkan
                    document.getElementById('rincian-id').innerText = id;
                    document.getElementById('rincian-nama').innerText = nama;
                    document.getElementById('rincian-stok').innerText = stok;

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
                console.log('diklik')
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const url = this.dataset.url;
                console.log(url);

                // Tampilkan nama di modal
                document.getElementById('delete-periode-nama').innerText =
                    `Apakah kamu yakin ingin menghapus "${nama}"?`;

                // Update form action dengan URL yang sesuai
                const deleteForm = document.getElementById('deletePeriodeForm');
                deleteForm.action = url; // Set URL untuk form action

                // Set ID hidden (opsional)
                const hiddenId = document.getElementById('delete-id');
                if (hiddenId) hiddenId.value = id; // opsional, kalau elemen ada
            });
        });

        document.querySelectorAll('.btn-update').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const mulai = this.dataset.mulai;
                const akhir = this.dataset.akhir;
                const url = this.dataset.url;

                // Isi form dengan data
                document.getElementById('update-periode-id').value = id;
                document.getElementById('update-nama-periode').value = nama;
                document.getElementById('update-tanggal-mulai').value = mulai;
                document.getElementById('update-tanggal-akhir').value = akhir;

                // Set form action
                document.getElementById('updatePeriodeForm').action = url;
            });
        });
    </script>


@endsection
