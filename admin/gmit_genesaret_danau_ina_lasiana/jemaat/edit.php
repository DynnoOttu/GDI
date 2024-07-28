<?php require_once('../_header.php') ?>

<?php
// Ambil kategori dari sesi
$kategori = isset($_SESSION['kategori']) ? $_SESSION['kategori'] : '';

// Cek kategori dan hak akses
// Misalnya, hanya Admin dan Ketua Majelis yang dapat mengakses halaman ini
if ($kategori !== 'Admin' && $kategori !== 'Ketua Majelis') {
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
            $sql_jemaat = mysqli_query($con, "SELECT * FROM jemaat WHERE id_jemaat = '$id'") or die(mysqli_error($con));
            $data = mysqli_fetch_array($sql_jemaat);

            ?>

            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Jemaat</h4>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="status_jemaat" class="col-sm-2 text-start control-label col-form-label">Status Jemaat</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id" value="<?= $data['id_jemaat'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_pendeta" class="col-sm-2 text-start control-label col-form-label">Pendeta</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_pendeta" id="id_pendeta" required>
                                    <option value="">Pilih Pendeta</option>
                                    <?php
                                    $result = mysqli_query($con, "SELECT id_pendeta, nama_pendeta FROM pendeta");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id_pendeta'] . "'" . ($data['id_pendeta'] == $row['id_pendeta'] ? ' selected' : '') . ">" . $row['nama_pendeta'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_kepala_keluarga" class="col-sm-2 text-start control-label col-form-label">Nomor KK</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_kepala_keluarga" id="id_kepala_keluarga" required>
                                    <option value="">Pilih Kepala Keluarga</option>
                                    <?php
                                    $result = mysqli_query($con, "SELECT id_kepala_keluarga, nomor_kk FROM kepala_keluarga");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id_kepala_keluarga'] . "'" . ($data['id_kepala_keluarga'] == $row['id_kepala_keluarga'] ? ' selected' : '') . ">" . $row['nomor_kk'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 text-start control-label col-form-label">Nama Jemaat</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Jemaat" value="<?= $data['nama'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tempat_dan_tanggal_lahir" class="col-sm-2 text-start control-label col-form-label">Tempat dan Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" name="tempat_dan_tanggal_lahir" class="form-control" id="tempat_dan_tanggal_lahir" placeholder="Tempat dan Tanggal Lahir" value="<?= $data['tempat_dan_tanggal_lahir'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2" for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="col-md-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki" <?php if ($data['jenis_kelamin'] == "Laki-Laki") echo 'selected'; ?>>Laki Laki</option>
                                    <option value="Perempuan" <?php if ($data['jenis_kelamin'] == "Perempuan") echo 'selected'; ?>>Perempuan</option>
                                </select>
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