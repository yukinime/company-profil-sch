<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/models/Berita.php';

$beritaModel = new Berita();

// Cek parameter slug atau id
$slug = $_GET['slug'] ?? '';
$id = $_GET['id'] ?? '';

// Cari berita berdasarkan slug atau id
if (!empty($slug)) {
  // Cek apakah slug adalah angka (kemungkinan ID)
  if (is_numeric($slug)) {
    $berita = $beritaModel->findById($slug);
  } else {
    $berita = $beritaModel->findBySlug($slug);
  }
} elseif (!empty($id)) {
  $berita = $beritaModel->findById($id);
} else {
  header('Location: berita.php');
  exit;
}

// Jika berita tidak ditemukan atau tidak aktif
if (!$berita || $berita['status'] !== 'active') {
  header('Location: berita.php');
  exit;
}

// Increment views
$beritaModel->incrementViews($berita['id']);

// Ambil foto tambahan
$photos = $beritaModel->getPhotos($berita['id']);

// Ambil berita terkait (kategori sama, exclude berita saat ini)
$allRelated = $beritaModel->all(['category' => $berita['category'], 'status' => 'active']);
$relatedBerita = array_filter($allRelated, function($item) use ($berita) {
  return $item['id'] !== $berita['id'];
});
$relatedBerita = array_slice($relatedBerita, 0, 4);

include 'includes/header.php';
?>

<style>
  .berita-detail-hero {
    position: relative;
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    height: 60vh;
    min-height: 400px;
    max-height: 600px;
    overflow: hidden;
  }

  .berita-detail-hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .berita-detail-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
  }

  .berita-detail-content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    align-items: flex-end;
    padding: 3rem 2rem;
  }

  .category-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 16px;
    background: rgba(34, 139, 34, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    color: white;
    margin-bottom: 1rem;
  }

  .article-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
  }

  .article-content p {
    margin-bottom: 1.5rem;
  }

  .article-content h2, .article-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #228B22;
    font-weight: 700;
  }

  .photo-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1rem;
    margin: 2rem 0;
  }

  .photo-gallery img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 12px;
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .photo-gallery img:hover {
    transform: scale(1.05);
  }

  .related-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
  }

  .related-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 30px rgba(34, 139, 34, 0.15);
  }

  .related-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
  }

  .share-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
  }

  .share-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .share-btn-fb {
    background: #1877F2;
    color: white;
  }

  .share-btn-tw {
    background: #1DA1F2;
    color: white;
  }

  .share-btn-wa {
    background: #25D366;
    color: white;
  }

  .share-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  }

  .breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1.5rem 0;
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

  .sidebar-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 1.5rem;
  }

  .sidebar-card h3 {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 3px solid #228B22;
  }

  .related-item {
    display: block;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #f3f4f6;
    transition: all 0.3s ease;
    text-decoration: none;
  }

  .related-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
  }

  .related-item:hover {
    transform: translateX(5px);
  }

  .popular-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #f3f4f6;
    transition: all 0.3s ease;
    text-decoration: none;
  }

  .popular-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
  }

  .popular-item:hover {
    transform: translateX(5px);
  }

  @media (max-width: 768px) {
    .berita-detail-hero {
      height: 50vh;
      min-height: 300px;
    }
  }
</style>

<!-- Hero Section -->
<section class="berita-detail-hero">
  <?php if (!empty($berita['image_path'])): ?>
    <img src="<?= asset($berita['image_path']) ?>" alt="<?= htmlspecialchars($berita['title']) ?>">
  <?php else: ?>
    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #228B22, #32CD32);"></div>
  <?php endif; ?>
  <div class="berita-detail-overlay"></div>
  <div class="berita-detail-content">
    <div class="max-w-4xl mx-auto w-full text-white">
      <span class="category-badge">
        <?php
          $catLabels = [
            'akademik' => '📚 Akademik',
            'prestasi' => '🏆 Prestasi',
            'kegiatan' => '🎉 Kegiatan',
            'pengumuman' => '📢 Pengumuman'
          ];
          echo $catLabels[$berita['category']] ?? 'Berita';
        ?>
      </span>
      <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
        <?= htmlspecialchars($berita['title']) ?>
      </h1>
      <div class="flex flex-wrap items-center gap-4 text-sm opacity-90">
        <span><i class="fas fa-user mr-2"></i><?= htmlspecialchars($berita['author_name'] ?? 'Admin') ?></span>
        <span><i class="fas fa-calendar mr-2"></i><?= date('d F Y', strtotime($berita['created_at'])) ?></span>
        <span><i class="fas fa-eye mr-2"></i><?= number_format($berita['views']) ?> views</span>
      </div>
    </div>
  </div>
</section>

<div class="max-w-7xl mx-auto px-4 md:px-6 py-8">
  <!-- Breadcrumb -->
  <div class="breadcrumb">
    <a href="<?= url('index.php') ?>">Beranda</a>
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
    </svg>
    <a href="<?= url('berita.php') ?>">Berita</a>
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
    </svg>
    <span><?= htmlspecialchars(substr($berita['title'], 0, 50)) ?><?= strlen($berita['title']) > 50 ? '...' : '' ?></span>
  </div>

  <div class="grid lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
      <div class="bg-white rounded-2xl p-6 md:p-10 shadow-lg">
        <!-- Excerpt -->
        <?php if (!empty($berita['excerpt'])): ?>
          <div class="text-xl text-gray-700 font-medium mb-8 pb-8 border-b-2 border-gray-100">
            <?= nl2br(htmlspecialchars($berita['excerpt'])) ?>
          </div>
        <?php endif; ?>

        <!-- Article Content -->
        <div class="article-content">
          <?= nl2br(htmlspecialchars($berita['content'])) ?>
        </div>

        <!-- Photo Gallery -->
        <?php if (!empty($photos)): ?>
          <div class="mt-10 pt-10 border-t-2 border-gray-100">
            <h3 class="text-2xl font-bold mb-6 text-gray-900">📸 Galeri Foto</h3>
            <div class="photo-gallery">
              <?php foreach ($photos as $photo): ?>
                <img src="<?= asset($photo['image_path']) ?>" 
                     alt="Foto berita" 
                     onclick="window.open('<?= asset($photo['image_path']) ?>', '_blank')">
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

        <!-- Share Buttons -->
        <div class="mt-10 pt-10 border-t-2 border-gray-100">
          <h3 class="text-lg font-bold mb-4 text-gray-900">📤 Bagikan Berita Ini</h3>
          <div class="share-buttons">
            <?php
              $currentUrl = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
              $shareUrl = urlencode($currentUrl);
              $shareTitle = urlencode($berita['title']);
            ?>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $shareUrl ?>" 
               target="_blank" 
               class="share-btn share-btn-fb">
              <i class="fab fa-facebook-f"></i> Facebook
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?= $shareUrl ?>&text=<?= $shareTitle ?>" 
               target="_blank" 
               class="share-btn share-btn-tw">
              <i class="fab fa-twitter"></i> Twitter
            </a>
            <a href="https://wa.me/?text=<?= $shareTitle ?>%20<?= $shareUrl ?>" 
               target="_blank" 
               class="share-btn share-btn-wa">
              <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
          </div>
        </div>
      </div>

      <!-- Navigation -->
      <div class="mt-8 flex gap-4">
        <a href="berita.php" class="inline-flex items-center px-6 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition-all">
          <i class="fas fa-arrow-left mr-2"></i> Kembali ke Berita
        </a>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
      <!-- Related Posts -->
      <?php if (!empty($relatedBerita)): ?>
        <div class="sidebar-card">
          <h3>🔗 Berita Terkait</h3>
          <div class="space-y-4">
            <?php foreach ($relatedBerita as $related): ?>
              <a href="berita-detail.php?id=<?= $related['id'] ?>" class="related-item">
                <div class="flex gap-3">
                  <?php if (!empty($related['image_path'])): ?>
                    <img src="<?= asset($related['image_path']) ?>" 
                         alt="<?= htmlspecialchars($related['title']) ?>"
                         class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                  <?php else: ?>
                    <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex-shrink-0"></div>
                  <?php endif; ?>
                  <div class="flex-1">
                    <h4 class="font-semibold text-sm text-gray-900 hover:text-green-600 transition-colors line-clamp-2">
                      <?= htmlspecialchars($related['title']) ?>
                    </h4>
                    <p class="text-xs text-gray-500 mt-1">
                      <i class="far fa-calendar mr-1"></i>
                      <?= date('d M Y', strtotime($related['created_at'])) ?>
                    </p>
                  </div>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>

      <!-- Popular Posts -->
      <div class="sidebar-card bg-gradient-to-br from-green-50 to-emerald-50">
        <h3>📈 Berita Populer</h3>
        <?php $popularBerita = $beritaModel->getPopular(5); ?>
        <div class="space-y-4">
          <?php foreach ($popularBerita as $popular): ?>
            <a href="berita-detail.php?id=<?= $popular['id'] ?>" class="popular-item">
              <div class="flex items-start gap-3">
                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center font-bold text-sm">
                  <?= number_format($popular['views']) ?>
                </span>
                <div class="flex-1">
                  <h4 class="font-semibold text-sm text-gray-900 hover:text-green-600 transition-colors line-clamp-2">
                    <?= htmlspecialchars($popular['title']) ?>
                  </h4>
                </div>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- CTA -->
      <div class="sidebar-card bg-gradient-to-br from-green-600 to-emerald-600 text-white">
        <h3 class="text-white border-white">📢 Informasi PMB</h3>
        <p class="mb-4 opacity-90 text-sm">
          Pendaftaran Peserta Didik Baru tahun ajaran 2025/2026 telah dibuka!
        </p>
        <a href="<?= url('kontak.php#daftar') ?>" class="block w-full text-center px-6 py-3 bg-white text-green-600 rounded-full font-bold hover:bg-gray-100 transition-all">
          Daftar Sekarang
        </a>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>