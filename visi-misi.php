<?php
require_once __DIR__ . '/includes/config.php'; include("includes/header.php"); ?>

<!-- Banner Visi Misi: full center overlay -->
<section class="relative rounded-2xl overflow-hidden border border-gray-200 shadow-lg">
  <div class="h-64 md:h-80 relative">
    <img src="<?= asset('assets/img/banner.jpg') ?>" alt="Visi Misi SMA ISR" class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black opacity-60"></div>

    <div class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center p-6 md:p-10 text-white">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Visi & Misi</h1>
      <p class="mt-3 md:mt-4 text-base md:text-lg opacity-95">
        SMA Ignatius Slamet Riyadi
      </p>
      <p class="mt-2 text-sm md:text-base opacity-90">
        Membangun Generasi Unggul dan Berkarakter
      </p>
      <div class="mt-5 flex flex-col sm:flex-row gap-3">
        <a href="https://api.whatsapp.com/send/?phone=623815432987&text&type=phone_number&app_absent=0"
           target="_blank" rel="noopener"
           class="inline-flex items-center justify-center px-5 py-3 rounded-xl text-sm font-semibold text-white shadow-md transition"
           style="background-color:#25D366">
          <svg class="mr-2" width="18" height="18" viewBox="0 0 32 32" fill="white" aria-hidden="true">
            <path d="M16 2a13 13 0 0 0-8 23.23V29a1 1 0 0 0 1.51.86l3.65-2.19A12.64 12.64 0 0 0 16 28a13 13 0 0 0 0-26zm0 24a11.13 11.13 0 0 1-2.76-.36 1 1 0 0 0-.76.11L10 27.23v-2.5a1 1 0 0 0-.42-.81A11 11 0 1 1 16 26z"/>
            <path d="M19.86 15.18a1.9 1.9 0 0 0-2.64 0l-.09.09-1.4-1.4.09-.09a1.86 1.86 0 0 0 0-2.64l-1.5-1.5a1.9 1.9 0 0 0-2.64 0l-.8.79a3.56 3.56 0 0 0-.5 3.76 10.64 10.64 0 0 0 2.62 4A8.7 8.7 0 0 0 18.56 21a2.92 2.92 0 0 0 2.1-.79l.79-.8a1.86 1.86 0 0 0 0-2.64z"/>
          </svg>
          Tanya Admin
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Main Content: center, wider & responsive -->
<div class="mx-auto w-full max-w-6xl px-4 sm:px-6 lg:px-8 mt-8">
  
  <!-- Visi Section -->
  <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 lg:p-12 shadow-sm mb-8">
    <div class="flex items-center gap-4 mb-6">
      <div class="w-14 h-14 lg:w-16 lg:h-16 bg-gradient-to-br from-blue-900 to-blue-700 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
        <svg class="w-8 h-8 lg:w-9 lg:h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
        </svg>
      </div>
      <div>
        <h2 class="text-2xl lg:text-3xl font-bold text-blue-900">Visi</h2>
      </div>
    </div>
    
    <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-6 lg:p-8 border-l-4 border-yellow-400">
      <p class="text-lg lg:text-xl text-gray-700 italic leading-relaxed font-medium">
        "Terwujudnya insan pembelajar yang cerdas dan berbudi dengan enterpreuneurship yang mumpuni"
      </p>
    </div>
  </div>

  <!-- Misi Section -->
  <div class="rounded-2xl border border-gray-200 bg-white p-6 sm:p-8 lg:p-12 shadow-sm mb-8">
    <div class="flex items-center gap-4 mb-8">
      <div class="w-14 h-14 lg:w-16 lg:h-16 bg-gradient-to-br from-blue-900 to-blue-700 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0">
        <svg class="w-8 h-8 lg:w-9 lg:h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
        </svg>
      </div>
      <div>
        <h2 class="text-2xl lg:text-3xl font-bold text-blue-900">Misi</h2>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Misi Item 1 -->
      <div class="flex gap-4 group">
        <div class="flex-shrink-0">
          <div class="flex items-center justify-center h-12 w-12 rounded-full bg-gradient-to-br from-blue-900 to-blue-700 shadow-md group-hover:scale-110 transition-transform">
            <span class="text-white font-bold text-lg">1</span>
          </div>
        </div>
        <div class="flex-1">
          <p class="text-gray-700 leading-relaxed font-medium hover:text-blue-900 transition">
            Menjadikan insan pembelajar yang beriman dan taat kepada Tuhan Yang Maha Esa serta memiliki kepribadian yang berbudi luhur
          </p>
        </div>
      </div>

      <!-- Misi Item 2 -->
      <div class="flex gap-4 group">
        <div class="flex-shrink-0">
          <div class="flex items-center justify-center h-12 w-12 rounded-full bg-gradient-to-br from-blue-900 to-blue-700 shadow-md group-hover:scale-110 transition-transform">
            <span class="text-white font-bold text-lg">2</span>
          </div>
        </div>
        <div class="flex-1">
          <p class="text-gray-700 leading-relaxed font-medium hover:text-blue-900 transition">
            Mengembangkan potensi siswa secara akademis dan non akademis dengan berdasar kepada minat dan bakat siswa
          </p>
        </div>
      </div>

      <!-- Misi Item 3 -->
      <div class="flex gap-4 group">
        <div class="flex-shrink-0">
          <div class="flex items-center justify-center h-12 w-12 rounded-full bg-gradient-to-br from-blue-900 to-blue-700 shadow-md group-hover:scale-110 transition-transform">
            <span class="text-white font-bold text-lg">3</span>
          </div>
        </div>
        <div class="flex-1">
          <p class="text-gray-700 leading-relaxed font-medium hover:text-blue-900 transition">
            Menjadikan siswa yang memiliki enterpreuneurship skill: berfikir kritis, kreatif, inovatif, pantang menyerah, problem solving serta berwawasan global
          </p>
        </div>
      </div>

      <!-- Misi Item 4 -->
      <div class="flex gap-4 group">
        <div class="flex-shrink-0">
          <div class="flex items-center justify-center h-12 w-12 rounded-full bg-gradient-to-br from-blue-900 to-blue-700 shadow-md group-hover:scale-110 transition-transform">
            <span class="text-white font-bold text-lg">4</span>
          </div>
        </div>
        <div class="flex-1">
          <p class="text-gray-700 leading-relaxed font-medium hover:text-blue-900 transition">
            Menjadikan insan pembelajar yang berkarakter: disiplin, tanggung jawab, berbudaya dan bertatakrama
          </p>
        </div>
      </div>

      <!-- Misi Item 5 -->
      <div class="flex gap-4 group">
        <div class="flex-shrink-0">
          <div class="flex items-center justify-center h-12 w-12 rounded-full bg-gradient-to-br from-blue-900 to-blue-700 shadow-md group-hover:scale-110 transition-transform">
            <span class="text-white font-bold text-lg">5</span>
          </div>
        </div>
        <div class="flex-1">
          <p class="text-gray-700 leading-relaxed font-medium hover:text-blue-900 transition">
            Menjadikan insan pembelajar yang memiliki kemampuan dalam berbahasa inggris, Teknologi Informasi dan Komunikasi
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- Info Section -->
  <section class="grid md:grid-cols-3 gap-6 mb-12">
    <!-- Keunggulan -->
    <div class="rounded-2xl border border-gray-200 bg-white p-6">
      <h3 class="font-bold text-lg text-blue-900">Keunggulan</h3>
      <ul class="mt-4 list-disc pl-5 text-gray-700 space-y-2">
        <li class="text-sm md:text-base">Pembelajaran aktif berbasis proyek.</li>
        <li class="text-sm md:text-base">Entrepreneurship sejak dini.</li>
        <li class="text-sm md:text-base">Pembinaan karakter yang kuat.</li>
        <li class="text-sm md:text-base">Fasilitas lengkap & lingkungan aman.</li>
      </ul>
    </div>

    <!-- Akademik -->
    <div class="rounded-2xl border border-gray-200 bg-white p-6">
      <h3 class="font-bold text-lg text-blue-900">Akademik</h3>
      <ul class="mt-4 list-disc pl-5 text-gray-700 space-y-2">
        <li class="text-sm md:text-base">Kurikulum Merdeka</li>
        <li class="text-sm md:text-base">Sistem SKS (penyelarasan ke Perguruan Tinggi)</li>
        <li class="text-sm md:text-base">Penguatan karakter & soft-skills</li>
        <li class="text-sm md:text-base">Teknologi Informasi & Komunikasi</li>
      </ul>
    </div>

    <!-- Komitmen -->
    <div class="rounded-2xl border border-gray-200 bg-white p-6">
      <h3 class="font-bold text-lg text-blue-900">Komitmen Kami</h3>
      <p class="mt-4 text-gray-700 text-sm md:text-base leading-relaxed">
        Menciptakan lingkungan pendidikan yang mendukung pertumbuhan holistik siswa, mengintegrasikan nilai-nilai spiritual, akademik, dan entrepreneurial.
      </p>
      <a href="<?= url('kontak.php#daftar') ?>" class="mt-4 inline-flex items-center px-5 py-3 rounded-xl text-sm font-semibold bg-yellow-400 text-black hover:opacity-90 transition">
        Hubungi Kami
      </a>
    </div>
  </section>

  <!-- Statistics Section -->
  <div class="mb-12">
    <div class="rounded-2xl border border-gray-200 bg-gradient-to-r from-blue-900 to-blue-700 p-8 lg:p-12 text-center text-white shadow-lg">
      <h2 class="text-2xl lg:text-3xl font-bold mb-4">Prestasi & Pencapaian</h2>
      <p class="text-sm md:text-base opacity-95 mb-8 max-w-2xl mx-auto">
        SMA Ignatius Slamet Riyadi telah melahirkan lulusan berprestasi yang tersebar di berbagai institusi terkemuka
      </p>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat 1 -->
        <div class="bg-white bg-opacity-10 rounded-xl p-6 backdrop-blur-sm hover:bg-opacity-20 transition">
          <div class="text-4xl lg:text-5xl font-bold mb-2">10+</div>
          <p class="text-sm lg:text-base font-medium opacity-90">Lulusan Berkualitas</p>
        </div>

        <!-- Stat 2 -->
        <div class="bg-white bg-opacity-10 rounded-xl p-6 backdrop-blur-sm hover:bg-opacity-20 transition">
          <div class="text-4xl lg:text-5xl font-bold mb-2">2006</div>
          <p class="text-sm lg:text-base font-medium opacity-90">Tahun Berdiri</p>
        </div>

        <!-- Stat 3 -->
        <div class="bg-white bg-opacity-10 rounded-xl p-6 backdrop-blur-sm hover:bg-opacity-20 transition">
          <div class="text-4xl lg:text-5xl font-bold mb-2">100%</div>
          <p class="text-sm lg:text-base font-medium opacity-90">Inovasi & Kualitas</p>
        </div>

        <!-- Stat 4 -->
        <div class="bg-white bg-opacity-10 rounded-xl p-6 backdrop-blur-sm hover:bg-opacity-20 transition">
          <div class="text-4xl lg:text-5xl font-bold mb-2">5</div>
          <p class="text-sm lg:text-base font-medium opacity-90">Pilar Misi</p>
        </div>
      </div>
    </div>
  </div>

</div>

<?php include("includes/footer.php"); ?>