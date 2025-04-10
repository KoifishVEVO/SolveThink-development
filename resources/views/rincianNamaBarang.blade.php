@extends('layouts.dashboard')

@section('title')
    RincianNamaBarang
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



.rincian-btn i {
    font-size: 16px !important;
    margin-right: 0 !important; /
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
        .entries{
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


.dataTables_paginate .pagination .page-item + .page-item .page-link {
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

.batal-btn{
    color: #272780 !important; 
    border-color:  #272780 !important;
}

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
                                    <select id="showEntries" name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm" style="width: auto; display: inline-block;">
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
                            <div id="dataTable_filter" class="dataTables_filter d-flex justify-content-md-end align-items-center">
                                <label class="mr-2 mb-0">Search:
                                    {{-- Placeholder: Link form to backend search --}}
                                    <form id="searchForm" method="GET" action="#" class="d-inline"> {{-- Placeholder Action --}}
                                        <input type="search" name="search" value="" class="form-control form-control-sm d-inline" aria-controls="dataTable" placeholder="">
                                    </form>
                                </label>
                                {{-- Link button to Add Modal --}}
                                <button class="btn btn-success btn-sm ml-2" data-toggle="modal" data-target="#addNamaBarangModal">Tambah</button>
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
                                    @php
                                        $exampleItems = [
                                            ['id' => 1, 'nama' => 'Barang 01'],
                                            ['id' => 2, 'nama' => 'Barang 02'],
                                            ['id' => 3, 'nama' => 'Barang 03'],
                                            ['id' => 4, 'nama' => 'Barang 04'],
                                            ['id' => 5, 'nama' => 'Barang 05'],
                                            // Add more rows if needed
                                        ];
                                    @endphp

                                    @foreach ($exampleItems as $item)
                                    <tr>
                                        <td>{{ $item['id'] }}</td>
                                        <td>
                                            {{-- Image Placeholder --}}
                                            <div class="image-placeholder">
                                                <i class="fa fa-image"></i>
                                            </div>
                                        </td>
                                        <td>{{ $item['nama'] }}</td>
                                        <td class="px-3 text-center">
                                            <div class="d-inline-block">
                                                 {{-- Rincian Button --}}
                                                <button class="btn btn-sm rincian-btn m-1"
                                                    data-id="{{ $item['id'] }}" {{-- Placeholder id --}}
                                                    data-nama="{{ $item['nama'] }}" {{-- Placeholder name --}}
                                                    {{-- Add data-gambar if you have it --}}
                                                    data-toggle="modal"
                                                    data-target="#rincianNamaBarangModal" {{-- Target Rincian Modal --}}
                                                >
                                                    <i class="fa fa-eye"></i> Rincian
                                                </button>
                                                {{-- Update Button --}}
                                                <button
                                                    class="btn btn-sm btn-warning m-1 btn-update"
                                                    data-id="{{ $item['id'] }}" {{-- Placeholder id --}}
                                                    data-nama="{{ $item['nama'] }}" {{-- Placeholder name --}}
                                                    data-url="#" {{-- Placeholder URL for update --}}
                                                    data-toggle="modal"
                                                    data-target="#updateNamaBarangModal" {{-- Target Update Modal --}}
                                                >
                                                    Update
                                                </button>
                                                {{-- Hapus Button --}}
                                                <button class="btn btn-sm btn-danger m-1 btn-delete"
                                                    data-id="{{ $item['id'] }}" {{-- Placeholder id --}}
                                                    data-nama="{{ $item['nama'] }}" {{-- Placeholder name --}}
                                                    data-url="#" {{-- Placeholder URL for delete --}}
                                                    data-toggle="modal"
                                                    data-target="#deleteNamaBarangModal" {{-- Target Delete Modal --}}
                                                >
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
                                {{-- Placeholder pagination info - Update with backend data --}}
                                Showing 1 to 5 of 5 entries {{-- Adjusted example count --}}
                                {{-- Example: Showing {{ $namaBarangItems->firstItem() }} to {{ $namaBarangItems->lastItem() }} of {{ $namaBarangItems->total() }} entries --}}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers">
                                <ul class="pagination justify-content-end">
                                    {{-- Placeholder pagination - Remove/replace when using Laravel pagination --}}
                                    <li class="paginate_button page-item disabled"><a href="#" class="page-link">Previous</a></li>
                                    <li class="paginate_button page-item active"><a href="#" class="page-link">1</a></li>
                                    <li class="paginate_button page-item disabled"><a href="#" class="page-link">Next</a></li>
                                    {{-- Example for Laravel Pagination: --}}
                                    {{-- {{ $namaBarangItems->links('pagination::bootstrap-4') }} --}}
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
<div class="modal fade" id="addNamaBarangModal" tabindex="-1" aria-labelledby="addNamaBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-color text-white">
                {{-- Title matches image --}}
                <h5 class="modal-title" id="addNamaBarangModalLabel">Tambah Nama Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            {{-- Placeholder: action should point to your store route, e.g., "{{ route('nama_barang.store') }}" --}}
            {{-- Added enctype="multipart/form-data" for file uploads --}}
            <form action="#" method="POST" id="addNamaBarangForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    {{-- Upload Foto Barang Section --}}
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">Upload Foto Barang</label>
                        {{-- Clickable Upload Area --}}
                        {{-- Uses modal-color for background, rounded-3 for corners, flex for centering --}}
                        <div id="add-nama-barang-upload-area" class="modal-color rounded-3 d-flex align-items-center justify-content-center mb-2"
                             style="height: 150px; cursor: pointer;">
                             {{-- Font Awesome icon --}}
                            <i class="fa fa-image fa-3x text-white"></i>
                        </div>
                        {{-- Hidden File Input - Triggered by clicking the div above --}}
                        <input type="file" class="d-none" id="add-nama-barang-gambar-input" name="gambar_barang" accept="image/*">
                         {{-- Area to optionally show preview/filename after selection (Initially hidden) --}}
                         <div id="add-nama-barang-preview" class="mt-2 text-center" style="display: none;">
                             <img src="#" alt="Preview" class="img-thumbnail" style="max-width: 100%; max-height: 150px;" />
                             <p class="mt-1 mb-0 text-muted small" id="add-nama-barang-filename"></p>
                         </div>
                    </div>

                    {{-- Nama Barang Input --}}
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" for="add-nama-barang">Nama Barang</label>
                        <select name="nama_barang" id="add-nama-barang" class="form-control" required>
                            <option value="" disabled selected>Pilih Nama Barang...</option>
                            <option value="Sensor">Sensor</option>
                            <option value="Actuator">Actuator</option>
                            <option value="Power">Power</option>
                            <option value="Equipment">Equipment</option>
                            
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    {{-- Batal Button - Uses batal-btn class --}}
                    <button type="button" class="btn btn-outline batal-btn rounded-3 me-2" data-dismiss="modal">Batal</button>
                    {{-- Tambah Button - Uses modal-color class --}}
                    <button type="submit" class="btn modal-color text-white font-weight-bold rounded-3">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- update -->
<div class="modal fade" id="updateNamaBarangModal" tabindex="-1" aria-labelledby="updateNamaBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> 
        <div class="modal-content">
            <div class="modal-header modal-color text-white">
                <h5 class="modal-title" id="updateNamaBarangModalLabel">Update Nama Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                <div id="update-image-placeholder" class="modal-color rounded-3 d-flex align-items-center justify-content-center position-relative"
                                     style="width: 100px; height: 100px; cursor: pointer;"
                                     onclick="document.getElementById('update-nama-barang-gambar-input').click();"> {{-- Make placeholder clickable --}}

                                    {{-- Default Icon (Initially Visible) --}}
                                    <i class="fa fa-box fa-3x text-white" id="update-default-icon"></i>

                                    {{-- Image Preview (Initially Hidden) --}}
                                    <img id="update-preview-img" src="#" alt="Preview" class="img-fluid rounded-3"
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
                                <input type="file" class="d-none" id="update-nama-barang-gambar-input" name="gambar_barang_update" accept="image/*">
                            </div>
                        </div>
                         {{-- Optional: Display selected new file name --}}
                         <div id="update-new-filename-display" class="mt-2 text-muted small" style="display: none;"></div>
                    </div>

                    {{-- Nama Barang Input Section --}}
                    <div class="form-group mb-3">
                        <label class="font-weight-bold" for="update-nama-barang">Nama Barang</label>
                        <select name="nama_barang" id="update-nama-barang" class="form-control" required>
                            <option value="" disabled selected>Pilih Nama Barang...</option>
                            <option value="Sensor">Sensor</option>
                            <option value="Actuator">Actuator</option>
                            <option value="Power">Power</option>
                            <option value="Equipment">Equipment</option>
                        </select>
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

<!-- delete -->
<div class="modal fade" id="deleteNamaBarangModal" tabindex="-1" aria-labelledby="deleteNamaBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-color text-white">
                <h5 class="modal-title" id="deleteNamaBarangModalLabel">Hapus Nama Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                    <button type="button" class="btn btn-outline batal-btn rounded-3 me-2" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn modal-color text-white font-weight-bold rounded-3">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- show -->
<div class="modal fade" id="rincianNamaBarangModal" tabindex="-1" aria-labelledby="rincianNamaBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Make slightly larger if needed --}}
        <div class="modal-content">
            <div class="modal-header modal-color text-white">
                <h5 class="modal-title" id="rincianNamaBarangModalLabel">Rincian Nama Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
             <!-- Body -->
             <div class="modal-body d-flex px-4 py-4">
                <!-- Image Area -->
                <div style="width: 260px; height: 260px; background-color: #2B2684; border: 2px dashed #ccc; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                    <div id="rincian-default-view" style="text-align: center;">
                        <i class="fa fa-cube fa-3x" style="color: white;"></i>
                    </div>
                    <div id="rincian-image-view" style="display: none; height: 100%; width: 100%;">
                        <img id="rincian-preview-img" src="" alt="Preview" style="height: 100%; width: 100%; object-fit: contain;">
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
                <button type="button" class="btn modal-color text-white font-weight-bold rounded-3" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>



@endsection