<?php include '../includes/header.php'; ?>

<section class="py-16 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">
  <div class="max-w-7xl mx-auto px-4">
    
    <!-- Hero Section -->
    <div class="text-center mb-16">
      <div class="inline-block px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold mb-4">
        Ekstrakurikuler
      </div>
      <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Semua Program Ekstrakurikuler</h1>
      <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">Temukan dan kembangkan potensi terbaikmu melalui berbagai program ekstrakurikuler yang dirancang untuk membentuk karakter, keterampilan, dan prestasi</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid md:grid-cols-4 gap-6 mb-16">
      <div class="bg-white rounded-2xl p-6 text-center shadow-lg">
        <div class="text-4xl font-bold text-indigo-600 mb-2">25+</div>
        <p class="text-gray-600 font-medium">Program Ekskul</p>
      </div>
      <div class="bg-white rounded-2xl p-6 text-center shadow-lg">
        <div class="text-4xl font-bold text-purple-600 mb-2">50+</div>
        <p class="text-gray-600 font-medium">Pembina Ahli</p>
      </div>
      <div class="bg-white rounded-2xl p-6 text-center shadow-lg">
        <div class="text-4xl font-bold text-pink-600 mb-2">800+</div>
        <p class="text-gray-600 font-medium">Siswa Aktif</p>
      </div>
      <div class="bg-white rounded-2xl p-6 text-center shadow-lg">
        <div class="text-4xl font-bold text-orange-600 mb-2">100+</div>
        <p class="text-gray-600 font-medium">Prestasi</p>
      </div>
    </div>

    <!-- Category Navigation -->
    <div class="mb-12">
      <div class="flex flex-wrap justify-center gap-3">
        <button onclick="filterCategory('all')" class="filter-btn active px-6 py-2 rounded-full font-semibold transition bg-indigo-600 text-white">
          Semua
        </button>
        <button onclick="filterCategory('programming')" class="filter-btn px-6 py-2 rounded-full font-semibold transition bg-white text-gray-700 hover:bg-indigo-50">
          Programming & Desain
        </button>
        <button onclick="filterCategory('sports')" class="filter-btn px-6 py-2 rounded-full font-semibold transition bg-white text-gray-700 hover:bg-indigo-50">
          Olahraga
        </button>
        <button onclick="filterCategory('arts')" class="filter-btn px-6 py-2 rounded-full font-semibold transition bg-white text-gray-700 hover:bg-indigo-50">
          Seni & Budaya
        </button>
        <button onclick="filterCategory('science')" class="filter-btn px-6 py-2 rounded-full font-semibold transition bg-white text-gray-700 hover:bg-indigo-50">
          Sains & Teknologi
        </button>
      </div>
    </div>

    <!-- Programming & Design Section -->
    <div class="mb-16 category-section" data-category="programming">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Programming & Desain</h2>
        <a href="./programming.php" class="text-indigo-600 hover:text-indigo-700 font-semibold text-sm flex items-center gap-2">
          Lihat Detail
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
      
      <div class="grid md:grid-cols-3 gap-6">
        
        <!-- Web Development -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
          <div class="h-48 bg-gradient-to-br from-blue-500 to-cyan-500 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500" alt="Web Development" class="w-full h-full object-cover opacity-80 group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute top-4 right-4 px-3 py-1 bg-yellow-400 text-gray-900 text-xs font-bold rounded-full">
              POPULER
            </div>
            <div class="absolute bottom-4 left-4 right-4">
              <h3 class="text-xl font-bold text-white">Web Development</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 text-sm mb-4">Belajar HTML, CSS, JavaScript, PHP dan framework modern seperti React, Vue.js, Laravel untuk membangun website profesional dan aplikasi web interaktif.</p>
            
            <div class="space-y-2 mb-4">
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
                <span>Rabu & Jumat, 15:30 - 17:30</span>
              </div>
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
                <span>30 Siswa Aktif</span>
              </div>
            </div>

            <div class="border-t pt-4">
              <p class="text-sm font-bold text-gray-900 mb-2">🏆 Prestasi:</p>
              <ul class="space-y-1 text-sm text-gray-600">
                <li>• Juara 1 Lomba Web Design Nasional 2024</li>
                <li>• Best Innovation Award Hackathon 2024</li>
                <li>• 5 Project Aplikasi Web Launching</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- UI/UX Design -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
          <div class="h-48 bg-gradient-to-br from-purple-500 to-pink-500 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=500" alt="UI/UX Design" class="w-full h-full object-cover opacity-80 group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-4 left-4 right-4">
              <h3 class="text-xl font-bold text-white">UI/UX Design</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 text-sm mb-4">Desain antarmuka dan pengalaman pengguna dengan Figma, Adobe XD. Pelajari design thinking, wireframing, prototyping hingga user testing.</p>
            
            <div class="space-y-2 mb-4">
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
                <span>Selasa & Kamis, 15:30 - 17:30</span>
              </div>
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
                <span>25 Siswa Aktif</span>
              </div>
            </div>

            <div class="border-t pt-4">
              <p class="text-sm font-bold text-gray-900 mb-2">🏆 Prestasi:</p>
              <ul class="space-y-1 text-sm text-gray-600">
                <li>• Juara 2 UI/UX Competition Jakarta 2024</li>
                <li>• Best Mobile Design Award 2024</li>
                <li>• 15+ Portfolio Project Published</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Graphic Design -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
          <div class="h-48 bg-gradient-to-br from-orange-500 to-red-500 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1626785774573-4b799315345d?w=500" alt="Graphic Design" class="w-full h-full object-cover opacity-80 group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-4 left-4 right-4">
              <h3 class="text-xl font-bold text-white">Graphic Design</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 text-sm mb-4">Adobe Photoshop, Illustrator, dan CorelDRAW. Pelajari desain logo, poster, branding, typography, dan digital illustration profesional.</p>
            
            <div class="space-y-2 mb-4">
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
                <span>Senin & Rabu, 15:30 - 17:30</span>
              </div>
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
                <span>28 Siswa Aktif</span>
              </div>
            </div>

            <div class="border-t pt-4">
              <p class="text-sm font-bold text-gray-900 mb-2">🏆 Prestasi:</p>
              <ul class="space-y-1 text-sm text-gray-600">
                <li>• Juara 1 Poster Design Competition 2024</li>
                <li>• Best Logo Design Regional Award</li>
                <li>• 20+ Client Projects Completed</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Mobile App Development -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
          <div class="h-48 bg-gradient-to-br from-green-500 to-emerald-500 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=500" alt="Mobile App" class="w-full h-full object-cover opacity-80 group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-4 left-4 right-4">
              <h3 class="text-xl font-bold text-white">Mobile App Development</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 text-sm mb-4">Flutter, React Native, dan Android Studio. Belajar membuat aplikasi mobile cross-platform untuk Android dan iOS dengan fitur modern.</p>
            
            <div class="space-y-2 mb-4">
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
                <span>Senin & Kamis, 15:30 - 17:30</span>
              </div>
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
                <span>20 Siswa Aktif</span>
              </div>
            </div>

            <div class="border-t pt-4">
              <p class="text-sm font-bold text-gray-900 mb-2">🏆 Prestasi:</p>
              <ul class="space-y-1 text-sm text-gray-600">
                <li>• 8 Apps Published on Play Store</li>
                <li>• Juara 3 Mobile App Competition 2024</li>
                <li>• Best Student Developer Award</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- 3D Modeling -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
          <div class="h-48 bg-gradient-to-br from-indigo-500 to-blue-500 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=500" alt="3D Modeling" class="w-full h-full object-cover opacity-80 group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-4 left-4 right-4">
              <h3 class="text-xl font-bold text-white">3D Modeling & Animation</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 text-sm mb-4">Blender, 3ds Max, dan Cinema 4D. Pelajari modeling, texturing, lighting, rendering, dan animasi 3D untuk game, film, dan arsitektur.</p>
            
            <div class="space-y-2 mb-4">
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
                <span>Selasa & Jumat, 15:30 - 17:30</span>
              </div>
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
                <span>18 Siswa Aktif</span>
              </div>
            </div>

            <div class="border-t pt-4">
              <p class="text-sm font-bold text-gray-900 mb-2">🏆 Prestasi:</p>
              <ul class="space-y-1 text-sm text-gray-600">
                <li>• Best 3D Animation Short Film 2024</li>
                <li>• 10+ Character Design Portfolio</li>
                <li>• Collaboration with Game Studio</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Video Editing -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition group">
          <div class="h-48 bg-gradient-to-br from-red-500 to-pink-500 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?w=500" alt="Video Editing" class="w-full h-full object-cover opacity-80 group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-4 left-4 right-4">
              <h3 class="text-xl font-bold text-white">Video Editing</h3>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 text-sm mb-4">Adobe Premiere Pro, After Effects, DaVinci Resolve. Pelajari color grading, motion graphics, visual effects, dan cinematic storytelling.</p>
            
            <div class="space-y-2 mb-4">
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
                <span>Rabu & Jumat, 15:30 - 17:30</span>
              </div>
              <div class="flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
                <span>22 Siswa Aktif</span>
              </div>
            </div>

            <div class="border-t pt-4">
              <p class="text-sm font-bold text-gray-900 mb-2">🏆 Prestasi:</p>
              <ul class="space-y-1 text-sm text-gray-600">
                <li>• Juara 1 Short Film Festival 2024</li>
                <li>• Best Editor Youth Competition</li>
                <li>• 25+ Video Projects Published</li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Sports Section -->
    <div class="mb-16 category-section" data-category="sports">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Olahraga</h2>
        <a href="./olahraga.php" class="text-green-600 hover:text-green-700 font-semibold text-sm flex items-center gap-2">
          Lihat Detail
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
      
      <div class="grid md:grid-cols-4 gap-6">
        
        <!-- Sepak Bola -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=500" alt="Sepak Bola" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">⚽</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Sepak Bola</h3>
            <p class="text-gray-600 text-sm mb-3">Pelatih berlisensi AFC dengan program latihan profesional dan mental juara</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Juara 1 Regional 2024</span>
            </div>
          </div>
        </div>

        <!-- Basket -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1546519638-68e109498ffc?w=500" alt="Basket" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🏀</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Basket</h3>
            <p class="text-gray-600 text-sm mb-3">Program DBL Training dengan hall indoor berstandar kompetisi nasional</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Juara 1 DBL Regional</span>
            </div>
          </div>
        </div>

        <!-- Voli -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?w=500" alt="Voli" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🏐</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Voli</h3>
            <p class="text-gray-600 text-sm mb-3">Pelatih FIVB Level 2 dengan track record juara nasional Livoli</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Juara Nasional 2024</span>
            </div>
          </div>
        </div>

        <!-- Badminton -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?w=500" alt="Badminton" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🏸</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Badminton</h3>
            <p class="text-gray-600 text-sm mb-3">BWF Certified Coach dengan fasilitas lapangan indoor berstandar internasional</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🥈</span>
              <span>Runner-up Regional</span>
            </div>
          </div>
        </div>

        <!-- Renang -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1519315901367-f34ff9154487?w=500" alt="Renang" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🏊</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Renang</h3>
            <p class="text-gray-600 text-sm mb-3">Kolam olimpik standard dengan pelatih bersertifikat internasional</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>3 Medali Emas Popda</span>
            </div>
          </div>
        </div>

        <!-- Karate -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1555597673-b21d5c935865?w=500" alt="Karate" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🥋</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Karate</h3>
            <p class="text-gray-600 text-sm mb-3">Sabuk Hitam 4 Dan, pembinaan karakter dan teknik bela diri tradisional</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Juara 1 Kejurda</span>
            </div>
          </div>
        </div>

        <!-- Atletik -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?w=500" alt="Atletik" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🏃</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Atletik</h3>
            <p class="text-gray-600 text-sm mb-3">Program multi-event: lari, lompat, lempar dengan track standar IAAF</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>5 Medali Emas O2SN</span>
            </div>
          </div>
        </div>

        <!-- Taekwondo -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1555597408-26bc8e548a46?w=500" alt="Taekwondo" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🥊</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Taekwondo</h3>
            <p class="text-gray-600 text-sm mb-3">Kukkiwon Certified dengan program persiapan PON dan kejuaraan</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🥈</span>
              <span>Medali Perak Kejurprov</span>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Arts & Culture Section -->
    <div class="mb-16 category-section" data-category="arts">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Seni & Budaya</h2>
        <a href="./seni-budaya.php" class="text-pink-600 hover:text-pink-700 font-semibold text-sm flex items-center gap-2">
          Lihat Detail
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
      
      <div class="grid md:grid-cols-4 gap-6">
        
        <!-- Paduan Suara -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500" alt="Paduan Suara" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🎵</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Paduan Suara</h3>
            <p class="text-gray-600 text-sm mb-3">Vokal group training dengan konduktor profesional dan repertoar klasik hingga modern</p>
            <div class="flex items-center gap-2 text-xs text-gray-500 bg-gray-50 px-3 py-2 rounded-lg">
              <span>⏰</span>
              <span>Senin & Rabu 15:30</span>
            </div>
          </div>
        </div>

        <!-- Band -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1511735111819-9a3f7709049c?w=500" alt="Band" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🎸</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Band</h3>
            <p class="text-gray-600 text-sm mb-3">Modern music ensemble dengan studio rekaman dan peralatan profesional</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Best Band Festival 2024</span>
            </div>
          </div>
        </div>

        <!-- Tari Tradisional -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1508700929628-666bc8bd84ea?w=500" alt="Tari Tradisional" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">💃</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Tari Tradisional</h3>
            <p class="text-gray-600 text-sm mb-3">Tari Nusantara dengan instruktur ahli pelestarian budaya Indonesia</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Juara FLS2N 2024</span>
            </div>
          </div>
        </div>

        <!-- Tari Modern -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1504609773096-104ff2c73ba4?w=500" alt="Tari Modern" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🕺</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Tari Modern</h3>
            <p class="text-gray-600 text-sm mb-3">Hip Hop & K-Pop Dance dengan choreographer profesional dan studio mirror</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Winner Dance Cover 2024</span>
            </div>
          </div>
        </div>

        <!-- Teater -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1503095396549-807759245b35?w=500" alt="Teater" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🎭</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Teater</h3>
            <p class="text-gray-600 text-sm mb-3">Drama & acting class dengan sutradara berpengalaman, auditorium lengkap</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Best Performance 2024</span>
            </div>
          </div>
        </div>

        <!-- Melukis -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?w=500" alt="Melukis" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🎨</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Melukis</h3>
            <p class="text-gray-600 text-sm mb-3">Painting & drawing dengan berbagai teknik: watercolor, acrylic, oil painting</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>10+ Gallery Exhibition</span>
            </div>
          </div>
        </div>

        <!-- Fotografi -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1452587925148-ce544e77e70d?w=500" alt="Fotografi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">📷</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Fotografi</h3>
            <p class="text-gray-600 text-sm mb-3">Photography & editing dengan DSLR, lighting studio, dan darkroom</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Best Photo Competition</span>
            </div>
          </div>
        </div>

        <!-- Sinematografi -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1485846234645-a62644f84728?w=500" alt="Sinematografi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🎬</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Sinematografi</h3>
            <p class="text-gray-600 text-sm mb-3">Film making & production dengan kamera cinema dan suite editing profesional</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Best Short Film 2024</span>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Science & Technology Section -->
    <div class="mb-16 category-section" data-category="science">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Sains & Teknologi</h2>
      </div>
      
      <div class="grid md:grid-cols-4 gap-6">
        
        <!-- Robotika -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=500" alt="Robotika" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🤖</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Robotika</h3>
            <p class="text-gray-600 text-sm mb-3">Arduino & Raspberry Pi programming untuk robot line follower, sumo, humanoid</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Juara 2 Kompetisi Nasional</span>
            </div>
          </div>
        </div>

        <!-- Sains Club -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=500" alt="Sains Club" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🔬</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Sains Club</h3>
            <p class="text-gray-600 text-sm mb-3">Eksperimen & penelitian sains dengan laboratorium lengkap dan mentor ahli</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Best Research Award</span>
            </div>
          </div>
        </div>

        <!-- Astronomi -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1464802686167-b939a6910659?w=500" alt="Astronomi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🔭</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Astronomi</h3>
            <p class="text-gray-600 text-sm mb-3">Observasi & planetarium dengan teleskop profesional dan field trip observatorium</p>
            <div class="flex items-center gap-2 text-xs text-gray-500 bg-gray-50 px-3 py-2 rounded-lg">
              <span>⏰</span>
              <span>Senin & Kamis 15:30</span>
            </div>
          </div>
        </div>

        <!-- Matematika Olimpiade -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1509228468518-180dd4864904?w=500" alt="Matematika" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🧮</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Matematika Olimpiade</h3>
            <p class="text-gray-600 text-sm mb-3">Persiapan OSN Matematika dengan pembina medalis internasional</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Medali Perak OSN</span>
            </div>
          </div>
        </div>

        <!-- Fisika Olimpiade -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=500" alt="Fisika" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">⚛️</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Fisika Olimpiade</h3>
            <p class="text-gray-600 text-sm mb-3">Persiapan OSN Fisika dengan lab eksperimen dan simulasi komputer</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🥉</span>
              <span>Medali Perunggu OSN</span>
            </div>
          </div>
        </div>

        <!-- Biologi Olimpiade -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1530587191325-3db32d826c18?w=500" alt="Biologi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🧬</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Biologi Olimpiade</h3>
            <p class="text-gray-600 text-sm mb-3">Persiapan OSN Biologi dengan praktikum lengkap dan field study</p>
            <div class="flex items-center gap-2 text-xs text-gray-500 bg-gray-50 px-3 py-2 rounded-lg">
              <span>⏰</span>
              <span>Selasa & Kamis 15:30</span>
            </div>
          </div>
        </div>

        <!-- Kimia Olimpiade -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1603126857599-f6e157fa2fe6?w=500" alt="Kimia" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🧪</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Kimia Olimpiade</h3>
            <p class="text-gray-600 text-sm mb-3">Persiapan OSN Kimia dengan lab modern dan chemical analysis tools</p>
            <div class="flex items-center gap-2 text-xs text-gray-500 bg-gray-50 px-3 py-2 rounded-lg">
              <span>⏰</span>
              <span>Rabu & Jumat 15:30</span>
            </div>
          </div>
        </div>

        <!-- English Debate -->
        <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition group">
          <div class="h-40 relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=500" alt="Debate" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-3 left-3">
              <span class="text-3xl">🗣️</span>
            </div>
          </div>
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-2">English Debate</h3>
            <p class="text-gray-600 text-sm mb-3">British Parliamentary Style dengan coach native speaker dan alumni IPU</p>
            <div class="flex items-center gap-2 text-xs text-yellow-600 font-semibold bg-yellow-50 px-3 py-2 rounded-lg">
              <span>🏆</span>
              <span>Best Speaker Regional</span>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Benefits Section -->
    <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-3xl p-12 mb-16 text-white">
      <h2 class="text-3xl font-bold mb-8 text-center">Keuntungan Mengikuti Ekstrakurikuler</h2>
      <div class="grid md:grid-cols-4 gap-6">
        
        <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center">
          <div class="w-16 h-16 bg-white/20 rounded-full mx-auto mb-4 flex items-center justify-center">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2">Pengembangan Bakat</h3>
          <p class="text-sm opacity-90">Temukan dan asah potensi terbaikmu</p>
        </div>

        <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center">
          <div class="w-16 h-16 bg-white/20 rounded-full mx-auto mb-4 flex items-center justify-center">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2">Networking</h3>
          <p class="text-sm opacity-90">Bangun relasi dengan teman sebaya</p>
        </div>

        <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center">
          <div class="w-16 h-16 bg-white/20 rounded-full mx-auto mb-4 flex items-center justify-center">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2">Raih Prestasi</h3>
          <p class="text-sm opacity-90">Kesempatan kompetisi tingkat nasional</p>
        </div>

        <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center">
          <div class="w-16 h-16 bg-white/20 rounded-full mx-auto mb-4 flex items-center justify-center">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2">Soft Skills</h3>
          <p class="text-sm opacity-90">Kepemimpinan, kerjasama, dan disiplin</p>
        </div>

      </div>
    </div>

    <!-- Achievement Highlights -->
    <div class="mb-16">
      <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Prestasi Gemilang 2024</h2>
      <div class="grid md:grid-cols-3 gap-6">
        
        <div class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl p-8 text-white">
          <div class="text-6xl mb-4">🏆</div>
          <h3 class="text-2xl font-bold mb-2">45+ Juara</h3>
          <p class="text-yellow-100">Kompetisi tingkat regional dan nasional di berbagai bidang</p>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-8 text-white">
          <div class="text-6xl mb-4">🎓</div>
          <h3 class="text-2xl font-bold mb-2">100% Aktif</h3>
          <p class="text-blue-100">Siswa aktif berpartisipasi minimal 1 ekstrakurikuler</p>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl p-8 text-white">
          <div class="text-6xl mb-4">⭐</div>
          <h3 class="text-2xl font-bold mb-2">4.9/5.0</h3>
          <p class="text-purple-100">Tingkat kepuasan siswa terhadap program ekstrakurikuler</p>
        </div>

      </div>
    </div>

    <!-- Schedule Overview -->
    <div class="bg-white rounded-3xl p-12 shadow-xl mb-16">
      <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Jadwal Ekstrakurikuler</h2>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="bg-indigo-50">
              <th class="px-6 py-4 text-left font-bold text-gray-900">Hari</th>
              <th class="px-6 py-4 text-left font-bold text-gray-900">Waktu</th>
              <th class="px-6 py-4 text-left font-bold text-gray-900">Kegiatan</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 font-semibold text-gray-900">Senin</td>
              <td class="px-6 py-4 text-gray-600">15:30 - 17:30</td>
              <td class="px-6 py-4 text-gray-600">Basket, Mobile App Dev, Graphic Design, Paduan Suara, Tari Modern, Fotografi, Astronomi</td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 font-semibold text-gray-900">Selasa</td>
              <td class="px-6 py-4 text-gray-600">15:30 - 17:30</td>
              <td class="px-6 py-4 text-gray-600">Sepak Bola, UI/UX Design, 3D Modeling, Band, Teater, Sinematografi, Biologi Olimpiade</td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 font-semibold text-gray-900">Rabu</td>
              <td class="px-6 py-4 text-gray-600">15:30 - 17:30</td>
              <td class="px-6 py-4 text-gray-600">Basket, Web Development, Graphic Design, Video Editing, Paduan Suara, Tari Tradisional, Melukis, Fotografi, Sains Club, Kimia Olimpiade</td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 font-semibold text-gray-900">Kamis</td>
              <td class="px-6 py-4 text-gray-600">15:30 - 17:30</td>
              <td class="px-6 py-4 text-gray-600">Sepak Bola, Voli, UI/UX Design, Mobile App Dev, Tari Modern, Band, Sinematografi, Astronomi, Biologi Olimpiade</td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 font-semibold text-gray-900">Jumat</td>
              <td class="px-6 py-4 text-gray-600">15:30 - 17:30</td>
              <td class="px-6 py-4 text-gray-600">Web Development, Video Editing, 3D Modeling, Tari Tradisional, Teater, Melukis, Sains Club, Kimia Olimpiade</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Gallery Section -->
    <div class="mb-16">
      <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Galeri Kegiatan</h2>
      <div class="grid md:grid-cols-4 gap-4">
        
        <div class="relative group overflow-hidden rounded-xl shadow-lg">
          <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=500" alt="Kegiatan 1" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition">
            <div class="absolute bottom-4 left-4">
              <p class="text-white font-bold">Workshop Programming</p>
            </div>
          </div>
        </div>

        <div class="relative group overflow-hidden rounded-xl shadow-lg">
          <img src="https://images.unsplash.com/photo-1526232761682-d26e03ac148e?w=500" alt="Kegiatan 2" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition">
            <div class="absolute bottom-4 left-4">
              <p class="text-white font-bold">Kompetisi Olahraga</p>
            </div>
          </div>
        </div>

        <div class="relative group overflow-hidden rounded-xl shadow-lg">
          <img src="https://images.unsplash.com/photo-1507676184212-d03ab07a01bf?w=500" alt="Kegiatan 3" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition">
            <div class="absolute bottom-4 left-4">
              <p class="text-white font-bold">Pertunjukan Seni</p>
            </div>
          </div>
        </div>

        <div class="relative group overflow-hidden rounded-xl shadow-lg">
          <img src="https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?w=500" alt="Kegiatan 4" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition">
            <div class="absolute bottom-4 left-4">
              <p class="text-white font-bold">Eksperimen Sains</p>
            </div>
          </div>
        </div>

        <div class="relative group overflow-hidden rounded-xl shadow-lg">
          <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?w=500" alt="Kegiatan 5" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition">
            <div class="absolute bottom-4 left-4">
              <p class="text-white font-bold">Studio Design</p>
            </div>
          </div>
        </div>

        <div class="relative group overflow-hidden rounded-xl shadow-lg">
          <img src="https://images.unsplash.com/photo-1517164850305-99a3e65bb47e?w=500" alt="Kegiatan 6" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition">
            <div class="absolute bottom-4 left-4">
              <p class="text-white font-bold">Latihan Basket</p>
            </div>
          </div>
        </div>

        <div class="relative group overflow-hidden rounded-xl shadow-lg">
          <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500" alt="Kegiatan 7" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition">
            <div class="absolute bottom-4 left-4">
              <p class="text-white font-bold">Coding Session</p>
            </div>
          </div>
        </div>

        <div class="relative group overflow-hidden rounded-xl shadow-lg">
          <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=500" alt="Kegiatan 8" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition">
            <div class="absolute bottom-4 left-4">
              <p class="text-white font-bold">Pentas Musik</p>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Testimonials -->
    <div class="mb-16">
      <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Apa Kata Mereka</h2>
      <div class="grid md:grid-cols-3 gap-6">
        
        <div class="bg-white rounded-2xl p-6 shadow-lg">
          <div class="flex items-center gap-4 mb-4">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100" alt="Alya" class="w-12 h-12 rounded-full object-cover">
            <div>
              <h4 class="font-bold text-gray-900">Alya Putri Maharani</h4>
              <p class="text-sm text-gray-600">UI/UX Design</p>
            </div>
          </div>
          <p class="text-gray-600 text-sm italic mb-4">"Ekstrakurikuler UI/UX Design sangat membantu saya mengembangkan skill desain. Sekarang saya sudah bisa freelance dan dapat uang sendiri! Mentor-mentornya juga sangat supportive."</p>
          <div class="flex gap-1">
            <span class="text-yellow-400">⭐⭐⭐⭐⭐</span>
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg">
          <div class="flex items-center gap-4 mb-4">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100" alt="Rafi" class="w-12 h-12 rounded-full object-cover">
            <div>
              <h4 class="font-bold text-gray-900">Rafi Ahmad Fauzan</h4>
              <p class="text-sm text-gray-600">Sepak Bola</p>
            </div>
          </div>
          <p class="text-gray-600 text-sm italic mb-4">"Program latihan yang terstruktur dan pelatih yang berpengalaman membuat saya berkembang pesat. Tim kami berhasil juara regional dan saya mendapat kesempatan trial di klub profesional!"</p>
          <div class="flex gap-1">
            <span class="text-yellow-400">⭐⭐⭐⭐⭐</span>
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg">
          <div class="flex items-center gap-4 mb-4">
            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100" alt="Dinda" class="w-12 h-12 rounded-full object-cover">
            <div>
              <h4 class="font-bold text-gray-900">Dinda Sari Pratiwi</h4>
              <p class="text-sm text-gray-600">Robotika</p>
            </div>
          </div>
          <p class="text-gray-600 text-sm italic mb-4">"Robotika mengajarkan saya problem solving dan teamwork. Kami bahkan sampai kompetisi nasional dan dapat juara 2! Pengalaman yang luar biasa dan bikin makin semangat belajar."</p>
          <div class="flex gap-1">
            <span class="text-yellow-400">⭐⭐⭐⭐⭐</span>
          </div>
        </div>

      </div>
    </div>

    <!-- FAQ Section -->
    <div class="bg-white rounded-3xl p-12 shadow-xl mb-16">
      <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Pertanyaan Umum</h2>
      <div class="space-y-4 max-w-3xl mx-auto">
        
        <div class="border border-gray-200 rounded-xl p-6 hover:border-indigo-300 transition">
          <h3 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
            <span class="text-indigo-600">💰</span>
            Berapa biaya ekstrakurikuler?
          </h3>
          <p class="text-gray-600 text-sm">Sebagian besar ekstrakurikuler sudah termasuk dalam biaya sekolah. Beberapa program khusus seperti robotika dan olahraga tertentu memiliki biaya tambahan untuk peralatan dan konsumsi sekitar Rp 200.000 - Rp 500.000 per semester.</p>
        </div>

        <div class="border border-gray-200 rounded-xl p-6 hover:border-indigo-300 transition">
          <h3 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
            <span class="text-indigo-600">📚</span>
            Boleh ikut lebih dari satu ekstrakurikuler?
          </h3>
          <p class="text-gray-600 text-sm">Ya! Siswa diperbolehkan mengikuti maksimal 3 ekstrakurikuler, dengan syarat jadwal tidak bentrok dan nilai akademis tetap terjaga minimal KKM. Kami mendorong siswa untuk eksplorasi berbagai bidang.</p>
        </div>

        <div class="border border-gray-200 rounded-xl p-6 hover:border-indigo-300 transition">
          <h3 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
            <span class="text-indigo-600">📅</span>
            Kapan pendaftaran dibuka?
          </h3>
          <p class="text-gray-600 text-sm">Pendaftaran ekstrakurikuler dibuka setiap awal semester (Juli dan Januari). Untuk siswa baru, pendaftaran dapat dilakukan pada masa orientasi sekolah. Kuota terbatas, first come first served!</p>
        </div>

        <div class="border border-gray-200 rounded-xl p-6 hover:border-indigo-300 transition">
          <h3 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
            <span class="text-indigo-600">✅</span>
            Apakah wajib ikut ekstrakurikuler?
          </h3>
          <p class="text-gray-600 text-sm">Setiap siswa diwajibkan mengikuti minimal 1 ekstrakurikuler untuk pengembangan karakter dan keterampilan non-akademis. Ini juga bagian dari penilaian raport dan syarat kelulusan.</p>
        </div>

        <div class="border border-gray-200 rounded-xl p-6 hover:border-indigo-300 transition">
          <h3 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
            <span class="text-indigo-600">🎯</span>
            Bagaimana cara memilih ekstrakurikuler yang tepat?
          </h3>
          <p class="text-gray-600 text-sm">Pilih berdasarkan minat dan bakat. Kami juga menyediakan sesi trial gratis 2 minggu di awal semester untuk siswa mencoba berbagai ekskul sebelum memutuskan. Konsultasi dengan wali kelas juga tersedia.</p>
        </div>

      </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl p-12 text-white text-center">
      <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Bergabung dengan Kami?</h2>
      <p class="text-lg mb-8 opacity-90 max-w-2xl mx-auto">Pilih ekstrakurikuler favoritmu dan kembangkan potensi terbaikmu bersama pembina profesional dan fasilitas terbaik!</p>
      <div class="flex flex-wrap justify-center gap-4">
        <a href="../kontak.php#daftar" class="inline-block px-8 py-3 bg-white text-indigo-600 font-bold rounded-xl hover:bg-gray-100 transition shadow-lg">Daftar Sekarang</a>
        <a href="../kontak.php" class="inline-block px-8 py-3 bg-transparent border-2 border-white text-white font-bold rounded-xl hover:bg-white hover:text-indigo-600 transition">Hubungi Kami</a>
      </div>
      
      <div class="mt-8 pt-8 border-t border-white/20">
        <p class="text-sm opacity-75">📞 Butuh informasi lebih lanjut? Hubungi bagian kesiswaan kami di (021) 123-4567</p>
        <p class="text-sm opacity-75 mt-2">📧 Email: ekskul@isresinda.sch.id</p>
      </div>
    </div>

  </div>
</section>

<!-- Filter Script -->
<script>
  function filterCategory(category) {
    const sections = document.querySelectorAll('.category-section');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Update button states
    buttons.forEach(btn => {
      btn.classList.remove('active', 'bg-indigo-600', 'text-white');
      btn.classList.add('bg-white', 'text-gray-700');
    });
    
    event.target.classList.remove('bg-white', 'text-gray-700');
    event.target.classList.add('active', 'bg-indigo-600', 'text-white');
    
    // Show/hide sections
    if (category === 'all') {
      sections.forEach(section => {
        section.style.display = 'block';
      });
    } else {
      sections.forEach(section => {
        if (section.dataset.category === category) {
          section.style.display = 'block';
        } else {
          section.style.display = 'none';
        }
      });
    }
    
    // Smooth scroll to first visible section
    setTimeout(() => {
      const firstVisible = document.querySelector('.category-section[style="display: block;"]');
      if (firstVisible && category !== 'all') {
        firstVisible.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    }, 100);
  }
</script>

<?php include '../includes/footer.php'; ?>