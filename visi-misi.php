<?php
// visi-misi.php - Halaman Visi Misi Sekolah
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Visi dan Misi - SDN Kalisari III</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f4f8;
      color: #333;
    }

    .visi-misi-section {
      padding: 80px 20px;
      background: linear-gradient(to bottom right, #d4f4dd, #ffffff);
    }

    .visi-misi-container {
      max-width: 960px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 16px;
      padding: 40px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
    }

    .page-title {
      text-align: center;
      color: #1d3557;
      font-size: 2.5rem;
      font-weight: 800;
      margin-bottom: 50px;
      position: relative;
    }

    .page-title::after {
      content: '';
      width: 80px;
      height: 4px;
      background-color: #52b788;
      display: block;
      margin: 16px auto 0;
      border-radius: 3px;
    }

    .section-title {
      display: flex;
      align-items: center;
      font-size: 1.5rem;
      color: #2d6a4f;
      margin-bottom: 20px;
      font-weight: 700;
    }

    .section-title i {
      margin-right: 12px;
      color: #40916c;
    }

    .visi-content {
      background-color: #e6f4ec;
      border-left: 4px solid #52b788;
      padding: 20px 25px;
      border-radius: 0 10px 10px 0;
      font-style: italic;
      font-size: 1.1rem;
      line-height: 1.8;
      color: #333;
      margin-bottom: 30px;
    }

    .misi-list, .tujuan-list {
      list-style: none;
      padding-left: 0;
    }

    .misi-item, .tujuan-item {
      position: relative;
      padding: 12px 0 12px 36px;
      margin-bottom: 12px;
      border-bottom: 1px solid #eee;
      font-size: 1rem;
      color: #444;
    }

    .misi-item::before, .tujuan-item::before {
      content: "\f00c";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      color: #52b788;
      position: absolute;
      left: 0;
      top: 14px;
    }

    .highlight-box {
      background-color: #f8f9fa;
      border: 1px solid #e0e0e0;
      border-radius: 12px;
      padding: 25px;
      margin-top: 50px;
      text-align: center;
    }

    .highlight-title {
      font-size: 1.3rem;
      color: #2d6a4f;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .highlight-content {
      font-size: 1.1rem;
      font-style: italic;
      color: #495057;
    }

    @media (max-width: 768px) {
      .page-title {
        font-size: 2rem;
      }

      .section-title {
        font-size: 1.3rem;
      }

      .visi-misi-container {
        padding: 25px;
      }

      .visi-content {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <?php include 'includes/header.php'; ?>

  <!-- Visi Misi Section -->
  <section class="visi-misi-section">
    <div class="visi-misi-container">
      <h2 class="page-title">Visi dan Misi SDN Kalisari III</h2>

      <div class="visi-section">
        <h3 class="section-title"><i class="fas fa-eye"></i> Visi Sekolah</h3>
        <div class="visi-content">
          "Terwujudnya peserta didik yang beriman, bertaqwa, berakhlak mulia, berprestasi, terampil, dan berwawasan lingkungan."
        </div>
      </div>

      <div class="misi-section">
        <h3 class="section-title"><i class="fas fa-bullseye"></i> Misi Sekolah</h3>
        <ul class="misi-list">
          <li class="misi-item">Menanamkan keimanan dan ketaqwaan melalui pengamalan ajaran agama</li>
          <li class="misi-item">Mengoptimalkan proses pembelajaran dan bimbingan</li>
          <li class="misi-item">Mengembangkan pengetahuan di bidang IPTEK, bahasa, olahraga, dan seni budaya</li>
          <li class="misi-item">Menjalin kerja sama yang harmonis antara warga sekolah dan lingkungan</li>
          <li class="misi-item">Menumbuhkan semangat keunggulan secara intensif kepada seluruh warga sekolah</li>
          <li class="misi-item">Membiasakan perilaku bersih dan sehat serta mencintai lingkungan</li>
        </ul>
      </div>

      <div class="tujuan-section">
        <h3 class="section-title"><i class="fas fa-flag-checkered"></i> Tujuan Sekolah</h3>
        <p style="margin-bottom: 15px;">Berdasarkan visi dan misi yang telah dirumuskan, tujuan SDN Kalisari III adalah:</p>
        <ul class="tujuan-list">
          <li class="tujuan-item">Meningkatkan kualitas iman, taqwa, dan akhlak mulia</li>
          <li class="tujuan-item">Meningkatkan kepedulian terhadap kebersihan dan kesehatan lingkungan sekolah</li>
          <li class="tujuan-item">Mengembangkan kemampuan akademik berwawasan keunggulan</li>
          <li class="tujuan-item">Meningkatkan potensi dan minat siswa dalam bidang akademik dan non-akademik</li>
          <li class="tujuan-item">Mengembangkan keterampilan dalam bidang teknologi informasi</li>
          <li class="tujuan-item">Meningkatkan kegiatan ekstrakurikuler yang menunjang prestasi siswa</li>
        </ul>
      </div>

      <div class="highlight-box">
        <h4 class="highlight-title"><i class="fas fa-quote-left"></i> Motto SDN Kalisari III</h4>
        <p class="highlight-content">"Disiplin, Bermutu, dan Berwawasan Lingkungan"</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

</body>
</html>
