<?php require_once "../_config/config.php";
require "../assets/libs/vendor/autoload.php";

if (isset($_POST['tambah'])) {
    $id_jemaat = trim(mysqli_real_escape_string($con, $_POST['id_jemaat']));
    $pendidikan = trim(mysqli_real_escape_string($con, $_POST['pendidikan']));
    $pekerjaan = trim(mysqli_real_escape_string($con, $_POST['pekerjaan']));
    $status_baptis = trim(mysqli_real_escape_string($con, $_POST['status_baptis']));
    $tanggal_baptis = trim(mysqli_real_escape_string($con, $_POST['tanggal_baptis']));
    $status_sidi = trim(mysqli_real_escape_string($con, $_POST['status_sidi']));
    $tanggal_sidi = trim(mysqli_real_escape_string($con, $_POST['tanggal_sidi']));
    $status_pernikahan = trim(mysqli_real_escape_string($con, $_POST['status_pernikahan']));
    $tanggal_nikah = trim(mysqli_real_escape_string($con, $_POST['tanggal_nikah']));
    $meninggal_at = trim(mysqli_real_escape_string($con, $_POST['meninggal_at']));

    $sql_cek_identitas = mysqli_query($con, "SELECT * FROM status_sosial_jemaat WHERE id_jemaat = '$id_jemaat'") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_cek_identitas) > 0) {
        echo "<script>alert('Nama Jemaat Sudah Ada');window.location='tambah.php';</script>";
    } else {
        // Menambahkan data baru
        $tambah = mysqli_query($con, "INSERT INTO status_sosial_jemaat (id_jemaat, pendidikan, pekerjaan, status_baptis, tanggal_baptis, status_sidi, tanggal_sidi, status_pernikahan, tanggal_nikah, meninggal_at) VALUES ( '$id_jemaat', '$pendidikan', '$pekerjaan', '$status_baptis', '$tanggal_baptis', '$status_sidi', '$tanggal_sidi', '$status_pernikahan', '$tanggal_nikah', '$meninggal_at')") or die(mysqli_error($con));
        if ($tambah) {
            echo "<script>alert('Data Berhasil Ditambahkan');window.location='data.php';</script>";
        } else {
            echo "<script>alert('Data Gagal Ditambahkan');window.location='data.php';</script>";
        }
    }
} else if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $pendidikan = trim(mysqli_real_escape_string($con, $_POST['pendidikan']));
    $pekerjaan = trim(mysqli_real_escape_string($con, $_POST['pekerjaan']));
    $status_baptis = trim(mysqli_real_escape_string($con, $_POST['status_baptis']));
    $tanggal_baptis = trim(mysqli_real_escape_string($con, $_POST['tanggal_baptis']));
    $status_sidi = trim(mysqli_real_escape_string($con, $_POST['status_sidi']));
    $tanggal_sidi = trim(mysqli_real_escape_string($con, $_POST['tanggal_sidi']));
    $status_pernikahan = trim(mysqli_real_escape_string($con, $_POST['status_pernikahan']));
    $tanggal_nikah = trim(mysqli_real_escape_string($con, $_POST['tanggal_nikah']));
    $meninggal_at = trim(mysqli_real_escape_string($con, $_POST['meninggal_at']));
    $id_jemaat = trim(mysqli_real_escape_string($con, $_POST['id_jemaat']));

    // Memeriksa apakah data status sosial jemaat sudah ada
    $sql_cek_identitas = mysqli_query($con, "SELECT * FROM status_sosial_jemaat WHERE id_jemaat = '$id_jemaat' AND id_status_sosial_jemaat != '$id' ") or die(mysqli_error($con));

    if (mysqli_num_rows($sql_cek_identitas) > 0) {
        echo "<script>alert('Nama Jemaat Sudah Ada');window.location='edit.php?id=$id';</script>";
    } else {
        $update = mysqli_query($con, "UPDATE status_sosial_jemaat SET pendidikan = '$pendidikan', pekerjaan = '$pekerjaan', status_baptis = '$status_baptis', tanggal_baptis = '$tanggal_baptis', status_sidi = '$status_sidi', tanggal_sidi = '$tanggal_sidi', status_pernikahan = '$status_pernikahan', tanggal_nikah = '$tanggal_nikah', meninggal_at = '$meninggal_at', id_jemaat = '$id_jemaat' WHERE id_status_sosial_jemaat = '$id'") or die(mysqli_error($con));
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
