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
            $sql_jemaat = mysqli_query($con, "SELECT * FROM periode WHERE id_periode = '$id'") or die(mysqli_error($con));
            $data = mysqli_fetch_array($sql_jemaat);

            ?>

            <form class="form-horizontal" action="proses_edit.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Periode</h4>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="id_pendeta" class="col-sm-2 text-start control-label col-form-label">Nama Pendeta</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_pendeta" id="id_pendeta" required>
                                    <option value="">Pilih Nama Pendeta</option>
                                    <?php
                                    // Ambil ID pendeta dari tabel dan tampilkan nama
                                    $result_pendeta = mysqli_query($con, "SELECT id_pendeta, nama_pendeta FROM pendeta");
                                    while ($row_pendeta = mysqli_fetch_assoc($result_pendeta)) {
                                        // Pilih nilai yang sesuai dengan data yang ada
                                        $selected = ($row_pendeta['id_pendeta'] == $data['id_pendeta']) ? "selected" : "";
                                        echo "<option value='" . $row_pendeta['id_pendeta'] . "' $selected>" . $row_pendeta['nama_pendeta'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan_majelis" class="col-sm-2 text-start control-label col-form-label">Jabatan Majelis</label>
                            <div class="col-sm-9">
                                <input type="text" name="jabatan_majelis" class="form-control" id="jabatan_majelis" placeholder="Jabatan Majelis" value="<?php echo htmlspecialchars($data['jabatan_majelis']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan_pendeta" class="col-sm-2 text-start control-label col-form-label">Jabatan Pendeta</label>
                            <div class="col-sm-9">
                                <input type="text" name="jabatan_pendeta" class="form-control" id="jabatan_pendeta" placeholder="Jabatan Pendeta" value="<?php echo htmlspecialchars($data['jabatan_pendeta']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_menjabat" class="col-sm-2 text-start control-label col-form-label">Tanggal Menjabat</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal_menjabat" class="form-control" id="tanggal_menjabat" value="<?php echo htmlspecialchars($data['tanggal_menjabat']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_jabatan_berakhir" class="col-sm-2 text-start control-label col-form-label">Tanggal Jabatan Berakhir</label>
                            <div class="col-sm-9">
                                <input type="date" name="tanggal_jabatan_berakhir" class="form-control" id="tanggal_jabatan_berakhir" value="<?php echo htmlspecialchars($data['tanggal_jabatan_berakhir']); ?>" required>
                            </div>
                        </div>
                        <input type="hidden" name="id_periode" value="<?php echo htmlspecialchars($data['id_periode']); ?>">
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