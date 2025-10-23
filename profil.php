<?php
require_once __DIR__ . '/includes/config.php';
// profil.php - Halaman Profil Sekolah ISR
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sejarah Singkat - Ignatius Slamet Riyadi</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" />

  <style>
    body {
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial;
    }
    
    .timeline-item {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 0.6s ease forwards;
    }
    
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .timeline-item:nth-child(1) { animation-delay: 0.1s; }
    .timeline-item:nth-child(2) { animation-delay: 0.2s; }
    .timeline-item:nth-child(3) { animation-delay: 0.3s; }
    
    .hero-gradient {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .card-hover {
      transition: all 0.3s ease;
    }
    
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    .school-img-container {
      position: relative;
      overflow: hidden;
      border-radius: 1rem;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .school-img-container img {
      transition: transform 0.5s ease;
    }
    
    .school-img-container:hover img {
      transform: scale(1.05);
    }
    
    .img-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 50%, transparent 100%);
    }
    
    .img-content {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 2rem;
      color: white;
      z-index: 10;
    }
  </style>
</head>
<body class="bg-gray-50">

  <!-- Header -->
  <?php include 'includes/header.php'; ?>

  <!-- Main Content -->
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
      
      <!-- School Image Section -->
      <div class="mb-12">
        <div class="school-img-container card-hover">
          <img src="<?= asset('assets/img/school.png') ?>" alt="Gedung Sekolah Ignatius Slamet Riyadi" class="w-full h-96 object-cover">
          <div class="img-overlay"></div>
          <div class="img-content">
            <h3 class="text-3xl md:text-4xl font-bold mb-2">Ignatius Slamet Riyadi</h3>
            <p class="text-lg md:text-xl text-gray-200">Membangun Generasi Unggul Sejak 1927</p>
            <div class="flex items-center gap-4 mt-4">
              <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm">Bandung, Indonesia</span>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm">Sejak 1927</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Introduction Card -->
      <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 mb-12 card-hover">
        <div class="flex items-start gap-4 mb-6">
          <div class="bg-purple-100 rounded-full p-3">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
          </div>
          <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Awal Mula Perjalanan</h2>
            <div class="h-1 w-20 bg-gradient-to-r from-purple-600 to-purple-400 rounded-full"></div>
          </div>
        </div>
        
        <div class="prose prose-lg max-w-none">
          <p class="text-gray-700 leading-relaxed mb-4">
            Sejarah berawal ketika tiga orang Imam Ordo Salib Suci tiba di Bandung tanggal <strong class="text-gray-900">9 Februari 1927</strong>, mereka adalah <strong class="text-gray-900">Pst. J. H. Goumans, OSC</strong>, <strong class="text-gray-900">Pst. M. Nillesen, OSC</strong>, dan <strong class="text-gray-900">Pst. J. de Rooj, OSC</strong>.
          </p>
          
          <p class="text-gray-700 leading-relaxed mb-4">
            Pada masa awal tugasnya, Pst. J. H. Goumans memusatkan perhatian pada pendirian sekolah-sekolah. Pada bulan <strong class="text-gray-900">Agustus 1927</strong> dengan bermodalkan uang sebesar <strong class="text-gray-900">100 gulden</strong>, dan dengan tujuan untuk memperluas karya misi di bidang sosial, berupa penyelenggaraan sekolah, rumah sakit, dan rumah yatim piatu, yang pada masa itu sangat dibutuhkan oleh masyarakat, maka dibentuklah suatu badan yang diberi nama <strong class="text-purple-600">Heilige Kruis Stichting</strong> pada tanggal <strong class="text-gray-900">17 Agustus 1927</strong>.
          </p>
        </div>
      </div>

      <!-- Founders Section -->
      <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-2xl p-8 md:p-12 mb-12">
        <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Pengurus Pertama</h3>
        
        <div class="grid md:grid-cols-3 gap-6">
          <div class="bg-white rounded-xl p-6 card-hover text-center">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Ketua</h4>
            <p class="text-gray-600">Pst. J. H. Goumans, OSC</p>
          </div>
          
          <div class="bg-white rounded-xl p-6 card-hover text-center">
            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Sekretaris</h4>
            <p class="text-gray-600">Pst. M. Nillesen, OSC</p>
          </div>
          
          <div class="bg-white rounded-xl p-6 card-hover text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Bendahara</h4>
            <p class="text-gray-600">Pst. J. de Rooj, OSC</p>
          </div>
        </div>
      </div>

      <!-- Timeline Section -->
      <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 mb-12">
        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8 text-center">Perkembangan Sekolah</h3>
        
        <div class="relative">
          <!-- Timeline Line -->
          <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-purple-600 via-indigo-500 to-blue-500"></div>
          
          <!-- Timeline Items -->
          <div class="space-y-12">
            
            <!-- 1930 -->
            <div class="timeline-item relative">
              <div class="md:flex items-center">
                <div class="md:w-1/2 md:pr-12 md:text-right">
                  <div class="bg-purple-50 rounded-xl p-6 card-hover">
                    <span class="inline-block bg-purple-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-3">Sekitar Tahun 1930</span>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Rencana Ekspansi</h4>
                    <p class="text-gray-600">Pst. Goumans, OSC berencana untuk mendirikan sekolah-sekolah lagi dalam situasi yang penuh tantangan.</p>
                  </div>
                </div>
                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-purple-600 border-4 border-white rounded-full"></div>
                <div class="md:w-1/2 md:pl-12"></div>
              </div>
            </div>
            
            <!-- Pendirian Sekolah -->
            <div class="timeline-item relative">
              <div class="md:flex items-center">
                <div class="md:w-1/2 md:pr-12"></div>
                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-indigo-600 border-4 border-white rounded-full"></div>
                <div class="md:w-1/2 md:pl-12">
                  <div class="bg-indigo-50 rounded-xl p-6 card-hover">
                    <span class="inline-block bg-indigo-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-3">Pencapaian</span>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Sekolah-Sekolah Berdiri</h4>
                    <p class="text-gray-600 mb-3">Setelah mengalami hambatan dan rintangan yang tak kunjung henti, akhirnya berdirilah berbagai sekolah:</p>
                    <ul class="space-y-2 text-gray-600">
                      <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Standardschool di Kebonwaru</span>
                      </li>
                      <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Schakelschool di Jl. Daendels (sekarang Jl. Jakarta)</span>
                      </li>
                      <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Standardschool di Cibangkong</span>
                      </li>
                      <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>HCS di Majalengka</span>
                      </li>
                      <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Palimanan (Cirebon)</span>
                      </li>
                      <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-indigo-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Subang</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Dukungan -->
            <div class="timeline-item relative">
              <div class="md:flex items-center">
                <div class="md:w-1/2 md:pr-12 md:text-right">
                  <div class="bg-blue-50 rounded-xl p-6 card-hover">
                    <span class="inline-block bg-blue-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-3">Apresiasi</span>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Dukungan Pengelolaan</h4>
                    <p class="text-gray-600">Syukurlah pada waktu itu yang mendampingi Pastor untuk mengurusi sekolah-sekolah tersebut dengan penuh dedikasi dan komitmen.</p>
                  </div>
                </div>
                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-blue-600 border-4 border-white rounded-full"></div>
                <div class="md:w-1/2 md:pl-12"></div>
              </div>
            </div>
            
          </div>
        </div>
      </div>

      <!-- Quote Section -->
      <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl p-8 md:p-12 text-white text-center">
        <svg class="w-12 h-12 mx-auto mb-6 opacity-50" fill="currentColor" viewBox="0 0 24 24">
          <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
        </svg>
        <blockquote class="text-xl md:text-2xl font-medium mb-4">
          "Dari modal 100 gulden, tumbuh semangat untuk mewujudkan pendidikan berkualitas bagi masyarakat"
        </blockquote>
        <p class="text-purple-200">Ignatius Slamet Riyadi - Sejak 1927</p>
      </div>

    </div>
  </section>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

</body>
</html>