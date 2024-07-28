<?php require_once('../_header.php') ?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Import Data Pasien</h4>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="file" class="col-sm-2 text-start control-label col-form-label">File Excel</label>
                            <div class="col-sm-9">
                                <input type="file" name="file" class="form-control" id="file" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="import" class="btn btn-success"><i class="fas fa-upload"></i> Import</button>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <a href="data.php"><button type="button" class="btn btn-warning"><i class=" fas fa-arrow-left"></i> Kembali</button></a>
                        <a href="../upload/simple/pasien.xlsx"><button type="button" class="btn btn-defaul"><i class="fas fa-cloud-download-alt"></i> Download Format Excel</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once('../_footer.php') ?>