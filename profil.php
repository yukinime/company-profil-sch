<?php
// profil.php - Halaman Profil Sekolah
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profil Sekolah - SDN Kalisari III</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background-color: #f4f6f8;
      color: #333;
    }

    .profil-section {
      padding: 80px 20px;
      background: linear-gradient(to bottom, #dff5e1, #ffffff);
    }

    .profil-container {
      max-width: 960px;
      margin: 0 auto;
      background: #fff;
      border-radius: 16px;
      padding: 40px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      transition: 0.3s ease-in-out;
    }

    .profil-container:hover {
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .profil-title {
      text-align: center;
      color: #1d3557;
      font-size: 2.5rem;
      font-weight: 800;
      margin-bottom: 40px;
    }

    .profil-container p {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #555;
      margin-bottom: 20px;
    }

    .profil-image {
      text-align: center;
      margin-bottom: 40px;
    }

    .profil-image img {
      width: 100%;
      max-width: 720px;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .struktur-organisasi {
      text-align: center;
      margin-top: 50px;
    }

    .struktur-organisasi h3 {
      font-size: 1.8rem;
      color: #2d6a4f;
      margin-bottom: 20px;
    }

    .struktur-organisasi img {
      width: 100%;
      max-width: 720px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
      .profil-title {
        font-size: 2rem;
      }

      .profil-container {
        padding: 25px;
      }

      .profil-container p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <?php include 'includes/header.php'; ?>

  <!-- Profil Section -->
  <section class="profil-section">
    <div class="profil-container">
      <h2 class="profil-title">Profil SDN Kalisari III</h2>

      <div class="profil-image">
        <img src="assets/img/sekolah1.jpg" alt="Foto SDN Kalisari III">
      </div>

      <p><strong>SD Negeri Kalisari III</strong> di Kecamatan Telagasari, Kabupaten Karawang, Jawa Barat, didirikan pada <strong>1 Januari 1968</strong> berdasarkan Surat Keputusan Nomor 1968. Sekolah ini berstatus negeri dan berada di bawah naungan Kementerian Pendidikan dan Kebudayaan.</p>

      <p>Pada <strong>31 Desember 2009</strong>, SDN Kalisari III memperoleh akreditasi dengan peringkat <strong>B</strong>, menunjukkan komitmennya terhadap standar mutu pendidikan yang ditetapkan pemerintah.</p>

      <p>Sekolah ini memiliki luas tanah <strong>2.481 m²</strong> dengan beberapa ruang kelas dalam kondisi baik serta 1 unit <strong>perpustakaan</strong> untuk mendukung kegiatan belajar siswa.</p>

      <p>Berlokasi di <strong>Kp. Tanjungsari, Desa Kalisari, Kecamatan Telagasari</strong>, SDN Kalisari III terus berupaya memberikan pendidikan berkualitas kepada seluruh siswa-siswinya.</p>

      <div class="struktur-organisasi">
        <h3>Struktur Organisasi</h3>
        <img src="assets/img/struktur.png" alt="Struktur Organisasi SDN Kalisari III">
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

</body>
</html>
