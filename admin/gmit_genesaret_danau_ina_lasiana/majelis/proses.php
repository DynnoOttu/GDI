<?php require_once "../_config/config.php";
require "../assets/libs/vendor/autoload.php";

if (isset($_POST['tambah'])) {
    $id_periode = trim(mysqli_real_escape_string($con, $_POST['id_periode']));
    $id_rayon = trim(mysqli_real_escape_string($con, $_POST['id_rayon']));
    $jabatan = trim(mysqli_real_escape_string($con, $_POST['jabatan']));
    $id_jemaat = trim(mysqli_real_escape_string($con, $_POST['id_jemaat']));

    // Cek apakah id_jemaat sudah terdaftar di tabel majelis
    $cek_jemaat = mysqli_query($con, "SELECT * FROM majelis WHERE id_jemaat = '$id_jemaat'");
    if (mysqli_num_rows($cek_jemaat) > 0) {
        echo "<script>alert('Jemaat sudah terdaftar sebagai majelis');window.location='data.php';</script>";
    } else {
        $tambah = mysqli_query($con, "INSERT INTO majelis (id_periode, id_rayon, jabatan, id_jemaat) VALUES ('$id_periode', '$id_rayon', '$jabatan', '$id_jemaat')") or die(mysqli_error($con));
        if ($tambah) {
            echo "<script>alert('Data Berhasil Ditambahkan');window.location='data.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Ditambahkan');window.location='data.php';</script>";
        }
    }
} else if (isset($_POST['edit'])) {
    $id_majelis = $_POST['id_majelis'];
    $id_periode = trim(mysqli_real_escape_string($con, $_POST['id_periode']));
    $id_rayon = trim(mysqli_real_escape_string($con, $_POST['id_rayon']));
    $jabatan = trim(mysqli_real_escape_string($con, $_POST['jabatan']));
    $id_jemaat = trim(mysqli_real_escape_string($con, $_POST['id_jemaat']));

    // Cek apakah id_jemaat sudah terdaftar di tabel majelis, kecuali untuk id_majelis yang sedang diedit
    $sql_cek_jemaat = mysqli_query($con, "SELECT * FROM majelis WHERE id_jemaat = '$id_jemaat' AND id_majelis != '$id_majelis'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_jemaat) > 0) {
        echo "<script>alert('Jemaat sudah terdaftar sebagai majelis');window.location='edit.php?id=$id_majelis';</script>";
    } else {
        // Cek apakah jabatan sudah ada, kecuali untuk id_majelis yang sedang diedit
        $sql_cek_jabatan = mysqli_query($con, "SELECT * FROM majelis WHERE jabatan = '$jabatan' AND id_majelis != '$id_majelis'") or die(mysqli_error($con));
        if (mysqli_num_rows($sql_cek_jabatan) > 0) {
            echo "<script>alert('Jabatan Sudah Ada');window.location='edit.php?id=$id_majelis';</script>";
        } else {
            // Update data
            $update = mysqli_query($con, "UPDATE majelis SET id_periode = '$id_periode', id_rayon = '$id_rayon', jabatan = '$jabatan', id_jemaat = '$id_jemaat' WHERE id_majelis = '$id_majelis'") or die(mysqli_error($con));
            if ($update) {
                echo "<script>alert('Data Berhasil Diperbarui');window.location='data.php';</script>";
            } else {
                echo "<script>alert('Data Gagal Diperbarui');window.location='edit.php?id=$id_majelis';</script>";
            }
        }
    }
} else if (isset($_POST['import'])) {
    $file = $_FILES['file']['name'];
    $ekstensi = explode(".", $file);
    $file_name = "file-" . round(microtime(true)) . "." . end($ekstensi);
    $sumber = $_FILES['file']['tmp_name'];
    $targer_dir = "../upload/";
    $targer_file = $targer_dir . $file_name;
    $upload = move_uploaded_file($sumber, $targer_file);
    $obj = PHPExcel_IOFactory::load($targer_file);
    $allData = $obj->getActiveSheet()->toArray(null, true, true, true);

    $sql = "INSERT INTO tb_pasien( nomor_identitas, nama_pasien, jenis_kelamin, alamat, no_telepon ) VALUES";
    for ($i = 3; $i <= count($allData); $i++) {
        $nomor_identitas = $allData[$i]['A'];
        $nama_pasien = $allData[$i]['B'];
        $jenis_kelamin = $allData[$i]['C'];
        $alamat = $allData[$i]['D'];
        $no_telepon = $allData[$i]['E'];

        $sql .= "('$nomor_identitas', '$nama_pasien', '$jenis_kelamin', '$alamat', '$no_telepon'),";
    }

    $sql = substr($sql, 0, -1);
    mysqli_query($con, $sql) or die(mysqli_error($con));

    unlink($targer_file);
    echo "<script>alert('File Berhasil Diupload'); window.location='data.php';</script>";
}
