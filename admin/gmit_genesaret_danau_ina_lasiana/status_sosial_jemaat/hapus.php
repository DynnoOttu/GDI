<?php require_once '../_config/config.php';

// Ambil kategori dari sesi
$kategori = isset($_SESSION['kategori']) ? $_SESSION['kategori'] : '';

// Cek kategori dan hak akses
// Misalnya, hanya Admin dan Ketua Majelis yang dapat mengakses halaman ini
if ($kategori !== 'Admin' && $kategori !== 'Kordinator') {
    http_response_code(403); // Set status kode HTTP 403 (Forbidden)
    echo "<script>window.location='" . base_url('akses-ditolak.php') . "';</script>";
    exit; // Pastikan eksekusi berhenti setelah redirect
}


mysqli_query($con, "DELETE FROM status_sosial_jemaat WHERE id_status_sosial_jemaat = '$_GET[id]'") or die(mysqli_error($con));
echo "<script>window.location='data.php'</script>";
