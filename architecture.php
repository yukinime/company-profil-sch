<?php include 'includes/header.php'; ?>

<section class="py-16 bg-gradient-to-br from-gray-50 via-white to-blue-50">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Architecture Design</h1>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">Desain arsitektur inovatif dan fungsional untuk berbagai jenis bangunan residensial, komersial, dan institusional</p>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
      <div class="text-center bg-white rounded-xl p-6 shadow-md">
        <div class="text-4xl font-bold text-blue-600 mb-2">50+</div>
        <div class="text-sm text-gray-600">Proyek Selesai</div>
      </div>
      <div class="text-center bg-white rounded-xl p-6 shadow-md">
        <div class="text-4xl font-bold text-green-600 mb-2">30+</div>
        <div class="text-sm text-gray-600">Klien Puas</div>
      </div>
      <div class="text-center bg-white rounded-xl p-6 shadow-md">
        <div class="text-4xl font-bold text-purple-600 mb-2">15+</div>
        <div class="text-sm text-gray-600">Penghargaan</div>
      </div>
      <div class="text-center bg-white rounded-xl p-6 shadow-md">
        <div class="text-4xl font-bold text-yellow-600 mb-2">100%</div>
        <div class="text-sm text-gray-600">Kepuasan</div>
      </div>
    </div>

    <!-- Categories -->
    <div class="flex flex-wrap justify-center gap-3 mb-12">
      <button class="px-6 py-2 rounded-full bg-blue-600 text-white font-medium hover:bg-blue-700 transition">Semua</button>
      <button class="px-6 py-2 rounded-full bg-white text-gray-700 font-medium hover:bg-gray-100 transition border border-gray-300">Residensial</button>
      <button class="px-6 py-2 rounded-full bg-white text-gray-700 font-medium hover:bg-gray-100 transition border border-gray-300">Komersial</button>
      <button class="px-6 py-2 rounded-full bg-white text-gray-700 font-medium hover:bg-gray-100 transition border border-gray-300">Institusional</button>
      <button class="px-6 py-2 rounded-full bg-white text-gray-700 font-medium hover:bg-gray-100 transition border border-gray-300">Landscape</button>
    </div>

    <!-- Architecture Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      
      <!-- Project 1 -->
      <div class="group bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300">
        <div class="aspect-[4/3] bg-gradient-to-br from-blue-300 to-indigo-300 relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center">
              <span class="text-white text-xl font-bold">Rumah Modern 2 Lantai</span>
              <p class="text-white/80 text-sm mt-2">400 m² | 4 Kamar Tidur</p>
            </div>
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
        </div>
        <div class="p-8">
          <div class="flex items-center gap-2 mb-3">
            <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-3 py-1 rounded-full">Residensial</span>
            <span class="text-xs text-gray-500">2024</span>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">Desain Rumah Minimalis Modern</h3>
          <p class="text-gray-600 mb-6">Desain rumah dengan konsep minimalis modern, memaksimalkan pencahayaan alami dan ventilasi udara. Menggunakan material berkualitas dan sustainable design.</p>
          <div class="flex flex-wrap gap-2 mb-6">
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Open Space</span>
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Green Design</span>
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Smart Home</span>
          </div>
          <button class="text-blue-600 hover:text-blue-800 font-semibold flex items-center gap-2">
            Lihat Detail Proyek 
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Project 2 -->
      <div class="group bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300">
        <div class="aspect-[4/3] bg-gradient-to-br from-purple-300 to-pink-300 relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center">
              <span class="text-white text-xl font-bold">Gedung Perkantoran</span>
              <p class="text-white/80 text-sm mt-2">2500 m² | 8 Lantai</p>
            </div>
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
        </div>
        <div class="p-8">
          <div class="flex items-center gap-2 mb-3">
            <span class="text-xs font-semibold text-purple-600 bg-purple-100 px-3 py-1 rounded-full">Komersial</span>
            <span class="text-xs text-gray-500">2024</span>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">Kantor Modern Berlantai 8</h3>
          <p class="text-gray-600 mb-6">Desain gedung perkantoran dengan konsep modern futuristik. Dilengkapi dengan sistem HVAC efisien, curtain wall kaca, dan rooftop garden untuk kenyamanan penghuni.</p>
          <div class="flex flex-wrap gap-2 mb-6">
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Energy Efficient</span>
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Modern Facade</span>
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Rooftop Garden</span>
          </div>
          <button class="text-blue-600 hover:text-blue-800 font-semibold flex items-center gap-2">
            Lihat Detail Proyek 
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Project 3 -->
      <div class="group bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300">
        <div class="aspect-[4/3] bg-gradient-to-br from-green-300 to-teal-300 relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center">
              <span class="text-white text-xl font-bold">Sekolah Internasional</span>
              <p class="text-white/80 text-sm mt-2">5000 m² | 3 Lantai</p>
            </div>
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
        </div>
        <div class="p-8">
          <div class="flex items-center gap-2 mb-3">
            <span class="text-xs font-semibold text-green-600 bg-green-100 px-3 py-1 rounded-full">Institusional</span>
            <span class="text-xs text-gray-500">2023</span>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">Gedung Sekolah Internasional</h3>
          <p class="text-gray-600 mb-6">Desain gedung sekolah dengan pendekatan child-friendly design, ruang kelas yang nyaman, area bermain outdoor, dan fasilitas pembelajaran modern yang lengkap.</p>
          <div class="flex flex-wrap gap-2 mb-6">
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Child Friendly</span>
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Natural Light</span>
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Outdoor Space</span>
          </div>
          <button class="text-blue-600 hover:text-blue-800 font-semibold flex items-center gap-2">
            Lihat Detail Proyek 
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Project 4 -->
      <div class="group bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300">
        <div class="aspect-[4/3] bg-gradient-to-br from-yellow-300 to-orange-300 relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center">
              <span class="text-white text-xl font-bold">Taman Kota</span>
              <p class="text-white/80 text-sm mt-2">10000 m² | Urban Park</p>
            </div>
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
        </div>
        <div class="p-8">
          <div class="flex items-center gap-2 mb-3">
            <span class="text-xs font-semibold text-yellow-600 bg-yellow-100 px-3 py-1 rounded-full">Landscape</span>
            <span class="text-xs text-gray-500">2023</span>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">Urban Park & Recreation</h3>
          <p class="text-gray-600 mb-6">Desain taman kota dengan konsep eco-friendly, walking path, jogging track, playground, dan area rekreasi keluarga. Mengintegrasikan vegetasi lokal dan sistem drainase alami.</p>
          <div class="flex flex-wrap gap-2 mb-6">
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Eco Design</span>
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Native Plants</span>
            <span class="text-xs bg-gray-100 text-gray-700 px-3 py-1 rounded-full">Water Feature</span>
          </div>
          <button class="text-blue-600 hover:text-blue-800 font-semibold flex items-center gap-2">
            Lihat Detail Proyek 
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
          </button>
        </div>
      </div>

    </div>

    <!-- Services Section -->
    <div class="mt-20 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-3xl p-12 text-white">
      <div class="text-center mb-10">
        <h2 class="text-3xl font-bold mb-4">Layanan Desain Arsitektur</h2>
        <p class="text-lg opacity-90">Kami menyediakan layanan desain arsitektur lengkap dari konsep hingga konstruksi</p>
      </div>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="text-center">
          <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-2">Konsep & Desain</h3>
          <p class="opacity-90 text-sm">Pengembangan konsep desain sesuai kebutuhan dan anggaran klien</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-2">Gambar Kerja</h3>
          <p class="opacity-90 text-sm">Penyusunan gambar kerja detail untuk keperluan konstruksi</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-2">Pengawasan</h3>
          <p class="opacity-90 text-sm">Supervisi dan quality control selama proses konstruksi</p>
        </div>
      </div>
      <div class="text-center mt-10">
        <a href="../kontak.php" class="inline-block px-8 py-3 bg-white text-blue-600 font-bold rounded-xl hover:bg-gray-100 transition">Konsultasi Gratis</a>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>