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
                    <h4 class="card-title">Tambah Data Majelis</h4>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="id_periode" class="col-sm-2 text-start control-label col-form-label">Periode</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_periode" id="id_periode" required>
                                    <option value="">Pilih Periode</option>
                                    <?php
                                    $result_periode = mysqli_query($con, "SELECT id_periode, tanggal_menjabat, tanggal_jabatan_berahkir  FROM periode");
                                    while ($row_periode = mysqli_fetch_assoc($result_periode)) {
                                        echo "<option value='" . $row_periode['id_periode'] . "'>" . $row_periode['tanggal_menjabat'] . " - " . $row_periode['tanggal_jabatan_berahkir'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_jemaat" class="col-sm-2 text-start control-label col-form-label">Nama Majelis</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_jemaat" id="id_jemaat" required>
                                    <option value="">Pilih Nama Majelis</option>
                                    <?php
                                    $result_jemaat = mysqli_query($con, "SELECT id_jemaat, nama FROM jemaat");
                                    while ($row_jemaat = mysqli_fetch_assoc($result_jemaat)) {
                                        $selected = ($row_jemaat['id_jemaat'] == $data['id_jemaat']) ? "selected" : "";
                                        echo "<option value='" . $row_jemaat['id_jemaat'] . "' $selected>" . $row_jemaat['nama'] . "</option>";
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
                                        echo "<option value='" . $row_rayon['id_rayon'] . "'>" . $row_rayon['rayon'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-2 text-start control-label col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="Jabatan" required>
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