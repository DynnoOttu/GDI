<?php

/*
 * Skrip pemrosesan server-side DataTables.
 */

// Nama tabel utama
$table = 'status_sosial_jemaat';

// Kunci utama tabel
$primaryKey = 'id_status_sosial_jemaat';

// Kolom yang akan dibaca dan dikirimkan kembali ke DataTables
$columns = array(
    array('db' => 'nama', 'dt' => 0),
    array('db' => 'pendidikan', 'dt' => 1),
    array('db' => 'pekerjaan', 'dt' => 2),
    array('db' => 'status_baptis', 'dt' => 3),
    array('db' => 'tanggal_baptis', 'dt' => 4),
    array('db' => 'status_sidi', 'dt' => 5),
    array('db' => 'tanggal_sidi', 'dt' => 6),
    array('db' => 'status_pernikahan', 'dt' => 7),
    array('db' => 'tanggal_nikah', 'dt' => 8),
    array('db' => 'meninggal_at', 'dt' => 9),
    array('db' => 'id_status_sosial_jemaat', 'dt' => 10),

);

// Konfigurasi koneksi database
include_once '../_config/conn.php';

// Sertakan kelas SSP
require('../assets/libs/ssp.class.php');
$joinTabelJemaat = "LEFT JOIN jemaat ON status_sosial_jemaat.id_jemaat = jemaat.id_jemaat";



echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinTabelJemaat)  // Menambahkan parameter JOIN
);
