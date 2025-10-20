<?php
// team.php - Halaman Tim & Pengajar Sekolah ISR
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tim Kami - Ignatius Slamet Riyadi</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css" />

  <style>
    body {
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial;
    }
    
    .hero-gradient {
      background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
      position: relative;
      overflow: hidden;
    }
    
    .hero-gradient::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></svg>');
      opacity: 0.3;
    }
    
    .team-card {
      position: relative;
      overflow: hidden;
      border-radius: 0.75rem;
      transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      background: white;
      border: 1px solid #e5e7eb;
    }
    
    .team-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
      border-color: #667eea;
    }
    
    .team-img-wrapper {
      position: relative;
      width: 100%;
      height: 400px;
      overflow: hidden;
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }
    
    .team-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.6s ease;
      filter: grayscale(20%);
    }
    
    .team-card:hover .team-img {
      transform: scale(1.08);
      filter: grayscale(0%);
    }
    
    .team-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.4) 40%, transparent 100%);
      opacity: 0;
      transition: opacity 0.5s ease;
    }
    
    .team-card:hover .team-overlay {
      opacity: 1;
    }
    
    .team-info {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 2rem;
      color: white;
      transform: translateY(100%);
      transition: transform 0.5s ease;
    }
    
    .team-card:hover .team-info {
      transform: translateY(0);
    }
    
    .badge {
      display: inline-block;
      padding: 0.5rem 1rem;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border-radius: 0.25rem;
    }
    
    .badge-primary {
      background: #1e293b;
      color: white;
    }
    
    .badge-secondary {
      background: #f1f5f9;
      color: #334155;
      border: 1px solid #e2e8f0;
    }
    
    .stats-card {
      background: white;
      border-radius: 0.75rem;
      padding: 2.5rem 2rem;
      text-align: center;
      transition: all 0.3s ease;
      border: 1px solid #e5e7eb;
    }
    
    .stats-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
      border-color: #667eea;
    }
    
    .stats-number {
      font-size: 3rem;
      font-weight: 800;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .animate-fade-in {
      animation: fadeIn 0.8s ease forwards;
      opacity: 0;
    }
    
    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }
    
    .animate-fade-in:nth-child(1) { animation-delay: 0.2s; }
    .animate-fade-in:nth-child(2) { animation-delay: 0.3s; }
    .animate-fade-in:nth-child(3) { animation-delay: 0.4s; }
    
    .section-divider {
      height: 3px;
      width: 60px;
      background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
      margin: 1.5rem auto;
    }
    
    .contact-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1.5rem;
      background: white;
      color: #1e293b;
      border: 2px solid #e5e7eb;
      border-radius: 0.5rem;
      font-weight: 600;
      font-size: 0.875rem;
      transition: all 0.3s ease;
      text-decoration: none;
    }
    
    .contact-btn:hover {
      background: #1e293b;
      color: white;
      border-color: #1e293b;
      transform: translateX(5px);
    }
    
    .profile-detail {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 1rem;
      background: #f8fafc;
      border-radius: 0.5rem;
      margin-bottom: 0.75rem;
      transition: all 0.3s ease;
    }
    
    .profile-detail:hover {
      background: #f1f5f9;
    }
    
    .profile-icon {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      border-radius: 0.5rem;
      color: #667eea;
      flex-shrink: 0;
    }
    
    .title-section {
      text-align: center;
      margin-bottom: 4rem;
    }
    
    .subtitle {
      display: inline-block;
      padding: 0.5rem 1.25rem;
      background: #f1f5f9;
      color: #475569;
      border-radius: 9999px;
      font-size: 0.875rem;
      font-weight: 600;
      letter-spacing: 0.05em;
      margin-bottom: 1rem;
    }
    
    .team-grid-large {
      max-width: 1000px;
      margin: 0 auto;
    }
    
    .team-grid-small {
      max-width: 1200px;
      margin: 0 auto;
    }
    
    .expertise-tag {
      display: inline-block;
      padding: 0.5rem 1rem;
      background: white;
      color: #64748b;
      border: 1px solid #e2e8f0;
      border-radius: 9999px;
      font-size: 0.813rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .expertise-tag:hover {
      background: #667eea;
      color: white;
      border-color: #667eea;
    }
  </style>
</head>
<body class="bg-gray-50">

  <!-- Header -->
  <?php include 'includes/header.php'; ?>


  <!-- Stats Section -->
  <section class="py-16 -mt-12">
    <div class="max-w-7xl mx-auto px-4">
      <div class="grid md:grid-cols-3 gap-6">
        <div class="stats-card animate-fade-in">
          <div class="stats-number">1</div>
          <div class="text-base font-semibold text-gray-900 mb-1">Kepala Sekolah</div>
          <div class="text-sm text-gray-600">Pemimpin Berpengalaman</div>
        </div>
        <div class="stats-card animate-fade-in">
          <div class="stats-number">50+</div>
          <div class="text-base font-semibold text-gray-900 mb-1">Tenaga Pendidik</div>
          <div class="text-sm text-gray-600">Profesional Tersertifikasi</div>
        </div>
        <div class="stats-card animate-fade-in">
          <div class="stats-number">98+</div>
          <div class="text-base font-semibold text-gray-900 mb-1">Tahun Pengalaman</div>
          <div class="text-sm text-gray-600">Gabungan Seluruh Tim</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Kepala Sekolah Section -->
  <section class="py-20">
    <div class="max-w-7xl mx-auto px-4">
      <div class="title-section">
        <div class="subtitle">PIMPINAN SEKOLAH</div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Kepala Sekolah</h2>
        <div class="section-divider"></div>
      </div>

      <div class="team-grid-large">
        <div class="team-card animate-fade-in">
          <div class="grid md:grid-cols-5 gap-0">
            <div class="md:col-span-2">
              <div class="team-img-wrapper h-full">
                <img src="assets/img/kepsek.png" alt="Ignasia Hastari K, S.Psi" class="team-img">
                <div class="team-overlay"></div>
                <div class="team-info">
                  <div class="badge badge-primary mb-3">KEPALA SEKOLAH</div>
                  <p class="text-sm text-gray-200 leading-relaxed">
                    Memimpin dengan visi untuk menciptakan lingkungan belajar yang inspiratif dan memberdayakan setiap potensi siswa.
                  </p>
                </div>
              </div>
            </div>
            <div class="md:col-span-3 p-8 md:p-10">
              <div class="mb-6">
                <span class="badge badge-secondary mb-4">KEPALA SEKOLAH SMA</span>
                <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                  Ignasia Hastari K, S.Psi
                </h3>
                <p class="text-lg text-gray-600 font-medium">
                  Kepala Sekolah SMA
                </p>
              </div>
              
              <div class="mb-6">
                <p class="text-gray-700 leading-relaxed mb-4">
                  Berdedikasi dalam mengembangkan potensi setiap siswa melalui pendekatan holistik dan inovatif. Dengan latar belakang psikologi, beliau memahami kebutuhan perkembangan karakter dan akademik siswa secara menyeluruh.
                </p>
              </div>

              <div class="space-y-3 mb-6">
                <div class="profile-detail">
                  <div class="profile-icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                  </div>
                  <div class="flex-1">
                    <div class="text-xs text-gray-500 font-medium uppercase tracking-wide">Bidang</div>
                    <div class="text-sm font-semibold text-gray-900">Manajemen Sekolah & Psikologi Pendidikan</div>
                  </div>
                </div>
                
                <div class="profile-detail">
                  <div class="profile-icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                  </div>
                  <div class="flex-1">
                    <div class="text-xs text-gray-500 font-medium uppercase tracking-wide">Pendidikan</div>
                    <div class="text-sm font-semibold text-gray-900">S.Psi - Sarjana Psikologi</div>
                  </div>
                </div>
              </div>
              
              <div class="flex flex-wrap gap-2">
                <span class="expertise-tag">Kepemimpinan</span>
                <span class="expertise-tag">Manajemen Pendidikan</span>
                <span class="expertise-tag">Psikologi Pendidikan</span>
                <span class="expertise-tag">Pengembangan Kurikulum</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tim Pendidik Section -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
      <div class="title-section">
        <div class="subtitle">TENAGA PENDIDIK</div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Tim Pengajar Profesional</h2>
        <div class="section-divider"></div>
        <p class="text-gray-600 max-w-2xl mx-auto text-base">
          Tenaga pendidik berpengalaman dan berkualitas yang berkomitmen membimbing siswa meraih prestasi terbaik
        </p>
      </div>

      <div class="team-grid-small">
        <div class="grid md:grid-cols-2 gap-8">
          
          <!-- Wawan Purwana -->
          <div class="team-card animate-fade-in">
            <div class="team-img-wrapper">
              <img src="assets/img/wk.png" alt="Wawan Purwana, S.Kom., M.Kom" class="team-img">
              <div class="team-overlay"></div>
              <div class="team-info">
                <div class="badge badge-primary mb-3">WAKIL KEPALA SEKOLAH</div>
                <p class="text-sm text-gray-200 leading-relaxed">
                  Mengawasi dan mengembangkan program kesiswaan untuk menciptakan lingkungan kondusif dan mendukung karakter siswa.
                </p>
              </div>
            </div>
            <div class="p-6">
              <div class="mb-4">
                <span class="badge badge-secondary mb-3">WK BIDANG KESISWAAN</span>
                <h3 class="text-xl font-bold text-gray-900 mb-1">
                  Wawan Purwana, S.Kom., M.Kom
                </h3>
                <p class="text-base text-gray-600 font-medium">
                  Wakil Kepala Bidang Kesiswaan
                </p>
              </div>
              
              <div class="space-y-2 mb-4">
                <div class="flex items-center gap-2 text-sm text-gray-600">
                  <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                  </svg>
                  <span>S.Kom., M.Kom - Magister Ilmu Komputer</span>
                </div>
              </div>
              
              <div class="flex flex-wrap gap-2">
                <span class="expertise-tag">Teknologi Informasi</span>
                <span class="expertise-tag">Manajemen Siswa</span>
                <span class="expertise-tag">Pengembangan Program</span>
              </div>
            </div>
          </div>

          <!-- Yulia Titik Widayati -->
          <div class="team-card animate-fade-in">
            <div class="team-img-wrapper">
              <img src="assets/img/sejarah.png" alt="Yulia Titik Widayati S.S" class="team-img">
              <div class="team-overlay"></div>
              <div class="team-info">
                <div class="badge badge-primary mb-3">GURU SENIOR</div>
                <p class="text-sm text-gray-200 leading-relaxed">
                  Mengajar dengan pendekatan interaktif untuk membangkitkan minat siswa dalam memahami sejarah dan nilai kewarganegaraan.
                </p>
              </div>
            </div>
            <div class="p-6">
              <div class="mb-4">
                <span class="badge badge-secondary mb-3">GURU MATA PELAJARAN</span>
                <h3 class="text-xl font-bold text-gray-900 mb-1">
                  Yulia Titik Widayati S.S
                </h3>
                <p class="text-base text-gray-600 font-medium">
                  Guru Sejarah dan PKN
                </p>
              </div>
              
              <div class="space-y-2 mb-4">
                <div class="flex items-center gap-2 text-sm text-gray-600">
                  <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                  </svg>
                  <span>S.S - Sarjana Sastra</span>
                </div>
              </div>
              
              <div class="flex flex-wrap gap-2">
                <span class="expertise-tag">Sejarah Indonesia</span>
                <span class="expertise-tag">PKN</span>
                <span class="expertise-tag">Pendidikan Karakter</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

</body>
</html>