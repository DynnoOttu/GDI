<?php

/*
 * Skrip pemrosesan server-side DataTables.
 */

// Nama tabel utama
$table = 'user';

// Kunci utama tabel
$primaryKey = 'id_user';

// Kolom yang akan dibaca dan dikirimkan kembali ke DataTables
$columns = array(
    array('db' => 'email', 'dt' => 0),
    array('db' => 'nama', 'dt' => 1),
    array('db' => 'kategori', 'dt' => 2),
    array('db' => 'id_user', 'dt' => 3),
);

// Konfigurasi koneksi database
include_once '../_config/conn.php';

// Sertakan kelas SSP
require('../assets/libs/ssp.class.php');

// Jalankan query dengan JOIN dan outputkan hasil dalam format JSON
echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)  // Menambahkan parameter JOIN
);
