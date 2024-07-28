<?php include '../_header.php' ?>

<?php
$get1 = mysqli_query($con, "SELECT * FROM jemaat");
$count1 = mysqli_num_rows($get1);

$get2 = mysqli_query($con, "SELECT * FROM majelis");
$count2 = mysqli_num_rows($get2);

$dataRayon = mysqli_query($con, "SELECT * FROM rayon");
$jumlahRayon = mysqli_num_rows($dataRayon);


$months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
$jumlahJemaatPerBulan = [];

for ($bulan = 1; $bulan <= 12; $bulan++) {
    $query = mysqli_query($con, "SELECT COUNT(*) as count FROM status_sosial_jemaat WHERE MONTH(meninggal_at) = '$bulan' AND meninggal_at IS NOT NULL");
    $row = $query->fetch_assoc();
    $jumlahJemaatPerBulan[] = $row['count'] ?? 0;
}

?>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales Cards  -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                    <h6 class="text-white">Jumlah Jemaat: <?= $count1 ?></h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                    <h6 class="text-white">Jumlah Majelis: <?= $count2 ?></h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                    <h6 class="text-white">Jumlah Rayon: <?= $jumlahRayon ?></h6>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <div class="row mt-5">
        <h3 class="mb-2">Jumlah jemaat yang meningal perbulan</h3>
        <div class="col-md-6">
            <canvas id="myChart" height="40vh" width="80vw"></canvas>
        </div>
    </div>

</div>

<?php include '../_footer.php' ?>

<script>
    const labels = <?php echo json_encode($months); ?>;
    const dataValues = <?php echo json_encode($jumlahJemaatPerBulan); ?>;

    const data = {
        labels: labels,
        datasets: [{
            label: 'Jumlah Jemaat Meninggal Berdasarkan Bulan',
            data: dataValues,
            backgroundColor: 'rgb(54, 162, 235)',
            borderColor: 'rgb(54, 162, 235)',
            fill: false,
            tension: 0.1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>