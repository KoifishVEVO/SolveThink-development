@extends('layouts.dashboard')

@section('title')
    RincianBarangBaru
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

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 heading-text font-weight-bold">ASSET BARANG BARU</h1>
    <p class="mb-4 heading-text font-weight-bold">Tabel asset barang baru adalah tabel yang berisikan informasi terkait barang baru</p>

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
                            <select id="showEntries" name="dataTable_length" class="custom-select custom-select-sm form-control form-control-sm">
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
<<<<<<< Updated upstream
                            <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable">
=======
                            <form id="searchForm" method="GET" action="{{ route('aset_barang.index') }}" class="d-inline">
                                <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm d-inline" aria-controls="dataTable">
                            </form>
>>>>>>> Stashed changes
                        </label>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addAssetModal">Tambah</button>
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
                                <th>Harga Jual Barang</th>
                                <th>Stok Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <!-- Sample row -->
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('assets/images/solvethink_transparent.png') }}" alt="Gambar"
                                            class="img-fluid" style="max-width: 100px; height: auto;">
                                    </div>
                                </td>
                                <td>Nama barang 01</td>
                                <td>Harga Jual barang 01</td>
                                <td>Stok barang 01</td>
                                <td class="px-3">
                                    <div class="d-flex flex-wrap justify-content-center">
                                        <button class="btn btn-sm rincian-btn m-1" data-toggle="modal" data-target="#rincianAssetModal">
                                            <i class="fa fa-eye"></i> Rincian
                                        </button>
                                        <button 
                                            class="btn btn-sm btn-warning m-1 btn-update"
                                            data-id="1"
                                            data-nama="Nama barang 01"
                                            data-harga="10000"
                                            data-stok="25"
                                            data-gambar="{{ asset('storage/uploads/gambar01.png') }}"
                                            data-url="{{ route('aset_barang.update', 1) }}"
                                            data-toggle="modal"
                                            data-target="#updateAssetModal">
                                            Update
                                        </button>
                                        <button class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#deleteAssetModal">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- pagination -->
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                        Showing 1 to 10 of 57 entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                        <ul class="pagination justify-content-end">
                            <li class="paginate_button page-item previous disabled" id="dataTable_previous">
                                <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link ">Previous</a>
                            </li>
                            <li class="paginate_button page-item active">
                                <a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                            </li>
                            <li class="paginate_button page-item next" id="dataTable_next">
                                <a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
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
<div class="modal fade" id="addAssetModal" tabindex="-1" role="dialog" aria-labelledby="addAssetLabel" aria-hidden="true">
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
                            <!-- image upload  -->
                            <div id="image-upload-container" class="modal-color position-relative mb-4"
                                style="border: 2px dashed #ccc; border-radius: 5px; padding: 20px;
                                    background-color: #f8f9fa; height: 200px; overflow: hidden;
                                    cursor: pointer; position: relative; text-align: center;">


                                <div id="upload-button-view"
                                    style="display: flex; flex-direction: column; align-items: center;
                                        justify-content: center; position: absolute; top: 50%; left: 50%;
                                        transform: translate(-50%, -50%); text-align: center; width: 100%;">
                                    <i class="fa fa-image" style="font-size: 24px; margin-bottom: 10px; color: #FFFFFF"></i>
                                    <div style="font-size: 16px; font-weight: bold; color: #FFFFFF">Click to Select Image</div>
                                    <input type="file" id="fileInput" name="gambar_barang"
                                        style="display: none;" accept="image/*" required>
                                </div>

                                <!-- Image Preview -->
                                <div id="image-preview" style="display: none; height: 200px; width: 100%; position: relative; padding: 0; margin-bottom: 4px;">
                                    <img id="preview-img" src="" alt="Preview"
                                        style="height: 100%; width: 100%; object-fit: contain; position: absolute; top: -20px; left: 0;">
                                    <!-- <h6 id="change-image-btn" class="position-absolute"
                                        style="top: 10px; right: 10px; cursor: pointer; z-index: 10; background-color: rgba(255,255,255,0.7); padding: 3px 6px; border-radius: 3px;">
                                        Click to Change Image
                                    </h6> -->
                                </div>
                            </div>


                    <!-- Other Inputs -->
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

                    <label class="font-weight-bold">Harga Jual Barang</label>
                    <input type="number" name="harga_jual_barang" class="form-control mb-3" required>

                    <label class="font-weight-bold">Stok Barang</label>
                    <input type="number" name="total_barang" class="form-control mb-3" required>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn text-muted font-weight-bold batal-btn mr-4" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn modal-color text-white font-weight-bold">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Rincian Asset Modal -->
<div class="modal fade" id="rincianAssetModal" tabindex="-1" aria-labelledby="rincianAssetLabel" aria-hidden="true">
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
                <div class="modal-color position-relative" style="width: 250px; height: 250px; border: 2px dashed #ccc; border-radius: 5px; overflow: hidden;">
                    <div id="rincian-default-view" style="display: flex; flex-direction: column; align-items: center; justify-content: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; width: 100%; height: 100%;">
                        <i class="fa fa-image fa-3x" style="color: white;"></i>
                    </div>
                    
                    <!-- image  -->
                    <div id="rincian-image-view" style="display: none; height: 100%; width: 100%; position: relative;">
                        <img id="rincian-preview-img" src="" alt="Preview" style="height: 100%; width: 100%; object-fit: contain;">
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
                        <strong style="color: #555; font-size: 16px;">Stok Barang</strong><br>
                        <span style="color: #777; font-size: 14px;" id="rincian-stok">jumlah stok barang</span>
                    </p>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn modal-color text-white font-weight-bold" data-dismiss="modal">Tutup</button>
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
                                    <input type="file" id="updateFileInput" name="gambar_barang"
                                        style="display: none;" accept="image/*" required>
                                </div>

                                <!-- Image Preview -->
                                <div id="update-image-preview" style="display: none; height: 200px; width: 100%; position: relative; padding: 0; margin-bottom: 4px;">
                                    <img id="update-preview-img" src="" alt="Preview"
                                        style="height: 100%; width: 100%; object-fit: contain; position: absolute; top: -20px; left: 0;">
                                    <!-- <h6 id="update-change-btn" class="position-absolute"
                                        style="top: 10px; right: 10px; cursor: pointer; z-index: 10; background-color: rgba(255,255,255,0.7); padding: 3px 6px; border-radius: 3px;">
                                        Click to Change Image
                                    </h6> -->
                                </div>
                            </div>
                    

                    <div class="form-group mb-3">
                        <label class="font-weight-bold" for="update-nama">Nama Barang</label>
                        <select name="nama_barang" id="update-nama" class="form-control" required>
                            <option value="" disabled selected>Pilih Nama Barang...</option>
                            <option value="Sensor">Sensor</option>
                            <option value="Actuator">Actuator</option>
                            <option value="Power">Power</option>
                            <option value="Equipment">Equipment</option>
                        </select>
                    </div>

                    <label class="font-weight-bold">Harga Jual Barang</label>
                    <input type="number" name="harga_jual_barang" id="update-harga" class="form-control mb-3" required>

                    <label class="font-weight-bold">Stok Barang</label>
                    <input type="number" name="total_barang" id="update-stok" class="form-control mb-3" required>
                </div>

                <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn font-weight-bold border px-3 batal-btn mr-4"  data-dismiss="modal">Batal</button>

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
                    <button type="button" class="btn btn-link text-muted font-weight-bold batal-btn mr-4" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn modal-color text-white font-weight-bold">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
    // Untuk modal "Tambah"
    document.getElementById("image-upload-container").addEventListener("click", function () {
        document.getElementById("fileInput").click();
    });

    // Preview gambar
    document.getElementById("fileInput").addEventListener("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                document.getElementById("preview-img").src = event.target.result;
                document.getElementById("image-preview").style.display = "block";
                document.getElementById("upload-button-view").style.display = "none";
            };
            reader.readAsDataURL(file);
        }
    });

    // Untuk modal "Update"
    document.getElementById("update-image-container").addEventListener("click", function () {
        document.getElementById("updateFileInput").click();
    });

    document.getElementById("updateFileInput").addEventListener("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                document.getElementById("update-preview-img").src = event.target.result;
                document.getElementById("update-image-preview").style.display = "block";
                document.getElementById("update-button-view").style.display = "none";
            };
            reader.readAsDataURL(file);
        }
    });

    // Tombol Update - Isi otomatis modal
    document.querySelectorAll('.btn-update').forEach(button => {
        button.addEventListener('click', function () {
            // Ambil data dari tombol
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const harga = this.dataset.harga;
            const stok = this.dataset.stok;
            const gambar = this.dataset.gambar;
            const url = this.dataset.url;

            // Isi form di modal
            document.getElementById('update-id').value = id;
            document.getElementById('update-nama').value = nama;
            document.getElementById('update-harga').value = harga;
            document.getElementById('update-stok').value = stok;

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

    

</script>

@endsection
