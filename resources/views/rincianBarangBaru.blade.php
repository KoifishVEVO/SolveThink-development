@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container mt-4">
        <h2 class="fw-bold text-primary">ASSET BARANG BARU</h2>
        <p class="text-secondary">Tabel asset barang baru adalah tabel yang berisikan informasi terkait barang baru</p>
        
        <div class="card">
            <div class="card-header bg-primary text-white">
                <strong>Data Tabel Asset Barang Baru</strong>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <!-- entries -->
                        <label for="showEntries">Show</label>
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
                <table class="table table-bordered">
                    <thead >
                        <tr>
                            <th>id</th>
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
                            <td><img src="placeholder.png" alt="Gambar" class="img-thumbnail" width="50"></td>
                            <td>Nama barang 01</td>
                            <td>Stok barang 01</td>
                            <td>
                                <button class="btn btn-sm btn-primary rincian-btn" data-toggle="modal" data-target="#rincianAssetModal">Rincian</button>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#updateAssetModal">Update</button>
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteAssetModal">Hapus</button>
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
     <!-- add asset -->
     <div class="modal fade" id="addAssetModal" tabindex="-1" role="dialog" aria-labelledby="addAssetLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addAssetLabel">Tambah Asset Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Drag & Drop Area -->
                <div id="drop-zone" class="text-center border border-dashed p-4 bg-primary text-white">
                    <i class="bi bi-image"></i>
                    <p class="mb-0">Drag & Drop foto di sini</p>
                    <input type="file" id="fileInput" name="image_file" class="d-none" accept="image/*">
                </div>
                
                <!-- Hidden File Input Trigger -->
                <p class="text-center text-muted mt-2">Atau</p>

                <!-- Input for Direct Image URL -->
                <input type="text" name="image_url" class="form-control mb-3" placeholder="Ketikan link foto di sini...">

                <!-- Other Inputs -->
                <input type="text" name="nama_barang" class="form-control mb-3" placeholder="Nama Barang">
                <input type="number" name="stok_barang" class="form-control mb-3" placeholder="Stok Barang">
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>

<!-- Rincian Asset Modal -->
<div class="modal fade" id="rincianAssetModal" tabindex="-1" aria-labelledby="rincianAssetLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="rincianAssetLabel">Rincian Asset Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex">
                <div class="border border-dashed bg-primary text-white d-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                    <i class="bi bi-image"></i>
                </div>
                <div class="ml-4">
                    <p><strong>id Barang</strong><br><span class="text-muted" id="rincian-id">nomor id barang</span></p>
                    <p><strong>Nama Barang</strong><br><span class="text-muted" id="rincian-nama">nama barang</span></p>
                    <p><strong>Stok Barang</strong><br><span class="text-muted" id="rincian-stok">jumlah stok barang</span></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Asset Modal -->
<div class="modal fade" id="updateAssetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Update Asset Barang</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Drag & Drop Area -->
                <div class="text-center p-3 bg-primary text-white d-flex flex-column align-items-center justify-content-center"
                     style="border: 2px dashed white; border-radius: 5px;">
                    <i class="fa fa-image fa-2x"></i>
                    <p class="mt-2 font-weight-bold">Drag & Drop foto di sini</p>
                </div>

                <!-- OR Divider -->
                <div class="d-flex align-items-center my-3">
                    <div class="flex-grow-1 border-top mx-2"></div>
                    <span class="text-muted">Atau</span>
                    <div class="flex-grow-1 border-top mx-2"></div>
                </div>

                <input type="text" class="form-control mb-3" placeholder="Ketikan link foto di sini...">

                <label>Nama Barang</label>
                <input type="text" class="form-control mb-3" id="updateNamaBarang">

                <label>Stok Barang</label>
                <input type="number" class="form-control" id="updateStokBarang">
            </div>

            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

    <!-- Delete Asset Modal -->
     <div class = "modal fade" id="deleteAssetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- header -->
                <div class="modal-header bg-primary text-white">
                    Hapus Asset Barang
                </div>

                <!-- body -->
                <div class="modal-body">
                    Konfirmasi Hapus Data Asset Barang
                </div>

                <!-- footer -->
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-link text-muted" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Hapus</button>
                </div>
            </div>
        </div>
    </div>

<!-- FontAwesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <script>
        // rendering table
        let items = [];
        for (let i = 1; i <= 50; i++) {
            items.push({ id: i, name: `Nama Barang ${i}`, stock: `Stok ${i}` });
        }

        let currentPage = 1;
        let entriesPerPage = 10;

        function renderTable() {
            let searchQuery = document.getElementById("search").value.toLowerCase();
            let filteredItems = items.filter(item => item.name.toLowerCase().includes(searchQuery));
            let start = (currentPage - 1) * entriesPerPage;
            let end = start + entriesPerPage;
            let paginatedItems = filteredItems.slice(start, end);

            document.getElementById("table-body").innerHTML = paginatedItems.map(item => `
                <tr>
                    <td>${item.id}</td>
                    <td><img src="placeholder.jpg" alt="Image" width="50"></td>
                    <td>${item.name}</td>
                    <td>${item.stock}</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Rincian</button>
                        <button class="btn btn-warning btn-sm">Update</button>
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            `).join('');
            
            document.getElementById("showing-info").innerText = `Showing ${start + 1} to ${Math.min(end, filteredItems.length)} of ${filteredItems.length} entries`;
        }

        document.getElementById("entries").addEventListener("change", function() {
            entriesPerPage = parseInt(this.value);
            currentPage = 1;
            renderTable();
        });

        document.getElementById("search").addEventListener("input", renderTable);
        
        document.getElementById("prev").addEventListener("click", function(e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });
        
        document.getElementById("next").addEventListener("click", function(e) {
            e.preventDefault();
            let maxPage = Math.ceil(items.length / entriesPerPage);
            if (currentPage < maxPage) {
                currentPage++;
                renderTable();
            }
        });

        renderTable();


        // image
        document.addEventListener("DOMContentLoaded", function () {
        const dropZone = document.getElementById("drop-zone");
        const fileInput = document.getElementById("fileInput");

        // Click to open file selector
        dropZone.addEventListener("click", () => fileInput.click());

        // Drag & Drop Functionality
        dropZone.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropZone.classList.add("border-success");
        });

        dropZone.addEventListener("dragleave", () => {
            dropZone.classList.remove("border-success");
        });

        dropZone.addEventListener("drop", (e) => {
            e.preventDefault();
            dropZone.classList.remove("border-success");
            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
            }
        });
    });
    </script>
@endsection

