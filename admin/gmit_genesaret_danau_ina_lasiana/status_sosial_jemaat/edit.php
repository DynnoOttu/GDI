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

            <?php
            $id = &$_GET['id'];
            $sql_jemaat = mysqli_query($con, "SELECT * FROM status_sosial_jemaat WHERE id_status_sosial_jemaat = '$id'") or die(mysqli_error($con));
            $data = mysqli_fetch_array($sql_jemaat);

            ?>

            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Status Sosial Jemaat</h4>
                    <div class="form-group row">
                        <label for="id_jemaat" class="col-sm-2 text-start control-label col-form-label">Nama Jemaat</label>
                        <input type="hidden" name="id" value="<?php echo $data['id_status_sosial_jemaat']; ?>">
                        <div class="col-sm-9">
                            <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="id_jemaat" id="id_jemaat" required>
                                <option value="">Pilih Nama Jemaat</option>
                                <?php
                                $result = mysqli_query($con, "SELECT id_jemaat, nama FROM jemaat");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id_jemaat'] . "' " . ($data['id_jemaat'] == $row['id_jemaat'] ? 'selected' : '') . ">" . $row['nama'] . "</option>";
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
                                <option value="SD" <?php echo $data['pendidikan'] == 'SD' ? 'selected' : ''; ?>>Sekolah Dasar</option>
                                <option value="SMP" <?php echo $data['pendidikan'] == 'SMP' ? 'selected' : ''; ?>>Sekolah Menengah Pertama</option>
                                <option value="SMA" <?php echo $data['pendidikan'] == 'SMA' ? 'selected' : ''; ?>>Sekolah Menengah Atas</option>
                                <option value="D1" <?php echo $data['pendidikan'] == 'D1' ? 'selected' : ''; ?>>Diploma 1</option>
                                <option value="D2" <?php echo $data['pendidikan'] == 'D2' ? 'selected' : ''; ?>>Diploma 2</option>
                                <option value="D3" <?php echo $data['pendidikan'] == 'D3' ? 'selected' : ''; ?>>Diploma 3</option>
                                <option value="S1" <?php echo $data['pendidikan'] == 'S1' ? 'selected' : ''; ?>>Sarjana 1</option>
                                <option value="S2" <?php echo $data['pendidikan'] == 'S2' ? 'selected' : ''; ?>>Magister</option>
                                <option value="S3" <?php echo $data['pendidikan'] == 'S3' ? 'selected' : ''; ?>>Doktor</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pekerjaan" class="col-sm-2 text-start control-label col-form-label">Pekerjaan</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="pekerjaan" id="pekerjaan">
                                <option value="">Pilih Pekerjaan</option>
                                <option value="Wirausaha" <?php echo $data['pekerjaan'] == 'Wirausaha' ? 'selected' : ''; ?>>Wirausaha</option>
                                <option value="Karyawan Swasta" <?php echo $data['pekerjaan'] == 'Karyawan Swasta' ? 'selected' : ''; ?>>Karyawan Swasta</option>
                                <option value="PNS" <?php echo $data['pekerjaan'] == 'PNS' ? 'selected' : ''; ?>>Pegawai Negeri Sipil</option>
                                <option value="Polri" <?php echo $data['pekerjaan'] == 'Polri' ? 'selected' : ''; ?>>Polri</option>
                                <option value="TNI" <?php echo $data['pekerjaan'] == 'TNI' ? 'selected' : ''; ?>>TNI</option>
                                <option value="Guru" <?php echo $data['pekerjaan'] == 'Guru' ? 'selected' : ''; ?>>Guru</option>
                                <option value="Dokter" <?php echo $data['pekerjaan'] == 'Dokter' ? 'selected' : ''; ?>>Dokter</option>
                                <option value="Informatika" <?php echo $data['pekerjaan'] == 'Informatika' ? 'selected' : ''; ?>>Informatika</option>
                                <option value="Lainnya" <?php echo $data['pekerjaan'] == 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_baptis" class="col-sm-2 text-start control-label col-form-label">Status Baptis</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="status_baptis" id="status_baptis">
                                <option value="">Pilih Status Baptis</option>
                                <option value="Sudah" <?php echo $data['status_baptis'] == 'Sudah' ? 'selected' : ''; ?>>Sudah</option>
                                <option value="Belum" <?php echo $data['status_baptis'] == 'Belum' ? 'selected' : ''; ?>>Belum</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_baptis" class="col-sm-2 text-start control-label col-form-label">Tanggal Baptis</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal_baptis" class="form-control" id="tanggal_baptis" value="<?php echo $data['tanggal_baptis']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_sidi" class="col-sm-2 text-start control-label col-form-label">Status Sidi</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="status_sidi" id="status_sidi">
                                <option value="">Pilih Status Sidi</option>
                                <option value="Sudah" <?php echo $data['status_sidi'] == 'Sudah' ? 'selected' : ''; ?>>Sudah</option>
                                <option value="Belum" <?php echo $data['status_sidi'] == 'Belum' ? 'selected' : ''; ?>>Belum</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_sidi" class="col-sm-2 text-start control-label col-form-label">Tanggal Sidi</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal_sidi" class="form-control" id="tanggal_sidi" value="<?php echo $data['tanggal_sidi']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_pernikahan" class="col-sm-2 text-start control-label col-form-label">Status Pernikahan</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="status_pernikahan" id="status_pernikahan">
                                <option value="">Pilih Status Pernikahan</option>
                                <option value="Kawin" <?php echo $data['status_pernikahan'] == 'Kawin' ? 'selected' : ''; ?>>Kawin</option>
                                <option value="Belum Kawin" <?php echo $data['status_pernikahan'] == 'Belum Kawin' ? 'selected' : ''; ?>>Belum Kawin</option>
                                <option value="Cerai Hidup" <?php echo $data['status_pernikahan'] == 'Cerai Hidup' ? 'selected' : ''; ?>>Cerai Hidup</option>
                                <option value="Cerai Mati" <?php echo $data['status_pernikahan'] == 'Cerai Mati' ? 'selected' : ''; ?>>Cerai Mati</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_nikah" class="col-sm-2 text-start control-label col-form-label">Tanggal Nikah</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggal_nikah" class="form-control" id="tanggal_nikah" value="<?php echo $data['tanggal_nikah']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meninggal_at" class="col-sm-2 text-start control-label col-form-label">Tanggal Meninggal</label>
                        <div class="col-sm-9">
                            <input type="date" name="meninggal_at" class="form-control" id="meninggal_at" value="<?php echo $data['meninggal_at']; ?>">
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