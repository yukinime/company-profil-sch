<?php
// kegiatan.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dokumentasi Kegiatan - Ignatius Slamet Riyadi</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <style>
    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding: 120px 0 80px;
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
      opacity: 0.3;
    }

    .hero-content {
      position: relative;
      z-index: 1;
    }

    .hero h2 {
      font-size: 1.2rem;
      font-weight: 500;
      margin-bottom: 10px;
      opacity: 0.9;
    }

    .hero h1 {
      font-size: 2.8rem;
      font-weight: 700;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .hero p {
      font-size: 1.1rem;
      margin-bottom: 30px;
      opacity: 0.95;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    .cta-button {
      display: inline-block;
      padding: 14px 40px;
      background: white;
      color: #667eea;
      text-decoration: none;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .cta-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }

    /* Activities Section */
    .activities-section {
      padding: 80px 0;
      background: #f8f9fa;
    }

    .section-title {
      text-align: center;
      font-size: 2.5rem;
      color: #2d3748;
      margin-bottom: 50px;
      position: relative;
      padding-bottom: 20px;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, #667eea, #764ba2);
      border-radius: 2px;
    }

    .activity-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
      padding: 0 20px;
    }

    .activity-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0,0,0,0.07);
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .activity-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }

    .activity-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .activity-card:hover img {
      transform: scale(1.05);
    }

    .activity-content {
      padding: 25px;
    }

    .activity-content h3 {
      font-size: 1.3rem;
      color: #2d3748;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .activity-content p {
      color: #718096;
      line-height: 1.6;
      font-size: 0.95rem;
    }

    .photo-count {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-top: 12px;
      color: #667eea;
      font-size: 0.9rem;
      font-weight: 500;
    }

    .photo-count i {
      font-size: 1rem;
    }

    /* Back to Top */
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .back-to-top.show {
      opacity: 1;
      visibility: visible;
    }

    .back-to-top:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 16px rgba(102, 126, 234, 0.6);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2rem;
      }

      .hero p {
        font-size: 1rem;
      }

      .section-title {
        font-size: 2rem;
      }

      .activity-cards {
        grid-template-columns: 1fr;
        gap: 20px;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <?php include 'includes/header.php'; ?>



  <!-- Activities Section -->
  <section id="kegiatan" class="activities-section">
    <div class="container">
      <h2 class="section-title">Dokumentasi Kegiatan Sekolah</h2>
      <div class="activity-cards">

        <!-- Kegiatan 1: MPLS 2024-2025 -->
        <div class="activity-card">
          <img src="assets/img/mpls-2024.jpg" alt="MPLS 2024-2025" />
          <div class="activity-content">
            <h3>MPLS 2024 - 2025</h3>
            <p>Masa Pengenalan Lingkungan Sekolah untuk siswa baru tahun ajaran 2024-2025.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 4 foto</span>
          </div>
        </div>

        <!-- Kegiatan 2: Karya Wisata Goes to Dufan -->
        <div class="activity-card">
          <img src="assets/img/karya-wisata-dufan.jpg" alt="Karya Wisata Dufan" />
          <div class="activity-content">
            <h3>KARYA WISATA GOES TO DUFAN</h3>
            <p>Kegiatan karya wisata siswa ke Dufan untuk pembelajaran di luar kelas yang menyenangkan.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 3 foto</span>
          </div>
        </div>

        <!-- Kegiatan 3: Halal Bihalal -->
        <div class="activity-card">
          <img src="assets/img/halal-bihalal.jpg" alt="Halal Bihalal" />
          <div class="activity-content">
            <h3>HALAL BIHALAL</h3>
            <p>Acara halal bihalal untuk mempererat silaturahmi warga sekolah setelah Idul Fitri.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 4 foto</span>
          </div>
        </div>

        <!-- Kegiatan 4: Paskah -->
        <div class="activity-card">
          <img src="assets/img/paskah.jpg" alt="Paskah" />
          <div class="activity-content">
            <h3>PASKAH</h3>
            <p>Perayaan Paskah bersama siswa untuk menghormati keberagaman agama di sekolah.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 4 foto</span>
          </div>
        </div>

        <!-- Kegiatan 5: Prestasi Siswa -->
        <div class="activity-card">
          <img src="assets/img/prestasi-siswa.jpg" alt="Prestasi Siswa" />
          <div class="activity-content">
            <h3>PRESTASI SISWA</h3>
            <p>Dokumentasi berbagai prestasi yang diraih oleh siswa-siswi berprestasi.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 1 foto</span>
          </div>
        </div>

        <!-- Kegiatan 6: LDK OSIS -->
        <div class="activity-card">
          <img src="assets/img/ldk-osis.jpg" alt="LDK OSIS" />
          <div class="activity-content">
            <h3>LDK OSIS</h3>
            <p>Latihan Dasar Kepemimpinan OSIS untuk melatih jiwa kepemimpinan siswa.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 4 foto</span>
          </div>
        </div>

        <!-- Kegiatan 7: Perayaan Imlek -->
        <div class="activity-card">
          <img src="assets/img/perayaan-imlek.jpg" alt="Perayaan Imlek" />
          <div class="activity-content">
            <h3>PERAYAAN IMLEK</h3>
            <p>Merayakan Tahun Baru Imlek sebagai bentuk toleransi dan keberagaman.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 3 foto</span>
          </div>
        </div>

        <!-- Kegiatan 8: Pemilihan Ketua & Wakil Ketua OSIS -->
        <div class="activity-card">
          <img src="assets/img/pemilihan-ketua-osis.jpg" alt="Pemilihan Ketua OSIS" />
          <div class="activity-content">
            <h3>PEMILIHAN KETUA & WAKIL KETUA OSIS</h3>
            <p>Kegiatan demokrasi sekolah untuk memilih pemimpin OSIS periode baru.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 4 foto</span>
          </div>
        </div>

        <!-- Kegiatan 9: Debat OSIS -->
        <div class="activity-card">
          <img src="assets/img/debat-osis.jpg" alt="Debat OSIS" />
          <div class="activity-content">
            <h3>DEBAT OSIS</h3>
            <p>Debat calon ketua OSIS untuk menyampaikan visi dan misi kepada seluruh siswa.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 4 foto</span>
          </div>
        </div>

        <!-- Kegiatan 10: Open House -->
        <div class="activity-card">
          <img src="assets/img/open-house.jpg" alt="Open House" />
          <div class="activity-content">
            <h3>OPEN HOUSE</h3>
            <p>Acara open house untuk menyambut calon siswa dan orang tua mengenal sekolah.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 2 foto</span>
          </div>
        </div>

        <!-- Kegiatan 11: Perayaan P5, Visitasi & EDU Fair -->
        <div class="activity-card">
          <img src="assets/img/p5-visitasi-edufair.jpg" alt="P5 Visitasi EDU Fair" />
          <div class="activity-content">
            <h3>PERAYAAN P5, VISITASI & EDU FAIR</h3>
            <p>Kegiatan Projek Penguatan Profil Pelajar Pancasila dan pameran pendidikan.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 1 foto</span>
          </div>
        </div>

        <!-- Kegiatan 12: Visitasi ke Universitas Maranatha Bandung -->
        <div class="activity-card">
          <img src="assets/img/visitasi-maranatha.jpg" alt="Visitasi Universitas Maranatha" />
          <div class="activity-content">
            <h3>VISITASI KE UNIVERSITAS MARANATHA BANDUNG</h3>
            <p>Kunjungan edukatif ke Universitas Maranatha untuk mengenalkan dunia kampus.</p>
            <span class="photo-count"><i class="fas fa-images"></i> 2 foto</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

  <a href="#" class="back-to-top" title="Kembali ke atas"><i class="fas fa-chevron-up"></i></a>

  <script>
    // Back to top button
    const backToTop = document.querySelector('.back-to-top');
    
    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 300) {
        backToTop.classList.add('show');
      } else {
        backToTop.classList.remove('show');
      }
    });

    backToTop.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  </script>
</body>
</html>