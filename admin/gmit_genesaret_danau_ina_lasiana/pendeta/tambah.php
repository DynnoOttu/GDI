<?php require_once('../_header.php') ?>

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
    <div class="col-md-12">
        <div class="card">
            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data Pendeta</h4>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="id_periode" class="col-sm-2 text-start control-label col-form-label">Periode</label>
                            <div class="col-sm-9">
                                <input type="text" name="id_periode" class="form-control" id="id_periode" placeholder="Periode" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 text-start control-label col-form-label">Nama Pendeta</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_pendeta" class="form-control" id="nama" placeholder="Nama Pendeta" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_menjabat" class="col-sm-2 text-start control-label col-form-label">Tanggal Menjabat</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal_menjabat" class="form-control" id="id_pendeta" placeholder="Tanggal Menjabat" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_jabatan_berakhir" class="col-sm-2 text-start control-label col-form-label">Tanggal Jabatan Berahkir</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal_jabatan_berakhir" class="form-control" id="tanggal_jabatan_berakhir" placeholder="Tanggal Jabatan Berahkir" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <a href="data.php"><button type="button" class="btn btn-warning"><i class=" fas fa-arrow-left"></i> Kembali</button></a>
                        <button type="submit" name="tambah" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../_footer.php') ?>