<?php 
/* Modern header ISR - Fixed with Absolute Paths */

// Deteksi base URL project secara otomatis
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$script_name = $_SERVER['SCRIPT_NAME'];

// Ambil folder project dari script name
// Misal: /company-profil-sch/ekstra/programming.php -> /company-profil-sch/
$project_folder = '/' . explode('/', trim($script_name, '/'))[0] . '/';

// Base URL lengkap
$base_url = $protocol . '://' . $host . $project_folder;
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ignatius Slamet Riyadi (ISR Resinda)</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/style.css" />
  <style>
    body{font-family:'Inter',system-ui,-apple-system,'Segoe UI',Roboto,Helvetica,Arial}
    .dropdown:hover .dropdown-menu{display:block}
    
    .mega-menu {
      left: 50%;
      transform: translateX(-50%);
      min-width: 800px;
    }
    
    .mega-menu-section h3 {
      color: #f59e0b;
      font-size: 0.875rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      margin-bottom: 0.75rem;
    }
    
    .mega-menu-link {
      display: block;
      padding: 0.5rem 0;
      color: #1f2937;
      font-size: 0.875rem;
      transition: color 0.2s;
    }
    
    .mega-menu-link:hover {
      color: #667eea;
      padding-left: 0.5rem;
    }
    
    .mega-menu-link.highlight {
      color: #f59e0b;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
  <nav class="sticky top-0 z-50 bg-white/90 backdrop-filter backdrop-blur border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex items-center justify-between h-16">
        <a href="<?php echo $base_url; ?>index.php" class="flex items-center">
          <img src="<?php echo $base_url; ?>assets/img/logo.png" alt="ISR" class="h-10 w-auto object-contain">
        </a>
        <div class="hidden md:flex items-center gap-6">
          <a class="text-sm font-medium text-gray-600 hover:text-gray-900" href="<?php echo $base_url; ?>index.php">Beranda</a>
          
          <!-- Dropdown Profil (Mega Menu) -->
          <div class="relative dropdown">
            <button class="text-sm font-medium text-gray-600 hover:text-gray-900 inline-flex items-center gap-1">
              Profil
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="dropdown-menu hidden absolute mega-menu mt-2 bg-white rounded-lg shadow-2xl border border-gray-200 p-6">
              <div class="grid grid-cols-3 gap-8">
                
                <!-- PROFIL, STAFF & TEAM -->
                <div class="mega-menu-section">
                  <h3>PROFIL, STAFF & TEAM</h3>
                  <a href="<?php echo $base_url; ?>profil.php" class="mega-menu-link">Sejarah Singkat</a>
                  <a href="<?php echo $base_url; ?>team.php" class="mega-menu-link">Team & Staff Ignatius Slamet Riyadi</a>
                </div>
                
                <!-- KARYA & PORTFOLIO -->
                <div class="mega-menu-section">
                  <h3>KARYA & PORTFOLIO</h3>
                  <a href="<?php echo $base_url; ?>render-art.php" class="mega-menu-link">Render Art Commission</a>
                  <a href="<?php echo $base_url; ?>architecture.php" class="mega-menu-link">Architecture Design</a>
                  <a href="<?php echo $base_url; ?>porto.php" class="mega-menu-link highlight">Semua Karya</a>
                  
                  <h3 class="mt-6">EKSTRAKURIKULER</h3>
                  <a href="<?php echo $base_url; ?>ekstra/programming.php" class="mega-menu-link">Bidang Programming dan Desain</a>
                  <a href="<?php echo $base_url; ?>ekstra/olahraga.php" class="mega-menu-link">Bidang Olahraga</a>
                  <a href="<?php echo $base_url; ?>ekstra/seni-budaya.php" class="mega-menu-link">Bidang Seni dan Budaya</a>
                  <a href="<?php echo $base_url; ?>ekstra/allekstra.php" class="mega-menu-link highlight">Semua Ekstrakurikuler</a>
                </div>
                
                <!-- FASILITAS, SARANA & PRASARANA -->
                <div class="mega-menu-section">
                  <h3>FASILITAS, SARANA & PRASARANA</h3>
                  <a href="<?php echo $base_url; ?>fasilitas/contoh.php" class="mega-menu-link">Contoh Fasilitas Sekolah</a>
                  <a href="<?php echo $base_url; ?>fasilitas/index.php" class="mega-menu-link highlight">Semua Fasilitas</a>
                  
                  <h3 class="mt-6">LAYANAN & PRODUK</h3>
                  <a href="<?php echo $base_url; ?>layanan.php" class="mega-menu-link highlight">Semua Layanan</a>
                </div>
                
              </div>
            </div>
          </div>
          
          <a class="text-sm font-medium text-gray-600 hover:text-gray-900" href="<?php echo $base_url; ?>visi-misi.php">Visi &amp; Misi</a>
          <a class="text-sm font-medium text-gray-600 hover:text-gray-900" href="<?php echo $base_url; ?>kegiatan.php">Kegiatan</a>
          <a class="text-sm font-medium text-gray-600 hover:text-gray-900" href="<?php echo $base_url; ?>galery.php">Galeri</a>
          
          <!-- Dropdown Jenjang -->
          <div class="relative dropdown">
            <button class="text-sm font-semibold text-gray-900 hover:text-gray-700 inline-flex items-center gap-1">
              Jenjang
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div class="dropdown-menu hidden absolute left-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
              <a class="block px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-100" href="<?php echo $base_url; ?>tk.php">TK</a>
              <a class="block px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-100" href="<?php echo $base_url; ?>sd.php">SD</a>
              <a class="block px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-100" href="<?php echo $base_url; ?>smp.php">SMP</a>
              <a class="block px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-gray-100" href="<?php echo $base_url; ?>sma.php">SMA</a>
            </div>
          </div>
        </div>
        <div class="hidden md:flex items-center gap-3">
          <a class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold border border-gray-300 hover:border-gray-900" href="<?php echo $base_url; ?>kontak.php">Kontak</a>
          <a class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-yellow-500 text-black hover:opacity-90" href="<?php echo $base_url; ?>kontak.php#daftar">Daftar</a>
        </div>
        <button class="md:hidden inline-flex items-center justify-center rounded-xl border border-gray-300 px-3 py-2" onclick="toggleMobileMenu()">
          <span class="sr-only">Menu</span>☰
        </button>
      </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mnav" class="md:hidden hidden border-t border-gray-200">
      <div class="max-w-7xl mx-auto px-4 py-2 space-y-2 text-sm">
        <a class="block py-2" href="<?php echo $base_url; ?>index.php">Beranda</a>
        
        <!-- Mobile Dropdown Profil -->
        <div>
          <button class="py-2 font-medium w-full text-left flex items-center justify-between" onclick="toggleMobileDropdown('mobileProfilMenu')">
            Profil
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          <div id="mobileProfilMenu" class="hidden pl-4 space-y-1 bg-gray-50 rounded-lg p-3 mt-2">
            <div class="mb-3">
              <p class="text-xs font-bold text-yellow-600 uppercase tracking-wide mb-2">Profil, Staff & Team</p>
              <a class="block py-1.5 text-sm" href="<?php echo $base_url; ?>profil.php">Sejarah Singkat</a>
              <a class="block py-1.5 text-sm" href="<?php echo $base_url; ?>team.php">Team & Staff</a>
            </div>
            
            <div class="mb-3">
              <p class="text-xs font-bold text-yellow-600 uppercase tracking-wide mb-2">Karya & Portfolio</p>
              <a class="block py-1.5 text-sm" href="<?php echo $base_url; ?>render-art.php">Render Art Commission</a>
              <a class="block py-1.5 text-sm" href="<?php echo $base_url; ?>architecture.php">Architecture Design</a>
              <a class="block py-1.5 text-sm text-yellow-600 font-medium" href="<?php echo $base_url; ?>porto.php">Semua Karya</a>
            </div>
            
            <div class="mb-3">
              <p class="text-xs font-bold text-yellow-600 uppercase tracking-wide mb-2">Ekstrakurikuler</p>
              <a class="block py-1.5 text-sm" href="<?php echo $base_url; ?>ekstra/programming.php">Programming & Desain</a>
              <a class="block py-1.5 text-sm" href="<?php echo $base_url; ?>ekstra/olahraga.php">Olahraga</a>
              <a class="block py-1.5 text-sm" href="<?php echo $base_url; ?>ekstra/seni-budaya.php">Seni dan Budaya</a>
              <a class="block py-1.5 text-sm text-yellow-600 font-medium" href="<?php echo $base_url; ?>ekstra/allekstra.php">Semua Ekstrakurikuler</a>
            </div>
            
            <div class="mb-3">
              <p class="text-xs font-bold text-yellow-600 uppercase tracking-wide mb-2">Fasilitas</p>
              <a class="block py-1.5 text-sm" href="<?php echo $base_url; ?>fasilitas/contoh.php">Contoh Fasilitas</a>
              <a class="block py-1.5 text-sm text-yellow-600 font-medium" href="<?php echo $base_url; ?>fasilitas/index.php">Semua Fasilitas</a>
            </div>
            
            <div>
              <p class="text-xs font-bold text-yellow-600 uppercase tracking-wide mb-2">Layanan & Produk</p>
              <a class="block py-1.5 text-sm text-yellow-600 font-medium" href="<?php echo $base_url; ?>layanan.php">Semua Layanan</a>
            </div>
          </div>
        </div>
        
        <a class="block py-2" href="<?php echo $base_url; ?>visi-misi.php">Visi &amp; Misi</a>
        <a class="block py-2" href="<?php echo $base_url; ?>kegiatan.php">Kegiatan</a>
        <a class="block py-2" href="<?php echo $base_url; ?>galery.php">Galeri</a>
        
        <!-- Mobile Dropdown Jenjang -->
        <div>
          <button class="py-2 font-semibold w-full text-left flex items-center justify-between" onclick="toggleMobileDropdown('mobileJenjang')">
            Jenjang
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          <div id="mobileJenjang" class="hidden pl-4 space-y-1 mt-2">
            <a class="block py-2 font-medium" href="<?php echo $base_url; ?>tk.php">TK</a>
            <a class="block py-2 font-medium" href="<?php echo $base_url; ?>sd.php">SD</a>
            <a class="block py-2 font-medium" href="<?php echo $base_url; ?>smp.php">SMP</a>
            <a class="block py-2 font-medium" href="<?php echo $base_url; ?>sma.php">SMA</a>
          </div>
        </div>
        
        <a class="block py-2 text-center rounded-xl border border-gray-300 mt-4" href="<?php echo $base_url; ?>kontak.php">Kontak</a>
        <a class="block py-2 text-center rounded-xl bg-yellow-500 text-black font-semibold" href="<?php echo $base_url; ?>kontak.php#daftar">Daftar</a>
      </div>
    </div>
  </nav>
  
  <!-- Script untuk kontrol dropdown -->
  <script>
    // Toggle mobile menu
    function toggleMobileMenu() {
      document.getElementById('mnav').classList.toggle('hidden');
    }
    
    // Toggle mobile dropdown
    function toggleMobileDropdown(dropdownId) {
      const dropdown = document.getElementById(dropdownId);
      if (dropdown) {
        dropdown.classList.toggle('hidden');
      }
    }
    
    // Tutup dropdown saat klik di luar
    document.addEventListener('click', function(event) {
      const isDropdownButton = event.target.closest('.dropdown button');
      const isInsideDropdown = event.target.closest('.dropdown-menu');
      
      if (!isDropdownButton && !isInsideDropdown) {
        const allDropdowns = document.querySelectorAll('.dropdown-menu');
        allDropdowns.forEach(dropdown => {
          dropdown.classList.add('hidden');
        });
      }
    });
  </script>