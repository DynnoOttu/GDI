<?php require_once('../_header.php'); ?>

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
            $id = $_GET['id'];
            $query = mysqli_query($con, "SELECT * FROM kordinator WHERE id_kordinator = '$id'") or die(mysqli_error($con));
            $data = mysqli_fetch_assoc($query);
            ?>
            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Kordinator</h4>
                    <div class="tabel">
                        <input type="hidden" name="id_kordinator" value="<?= $data['id_kordinator'] ?>">
                        <div class="form-group row">
                            <label for="id_majelis" class="col-sm-2 text-start control-label col-form-label">Majelis</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_majelis" id="id_majelis" required>
                                    <option value="">Pilih Majelis</option>
                                    <?php
                                    $result_majelis = mysqli_query($con, "SELECT id_majelis, jabatan FROM majelis");
                                    while ($row_majelis = mysqli_fetch_assoc($result_majelis)) {
                                        echo "<option value='" . $row_majelis['id_majelis'] . "' " . ($row_majelis['id_majelis'] == $data['id_majelis'] ? 'selected' : '') . ">" . $row_majelis['jabatan'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_rayon" class="col-sm-2 text-start control-label col-form-label">Rayon</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_rayon" id="id_rayon" required>
                                    <option value="">Pilih Rayon</option>
                                    <?php
                                    $result_rayon = mysqli_query($con, "SELECT id_rayon, rayon FROM rayon");
                                    while ($row_rayon = mysqli_fetch_assoc($result_rayon)) {
                                        echo "<option value='" . $row_rayon['id_rayon'] . "' " . ($row_rayon['id_rayon'] == $data['id_rayon'] ? 'selected' : '') . ">" . $row_rayon['rayon'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_kordinator" class="col-sm-2 text-start control-label col-form-label">Nama Kordinator</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_kordinator" class="form-control" id="nama_kordinator" placeholder="Nama Kordinator" value="<?= $data['nama_kordinator'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 text-start control-label col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat" value="<?= $data['alamat'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 text-start control-label col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="status" id="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif" <?= $data['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="Tidak Aktif" <?= $data['status'] == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telepon" class="col-sm-2 text-start control-label col-form-label">Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" name="telepon" class="form-control" id="telepon" placeholder="Telepon" value="<?= $data['telepon'] ?>" required>
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
<?php require_once('../_footer.php'); ?>