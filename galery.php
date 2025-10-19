<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galeri - SDN Kalisari III</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

  <style>
    .gallery-section {
      padding: 40px 20px;
      max-width: 1200px;
      margin: auto;
    }

    .gallery-title {
      text-align: center;
      font-size: 2rem;
      color: #2d6a4f;
      margin-bottom: 40px;
      font-weight: bold;
    }

    .gallery-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .gallery-card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      overflow: hidden;
      width: calc(33.333% - 20px);
      min-width: 250px;
      transition: transform 0.3s ease;
    }

    .gallery-card:hover {
      transform: translateY(-5px);
    }

    .gallery-card img {
      width: 100%;
      height: auto;
      display: block;
    }

    .gallery-info {
      padding: 15px;
      text-align: center;
    }

    .gallery-info h4 {
      margin: 10px 0 5px;
      font-size: 18px;
      color: #2d6a4f;
    }

    .gallery-info p {
      margin: 0;
      color: #666;
      font-size: 14px;
    }

    @media (max-width: 768px) {
      .gallery-card {
        width: calc(50% - 20px);
      }
    }

    @media (max-width: 480px) {
      .gallery-card {
        width: 100%;
      }

      .gallery-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<section class="gallery-section">
  <h2 class="gallery-title">Galeri Guru SDN Kalisari III</h2>

  <div class="gallery-grid">
    <div class="gallery-card">
      <img src="assets/img/guru 1.jpg" alt="Guru 1">
      <div class="gallery-info">
        <h4>Deden, S.pd</h4>
        <p>Guru Kelas 4</p>
      </div>
    </div>

    <div class="gallery-card">
      <img src="assets/img/guru2.jpg" alt="Guru 2">
      <div class="gallery-info">
        <h4>Siti Maryata, S.Pd</h4>
        <p>Guru Kelas 5</p>
      </div>
    </div>

    <div class="gallery-card">
      <img src="assets/img/guru3.jpg" alt="Guru 3">
      <div class="gallery-info">
        <h4>Bayu Lajuradi, S.pd</h4>
        <p>Guru Kelas 6</p>
      </div>
    </div>

    <div class="gallery-card">
      <img src="assets/img/guru4.jpg" alt="Guru 4">
      <div class="gallery-info">
        <h4>Siti Maesaroh</h4>
        <p>Guru Kelas 3</p>
      </div>
    </div>

    <div class="gallery-card">
      <img src="assets/img/guru5.jpg" alt="Guru 5">
      <div class="gallery-info">
        <h4>Rina Marlina</h4>
        <p>Guru Kelas 1</p>
      </div>
    </div>

    <div class="gallery-card">
      <img src="assets/img/guru6.jpg" alt="Guru 6">
      <div class="gallery-info">
        <h4>Siti Aisyah</h4>
        <p>Guru Kelas 2</p>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

</body>
</html>
