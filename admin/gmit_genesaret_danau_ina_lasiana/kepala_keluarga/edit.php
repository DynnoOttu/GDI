<?php require_once('../_header.php'); ?>


<?php
// Ambil kategori dari sesi
$kategori = isset($_SESSION['kategori']) ? $_SESSION['kategori'] : '';

// Cek kategori dan hak akses
// Misalnya, hanya Admin dan Ketua Majelis yang dapat mengakses halaman ini
if ($kategori !== 'Admin' && $kategori !== 'Kordinator') {
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
            $sql_kepala_keluarga = mysqli_query($con, "SELECT * FROM kepala_keluarga WHERE id_kepala_keluarga = '$id'") or die(mysqli_error($con));
            $data = mysqli_fetch_array($sql_kepala_keluarga);
            ?>
            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Update Data Kepala Keluarga</h4>
                    <div class="tabel">
                        <input type="hidden" name="id_kepala_keluarga" value="<?php echo $data['id_kepala_keluarga']; ?>">
                        <div class="form-group row">
                            <label for="id_rayon" class="col-sm-2 text-start control-label col-form-label">Rayon</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_rayon" id="id_rayon" required>
                                    <option value="">Pilih Rayon</option>
                                    <?php
                                    $result = mysqli_query($con, "SELECT id_rayon, rayon FROM rayon");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = ($data['id_rayon'] == $row['id_rayon']) ? 'selected' : '';
                                        echo "<option value='" . $row['id_rayon'] . "' $selected>" . $row['rayon'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_kk" class="col-sm-2 text-start control-label col-form-label">Jenis KK</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="jenis_kk" id="jenis_kk" required>
                                    <option value="">Pilih Jenis KK</option>
                                    <option value="Rumah" <?php echo ($data['jenis_kk'] == 'Rumah') ? 'selected' : ''; ?>>Rumah</option>
                                    <option value="asrama" <?php echo ($data['jenis_kk'] == 'asrama') ? 'selected' : ''; ?>>Asrama</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nomor_kk" class="col-sm-2 text-start control-label col-form-label">Nomor KK</label>
                            <div class="col-sm-9">
                                <input type="text" name="nomor_kk" class="form-control" id="nomor_kk" placeholder="Nomor KK" value="<?php echo $data['nomor_kk']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 text-start control-label col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat" value="<?php echo $data['alamat']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_asrama" class="col-sm-2 text-start control-label col-form-label">Nama Asrama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_asrama" class="form-control" id="nama_asrama" placeholder="Nama Asrama" value="<?php echo $data['nama_asrama']; ?>">
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