<?php include '../_header.php' ?>

<?php
// Ambil kategori dari sesi
$kategori = isset($_SESSION['kategori']) ? $_SESSION['kategori'] : '';

// Cek kategori dan hak akses
// Misalnya, hanya Admin dan Ketua Majelis yang dapat mengakses halaman ini
if ($kategori !== 'Admin') {
    http_response_code(403); // Set status kode HTTP 403 (Forbidden)
    echo "<script>window.location='" . base_url('akses-ditolak.php') . "';</script>";
    exit; // Pastikan eksekusi berhenti setelah redirect
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="card-body mb-1">
                            <h5 class="card-title mb-0"><i class="fas fa-table"></i>Data Jemaat</h5>
                            <a href="tambah.php" class="btn btn-info mt-3"><i class="fas fa-plus"></i> Tambah Data</a>
                            <!-- <a href="import.php" class="btn btn-success mt-3"><i class="fas fa-file-excel"></i> Import Excel</a> -->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="pendeta" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Periode</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tanggal Menjabat</th>
                                    <th scope="col">Tanggal Jabatan Berahkir</th>
                                    <th scope="col">
                                        <i class="fas fa-cog"></i>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <?php include '../_footer.php' ?>
            <script>
                $(document).ready(function() {
                    $('#pendeta').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: 'script_server_side.php',
                        scrollY: '250px',
                        dom: 'Bfrtip',
                        button: [{
                                extend: 'pdf',
                                oriented: 'potrait',
                                pageSize: 'Legal',
                                title: 'Data Pendeta',
                                download: 'open'


                            },
                            'csv', 'excel', 'print', 'copy'
                        ],
                        columnDefs: [{
                            "searchable": false,
                            "orderable": false,
                            "targets": 4,
                            "render": function(data, type, row) {
                                let btn = "<center><a href = 'edit.php?id=" + data + "' style='margin-right: 2px; margin-left: -10px;' class='btn-sm btn-warning'><i class='fas fa-edit'></i></a><a href = 'hapus.php?id=" + data + "' onclick=\"return confirm('Data Akan Dihapus?')\" class='btn-sm btn-danger'><i class='fas fa-trash'></i></a></center>";
                                return btn;
                            }
                        }],
                        "order": [0, "desc"]
                    });
                });
            </script>