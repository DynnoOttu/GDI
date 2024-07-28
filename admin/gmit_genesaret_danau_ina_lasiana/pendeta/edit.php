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

            <?php
            $id = &$_GET['id'];
            $sql_jemaat = mysqli_query($con, "SELECT * FROM pendeta WHERE id_pendeta = '$id'") or die(mysqli_error($con));
            $data = mysqli_fetch_array($sql_jemaat);

            ?>

            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Pendeta</h4>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="id_periode" class="col-sm-2 text-start control-label col-form-label">Periode</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id" value="<?= $data['id_pendeta'] ?>">
                                <input type="text" name="id_periode" class="form-control" id="id_periode" placeholder="Periode" value="<?= $data['id_periode'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_pendeta" class="col-sm-2 text-start control-label col-form-label">Nama Pendeta</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_pendeta" class="form-control" id="nama_pendeta" placeholder="Nama Pendeta" value="<?= $data['nama_pendeta'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_menjabat" class="col-sm-2 text-start control-label col-form-label">Tanggal Menjabat</label>
                            <div class="col-sm-9">
                                <input type="text" name="tanggal_menjabat" class="form-control" id="tanggal_menjabat" placeholder="Tanggal Menjabat" value="<?= $data['tanggal_menjabat'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_jabatan_berakhir" class="col-sm-2 text-start control-label col-form-label">Tanggal Jabatan Berakhir</label>
                            <div class="col-sm-9">
                                <input type="text" name="tanggal_jabatan_berakhir" class="form-control" id="tanggal_jabatan_berakhir" placeholder="Tanggal Jabatan Berakhir" value="<?= $data['tanggal_jabatan_berakhir'] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <a href="data.php"><button type="button" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Kembali</button></a>
                        <button type="submit" name="edit" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?php require_once('../_footer.php') ?>