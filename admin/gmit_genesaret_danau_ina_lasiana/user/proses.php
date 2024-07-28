<?php require_once "../_config/config.php";
require "../assets/libs/vendor/autoload.php";

if (isset($_POST['tambah'])) {
    $email = trim(mysqli_real_escape_string($con, $_POST['email']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $kategori = trim(mysqli_real_escape_string($con, $_POST['kategori']));
    $password = trim(mysqli_real_escape_string($con, $_POST['password']));

    $sql_cek_rayon = mysqli_query($con, "SELECT * FROM user WHERE email = '$email'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_rayon) > 0) {
        echo "<script>alert('Rayon Sudah Ada');window.location='tambah.php';</script>";
    } else {
        // Menambahkan data baru
        $tambah = mysqli_query($con, "INSERT INTO user (email, nama, kategori, password) VALUES ('$email','$nama', '$kategori', '$password')") or die(mysqli_error($con));
        if ($tambah) {
            echo "<script>alert('Data Berhasil Ditambahkan');window.location='data.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Ditambahkan');window.location='data.php';</script>";
        }
    }
} else if (isset($_POST['edit'])) {
    // Mengambil data dari form input
    $id = $_POST['id'];
    $email = trim(mysqli_real_escape_string($con, $_POST['email']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $kategori = trim(mysqli_real_escape_string($con, $_POST['kategori']));


    // Memeriksa apakah data jemaat sudah ada
    $sql_cek = mysqli_query($con, "SELECT * FROM user WHERE email = '$email' AND id_user != '$id'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek) > 0) {
        echo "<script>alert('Email Sudah Ada');window.location='edit.php?id=$id';</script>";
    } else {
        // Mengupdate data
        $update = mysqli_query($con, "UPDATE user SET email = '$email', nama = '$nama', kategori = '$kategori' WHERE id_user = '$id'") or die(mysqli_error($con));
        if ($update) {
            echo "<script>alert('Data Berhasil Diubah');window.location='data.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Diubah');window.location='data.php';</script>";
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
