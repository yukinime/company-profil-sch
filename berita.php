<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/models/Berita.php';

$beritaModel = new Berita();

// Ambil parameter filter
$category = $_GET['category'] ?? '';
$search = $_GET['q'] ?? '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 9;

// Build filters
$filters = ['status' => 'active'];
if (!empty($category)) {
  $filters['category'] = $category;
}
if (!empty($search)) {
  $filters['q'] = $search;
}

// Ambil semua berita dengan filter
$allBerita = $beritaModel->all($filters);

// Pagination
$totalBerita = count($allBerita);
$totalPages = ceil($totalBerita / $perPage);
$page = max(1, min($page, $totalPages));
$offset = ($page - 1) * $perPage;
$beritaList = array_slice($allBerita, $offset, $perPage);

// Ambil berita populer untuk sidebar
$popularBerita = $beritaModel->getPopular(5);

include 'includes/header.php';
?>

<style>
  .berita-hero {
    position: relative;
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    height: 50vh;
    min-height: 400px;
    max-height: 500px;
    overflow: hidden;
    background: linear-gradient(135deg, #228B22 0%, #32CD32 100%);
  }

  .berita-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite;
  }

  .berita-hero::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite reverse;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
  }

  .berita-hero-content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
  }

  .berita-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
    transition: all 0.4s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .berita-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 50px rgba(34, 139, 34, 0.2);
  }

  .berita-card-image {
    width: 100%;
    height: 240px;
    object-fit: cover;
    position: relative;
  }

  .berita-card-body {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .category-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    background: rgba(34, 139, 34, 0.1);
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 700;
    color: #228B22;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
    width: fit-content;
  }

  .berita-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 0.85rem;
    color: #666;
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid #f0f0f0;
  }

  .filter-section {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    margin-bottom: 2rem;
  }

  .category-filter {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
  }

  .category-btn {
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    border: 2px solid #e5e7eb;
    background: white;
    color: #6b7280;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .category-btn:hover {
    border-color: #228B22;
    color: #228B22;
    transform: translateY(-2px);
  }

  .category-btn.active {
    background: linear-gradient(135deg, #228B22, #32CD32);
    color: white;
    border-color: #228B22;
  }

  .search-box {
    position: relative;
    max-width: 500px;
  }

  .search-box input {
    width: 100%;
    padding: 1rem 3rem 1rem 1.5rem;
    border: 2px solid #e5e7eb;
    border-radius: 50px;
    font-size: 1rem;
    transition: all 0.3s ease;
  }

  .search-box input:focus {
    outline: none;
    border-color: #228B22;
    box-shadow: 0 0 0 3px rgba(34, 139, 34, 0.1);
  }

  .search-box button {
    position: absolute;
    right: 0.5rem;
    top: 50%;
    transform: translateY(-50%);
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #228B22, #32CD32);
    border: none;
    border-radius: 50px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .search-box button:hover {
    transform: translateY(-50%) scale(1.05);
    box-shadow: 0 4px 15px rgba(34, 139, 34, 0.3);
  }

  .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    margin-top: 3rem;
  }

  .pagination a, .pagination span {
    padding: 0.75rem 1.25rem;
    border-radius: 12px;
    border: 2px solid #e5e7eb;
    background: white;
    color: #6b7280;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .pagination a:hover {
    border-color: #228B22;
    color: #228B22;
    transform: translateY(-2px);
  }

  .pagination .active {
    background: linear-gradient(135deg, #228B22, #32CD32);
    color: white;
    border-color: #228B22;
  }

  .sidebar {
    position: sticky;
    top: 2rem;
  }

  .sidebar-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    margin-bottom: 2rem;
  }

  .sidebar-card h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #228B22;
  }

  .popular-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #f3f4f6;
    transition: all 0.3s ease;
  }

  .popular-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
  }

  .popular-item:hover {
    transform: translateX(5px);
  }

  .popular-number {
    flex-shrink: 0;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #228B22, #32CD32);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
  }

  .popular-content h4 {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1f2937;
    line-height: 1.4;
    margin-bottom: 0.5rem;
  }

  .popular-content p {
    font-size: 0.8rem;
    color: #6b7280;
  }

  .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
  }

  .empty-state-icon {
    font-size: 5rem;
    margin-bottom: 1.5rem;
    opacity: 0.5;
  }

  @media (max-width: 768px) {
    .berita-hero {
      height: 40vh;
      min-height: 300px;
    }

    .category-filter {
      justify-content: center;
    }

    .search-box {
      max-width: 100%;
    }

    .pagination {
      flex-wrap: wrap;
    }
  }

  .breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 0;
    font-size: 0.9rem;
    color: #6b7280;
  }

  .breadcrumb a {
    color: #228B22;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .breadcrumb a:hover {
    color: #32CD32;
  }
</style>

<!-- Hero Section -->
<section class="berita-hero">
  <div class="berita-hero-content">
    <div class="max-w-4xl mx-auto px-6">
      <div class="inline-block px-6 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white font-semibold mb-4">
        📰 Pusat Informasi
      </div>
      <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
        Berita & Informasi
      </h1>
      <p class="text-xl md:text-2xl opacity-95">
        Update terbaru tentang kegiatan, prestasi, dan pencapaian Ignatius Slamet Riyadi
      </p>
    </div>
  </div>
</section>

<div class="max-w-7xl mx-auto px-4 md:px-6 py-12">
  <!-- Breadcrumb -->
  <div class="breadcrumb">
    <a href="<?= url('index.php') ?>">Beranda</a>
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
    </svg>
    <span>Berita</span>
  </div>

  <!-- Filter Section -->
  <div class="filter-section">
    <form method="GET" action="" id="filterForm">
      <div class="category-filter">
        <button type="button" class="category-btn <?= empty($category) ? 'active' : '' ?>" onclick="filterCategory('')">
          📰 Semua Berita
        </button>
        <button type="button" class="category-btn <?= $category === 'akademik' ? 'active' : '' ?>" onclick="filterCategory('akademik')">
          📚 Akademik
        </button>
        <button type="button" class="category-btn <?= $category === 'prestasi' ? 'active' : '' ?>" onclick="filterCategory('prestasi')">
          🏆 Prestasi
        </button>
        <button type="button" class="category-btn <?= $category === 'kegiatan' ? 'active' : '' ?>" onclick="filterCategory('kegiatan')">
          🎉 Kegiatan
        </button>
        <button type="button" class="category-btn <?= $category === 'pengumuman' ? 'active' : '' ?>" onclick="filterCategory('pengumuman')">
          📢 Pengumuman
        </button>
      </div>

      <div class="search-box">
        <input type="text" 
               name="q" 
               value="<?= htmlspecialchars($search) ?>" 
               placeholder="Cari berita..." 
               id="searchInput">
        <button type="submit">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </button>
      </div>
      <input type="hidden" name="category" id="categoryInput" value="<?= htmlspecialchars($category) ?>">
    </form>
  </div>

  <div class="grid lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
      <?php if (empty($beritaList)): ?>
        <div class="empty-state">
          <div class="empty-state-icon">🔍</div>
          <h3 class="text-2xl font-bold text-gray-900 mb-3">Tidak Ada Berita Ditemukan</h3>
          <p class="text-gray-600 mb-6">
            <?php if (!empty($search)): ?>
              Pencarian "<?= htmlspecialchars($search) ?>" tidak ditemukan. Coba kata kunci lain.
            <?php elseif (!empty($category)): ?>
              Belum ada berita untuk kategori ini.
            <?php else: ?>
              Belum ada berita yang dipublikasikan.
            <?php endif; ?>
          </p>
          <?php if (!empty($search) || !empty($category)): ?>
            <a href="berita.php" class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-full font-semibold hover:bg-green-700 transition-all">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
              </svg>
              Tampilkan Semua Berita
            </a>
          <?php endif; ?>
        </div>
      <?php else: ?>
        <!-- Results Info -->
        <div class="mb-6">
          <p class="text-gray-600">
            Menampilkan <strong><?= count($beritaList) ?></strong> dari <strong><?= $totalBerita ?></strong> berita
            <?php if (!empty($search)): ?>
              untuk pencarian "<strong><?= htmlspecialchars($search) ?></strong>"
            <?php endif; ?>
          </p>
        </div>

        <!-- Berita Grid -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
          <?php foreach ($beritaList as $berita): ?>
            <article class="berita-card">
              <div class="relative overflow-hidden">
                <?php if (!empty($berita['image_path'])): ?>
                  <img src="<?= asset($berita['image_path']) ?>" 
                       alt="<?= htmlspecialchars($berita['title']) ?>" 
                       class="berita-card-image">
                <?php else: ?>
                  <div class="berita-card-image bg-gradient-to-br from-green-400 to-green-600"></div>
                <?php endif; ?>
                <div class="absolute top-4 left-4">
                  <span class="category-badge">
                    <?php
                      $catIcons = [
                        'akademik' => '📚 Akademik',
                        'prestasi' => '🏆 Prestasi',
                        'kegiatan' => '🎉 Kegiatan',
                        'pengumuman' => '📢 Pengumuman'
                      ];
                      echo $catIcons[$berita['category']] ?? '📰 Berita';
                    ?>
                  </span>
                </div>
              </div>
              
              <div class="berita-card-body">
                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                  <?= htmlspecialchars($berita['title']) ?>
                </h3>
                
                <?php if (!empty($berita['excerpt'])): ?>
                  <p class="text-gray-600 mb-4 line-clamp-3 flex-1">
                    <?= htmlspecialchars($berita['excerpt']) ?>
                  </p>
                <?php endif; ?>
                
                <div class="berita-meta">
                  <span>
                    <i class="far fa-calendar mr-1"></i> 
                    <?= date('d M Y', strtotime($berita['created_at'])) ?>
                  </span>
                  <span>
                    <i class="far fa-eye mr-1"></i> 
                    <?= number_format($berita['views']) ?>
                  </span>
                </div>
                
                <a href="berita-detail.php?slug=<?= htmlspecialchars($berita['slug']) ?>" 
                   class="mt-4 inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors">
                  Baca Selengkapnya 
                  <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                  </svg>
                </a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
          <div class="pagination">
            <?php if ($page > 1): ?>
              <a href="?page=<?= $page - 1 ?><?= !empty($category) ? '&category=' . urlencode($category) : '' ?><?= !empty($search) ? '&q=' . urlencode($search) : '' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
              </a>
            <?php endif; ?>

            <?php
              $startPage = max(1, $page - 2);
              $endPage = min($totalPages, $page + 2);
              
              for ($i = $startPage; $i <= $endPage; $i++):
            ?>
              <?php if ($i == $page): ?>
                <span class="active"><?= $i ?></span>
              <?php else: ?>
                <a href="?page=<?= $i ?><?= !empty($category) ? '&category=' . urlencode($category) : '' ?><?= !empty($search) ? '&q=' . urlencode($search) : '' ?>">
                  <?= $i ?>
                </a>
              <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
              <a href="?page=<?= $page + 1 ?><?= !empty($category) ? '&category=' . urlencode($category) : '' ?><?= !empty($search) ? '&q=' . urlencode($search) : '' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
              </a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
      <div class="sidebar">
        <!-- Popular Posts -->
        <div class="sidebar-card">
          <h3>📈 Berita Populer</h3>
          <?php if (empty($popularBerita)): ?>
            <p class="text-gray-500 text-sm">Belum ada berita populer</p>
          <?php else: ?>
            <?php foreach ($popularBerita as $index => $popular): ?>
              <a href="berita-detail.php?slug=<?= htmlspecialchars($popular['slug']) ?>" class="popular-item block">
                <div class="popular-number"><?= $index + 1 ?></div>
                <div class="popular-content">
                  <h4><?= htmlspecialchars($popular['title']) ?></h4>
                  <p>
                    <i class="far fa-eye mr-1"></i> <?= number_format($popular['views']) ?> views
                  </p>
                </div>
              </a>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <!-- Categories -->
        <div class="sidebar-card">
          <h3>📂 Kategori</h3>
          <div class="space-y-3">
            <?php
              $categories = [
                'akademik' => ['icon' => '📚', 'label' => 'Akademik'],
                'prestasi' => ['icon' => '🏆', 'label' => 'Prestasi'],
                'kegiatan' => ['icon' => '🎉', 'label' => 'Kegiatan'],
                'pengumuman' => ['icon' => '📢', 'label' => 'Pengumuman']
              ];

              foreach ($categories as $cat => $info):
                $catBerita = $beritaModel->all(['category' => $cat, 'status' => 'active']);
                $count = count($catBerita);
            ?>
              <a href="?category=<?= $cat ?>" 
                 class="flex items-center justify-between p-3 rounded-lg hover:bg-green-50 transition-colors <?= $category === $cat ? 'bg-green-50 border-2 border-green-600' : 'border-2 border-transparent' ?>">
                <span class="font-semibold text-gray-700">
                  <?= $info['icon'] ?> <?= $info['label'] ?>
                </span>
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">
                  <?= $count ?>
                </span>
              </a>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- CTA -->
        <div class="sidebar-card bg-gradient-to-br from-green-600 to-emerald-600 text-white">
          <h3 class="text-white border-white">📢 Informasi PMB</h3>
          <p class="mb-4 opacity-90">
            Pendaftaran Peserta Didik Baru tahun ajaran 2025/2026 telah dibuka!
          </p>
          <a href="<?= url('kontak.php#daftar') ?>" class="block w-full text-center px-6 py-3 bg-white text-green-600 rounded-full font-bold hover:bg-gray-100 transition-all">
            Daftar Sekarang
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function filterCategory(cat) {
  document.getElementById('categoryInput').value = cat;
  document.getElementById('searchInput').value = '';
  document.getElementById('filterForm').submit();
}
</script>

<?php include 'includes/footer.php'; ?>