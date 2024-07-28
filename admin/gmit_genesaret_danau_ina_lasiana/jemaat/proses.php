<?php require_once "../_config/config.php";
require "../assets/libs/vendor/autoload.php";

if (isset($_POST['tambah'])) {
    $id_pendeta = trim(mysqli_real_escape_string($con, $_POST['id_pendeta']));
    $id_kepala_keluarga = trim(mysqli_real_escape_string($con, $_POST['id_kepala_keluarga']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $tempat_dan_tanggal_lahir = trim(mysqli_real_escape_string($con, $_POST['tempat_dan_tanggal_lahir']));
    $jenis_kelamin = trim(mysqli_real_escape_string($con, $_POST['jenis_kelamin']));

    $sql_cek_id_kepala_keluarga = mysqli_query($con, "SELECT * FROM jemaat WHERE id_kepala_keluarga = '$id_kepala_keluarga'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_id_kepala_keluarga) > 0) {
        echo "<script>alert('Nomor KK Sudah Terdaftar');window.location='tambah.php';</script>";
    } else {
        // Cek apakah nama jemaat sudah ada di database
        $sql_cek_nama = mysqli_query($con, "SELECT * FROM jemaat WHERE nama = '$nama'") or die(mysqli_error($con));
        if (mysqli_num_rows($sql_cek_nama) > 0) {
            echo "<script>alert('Nama Jemaat Sudah Ada');window.location='tambah.php';</script>";
        } else {
            // Menambahkan data baru
            $tambah = mysqli_query($con, "INSERT INTO jemaat (id_pendeta, id_kepala_keluarga, nama, tempat_dan_tanggal_lahir, jenis_kelamin) VALUES ('$id_pendeta', '$id_kepala_keluarga', '$nama', '$tempat_dan_tanggal_lahir', '$jenis_kelamin')") or die(mysqli_error($con));
            if ($tambah) {
                echo "<script>alert('Data Berhasil Ditambahkan');window.location='data.php';</script>";
            } else {
                echo "<script>alert('Data Gagal Ditambahkan');window.location='data.php';</script>";
            }
        }
    }
} else if (isset($_POST['edit'])) {
    // Mengambil data dari form input
    $id = $_POST['id'];
    $id_pendeta = trim(mysqli_real_escape_string($con, $_POST['id_pendeta']));
    $id_kepala_keluarga = trim(mysqli_real_escape_string($con, $_POST['id_kepala_keluarga']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
    $tempat_dan_tanggal_lahir = trim(mysqli_real_escape_string($con, $_POST['tempat_dan_tanggal_lahir']));
    $jenis_kelamin = trim(mysqli_real_escape_string($con, $_POST['jenis_kelamin']));

    $sql_cek_id_kepala_keluarga = mysqli_query($con, "SELECT * FROM jemaat WHERE id_kepala_keluarga = '$id_kepala_keluarga' AND id_jemaat != '$id'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_id_kepala_keluarga) > 0) {
        echo "<script>alert('Nomor KK Sudah Terdaftar');window.location='edit.php?id=$id';</script>";
    } else {
        // Cek apakah nama jemaat sudah ada di database
        $sql_cek_nama = mysqli_query($con, "SELECT * FROM jemaat WHERE nama = '$nama' AND id_jemaat != '$id'") or die(mysqli_error($con));
        if (mysqli_num_rows($sql_cek_nama) > 0) {
            echo "<script>alert('Nama Jemaat Sudah Ada');window.location='edit.php?id=$id';</script>";
        } else {
            // Mengupdate data
            $update = mysqli_query($con, "UPDATE jemaat SET id_pendeta = '$id_pendeta', id_kepala_keluarga = '$id_kepala_keluarga', nama = '$nama', tempat_dan_tanggal_lahir = '$tempat_dan_tanggal_lahir', jenis_kelamin = '$jenis_kelamin' WHERE id_jemaat = '$id'") or die(mysqli_error($con));
            if ($update) {
                echo "<script>alert('Data Berhasil Diubah');window.location='data.php';</script>";
            } else {
                echo "<script>alert('Data Gagal Diubah');window.location='data.php';</script>";
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
