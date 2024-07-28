<?php require_once('../_header.php') ?>

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
            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data Status Sosial Jemaat</h4>
                    <div class="form-group row">
                        <label for="id_jemaat" class="col-sm-2 text-start control-label col-form-label">Nama Jemaat</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_jemaat" id="id_jemaat" required>
                                <option value="">Pilih Nama Jemaat</option>
                                <?php
                                $result = mysqli_query($con, "SELECT id_jemaat, nama FROM jemaat");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id_jemaat'] . "'>" . $row['nama'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pendidikan" class="col-sm-2 text-start control-label col-form-label">Pendidikan</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="pendidikan" id="pendidikan" required>
                                <option value="">Pilih Pendidikan</option>
                                <option value="SD">Sekolah Dasar</option>
                                <option value="SMP">Sekolah Menengah Pertama</option>
                                <option value="SMA">Sekolah Menengah Atas</option>
                                <option value="D1">Diploma 1</option>
                                <option value="D2">Diploma 2</option>
                                <option value="D3">Diploma 3</option>
                                <option value="S1">Sarjana 1</option>
                                <option value="S2">Magister</option>
                                <option value="S3">Doktor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pekerjaan" class="col-sm-2 text-start control-label col-form-label">Pekerjaan</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="pekerjaan" id="pekerjaan">
                                <option value="">Pilih Pekerjaan</option>
                                <option value="Wirausaha">Wirausaha</option>
                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                <option value="PNS">Pegawai Negeri Sipil</option>
                                <option value="Polri">Polri</option>
                                <option value="TNI">TNI</option>
                                <option value="Guru">Guru</option>
                                <option value="Dokter">Dokter</option>
                                <option value="Informatika">Informatika</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_baptis" class="col-sm-2 text-start control-label col-form-label">Status Baptis</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="status_baptis" id="status_baptis">
                                <option value="">Pilih Status Baptis</option>
                                <option value="Sudah">Sudah</option>
                                <option value="Belum">Belum</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_baptis" class="col-sm-2 text-start control-label col-form-label">Tanggal Baptis</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal_baptis" class="form-control" id="tanggal_baptis">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_sidi" class="col-sm-2 text-start control-label col-form-label">Status Sidi</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="status_sidi" id="status_sidi">
                                <option value="">Pilih Status Sidi</option>
                                <option value="Sudah">Sudah</option>
                                <option value="Belum">Belum</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_sidi" class="col-sm-2 text-start control-label col-form-label">Tanggal Sidi</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal_sidi" class="form-control" id="tanggal_sidi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_pernikahan" class="col-sm-2 text-start control-label col-form-label">Status Pernikahan</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="status_pernikahan" id="status_pernikahan">
                                <option value="">Pilih Status Pernikahan</option>
                                <option value="Kawin">Kawin</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                                <option value="Cerai Hidup">Cerai Hidup</option>
                                <option value="Cerai Mati">Cerai Mati</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_nikah" class="col-sm-2 text-start control-label col-form-label">Tanggal Nikah</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal_nikah" class="form-control" id="tanggal_nikah">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meninggal_at" class="col-sm-2 text-start control-label col-form-label">Tanggal Meninggal</label>
                        <div class="col-sm-9">
                            <input type="date" name="meninggal_at" class="form-control" id="meninggal_at">
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