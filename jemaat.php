<?php
$totalJemaat = mysqli_query($con, "SELECT * FROM jemaat");
$jumlahJemaat = mysqli_num_rows($totalJemaat);

$totalJemaatL = mysqli_query($con, "SELECT * FROM jemaat WHERE jenis_kelamin = 'Laki-Laki'");
$jumlahTotalJemaatL = mysqli_num_rows($totalJemaatL);

$totalJemaatP = mysqli_query($con, "SELECT * FROM jemaat WHERE jenis_kelamin = 'Perempuan'");
$jumlahTotalJemaatP = mysqli_num_rows($totalJemaatP);
?>


<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
        <img class="img-fluid mb-4" src="img/icon-1.png" alt="" />
        <h4 class="mb-3">Data Jemaat</h4>
        <p class="mb-2">
            Jumlah Data Jemaat Seluruh: <?= $jumlahJemaat ?>
        </p>
        <p class="mb-2">
            Jumlah Jemaat Laki - Laki: <?= $jumlahTotalJemaatL ?>
        </p>
        <p class="mb-2">
            Jumlah Jemaat Perempuan: <?= $jumlahTotalJemaatP ?>
        </p>
        <a class="btn btn-outline-primary px-3 mt-4" href="" data-bs-toggle="modal" data-bs-target="#myModal">
            Lihat Detail Data Jemaat
            <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                <i class="fa fa-arrow-right"></i>
            </div>
        </a>
    </div>
</div>



<div class="modal" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container mt-3">
                    <h2>Tabel Data Jemaat</h2>
                    <p>Ini adalah informasi seluruh data Jemaat yang terdaftar</p>
                    <?php
                    // Query untuk mendapatkan data jemaat
                    $sqlJemaat = mysqli_query($con, "SELECT j.nama AS nama_jemaat, 
                                        j.tempat_dan_tanggal_lahir, 
                                        j.jenis_kelamin, 
                                        p.nama_pendeta, 
                                        k.alamat 
                                 FROM jemaat j
                                 JOIN pendeta p ON j.id_pendeta = p.id_pendeta
                                 JOIN kepala_keluarga k ON j.id_kepala_keluarga = k.id_kepala_keluarga")
                        or die(mysqli_error($con));
                    ?>

                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama Pendeta</th>
                                <th>Alamat</th>
                                <th>Nama Jemaat</th>
                                <th>Tempat dan Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($dataJemaat = mysqli_fetch_assoc($sqlJemaat)) {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($dataJemaat['nama_pendeta'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($dataJemaat['alamat'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($dataJemaat['nama_jemaat'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($dataJemaat['tempat_dan_tanggal_lahir'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($dataJemaat['jenis_kelamin'], ENT_QUOTES, 'UTF-8') ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>



                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>