<?php require_once "../_config/config.php";
require "../assets/libs/vendor/autoload.php";

if (isset($_POST['tambah'])) {
    $id_majelis = trim(mysqli_real_escape_string($con, $_POST['id_majelis']));
    $id_rayon = trim(mysqli_real_escape_string($con, $_POST['id_rayon']));
    $nama_kordinator = trim(mysqli_real_escape_string($con, $_POST['nama_kordinator']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $status = trim(mysqli_real_escape_string($con, $_POST['status']));
    $telepon = trim(mysqli_real_escape_string($con, $_POST['telepon']));

    $sql_cek_nama_kordinator = mysqli_query($con, "SELECT * FROM kordinator WHERE nama_kordinator = '$nama_kordinator'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_nama_kordinator) > 0) {
        echo "<script>alert('Nama Kordinator Sudah Ada');window.location='tambah.php';</script>";
    } else {
        // Menambahkan data baru
        $tambah = mysqli_query($con, "INSERT INTO kordinator (id_majelis, id_rayon, nama_kordinator, alamat, status, telepon) VALUES ('$id_majelis', '$id_rayon', '$nama_kordinator', '$alamat', '$status', '$telepon')") or die(mysqli_error($con));
        if ($tambah) {
            echo "<script>alert('Data Berhasil Ditambahkan');window.location='data.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Ditambahkan');window.location='data.php';</script>";
        }
    }
} else if (isset($_POST['edit'])) {
    $id = $_POST['id_kordinator'];
    $id_majelis = trim(mysqli_real_escape_string($con, $_POST['id_majelis']));
    $id_rayon = trim(mysqli_real_escape_string($con, $_POST['id_rayon']));
    $nama_kordinator = trim(mysqli_real_escape_string($con, $_POST['nama_kordinator']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $status = trim(mysqli_real_escape_string($con, $_POST['status']));
    $telepon = trim(mysqli_real_escape_string($con, $_POST['telepon']));

    $sql_cek_nama_kordinator = mysqli_query($con, "SELECT * FROM kordinator WHERE nama_kordinator = '$nama_kordinator' AND id_kordinator != '$id'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_nama_kordinator) > 0) {
        echo "<script>alert('Nama Kordinator Sudah Ada');window.location='edit.php?id=$id';</script>";
    } else {
        // Update data
        $update = mysqli_query($con, "UPDATE kordinator SET id_majelis = '$id_majelis', id_rayon = '$id_rayon', nama_kordinator = '$nama_kordinator', alamat = '$alamat', status = '$status', telepon = '$telepon' WHERE id_kordinator = '$id'") or die(mysqli_error($con));
        if ($update) {
            echo "<script>alert('Data Berhasil Diperbarui');window.location='data.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Diperbarui');window.location='edit.php?id=$id';</script>";
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
