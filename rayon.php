<?php
$dataRayon = mysqli_query($con, "SELECT * FROM rayon");
$jumlahRayon = mysqli_num_rows($dataRayon);
?>


<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
        <img class="img-fluid mb-4" src="img/home.png" alt="" />
        <h4 class="mb-3">Data Rayon</h4>
        <p class="mb-4">
            Jumlah Rayon <?= $jumlahRayon ?>
        </p>
        <a class="btn btn-outline-primary px-3" href="" data-bs-toggle="modal" data-bs-target="#rayon">
            Lihat Detail Data Rayon
            <div class="d-inline-flex btn-sm-square bg-primary text-white rounded-circle ms-2">
                <i class="fa fa-arrow-right"></i>
            </div>
        </a>
    </div>
</div>



<div class="modal" id="rayon">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container mt-3">
                    <h2>Tabel Data Rayon</h2>
                    <p>Ini adalah informasi seluruh data Rayon</p>
                    <?php
                    // Query untuk mendapatkan data rayon
                    $sqlRayon = mysqli_query($con, "SELECT * FROM rayon")
                        or die(mysqli_error($con));
                    ?>

                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Rayon</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($dataRayon = mysqli_fetch_assoc($sqlRayon)) {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($dataRayon['rayon'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($dataRayon['keterangan'], ENT_QUOTES, 'UTF-8') ?></td>
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