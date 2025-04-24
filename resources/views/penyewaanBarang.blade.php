@extends('layouts.dashboard')

@section('title')
    penyewaanBarang
@endsection

@section('styles')
@endsection

@section('content')

<style>
    .heading-text {
            color: #272780 !important;
            font-weight: bold !important;
        }
    .card-color {
        background-color: #2B2684; /* Color from screenshot header */
        border-color: #2B2684;
    }
    .modal-color {
         background-color: #2B2684; /* Modal Header/Button Color */
         border-color: #2B2684;
    }
    .batal-btn {
        border-color: #2B2684;
        color: #2B2684;
    }
    .batal-btn:hover {
        background-color: #2B2684;
        color: white;
    }
    /* buttons */
    .btn-success {
            background-color: #00B634 !important;
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

        .btn-kurangi,
        .btn-tambah {
            background-color: #272780;
            color: white;
            font-size: 1rem;
            /* <-- REDUCED from 1.2rem */
            font-weight: bold;
            width: 35px;
            /* <-- OPTIONAL: Reduced width */
            height: 30px;
            /* <-- REDUCED from 40px */
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            box-sizing: border-box;
            transition: background-color 0.3s ease;
            line-height: 1;
            /* Helps center icons vertically */
            cursor: pointer;
            /* Add pointer cursor */
        }

        .btn-kurangi {
            /* Match container radius on the left */
            border-radius: 8px 0 0 8px;
        }

        .btn-tambah {
            /* Match container radius on the right */
            border-radius: 0 8px 8px 0;
        }
        .btn-filter{
            background-color: #A9B5DF !important;
            color: white !important;
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

    .delete-text {
        color: #858796; /* Subdued text color for confirmation */
    }
     /* Adjust button spacing and alignment if needed */
    .aksi-buttons .btn {
         margin-right: 5px; /* Add some space between buttons */
    }
    .aksi-buttons .btn:last-child {
         margin-right: 0;
    }
     /* Style for bukti buttons */
     .btn-bukti {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background-color: white;
        color: #1b2e91; /* Biru tua */
        border: 2px solid #1b2e91;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: 0.2s ease-in-out;
    }

    .btn-bukti i {
        font-size: 1rem;
    }

    .btn-bukti:hover {
        background-color: #f0f4ff; 
        border-color: #1b2e91;
        color: #1b2e91;
        text-decoration: none;
    }
    .btn-bukti-container {
        display: flex;
        flex-direction: column;
        gap: 8px; 
    }

    /* Style for rental status */

    .status-badge {
    display: inline-flex;
    font-size: 0.75rem;
        padding: 0.3em 0.6em;
        border-radius: 0.25rem;
        font-weight: 600;
    gap: 6px;
}

.status-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    
}

.status-berlangsung .status-dot {
    background-color: #f4b400; /* Yellow-orange */
}

.status-selesai .status-dot {
    background-color: #00c853; /* Green */
}


    .status-berlangsung{
        color:#f4b400
    }
    
    .status-selesai {
      
         color: #00c853; /* Dark green text */
       
    }
    /* Add other statuses as needed */
</style>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


{{-- begin page content --}}
<div class="container-fluid">

    {{-- Page Heading --}}
    <h1 class="h3 mb-2 mt-4 heading-text font-weight-bold">PENYEWAAN BARANG</h1>
    <p class="mb-4 heading-text font-weight-bold">Tabel Penyewaan Barang adalah tabel yang menunjukkan data penyewaan dalam rentang periode tertentu</p>

    {{-- DataTales Example --}}
    <div class="card shadow mb-4">
        <div class="card-header py-5 card-color"> {{-- Adjusted padding --}}
            <h6 class="m-0 font-weight-bold text-white">Data Tabel Penyewaan Barang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    {{-- Top Controls Row: Show Entries, Search, Filter, Tambah --}}
                    <div class="row mb-3 align-items-center">
                         <div class="col-sm-12 col-md-auto"> {{-- Adjust columns for responsiveness --}}
                             <div class="dataTables_length" id="dataTable_length">
                                 <label class="mb-0">Show
                                     <select id="showEntries" name="dataTable_length" aria-controls="dataTable"
                                             class="custom-select custom-select-sm form-control form-control-sm"
                                             style="width: auto; display: inline-block;">
                                         {{-- Placeholder: Link value to backend query limit --}}
                                         {{-- @TODO: Add JS to handle entry limit change and reload data --}}
                                         {{-- @TODO: Check request('limit') to set selected option --}}
                                         <option value="10">10</option>
                                         <option value="25">25</option>
                                         <option value="50">50</option>
                                         <option value="100">100</option>
                                     </select> entries
                                 </label>
                             </div>
                         </div>

                         <div class="col-sm-12 col-md"> {{-- Takes remaining space --}}
                             <div id="dataTable_filter"
                                  class="dataTables_filter d-flex justify-content-md-end align-items-center">
                                  {{-- Search Form --}}
                                 <label class="mr-2 mb-0">Search:
                                     {{-- Placeholder: Link form to backend search --}}
                                     {{-- @TODO: Point action to the correct route for penyewaanBarang search --}}
                                     <form id="searchForm" method="GET" action="{{-- route('penyewaan_barang.index') --}}" class="d-inline">
                                         <input type="search" name="search" value="{{-- request()->search --}}"
                                                class="form-control form-control-sm d-inline-block" style="width: auto;"
                                                aria-controls="dataTable" placeholder="">
                                         {{-- Add hidden input for limit if needed --}}
                                         {{-- <input type="hidden" name="limit" value="{{ request()->limit ?? 10 }}"> --}}
                                     </form>
                                 </label>

                                 {{-- Filter Button (Placeholder) --}}
                                 {{-- @TODO: Link button to Filter Modal or implement filter logic --}}
                                 <button class="btn btn-filter btn-sm ml-2" data-toggle="modal" data-target="#filterPenyewaanModal">Filter</button>

                                 {{-- Tambah Button --}}
                                 {{-- @TODO: Link button to Add Modal --}}
                                 <button class="btn btn-success btn-sm ml-2" data-toggle="modal" data-target="#addPenyewaanModal">Tambah</button>
                             </div>
                         </div>
                     </div>

                    {{-- Table Row --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th>ID</th>
                                        <th>Informasi Penyewa</th>
                                        <th>Detail Transaksi</th>
                                        <th>Detail Pembayaran</th>
                                        <th>Detail Sewa</th> {{-- New Column --}}
                                        <th>Pengiriman</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    {{-- Placeholder: Loop through $penyewaan data from backend --}}
                                    {{-- Example Dummy Data (Replace with @foreach loop and actual data) --}}
                                    @php
                                        // Dummy data for demonstration
                                        $dummyPenyewaan = [
                                            (object)['id' => 1, 'nama_penyewa' => 'INI NAMA PEMBELI', 'alamat_penyewa' => 'XXXXXXXXXXX', 'barang_disewa' => 'BARANG YANG DISEWA', 'total_harga' => 'RPXXXXXX', 'bukti_pembayaran_url' => '#', 'bukti_ktm_url' => '#', 'tanggal_mulai' => 'DD/MM/YYYY', 'durasi' => 'X Minggu', 'status_sewa' => 'Berlangsung', 'metode_pengiriman' => 'Metode Pengiriman'],
                                            (object)['id' => 2, 'nama_penyewa' => 'INI NAMA PEMBELI', 'alamat_penyewa' => 'XXXXXXXXXXX', 'barang_disewa' => 'BARANG YANG DISEWA', 'total_harga' => 'RPXXXXXX', 'bukti_pembayaran_url' => '#', 'bukti_ktm_url' => null, 'tanggal_mulai' => 'DD/MM/YYYY', 'durasi' => 'X Minggu', 'status_sewa' => 'Berlangsung', 'metode_pengiriman' => 'Metode Pengiriman'], // No KTP
                                            (object)['id' => 3, 'nama_penyewa' => 'INI NAMA PEMBELI', 'alamat_penyewa' => 'XXXXXXXXXXX', 'barang_disewa' => 'BARANG YANG DISEWA', 'total_harga' => 'RPXXXXXX', 'bukti_pembayaran_url' => null, 'bukti_ktm_url' => '#', 'tanggal_mulai' => 'DD/MM/YYYY', 'durasi' => 'X Minggu', 'status_sewa' => 'Berlangsung', 'metode_pengiriman' => 'Metode Pengiriman'], // No Payment proof
                                            (object)['id' => 4, 'nama_penyewa' => 'INI NAMA PEMBELI', 'alamat_penyewa' => 'XXXXXXXXXXX', 'barang_disewa' => 'BARANG YANG DISEWA', 'total_harga' => 'RPXXXXXX', 'bukti_pembayaran_url' => '#', 'bukti_ktm_url' => '#', 'tanggal_mulai' => 'DD/MM/YYYY', 'durasi' => 'X Minggu', 'status_sewa' => 'Selesai', 'metode_pengiriman' => 'Metode Pengiriman'], // Completed status
                                            (object)['id' => 5, 'nama_penyewa' => 'INI NAMA PEMBELI', 'alamat_penyewa' => 'XXXXXXXXXXX', 'barang_disewa' => 'BARANG YANG DISEWA', 'total_harga' => 'RPXXXXXX', 'bukti_pembayaran_url' => '#', 'bukti_ktm_url' => '#', 'tanggal_mulai' => 'DD/MM/YYYY', 'durasi' => 'X Minggu', 'status_sewa' => 'Berlangsung', 'metode_pengiriman' => 'Metode Pengiriman'],
                                        ];
                                         // Dummy Pagination Data (Replace with actual $penyewaan variable from controller)
                                         $penyewaan = new \Illuminate\Pagination\LengthAwarePaginator($dummyPenyewaan, count($dummyPenyewaan), 10, 1); // Example: 5 items, 10 per page, current page 1
                                    @endphp

                                    @forelse ($penyewaan as $item)
                                        <tr role="row" class="{{ $loop->odd ? 'odd' : 'even' }}">
                                            <td>{{ $loop->iteration + $penyewaan->firstItem() - 1 }}</td> {{-- Correct ID based on pagination --}}
                                            <td>
                                                <strong>{{ $item->nama_penyewa }}</strong><br>
                                                <small>{{ $item->alamat_penyewa }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $item->barang_disewa }}</strong><br>
                                                <small>{{ $item->total_harga }}</small>
                                            </td>
                                            <td class="text-center" style="min-width: 130px;"> {{-- Ensure enough width for buttons --}}
                                                {{-- Bukti Pembayaran Button --}}
                                                <div class = "btn-bukti-container">
                                                @if($item->bukti_pembayaran_url)
                                                    <a href="{{ $item->bukti_pembayaran_url }}" target="_blank" class="btn btn-sm btn-bukti">
                                                        <i class="fas fa-receipt"></i> Bukti Pembayaran
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-bukti disabled" disabled>
                                                         <i class="fas fa-receipt"></i> (Belum Ada)
                                                    </button>
                                                @endif
                                                {{-- Bukti KTM/KTP Button --}}
                                                @if($item->bukti_ktm_url)
                                                    <a href="{{ $item->bukti_ktm_url }}" target="_blank" class="btn btn-sm btn-bukti">
                                                        <i class="fas fa-id-card"></i> Bukti KTM/KTP
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm btn-bukti disabled" disabled>
                                                        <i class="fas fa-id-card"></i> (Belum Ada)
                                                    </button>
                                                @endif
                                            </div>
                                            </td>
                                            <td>
                                                {{ $item->tanggal_mulai }}<br> {{-- Assuming tanggal_mulai contains start date --}}
                                                <small>{{ $item->durasi }}</small><br>
                                                {{-- Status Badge --}}
                                                @php
                                                    $statusClass = 'status-berlangsung'; // Default
                                                    if (strtolower($item->status_sewa ?? '') == 'selesai') {
                                                        $statusClass = 'status-selesai';
                                                    }
                                                    // Add more conditions for other statuses
                                                @endphp
                                                @php
                                                $statusClass = 'status-berlangsung'; // Default
                                                if (strtolower($item->status_sewa ?? '') == 'selesai') {
                                                    $statusClass = 'status-selesai';
                                                }
                                            @endphp
                                            <span class="badge status-badge {{ $statusClass }}">
                                                <span class="status-dot"></span> {{ $item->status_sewa ?? 'N/A' }}
                                            </span>
                                            
                                            </td>
                                            <td>{{ $item->metode_pengiriman }}</td>
                                            <td class="px-3 text-center aksi-buttons">
                                                {{-- Action Buttons --}}
                                                <div class="d-inline-block">
                                                    {{-- Rincian Button --}}
                                                    {{-- @TODO: Populate data-* attributes with actual data from $item for penyewaan --}}
                                                    <button class="btn btn-sm rincian-btn m-1"
                                                            data-id="{{ $item->id }}"
                                                            data-penyewa="{{ $item->nama_penyewa }}"
                                                            {{-- Add other necessary data attributes (barang, tanggal, status, urls etc.) --}}
                                                            data-toggle="modal"
                                                            data-target="#rincianPenyewaanModal">
                                                            <i class="fa fa-eye"></i>
                                                        Rincian
                                                    </button>

                                                    {{-- Update Button --}}
                                                     {{-- @TODO: Populate data-* attributes and set correct update URL for penyewaan --}}
                                                    <button class="btn btn-sm btn-warning m-1 btn-update"
                                                            data-id="{{ $item->id }}"
                                                            data-penyewa="{{ $item->nama_penyewa }}"
                                                            {{-- Add other fields to pre-fill the update form --}}
                                                            data-url="{{-- route('penyewaan_barang.update', $item->id) --}}" {{-- Placeholder URL --}}
                                                            data-toggle="modal"
                                                            data-target="#updatePenyewaanModal">
                                                        Update
                                                    </button>

                                                    {{-- Hapus Button --}}
                                                     {{-- @TODO: Populate data-* attributes and set correct delete URL for penyewaan --}}
                                                    <button class="btn btn-sm btn-danger m-1 btn-delete"
                                                            data-id="{{ $item->id }}"
                                                            data-info="Penyewaan ID {{ $item->id }} oleh {{ $item->nama_penyewa }}" {{-- Info for confirmation modal --}}
                                                            data-url="{{-- route('penyewaan_barang.destroy', $item->id) --}}" {{-- Placeholder URL --}}
                                                            data-toggle="modal"
                                                            data-target="#deletePenyewaanModal">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No data available in table</td> {{-- Updated colspan --}}
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination Row --}}
                    {{-- Make sure the $penyewaan variable is a Paginator instance from your Controller --}}
                    <div class="row">
                         <div class="col-sm-12 col-md-5">
                             <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                 Showing {{ $penyewaan->firstItem() ?? 0 }} to {{ $penyewaan->lastItem() ?? 0 }} of {{ $penyewaan->total() }} entries {{-- Handle empty data --}}
                             </div>
                         </div>
                         <div class="col-sm-12 col-md-7">
                             <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                 {{-- Render pagination links, append search/filter query if exists --}}
                                 {{-- {{ $penyewaan->appends(request()->query())->links('pagination::bootstrap-4') }} --}}
                                 {{ $penyewaan->links('pagination::bootstrap-4') }} {{-- Use the dummy paginator for display --}}
                             </div>
                         </div>
                     </div>

                </div>
            </div>
        </div>
    </div>

</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>

</script>

</script>
@endsection