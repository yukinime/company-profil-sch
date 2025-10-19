<?php
// kegiatan.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dokumentasi Kegiatan - SDN Kalisari III</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>

  <!-- Header -->
  <?php include 'includes/header.php'; ?>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content container">
      <h2>SDN Kalisari III</h2>
      <h1>Dokumentasi Kegiatan Sekolah</h1>
      <p>Mengenal aktivitas dan prestasi siswa kami melalui berbagai dokumentasi kegiatan.</p>
      <a href="#kegiatan" class="cta-button">Lihat Kegiatan</a>
    </div>
  </section>

  <!-- Activities Section -->
  <section id="kegiatan" class="activities-section">
    <div class="container">
      <h2 class="section-title">Dokumentasi Kegiatan Sekolah</h2>
      <div class="activity-cards">

        <!-- Kegiatan 1 -->
        <div class="activity-card">
          <img src="assets/img/upcara.jpg" alt="Upacara Bendera" />
          <div class="activity-content">
            <h3>Upacara Bendera</h3>
            <p>Kegiatan rutin setiap hari Senin untuk menanamkan nilai nasionalisme.</p>
          </div>
        </div>

        <!-- Kegiatan 2 -->
        <div class="activity-card">
          <img src="assets/img/olahraga.jpg" alt="Lomba 17 Agustus" />
          <div class="activity-content">
            <h3>Lomba 17 Agustus</h3>
            <p>Siswa aktif mengikuti lomba untuk memeriahkan Hari Kemerdekaan.</p>
          </div>
        </div>

        <!-- Kegiatan 3 -->
        <div class="activity-card">
          <img src="assets/img/pramuka.jpg" alt="Kegiatan Pramuka" />
          <div class="activity-content">
            <h3>Kegiatan Pramuka</h3>
            <p>Melatih kemandirian dan kerja sama siswa dalam kegiatan ekstrakurikuler.</p>
          </div>
        </div>

        <!-- Kegiatan 4 -->
        <div class="activity-card">
          <img src="assets/img/eskul.jpg" alt="Kegiatan Seni" />
          <div class="activity-content">
            <h3>Kegiatan Seni</h3>
            <p>Menyalurkan bakat seni siswa melalui berbagai pertunjukan dan workshop.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

  <a href="#" class="back-to-top" title="Kembali ke atas"><i class="fas fa-chevron-up"></i></a>

  <script src="assets/js/script.js"></script>
</body>
</html>
