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


</style>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 heading-text">ASSET BARANG BARU</h1>
    <p class="mb-4 heading-text">Tabel asset barang baru adalah tabel yang berisikan informasi terkait barang baru</p>

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
                            <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable">
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
                           @foreach ($barang as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('storage/' . $item->gambar_barang) }}" alt="Gambar" class="img-fluid" style="max-width: 100px; height: auto;">
                                </div>
                            </td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>Rp {{ number_format($item->harga_jual_barang, 0, ',', '.') }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td class="px-3">

                                <div class="d-flex flex-wrap justify-content-center">
                                    <button class="btn btn-sm btn-success m-1 btn-tambah"
                                        data-id="{{ $item->id }}"
                                        data-nama="{{ $item->nama_barang }}"
                                        data-harga="{{ $item->harga_jual_barang }}"
                                        data-stok="{{ $item->total_barang }}"
                                        data-gambar="{{ $item->gambar_barang }}">
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
                                        data-stok="{{ $item->stok_barang }}"
                                        data-gambar="{{ asset('storage/' . $item->gambar_barang) }}"
                                        data-toggle="modal"
                                        data-target="#rincianAssetModal">
                                        <i class="fa fa-eye"></i> Rincian
                                    </button>
                                    <button
                                        class="btn btn-sm btn-warning m-1 btn-update"
                                        data-id="{{ $item->id }}"
                                        data-nama="{{ $item->nama_barang }}"
                                        data-harga="{{ $item->harga_jual_barang }}"
                                        data-stok="{{ $item->total_barang }}"
                                        data-gambar="{{ asset('storage/' . $item->gambar_barang) }}"
                                        data-url="{{ route('aset_barang.update', $item->id) }}"
                                        data-toggle="modal"
                                        data-target="#updateAssetModal">
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
                        Showing {{ $barang->firstItem() }} to {{ $barang->lastItem() }} of {{ $barang->total() }} entries
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers">
                        <ul class="pagination justify-content-end">
                            {{-- Tombol Previous --}}
                            <li class="paginate_button page-item {{ $barang->onFirstPage() ? 'disabled' : '' }}">
                                <a href="{{ $barang->previousPageUrl() ?? '#' }}" class="page-link">Previous</a>
                            </li>

                            {{-- Nomor Halaman --}}
                            @for ($i = 1; $i <= $barang->lastPage(); $i++)
                                <li class="paginate_button page-item {{ $i == $barang->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $barang->url($i) }}" class="page-link">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Tombol Next --}}
                            <li class="paginate_button page-item {{ $barang->hasMorePages() ? '' : 'disabled' }}">
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
                                        style="display: none;" accept="image/*">
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

<script>
    // Tombol Rincian - Isi otomatis modal dengan data
    document.querySelectorAll('.rincian-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const harga = this.dataset.harga;
            const stok = this.dataset.stok;
            const gambar = this.dataset.gambar;

            console.log(stok)

            $('#rincianAssetModal').on('shown.bs.modal', function () {
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

    // Tombol Delete - Isi otomatis modal dan set form action
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const url = this.dataset.url;

            // Tampilkan nama di modal
            document.getElementById('delete-item-name').innerText = `Apakah kamu yakin ingin menghapus "${nama}"?`;

            // Set form action
            const deleteForm = document.querySelector('#deleteAssetModal form');
            deleteForm.action = url;

            // Set ID hidden (opsional, kalau diperlukan)
            document.getElementById('delete-id').value = id;
        });
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

  document.addEventListener("click", function (event) {
    if (event.target.closest(".btn-tambah")) {
        let button = event.target.closest(".btn-tambah");

        let data = {
            nama_barang: button.getAttribute("data-nama"),
            harga_jual_barang: parseInt(button.getAttribute("data-harga")),
            total_barang: parseInt(button.getAttribute("data-stok")),
            gambar_barang: button.getAttribute("data-gambar"),
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

  document.addEventListener("click", function (event) {
    if (event.target.closest(".btn-kurangi")) {
        let button = event.target.closest(".btn-kurangi");
        let namaBarang = button.getAttribute("data-nama");

        fetch("{{ route('aset_barang.deleteOne', ':nama_barang') }}".replace(':nama_barang', encodeURIComponent(namaBarang)), {
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
