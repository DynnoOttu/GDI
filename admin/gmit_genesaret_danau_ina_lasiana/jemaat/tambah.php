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
            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data Jemaat</h4>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="id_pendeta" class="col-sm-2 text-start control-label col-form-label">Pendeta</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_pendeta" id="id_pendeta" required>
                                    <option value="">Pilih Pendeta</option>
                                    <?php
                                    $result = mysqli_query($con, "SELECT id_pendeta, nama_pendeta FROM pendeta");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id_pendeta'] . "'>" . $row['nama_pendeta'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_kk" class="col-sm-2 text-start control-label col-form-label">Nomor KK</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_kepala_keluarga" id="id_kk" required>
                                    <option value="">Pilih Kepala Keluarga</option>
                                    <?php
                                    $result = mysqli_query($con, "SELECT id_kepala_keluarga, nomor_kk FROM kepala_keluarga");
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id_kepala_keluarga'] . "'>" . $row['nomor_kk'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 text-start control-label col-form-label">Nama Jemaat</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Pendeta" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tempat_dan_tanggal_lahir" class="col-sm-2 text-start control-label col-form-label">Tempat dan Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" name="tempat_dan_tanggal_lahir" class="form-control" id="tempat_dan_tanggal_lahir" placeholder="Tempat dan Tanggal Lahir" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2" for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="col-md-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
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