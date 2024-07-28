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
            $sql_jemaat = mysqli_query($con, "SELECT * FROM rayon WHERE id_rayon = '$id'") or die(mysqli_error($con));
            $data = mysqli_fetch_array($sql_jemaat);

            ?>

            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Rayon</h4>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="status_jemaat" class="col-sm-2 text-start control-label col-form-label">Rayon</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id" value="<?= $data['id_rayon'] ?>">
                                <input type="text" name="rayon" class="form-control" id="rayon" placeholder="Rayon" value="<?= $data['rayon'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="status_jemaat" class="col-sm-2 text-start control-label col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id" value="<?= $data['id_rayon'] ?>">
                                <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan" value="<?= $data['keterangan'] ?>" required>
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