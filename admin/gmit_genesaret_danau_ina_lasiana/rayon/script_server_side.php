<?php

/*
 * Skrip pemrosesan server-side DataTables.
 */

// Nama tabel utama
$table = 'rayon';

// Kunci utama tabel
$primaryKey = 'id_rayon';

// Kolom yang akan dibaca dan dikirimkan kembali ke DataTables
$columns = array(
    array('db' => 'rayon', 'dt' => 0),
    array('db' => 'keterangan', 'dt' => 1),
    array('db' => 'id_rayon', 'dt' => 2),
);

// Konfigurasi koneksi database
include_once '../_config/conn.php';

// Sertakan kelas SSP
require('../assets/libs/ssp.class.php');

// Jalankan query dengan JOIN dan outputkan hasil dalam format JSON
echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)  // Menambahkan parameter JOIN
);
