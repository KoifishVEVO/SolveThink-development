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
                        <label for="search">Search:</label>
                        <input type="text" id="search" class="form-control d-inline w-auto">
                    </div>
                    <button class="btn btn-success" data-toggle="modal" data-target="#addAssetModal">Tambah</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
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