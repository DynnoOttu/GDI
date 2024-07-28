<?php require_once('../_header.php') ?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">

            <?php
            $id = &$_GET['id'];
            $sql_jemaat = mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id'") or die(mysqli_error($con));
            $data = mysqli_fetch_array($sql_jemaat);

            // Definisikan opsi kategori
            $categories = [
                'Admin' => 'Admin',
                'Ketua Majelis' => 'Ketua Majelis',
                'Kordinator' => 'Kordinator'
            ];

            // Ambil nilai kategori yang dipilih dari database
            $selectedCategory = $data['kategori'];

            ?>

            <form class="form-horizontal" action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <h4 class="card-title">Edit Data User</h4>
                    <div class="tabel">
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 text-start control-label col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id" value="<?= $data['id_user'] ?>">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Rayon" value="<?= $data['email'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 text-start control-label col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" class="form-control" id="email" placeholder="Nama" value="<?= $data['nama'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 text-start control-label col-form-label">Kategori</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 form-select shadow-none" style="width: 100%; height:36px;" name="kategori" id="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php
                                    foreach ($categories as $value => $label) {
                                        $selected = ($selectedCategory == $value) ? "selected" : "";
                                        echo "<option value='" . htmlspecialchars($value) . "' $selected>" . htmlspecialchars($label) . "</option>";
                                    }
                                    ?>
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