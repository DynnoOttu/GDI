<div class="container-xxl bg-light my-5 py-5" id="pendeta-section">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">
                Data Pendeta
            </div>
            <h1 class="display-6 mb-5">
                Infomasi Data Pendeta
            </h1>
        </div>
        <?php
        $sqlPendeta = mysqli_query($con, "SELECT * FROM pendeta") or die(mysqli_error($con));
        ?>

        <div class="row g-4 justify-content-center">
            <?php
            while ($dataPendeta = mysqli_fetch_assoc($sqlPendeta)) {
            ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="causes-item d-flex flex-column bg-white border-top border-5 border-primary rounded-top overflow-hidden h-100">
                        <div class="text-center p-4 pt-0">
                            <div class="d-inline-block bg-primary text-white rounded-bottom fs-5 pb-1 px-3 mb-4">
                                <small>Biodata Pendeta</small>
                            </div>
                            <h5 class="mb-3">Nama Pendeta: <?= htmlspecialchars($dataPendeta['nama_pendeta'], ENT_QUOTES, 'UTF-8') ?></h5>
                            <h5 class="mb-3">Tanggal Menjabat: <?= htmlspecialchars($dataPendeta['tanggal_menjabat'], ENT_QUOTES, 'UTF-8') ?></h5>
                            <h5 class="mb-3">Tanggal Jabatan Berakhir: <?= htmlspecialchars($dataPendeta['tanggal_jabatan_berakhir'], ENT_QUOTES, 'UTF-8') ?></h5>
                            <!-- <p>
                  Tempor erat elitr rebum at clita dolor diam ipsum sit diam
                  amet diam et eos
                </p> -->
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>