@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('styles')


@endsection

@section('content')

<x-rincian-barang/>
        

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
        const dropZone = document.getElementById("drop-add");
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

