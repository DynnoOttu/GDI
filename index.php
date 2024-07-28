<?php require_once('_config/config.php') ?>


<?php include 'header.php' ?>

<body>
  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
  </div>
  <!-- Spinner End -->
  <?php include 'navbar.php' ?>
  <?php include 'carousel.php' ?>

  <!-- About Start -->
  <div class="container-xxl py-5">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
          <div class="position-relative overflow-hidden h-100" style="min-height: 400px">
            <img class="position-absolute w-100 h-100 pt-5 pe-5" src="img/Gereja/header.jpg" alt="" style="object-fit: cover" />
            <img class="position-absolute top-0 end-0 bg-white ps-2 pb-2" src="img/Gereja/header.jpg" alt="" style="width: 200px; height: 200px" />
          </div>
        </div>
        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
          <div class="h-100">
            <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">
              Tentang Kami
            </div>
            <h1 class="display-6 mb-5">
              Sejarah Jemaat Gen Danau Ina Lasiana Klasis Kupang Tengah
            </h1>
            <div class="bg-light border-bottom border-5 border-primary rounded p-4 mb-4">
              <p class="text-dark mb-2">
                Bagi Jemaat Genesaret Danau Ina (GDI) yang baru dibentuk pada
                tanggal 12 September 2004 atau baru berumur 14 tahun
              </p>
            </div>
            <p class="mb-5">
              walaupun terasa usianya tergolong usia muda tetap menjadi sangat
              urgen dilakukan penulisan sejarahnya saat ini. Urgensi penulisan
              sejarah Jemaat Genesaret Danau Ina adalah didasari atas beberapa
              pertimbangan strategis antara lain; (1). Saat ini hampir seluruh
              pelaku sejarah masih hidup dan aktif berjemaat
            </p>
          </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- About End -->


  <!-- DATA PENDETA START  -->
  <?php include 'pendeta.php' ?>
  <!-- DATA PENDETA END -->

  <!-- Service Start -->
  <div class="container-xxl py-5" id="jemaat-section">
    <div class="container">
      <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px">
        <div class="d-inline-block rounded-pill bg-secondary text-primary py-1 px-3 mb-3">
          Informasi
        </div>
        <h1 class="display-6 mb-5">Data Jemaat, Data Majelis dan Data Rayon</h1>
      </div>
      <div class="row g-4 justify-content-center">
        <?php include 'jemaat.php' ?>
        <?php include 'majelis.php' ?>
        <?php include 'rayon.php' ?>
      </div>
    </div>
  </div>
  <!-- Service End -->

  <!-- Donate Start -->
  <!-- Contact Start -->
  <div class="container-xxl py-5" id="alamat-section">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
          <h1 class="display-6 mb-5">
            Informasi Alamat GMIT Genesaret Danau Ina Lasiana
          </h1>
          <p class="mb-4">
            Alamat: Lasiana, Kec. Klp. Lima, Kota Kupang, Nusa Tenggara Tim.
            Provinsi: Nusa Tenggara Timur
          </p>
        </div>
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 450px">
          <div class="position-relative rounded overflow-hidden h-100">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15709.826910112211!2d123.6664941!3d-10.1434799!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c5683a6f36808f5%3A0x65872a7c8b7c2dc9!2sGMIT%20Jemaat%20Genesaret%20Danau%20Ina!5e0!3m2!1sid!2sid!4v1722074879833!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Contact End -->
  <!-- Donate End -->

  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/parallax/parallax.min.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
</body>

</html>