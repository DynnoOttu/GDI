<?php require_once "../_config/config.php";
require "../assets/libs/vendor/autoload.php";

if (isset($_POST['tambah'])) {
    // Mengambil data dari form input
    $id_periode = trim(mysqli_real_escape_string($con, $_POST['id_periode']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama_pendeta']));
    $tanggal_menjabat = trim(mysqli_real_escape_string($con, $_POST['tanggal_menjabat']));
    $tanggal_jabatan_berakhir = trim(mysqli_real_escape_string($con, $_POST['tanggal_jabatan_berakhir']));

    // Memeriksa apakah nama pendeta sudah ada
    $sql_cek_identitas = mysqli_query($con, "SELECT * FROM pendeta WHERE nama_pendeta = '$nama'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_identitas) > 0) {
        echo "<script>alert('Nama Pendeta Sudah Ada');window.location='tambah.php';</script>";
    } else {
        // Menambahkan data baru
        $tambah = mysqli_query($con, "INSERT INTO pendeta (id_periode, nama_pendeta, tanggal_menjabat, tanggal_jabatan_berakhir) VALUES ('$id_periode', '$nama', '$tanggal_menjabat', '$tanggal_jabatan_berakhir')") or die(mysqli_error($con));
        if ($tambah) {
            echo "<script>alert('Data Berhasil Ditambahkan');window.location='data.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Ditambahkan');window.location='data.php';</script>";
        }
    }
} else if (isset($_POST['edit'])) {
    // Mengambil data dari form input
    $id = $_POST['id'];
    $id_periode = trim(mysqli_real_escape_string($con, $_POST['id_periode']));
    $nama = trim(mysqli_real_escape_string($con, $_POST['nama_pendeta']));
    $tanggal_menjabat = trim(mysqli_real_escape_string($con, $_POST['tanggal_menjabat']));
    $tanggal_jabatan_berakhir = trim(mysqli_real_escape_string($con, $_POST['tanggal_jabatan_berakhir']));

    // Memeriksa apakah nama pendeta sudah ada, kecuali untuk data yang sedang diedit
    $sql_cek_identitas = mysqli_query($con, "SELECT * FROM pendeta WHERE nama_pendeta = '$nama' AND id_pendeta != '$id'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_identitas) > 0) {
        echo "<script>alert('Nama Pendeta Sudah Ada');window.location='edit.php?id=$id';</script>";
    } else {
        // Mengupdate data yang ada
        $update = mysqli_query($con, "UPDATE pendeta SET id_periode = '$id_periode', nama_pendeta = '$nama', tanggal_menjabat = '$tanggal_menjabat', tanggal_jabatan_berakhir = '$tanggal_jabatan_berakhir' WHERE id_pendeta = '$id'") or die(mysqli_error($con));
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
