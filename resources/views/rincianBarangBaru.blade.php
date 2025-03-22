@extends('layouts.dashboard')

@section('title')
    HargaJualBarang
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
    font-weight: bold !important;
    border-radius: 5px !important;

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
</style>

<<<<<<< Updated upstream
<div class="table-container">
        <h2 class="fw-bold heading-text">ASSET BARANG BARU</h2>
        <p class=" heading-text">Tabel asset barang baru adalah tabel yang berisikan informasi terkait barang baru</p>
        
        <div class="card">
            <div class="card-header card-color text-white">
                <strong>Data Tabel Asset Barang Baru</strong>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <!-- entries -->
                        <label for="showEntries" >Show</label>
                        <select id="showEntries" class="form-select d-inline w-auto">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select> entries
                    </div>
                    <!-- search -->
                    <div class="d-flex gap-2">
                    <div class = "mr-3">
=======
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 heading-text">ASSET BARANG BARU</h1>
    <p class="mb-4 heading-text">Tabel asset barang baru adalah tabel yang berisikan informasi terkait barang baru</p>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 card-color">
            <h6 class="m-0 font-weight-bold text-white">Data Tabel Asset Barang Baru</h6>
        </div>
        <div class="card-body">
            <div class="table-controls d-sm-flex justify-content-between align-items-center mb-3">
                <div class="entries-container">
                    <label for="showEntries">Show</label>
                    <select id="showEntries" class="entries mx-2">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>entries</span>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <div class="search-container mr-2">
>>>>>>> Stashed changes
                        <label for="search">Search:</label>
                        <input type="text" id="search" class="form-control d-inline w-auto">
                    </div>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addAssetModal">Tambah</button>
                </div>
<<<<<<< Updated upstream
                </div>
                
                <!-- main table -->
                <table class="table ">
                    <thead >
=======
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
>>>>>>> Stashed changes
                        <tr>
                            <th>ID</th>
                            <th>Gambar Barang</th>
                            <th>Nama Barang</th>
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
                            <td>Stok barang 01</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm rincian-btn" data-toggle="modal" data-target="#rincianAssetModal">
                                        <i class="fa fa-eye"></i> Rincian
                                    </button>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#updateAssetModal">Update</button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteAssetModal">Hapus</button>
                                </div>
                            </td>
                        </tr>
<<<<<<< Updated upstream
                        
=======
>>>>>>> Stashed changes
                    </tbody>
                </table>
            </div>
            
            <div class="d-sm-flex justify-content-between align-items-center">
                <p id="showing-info">Showing 1 to 10 of 20 entries</p>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" id="prev" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" id="next" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
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
            
            <form action="#" method="POST" enctype="multipart/form-data">
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
                        <div id="image-preview" style="display: none; height: 100%; width: 100%;">
                            <img id="preview-img" src="" alt="Preview" 
                                style="max-height: 100%; max-width: 100%; object-fit: contain;">
                            <h6 id="change-image-btn" class="position-absolute" 
                                style="top: 10px; right: 10px; cursor: pointer;">
                                Click to Change Image
                            </h6>
                        </div>
                    </div>

                    
                    <!-- Other Inputs -->
                    <label class="font-weight-bold">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control mb-3" required>
                    
                    <label class="font-weight-bold">Harga Jual Barang</label>
                    <input type="number" name="harga_jual_barang" class="form-control mb-3" required>
                    
                    <label class="font-weight-bold">Stok Barang</label>
                    <input type="number" name="total_barang" class="form-control mb-3" required>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-link text-muted font-weight-bold" data-dismiss="modal">Batal</button>
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
                <!-- images -->
                <div class="drop-zone" style="width: 250px; height: 250px; padding: 0; display: flex; align-items: center; justify-content: center;">
                    <i class="fa fa-image fa-3x" style="color: white;"></i>
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
                    <!-- Image Upload Area -->
                    <div id="update-image-container" class="modal-color position-relative mb-4" 
                        style="border: 2px dashed #ccc; border-radius: 5px; padding: 20px; text-align: center; 
                            background-color: #f8f9fa; height: 200px; overflow: hidden; cursor: pointer;">
                        <!-- Clickable Area -->
                        <div id="update-button-view" style="display: flex; flex-direction: column; align-items: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <i class="fa fa-image" style="font-size: 24px; margin-bottom: 10px; color: #FFFFFF"></i>
                            <div style="font-size: 16px; font-weight: bold; color: #FFFFFF">Click to Select Image</div>
                            <input type="file" id="updateFileInput" name="gambar_barang" style="display: none;" accept="image/*">
                        </div>
                        
                        <div id="update-image-preview" style="display: none; height: 100%; width: 100%;">
                            <img id="update-preview-img" src="" alt="Preview" 
                                style="max-height: 100%; max-width: 100%; object-fit: contain;">
                            <h6 id="update-change-btn" class="position-absolute" 
                                style="top: 10px; right: 10px;">
                                Click to Change Image
                            </h6>
                        </div>
                    </div>

                    <label class="font-weight-bold">Nama Barang</label>
                    <input type="text" name="nama_barang" id="update-nama" class="form-control mb-3" required>
                    
                    <label class="font-weight-bold">Harga Jual Barang</label>
                    <input type="number" name="harga_jual_barang" id="update-harga" class="form-control mb-3" required>
                    
                    <label class="font-weight-bold">Stok Barang</label>
                    <input type="number" name="total_barang" id="update-stok" class="form-control mb-3" required>
                </div>

                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-link text-muted font-weight-bold" data-dismiss="modal">Batal</button>
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
                    <button type="button" class="btn btn-link text-muted font-weight-bold" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn modal-color text-white font-weight-bold">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


@endsection
