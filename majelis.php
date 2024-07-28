<?php
$totalMajelis = mysqli_query($con, "SELECT * FROM majelis");
$jumlahMajelis = mysqli_num_rows($totalMajelis);

?>


<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
        <img class="img-fluid mb-4" src="img/book.png" alt="" />
        <h4 class="mb-3">Data Majelis</h4>
        <p class="mb-4">
            Jumalah Data Majelis: <?= $jumlahMajelis ?>
        </p>
        <a class="btn btn-outline-primary px-3" href="" data-bs-toggle="modal" data-bs-target="#majelis">
            Lihat Detail Data Majelis
            <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                <i class="fa fa-arrow-right"></i>
            </div>
        </a>
    </div>
</div>



<div class="modal" id="majelis">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container mt-3">
                    <h2>Tabel Data Majelis</h2>
                    <p>Ini adalah informasi seluruh data Majelis</p>
                    <?php
                    // Query untuk mendapatkan data majelis
                    $sqlMajelis = mysqli_query($con, "SELECT m.id_majelis, 
                                                    p.tanggal_menjabat, 
                                                    p.tanggal_jabatan_berahkir, 
                                                    j.nama AS nama_jemaat, 
                                                    r.rayon, 
                                                    m.jabatan
                                             FROM majelis m
                                             JOIN jemaat j ON m.id_jemaat = j.id_jemaat
                                             JOIN periode p ON m.id_periode = p.id_periode
                                             JOIN rayon r ON m.id_rayon = r.id_rayon")
                        or die(mysqli_error($con));
                    ?>

                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama Jemaat</th>
                                <th>Periode Mulai</th>
                                <th>Periode Berakhir</th>
                                <th>Rayon</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($dataMajelis = mysqli_fetch_assoc($sqlMajelis)) {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($dataMajelis['nama_jemaat'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($dataMajelis['tanggal_menjabat'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($dataMajelis['tanggal_jabatan_berahkir'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($dataMajelis['rayon'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($dataMajelis['jabatan'], ENT_QUOTES, 'UTF-8') ?></td>
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