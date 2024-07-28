<?php require_once "../_config/config.php";
require "../assets/libs/vendor/autoload.php";

if (isset($_POST['tambah'])) {
    $id_rayon = trim(mysqli_real_escape_string($con, $_POST['id_rayon']));
    $jenis_kk = trim(mysqli_real_escape_string($con, $_POST['jenis_kk']));
    $nomor_kk = trim(mysqli_real_escape_string($con, $_POST['nomor_kk']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $nama_asrama = trim(mysqli_real_escape_string($con, $_POST['nama_asrama']));

    $sql_cek_nomor_kk = mysqli_query($con, "SELECT * FROM kepala_keluarga WHERE nomor_kk = '$nomor_kk'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_nomor_kk) > 0) {
        echo "<script>alert('Nomor KK Sudah Ada');window.location='tambah.php';</script>";
    } else {
        // Menambahkan data baru
        $tambah = mysqli_query($con, "INSERT INTO kepala_keluarga (id_rayon, jenis_kk, nomor_kk, alamat, nama_asrama) VALUES ('$id_rayon', '$jenis_kk', '$nomor_kk', '$alamat', '$nama_asrama')") or die(mysqli_error($con));
        if ($tambah) {
            echo "<script>alert('Data Berhasil Ditambahkan');window.location='data.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Ditambahkan');window.location='data.php';</script>";
        }
    }
} else if (isset($_POST['edit'])) {
    $id = $_POST['id_kepala_keluarga'];
    $id_rayon = trim(mysqli_real_escape_string($con, $_POST['id_rayon']));
    $jenis_kk = trim(mysqli_real_escape_string($con, $_POST['jenis_kk']));
    $nomor_kk = trim(mysqli_real_escape_string($con, $_POST['nomor_kk']));
    $alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
    $nama_asrama = trim(mysqli_real_escape_string($con, $_POST['nama_asrama']));

    // Cek apakah nomor KK sudah ada di database, kecuali untuk id_kepala_keluarga yang sedang diupdate
    $sql_cek_nomor_kk = mysqli_query($con, "SELECT * FROM kepala_keluarga WHERE nomor_kk = '$nomor_kk' AND id_kepala_keluarga != '$id'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_nomor_kk) > 0) {
        echo "<script>alert('Nomor KK Sudah Ada');window.location='edit.php?id=$id';</script>";
    } else {
        // Update data
        $update = mysqli_query($con, "UPDATE kepala_keluarga SET id_rayon='$id_rayon', jenis_kk='$jenis_kk', nomor_kk='$nomor_kk', alamat='$alamat', nama_asrama='$nama_asrama' WHERE id_kepala_keluarga='$id'") or die(mysqli_error($con));
        if ($update) {
            echo "<script>alert('Data Berhasil Diupdate');window.location='data.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Diupdate');window.location='data.php';</script>";
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
