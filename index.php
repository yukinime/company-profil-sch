<?php include 'includes/header.php'; ?>

  <style>
    /* Custom Animations */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }

    @keyframes slideInLeft {
      from { opacity: 0; transform: translateX(-50px); }
      to { opacity: 1; transform: translateX(0); }
    }

    @keyframes slideInRight {
      from { opacity: 0; transform: translateX(50px); }
      to { opacity: 1; transform: translateX(0); }
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }

    .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
    .animate-float { animation: float 3s ease-in-out infinite; }
    .animate-slide-in-left { animation: slideInLeft 0.8s ease-out forwards; }
    .animate-slide-in-right { animation: slideInRight 0.8s ease-out forwards; }
    .animate-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }

    /* Full Width Video Hero Section */
    .video-hero {
      position: relative;
      width: 100vw;
      margin-left: calc(-50vw + 50%);
      height: 85vh;
      min-height: 600px;
      max-height: 900px;
      overflow: hidden;
    }

    .video-hero video {
      position: absolute;
      top: 50%;
      left: 50%;
      min-width: 100%;
      min-height: 100%;
      width: auto;
      height: auto;
      transform: translate(-50%, -50%);
      object-fit: cover;
    }

    .video-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(34, 139, 34, 0.6) 100%);
      z-index: 1;
    }

    .video-content {
      position: relative;
      z-index: 2;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Gradient Text */
    .gradient-text {
      background: linear-gradient(90deg, #228B22, #FFD700);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Welcome Section */
    .welcome-bg {
      background: linear-gradient(135deg, #228B22 0%, #32CD32 100%);
      border-radius: 30px;
      position: relative;
      overflow: hidden;
    }

    .welcome-bg::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -50%;
      width: 100%;
      height: 100%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
      animation: float 6s ease-in-out infinite;
    }

    .welcome-bg::after {
      content: '';
      position: absolute;
      bottom: -50%;
      left: -50%;
      width: 100%;
      height: 100%;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
      animation: float 8s ease-in-out infinite reverse;
    }

    /* Timeline */
    .timeline-item {
      position: relative;
      padding-left: 50px;
      margin-bottom: 2.5rem;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: 0;
      top: 5px;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: linear-gradient(135deg, #228B22, #FFD700);
      box-shadow: 0 0 0 6px rgba(34, 139, 34, 0.15);
    }

    .timeline-item::after {
      content: '';
      position: absolute;
      left: 8px;
      top: 25px;
      width: 2px;
      height: calc(100% + 15px);
      background: linear-gradient(180deg, #228B22, transparent);
    }

    .timeline-item:last-child::after {
      display: none;
    }

    /* Cards */
    .modern-card {
      background: white;
      border-radius: 24px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
      transition: all 0.4s ease;
      overflow: hidden;
      position: relative;
      border: 1px solid rgba(34, 139, 34, 0.1);
    }

    .modern-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: linear-gradient(90deg, #228B22, #FFD700);
      transform: scaleX(0);
      transition: transform 0.4s ease;
    }

    .modern-card:hover::before {
      transform: scaleX(1);
    }

    .modern-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 60px rgba(34, 139, 34, 0.2);
      border-color: rgba(34, 139, 34, 0.3);
    }

    /* Stats */
    .stat-card {
      background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
      border-radius: 20px;
      padding: 32px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .stat-card:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
      width: 70px;
      height: 70px;
      margin: 0 auto 20px;
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }

    /* Section Spacing */
    .section-spacing {
      padding: 5rem 1rem;
    }

    @media (max-width: 768px) {
      .section-spacing {
        padding: 3rem 1rem;
      }
      .video-hero {
        height: 70vh;
        min-height: 500px;
      }
    }

    /* Announcement Cards */
    .announcement-card {
      background: white;
      border-radius: 20px;
      padding: 28px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
      display: flex;
      gap: 24px;
      align-items: start;
      transition: all 0.3s ease;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .announcement-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 15px 45px rgba(34, 139, 34, 0.15);
      border-color: rgba(34, 139, 34, 0.2);
    }

    .announcement-icon {
      flex-shrink: 0;
      width: 72px;
      height: 72px;
      border-radius: 50%;
      overflow: hidden;
      background: linear-gradient(135deg, #f0fff0, #e0ffe0);
      padding: 4px;
      border: 2px solid rgba(34, 139, 34, 0.1);
    }

    .announcement-icon img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    /* Partner Logos */
    .partner-logo {
      filter: grayscale(100%);
      opacity: 0.6;
      transition: all 0.3s ease;
    }

    .partner-logo:hover {
      filter: grayscale(0%);
      opacity: 1;
      transform: scale(1.08);
    }

    /* History Section */
    .history-card {
      background: white;
      border-radius: 24px;
      padding: 40px;
      box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    /* Scroll animations */
    .scroll-reveal {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.8s ease;
    }

    .scroll-reveal.active {
      opacity: 1;
      transform: translateY(0);
    }

    /* CTA Button Enhanced */
    .cta-btn {
      position: relative;
      overflow: hidden;
    }

    .cta-btn::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.3);
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
    }

    .cta-btn:hover::after {
      width: 300px;
      height: 300px;
    }

    /* Video Controls Enhancement */
    .video-wrapper {
      position: relative;
      background: #000;
    }

    /* Badge Style */
    .badge-modern {
      display: inline-flex;
      align-items: center;
      padding: 8px 20px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border-radius: 50px;
      font-size: 0.9rem;
      font-weight: 600;
      margin-bottom: 1rem;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
  </style>

  <!-- Full Width Video Hero Section -->
  <section class="video-hero">
    <video autoplay muted loop playsinline>
      <source src="./assets/video/profil.mp4" type="video/mp4">
    </video>
    <div class="video-overlay"></div>
    <div class="video-content">
      <div class="max-w-5xl mx-auto px-6 text-center text-white">
        <div class="animate-fade-in-up">
          <div class="badge-modern inline-flex items-center mb-6">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
            </svg>
            Terakreditasi A
          </div>
          
          <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold mb-6 leading-tight tracking-tight">
            Ignatius Slamet Riyadi
          </h1>
          
          <p class="text-2xl md:text-4xl mb-4 font-bold opacity-95">
            Yayasan Salib Suci
          </p>
          
          <p class="text-xl md:text-2xl mb-8 opacity-90 font-medium">
            Resinda Karawang — TK • SD • SMP • SMA
          </p>
          
          <p class="text-base md:text-lg mb-12 opacity-85 max-w-3xl mx-auto leading-relaxed">
            Modern, Profesional, & Berkarakter dengan Kurikulum Merdeka & Entrepreneurship
          </p>
          
          <div class="flex flex-wrap gap-4 justify-center">
            <a href="#tentang" class="cta-btn inline-flex items-center px-10 py-5 rounded-full text-lg font-bold bg-green-500 text-white hover:bg-green-400 transition-all transform hover:scale-105 shadow-2xl">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
              Jelajahi Sekolah Kami
            </a>
            <a href="#daftar" class="cta-btn inline-flex items-center px-10 py-5 rounded-full text-lg font-bold border-2 border-white hover:bg-white hover:text-green-600 transition-all backdrop-blur-sm bg-white/10">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
              </svg>
              Daftar Sekarang
            </a>
          </div>
        </div>
      </div>
    </div>
    
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
      <svg class="w-8 h-8 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
      </svg>
    </div>
  </section>

  <div class="max-w-7xl mx-auto px-4 md:px-6 py-8">

    <!-- Welcome Section -->
    <section class="section-spacing scroll-reveal" id="welcome">
      <div class="welcome-bg text-white p-10 md:p-20 relative">
        <div class="relative z-10">
          <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/3 text-center">
              <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 inline-block">
                <img src="./assets/img/yayasan.png" alt="Logo Yayasan Salib Suci" class="w-56 h-56 mx-auto animate-float drop-shadow-2xl">
              </div>
            </div>
            <div class="md:w-2/3">
              <h2 class="text-4xl md:text-6xl font-extrabold mb-10 leading-tight">
                SELAMAT DATANG DI WEBSITE<br>YAYASAN SALIB SUCI
              </h2>
              <h3 class="text-2xl md:text-3xl font-bold mb-8">
                IGNATIUS SLAMET RIYADI RESINDA KARAWANG
              </h3>
              <div class="space-y-6 text-lg leading-relaxed">
                <p class="opacity-95">
                  Yayasan Salib Suci merupakan sebuah Yayasan Pendidikan penyelenggara pendidikan dasar dan menengah dengan jumlah sekolah, murid, dan guru paling banyak di wilayah Kabupaten Bandung, dengan sekolah-sekolah yang tersebar di semua wilayah di mana terdapat umat Katolik.
                </p>
                <p class="opacity-95">
                  Karya besar penyelenggaraan pendidikan sampai hari ini terus berlangsung. Tercatat <strong class="text-yellow-400">69 sekolah</strong> yang tersebar di Jawa Barat, di antaranya Bandung, Kabupaten Bandung, Purwakarta, Karawang, Subang, Pamanukan, Jatibarang, Indramayu, Cirebon, Ciledug, Cigugur, Cisantana.
                </p>
                <p class="opacity-95">
                  Dikelola oleh lebih dari <strong class="text-yellow-400">1.100 guru/pegawai</strong>, dan melayani lebih dari <strong class="text-yellow-400">12.000 siswa</strong> di seluruh Jawa Barat.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Sejarah Section -->
    <section class="section-spacing bg-white rounded-3xl scroll-reveal" id="sejarah">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20">
          <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
            Sejarah Kami
          </div>
          <h2 class="text-4xl md:text-6xl font-extrabold mb-6">
            <span class="gradient-text">Sejarah</span> Yayasan Salib Suci
          </h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Perjalanan panjang dedikasi dalam dunia pendidikan sejak 1927
          </p>
        </div>

        <div class="grid md:grid-cols-2 gap-16 items-center">
          <div class="order-2 md:order-1">
            <div class="history-card">
              <div class="space-y-6">
                <div class="timeline-item">
                  <h3 class="text-2xl font-bold mb-3 text-gray-900">9 Februari 1927</h3>
                  <p class="text-gray-700 leading-relaxed">
                    Sejarah berawal ketika tiga orang Imam Ordo Salib Suci tiba di Bandung: <strong>Pst. J. H. Goumans, OSC</strong>, <strong>Pst. M. Nillesen, OSC</strong>, dan <strong>Pst. J. de Rooj, OSC</strong>.
                  </p>
                </div>

                <div class="timeline-item">
                  <h3 class="text-2xl font-bold mb-3 text-gray-900">Agustus 1927</h3>
                  <p class="text-gray-700 leading-relaxed">
                    Pada masa awal tugasnya, Pst. J. H. Goumans memusatkan perhatian pada pendirian sekolah-sekolah dengan bermodalkan uang sebesar <strong>100 gulden</strong>, dengan tujuan untuk memperluas karya misi di bidang sosial.
                  </p>
                </div>

                <div class="timeline-item">
                  <h3 class="text-2xl font-bold mb-3 text-gray-900">17 Agustus 1927</h3>
                  <p class="text-gray-700 leading-relaxed">
                    Dibentuk suatu badan yang diberi nama <strong>Heilige Kruis Stichting</strong> untuk penyelenggaraan sekolah, rumah sakit, dan rumah yatim piatu yang sangat dibutuhkan masyarakat. Susunan pengurus pertama diketuai oleh <strong>Pst. J. H. Goumans, OSC</strong> sebagai ketua dan <strong>Pst. M. Nillesen</strong> sebagai sekretaris.
                  </p>
                </div>

                <div class="timeline-item">
                  <h3 class="text-2xl font-bold mb-3 text-gray-900">Hingga Kini</h3>
                  <p class="text-gray-700 leading-relaxed">
                    Yayasan terus berkembang dan memberikan kontribusi nyata dalam dunia pendidikan di berbagai wilayah Jawa Barat, melayani ribuan siswa dengan dedikasi penuh.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="order-1 md:order-2">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl">
              <img src="./assets/img/sejarah.png" alt="Sejarah Yayasan Salib Suci" class="w-full h-auto">
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
              <div class="absolute bottom-0 left-0 right-0 p-10 text-white">
                <p class="text-3xl font-bold mb-2">Lebih dari 95 Tahun</p>
                <p class="text-xl opacity-90">Melayani Pendidikan Indonesia</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Jenjang Pendidikan -->
    <section class="section-spacing scroll-reveal" id="jenjang">
      <div class="text-center mb-20">
        <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
          Jenjang Pendidikan
        </div>
        <h2 class="text-4xl md:text-6xl font-extrabold mb-6">
          Jenjang <span class="gradient-text">Pendidikan</span>
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
          Kurikulum Merdeka & Entrepreneurship dengan Sistem SKS
        </p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="modern-card p-10">
          <div class="text-center mb-6">
            <div class="w-28 h-28 mx-auto mb-6 rounded-full bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center text-white text-4xl font-extrabold shadow-xl">
              TK
            </div>
          </div>
          <h3 class="text-2xl font-bold mb-5 text-center">Taman Kanak-Kanak</h3>
          <p class="text-gray-600 mb-8 text-center leading-relaxed">
            Humaniora School, Basic Life Skill, Full Day School, Environmental Learning Activity
          </p>
          <a href="./tk.php" class="block w-full text-center px-6 py-4 rounded-full bg-gradient-to-r from-pink-400 to-pink-600 text-white font-bold hover:shadow-2xl transition-all transform hover:scale-105">
            Pelajari Lebih Lanjut →
          </a>
        </div>

        <div class="modern-card p-10">
          <div class="text-center mb-6">
            <div class="w-28 h-28 mx-auto mb-6 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white text-4xl font-extrabold shadow-xl">
              SD
            </div>
          </div>
          <h3 class="text-2xl font-bold mb-5 text-center">Sekolah Dasar</h3>
          <p class="text-gray-600 mb-8 text-center leading-relaxed">
            Green School Project, Healthy Lunch Program, Kompetisi Akademik & Non-Akademik, Digital Learning Corner
          </p>
          <a href="./sd.php" class="block w-full text-center px-6 py-4 rounded-full bg-gradient-to-r from-green-400 to-green-600 text-white font-bold hover:shadow-2xl transition-all transform hover:scale-105">
            Pelajari Lebih Lanjut →
          </a>
        </div>

        <div class="modern-card p-10">
          <div class="text-center mb-6">
            <div class="w-28 h-28 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-4xl font-extrabold shadow-xl">
              SMP
            </div>
          </div>
          <h3 class="text-2xl font-bold mb-5 text-center">Sekolah Menengah Pertama</h3>
          <p class="text-gray-600 mb-8 text-center leading-relaxed">
            Talent Development, English Program, Good Relationship, Character & Leadership Building
          </p>
          <a href="./smp.php" class="block w-full text-center px-6 py-4 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 text-white font-bold hover:shadow-2xl transition-all transform hover:scale-105">
            Pelajari Lebih Lanjut →
          </a>
        </div>

        <div class="modern-card p-10">
          <div class="text-center mb-6">
            <div class="w-28 h-28 mx-auto mb-6 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-white text-4xl font-extrabold shadow-xl">
              SMA
            </div>
          </div>
          <h3 class="text-2xl font-bold mb-5 text-center">Sekolah Menengah Atas</h3>
          <p class="text-gray-600 mb-8 text-center leading-relaxed">
            School of Entrepreneurship, Project Based Learning, Moving Class, Pengembangan Minat & Bakat
          </p>
          <a href="./sma.php" class="block w-full text-center px-6 py-4 rounded-full bg-gradient-to-r from-yellow-400 to-yellow-600 text-white font-bold hover:shadow-2xl transition-all transform hover:scale-105">
            Pelajari Lebih Lanjut →
          </a>
        </div>
      </div>
    </section>

    <!-- Tentang Sekolah -->
    <section id="tentang" class="section-spacing bg-white rounded-3xl scroll-reveal">
      <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-12">
          <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
            Profil Sekolah
          </div>
          <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Tentang <span class="gradient-text">Sekolah</span></h2>
          <p class="text-lg text-gray-700 leading-relaxed mb-10 max-w-4xl mx-auto">
            Ignatius Slamet Riyadi didirikan pada tahun 2006, dan telah meluluskan ribuan lulusan, banyak di antaranya adalah profesional di institusi terbaik di Indonesia. Sekolah kami menerapkan Kurikulum Merdeka serta Entrepreneurship, dengan sistem SKS, sebagai satu-satunya sekolah di Karawang yang menerapkan sistem ini.
          </p>
        </div>
        <div class="relative rounded-3xl overflow-hidden shadow-2xl video-wrapper">
          <div class="relative w-full" style="padding-top:56.25%;">
            <video class="absolute inset-0 w-full h-full" controls preload="metadata" playsinline poster="./assets/img/banner.jpg">
              <source src="./assets/video/profil.mp4" type="video/mp4">
              Browser Anda tidak mendukung pemutar video HTML5.
            </video>
          </div>
        </div>
      </div>
    </section>

    <!-- Announcement ISR -->
    <section id="announcement" class="section-spacing scroll-reveal">
      <div class="text-center mb-20">
        <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
          Program Unggulan
        </div>
        <h2 class="text-4xl md:text-6xl font-extrabold mb-6">
          <span class="gradient-text">Announcement</span> ISR
        </h2>
        <p class="text-xl text-gray-600">
          Ignatius Slamet Riyadi - Program Unggulan
        </p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="announcement-card">
          <div class="announcement-icon">
            <img src="./assets/img/AnnouncementSdSmpSma.png" alt="TK">
          </div>
          <div>
            <h5 class="text-xl font-bold mb-3 text-gray-900">TK</h5>
            <p class="text-gray-600 leading-relaxed">
              Humaniora School, Basic Life Skill, Full Day School, Environmental Learning Activity
            </p>
          </div>
        </div>

        <div class="announcement-card">
          <div class="announcement-icon">
            <img src="./assets/img/AnnouncementSdSmpSma.png" alt="SD">
          </div>
          <div>
            <h5 class="text-xl font-bold mb-3 text-gray-900">SD</h5>
            <p class="text-gray-600 leading-relaxed">
              Green School Project, Healthy Lunch Program, Kompetisi Akademik & Non-Akademik, Digital Learning Corner
            </p>
          </div>
        </div>

        <div class="announcement-card">
          <div class="announcement-icon">
            <img src="./assets/img/AnnouncementSdSmpSma.png" alt="SMP">
          </div>
          <div>
            <h5 class="text-xl font-bold mb-3 text-gray-900">SMP</h5>
            <p class="text-gray-600 leading-relaxed">
              Talent Development, English Program, Good Relationship, Character & Leadership Building
            </p>
          </div>
        </div>

        <div class="announcement-card">
          <div class="announcement-icon">
            <img src="./assets/img/AnnouncementSdSmpSma.png" alt="SMA">
          </div>
          <div>
            <h5 class="text-xl font-bold mb-3 text-gray-900">SMA</h5>
            <p class="text-gray-600 leading-relaxed">
              School of Entrepreneurship, Project Based Learning, Pembelajaran Digital, Moving Class
            </p>
          </div>
        </div>

        <div class="announcement-card">
          <div class="announcement-icon">
            <img src="./assets/img/Announcementketakwaan.jpg" alt="Ketaqwaan">
          </div>
          <div>
            <h5 class="text-xl font-bold mb-3 text-gray-900">Ketaqwaan kepada Tuhan YME</h5>
            <p class="text-gray-600 leading-relaxed">
              Memfasilitasi ibadah sesuai agama & kepercayaan masing-masing
            </p>
          </div>
        </div>

        <div class="announcement-card">
          <div class="announcement-icon">
            <img src="./assets/img/AnnouncementPenguasaan.png" alt="IPTEK">
          </div>
          <div>
            <h5 class="text-xl font-bold mb-3 text-gray-900">Penguasaan IPTEK</h5>
            <p class="text-gray-600 leading-relaxed">
              Peserta didik menguasai ilmu pengetahuan & teknologi dengan baik
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Statistics -->
    <section class="section-spacing bg-white rounded-3xl scroll-reveal" id="prestasi">
      <div class="text-center mb-20">
        <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
          Pencapaian Kami
        </div>
        <h2 class="text-4xl md:text-6xl font-extrabold mb-6">
          Prestasi & <span class="gradient-text">Pencapaian</span>
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
          Angka-angka yang menunjukkan komitmen kami dalam memberikan layanan terbaik
        </p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="stat-card">
          <div class="stat-icon bg-gradient-to-br from-pink-400 to-pink-600">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
          </div>
          <div class="text-5xl font-extrabold text-gray-900 mb-3 counter" data-count="3472">0</div>
          <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Happy Customers</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon bg-gradient-to-br from-green-400 to-green-600">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
              <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
            </svg>
          </div>
          <div class="text-5xl font-extrabold text-gray-900 mb-3 counter" data-count="4537">0</div>
          <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Expert Employees</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon bg-gradient-to-br from-blue-400 to-blue-600">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17 3H7v3H3v3c0 3.31 2.69 6 6 6h6c3.31 0 6-2.69 6-6V6h-4V3zM8 21h8v-2H8v2z"/>
            </svg>
          </div>
          <div class="text-5xl font-extrabold text-gray-900 mb-3 counter" data-count="2654">0</div>
          <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Awards Won</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon bg-gradient-to-br from-yellow-400 to-yellow-600">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM3.18 12.4L1 13.5 12 19l3.5-1.86V15L12 18 3.18 12.4z"/>
            </svg>
          </div>
          <div class="text-5xl font-extrabold text-gray-900 mb-3 counter" data-count="1789">0</div>
          <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Graduated Students</div>
        </div>
      </div>
    </section>

    <!-- Partnership -->
    <section class="section-spacing scroll-reveal" id="partnership">
      <div class="text-center mb-20">
        <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
          Mitra Kami
        </div>
        <h2 class="text-4xl md:text-6xl font-extrabold mb-6">
          <span class="gradient-text">Partnership</span>
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
          Bekerja sama dengan institusi terbaik untuk memberikan pendidikan berkualitas
        </p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-12 items-center justify-items-center">
        <div class="flex justify-center">
          <img src="./assets/img/Patnership1.png" alt="Partner 1" class="partner-logo w-40 md:w-52 h-auto">
        </div>
        <div class="flex justify-center">
          <img src="./assets/img/Patnership2.png" alt="Partner 2" class="partner-logo w-40 md:w-52 h-auto">
        </div>
        <div class="flex justify-center">
          <img src="./assets/img/Patnership3.png" alt="Partner 3" class="partner-logo w-40 md:w-52 h-auto">
        </div>
        <div class="flex justify-center">
          <img src="./assets/img/Patnership4.png" alt="Partner 4" class="partner-logo w-40 md:w-52 h-auto">
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="section-spacing scroll-reveal" id="daftar">
      <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-green-600 via-green-500 to-emerald-500 p-16 md:p-24 text-center text-white shadow-2xl">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white opacity-5 rounded-full -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-white opacity-5 rounded-full -ml-40 -mb-40"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full">
          <div class="absolute top-0 left-1/4 w-2 h-2 bg-white rounded-full animate-pulse"></div>
          <div class="absolute bottom-1/4 right-1/4 w-3 h-3 bg-white rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
          <div class="absolute top-1/3 right-1/3 w-2 h-2 bg-white rounded-full animate-pulse" style="animation-delay: 1s;"></div>
        </div>
        <div class="relative z-10">
          <div class="inline-block px-6 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white font-semibold mb-6">
            Pendaftaran Terbuka
          </div>
          <h2 class="text-4xl md:text-6xl font-extrabold mb-8 leading-tight">
            Siap Bergabung dengan Kami?
          </h2>
          <p class="text-xl md:text-2xl mb-12 opacity-95 max-w-3xl mx-auto leading-relaxed">
            Daftarkan putra-putri Anda sekarang dan jadilah bagian dari keluarga besar ISR Resinda
          </p>
          <div class="flex flex-wrap gap-5 justify-center">
            <a href="./kontak.php#daftar" class="cta-btn inline-flex items-center px-12 py-5 rounded-full text-lg font-bold bg-white text-green-600 hover:bg-gray-100 transition-all transform hover:scale-105 shadow-2xl">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
              </svg>
              Daftar Sekarang
            </a>
            <a href="./profil.php" class="cta-btn inline-flex items-center px-12 py-5 rounded-full text-lg font-bold border-2 border-white hover:bg-white hover:text-green-600 transition-all backdrop-blur-sm bg-white/10">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              Lihat Profil Lengkap
            </a>
          </div>
        </div>
      </div>
    </section>

  </div>

  <!-- JavaScript -->
  <script>
    // Counter Animation
    document.addEventListener("DOMContentLoaded", () => {
      const counters = document.querySelectorAll(".counter");
      const options = { threshold: 0.6 };

      const animateCounter = (el) => {
        const target = parseInt(el.dataset.count);
        let current = 0;
        const increment = Math.max(1, Math.floor(target / 100));
        
        const updateCounter = () => {
          current += increment;
          if (current >= target) {
            el.textContent = target.toLocaleString();
          } else {
            el.textContent = current.toLocaleString();
            requestAnimationFrame(updateCounter);
          }
        };
        updateCounter();
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            animateCounter(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, options);

      counters.forEach(counter => observer.observe(counter));
    });

    // Scroll Reveal Animation
    const scrollReveal = () => {
      const reveals = document.querySelectorAll('.scroll-reveal');
      
      reveals.forEach(element => {
        const windowHeight = window.innerHeight;
        const elementTop = element.getBoundingClientRect().top;
        const elementVisible = 150;
        
        if (elementTop < windowHeight - elementVisible) {
          element.classList.add('active');
        }
      });
    };

    window.addEventListener('scroll', scrollReveal);
    scrollReveal(); // Initial check

    // Smooth Scroll
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

<?php include 'includes/footer.php'; ?>