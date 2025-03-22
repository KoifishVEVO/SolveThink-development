
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

<div class="table-container">
        <h2 class="fw-bold heading-text"></h2>
        <p class=" heading-text">{{ $headingText }}</p>
        
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
                        <label for="search">Search:</label>
                        <input type="text" id="search" class="form-control d-inline w-auto">
                    </div>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addAssetModal">Tambah</button>
                </div>
                </div>
                
                <!-- main table -->
                <table class="table ">
                    <thead >
                        <tr>
                            <th scope = "col">id</th>
                            <th>Gambar Barang</th>
                            <th>Nama Barang</th>
                            <th>Stok Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id = "table-body">
                        <!-- sample rows -->
                        <tr>
                            <td>1</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('assets/images/solvethink_transparent.png') }}" alt="Gambar"
                                        class="img-fluid" style="max-width: 150px; height: auto;">
                                </div>
                            </td>
                            <td>Nama barang 01</td>
                            <td>Stok barang 01</td>
                            <td class= "px-3 d-flex align-items-center justify-content-center border-0">
                                <button class="btn btn-sm rincian-btn ml-3" data-toggle="modal" data-target="#rincianAssetModal">
                                <i class="fa fa-eye"></i>
                                Rincian
                                </button>
                                <button class="btn btn-sm btn-warning ml-3" data-toggle="modal" data-target="#updateAssetModal">Update</button>
                                <button class="btn btn-sm btn-danger ml-3" data-toggle="modal" data-target="#deleteAssetModal">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <p id="showing-info">Showing 1 to 10 of 20 entries</p>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#" id="prev">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- end of card -->
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
            <div class="modal-body">
                <!-- Drag & Drop Area -->
                <div id="drop-add" class="drop-zone">
                    <i class="fa fa-image" style="font-size: 24px; display: block; margin-bottom: 10px;"></i>
                    <div style="font-size: 16px; font-weight: bold;">Drag&Drop foto di siasdasdsani</div>
                    <input type="file" id="fileInput" name="image_file" style="display: none;" accept="image/*">
                </div>
                
                <!-- OR Divider -->
                <div class="d-flex align-items-center my-3">
                    <div class="flex-grow-1 border-top mx-2"></div>
                    <span class="text-muted font-weight-bold">Atau</span>
                    <div class="flex-grow-1 border-top mx-2"></div>
                </div>

                <!-- Input for Direct Image URL -->
                <input type="text" name="image_url" class="form-control mb-3" placeholder="Ketikan link foto di sini...">

                <!-- Other Inputs -->
                <input type="text" name="nama_barang" class="form-control mb-3" placeholder="Nama Barang">
                <input type="number" name="stok_barang" class="form-control mb-3" placeholder="Stok Barang">
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn modal-color text-white font-weight-bold">Tambah</button>
            </div>
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

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Drag & Drop Area -->
                <div class="drop-zone d-flex flex-column align-items-center justify-content-center">
                    <i class="fa fa-image fa-2x"></i>
                    <p class="mt-2 font-weight-bold">Drag & Drop foto di siniasdsadsa</p>
                </div>

                <!-- OR Divider -->
                <div class="d-flex align-items-center my-3">
                    <div class="flex-grow-1 border-top mx-2"></div>
                    <span class="text-muted font-weight-bold">Atau</span>
                    <div class="flex-grow-1 border-top mx-2"></div>
                </div>

                <input type="text" class="form-control mb-3" placeholder="Ketikan link foto di sini...">

                <label class="font-weight-bold">Nama Barang</label>
                <input type="text" class="form-control mb-3" id="updateNamaBarang">

                <label class="font-weight-bold">Stok Barang</label>
                <input type="number" class="form-control" id="updateStokBarang">
            </div>

            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-link text-muted font-weight-bold" data-dismiss="modal">Batal</button>
                <button type="button" class="btn modal-color text-white font-weight-bold">Simpan</button>
            </div>
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

            <!-- body -->
            <div class="modal-body">
                <p class="delete-text text-center">Konfirmasi Hapus Data Asset Barang</p>
            </div>

            <!-- footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-link text-muted font-weight-bold" data-dismiss="modal">Batal</button>
                <button type="button" class="btn modal-color text-white font-weight-bold">Hapus</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

