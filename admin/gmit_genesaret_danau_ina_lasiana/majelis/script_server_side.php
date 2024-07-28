<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'majelis';

// Table's primary key
$primaryKey = 'id_majelis';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'tanggal_menjabat', 'dt' => 0),
    array('db' => 'tanggal_jabatan_berahkir', 'dt' => 1),
    array('db' => 'nama_jemaat', 'dt' => 2),
    array('db' => 'rayon', 'dt' => 3),
    array('db' => 'jabatan', 'dt' => 4),
    array('db' => 'id_majelis', 'dt' => 5),
    // array(
    //     'db'        => 'salary',
    //     'dt'        => 5,
    //     'formatter' => function ($d, $row) {
    //         return '$' . number_format($d);
    //     }
    // )
);

// SQL server connection information
include_once '../_config/conn.php';


$joinQuery = "
    SELECT 
        m.id_majelis,
        p.tanggal_menjabat,
        p.tanggal_jabatan_berahkir,
        r.rayon,
        m.jabatan,
        j.nama AS nama_jemaat
    FROM 
        majelis m
    LEFT JOIN 
        periode p ON m.id_periode = p.id_periode
    LEFT JOIN 
        rayon r ON m.id_rayon = r.id_rayon
    LEFT JOIN 
        jemaat j ON m.id_jemaat = j.id_jemaat
";


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require('../assets/libs/ssp.class.php');

echo json_encode(
    SSP::complex($_GET, $sql_details, $joinQuery, $primaryKey, $columns)
);
