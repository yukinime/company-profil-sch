<?php
// File ini untuk ditempatkan di: site/render-art.php
include 'includes/header.php';
require_once __DIR__ . '/config/database.php';

$db = (new Database())->getConnection();

// Ambil filter kategori dari query string
$filter = $_GET['cat'] ?? '';

// Ambil data dari tabel render_art
$sql = "SELECT * FROM render_art WHERE status = 'active'";
$params = [];

if (!empty($filter) && in_array($filter, ['eksterior','interior','3d_modeling'])) {
  $sql .= " AND category = :cat";
  $params[':cat'] = $filter;
}

$sql .= " ORDER BY created_at DESC";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$render_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Label kategori untuk display
$categoryLabels = [
  'eksterior' => 'Eksterior',
  'interior' => 'Interior',
  '3d_modeling' => '3D Modeling'
];

// Helper function untuk path gambar
function getImageUrl($imagePath) {
  if (empty($imagePath)) return '';
  // Jika path sudah lengkap dengan /site/, langsung return
  if (strpos($imagePath, '/site/') !== false) {
    return $imagePath;
  }
  // Jika path dimulai dengan uploads/, tambahkan /site/ di depan
  if (strpos($imagePath, 'uploads/') === 0) {
    return '/site/' . $imagePath;
  }
  // Default return as-is
  return $imagePath;
}
?>

<section class="py-16 bg-gradient-to-br from-purple-50 via-white to-indigo-50">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Render Art Commission</h1>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">
        Karya seni digital render berkualitas tinggi untuk berbagai kebutuhan visualisasi arsitektur dan desain interior
      </p>
    </div>

    <!-- Filter Categories -->
    <div class="flex flex-wrap justify-center gap-3 mb-12">
      <a href="render-art.php" class="px-6 py-2 rounded-full <?= empty($_GET['cat']) ? 'bg-purple-600 text-white' : 'bg-white text-gray-700' ?> font-medium hover:bg-purple-500 hover:text-white transition border border-gray-300">Semua</a>
      <a href="render-art.php?cat=eksterior" class="px-6 py-2 rounded-full <?= ($_GET['cat'] ?? '')==='eksterior' ? 'bg-purple-600 text-white' : 'bg-white text-gray-700' ?> font-medium hover:bg-purple-500 hover:text-white transition border border-gray-300">Eksterior</a>
      <a href="render-art.php?cat=interior" class="px-6 py-2 rounded-full <?= ($_GET['cat'] ?? '')==='interior' ? 'bg-purple-600 text-white' : 'bg-white text-gray-700' ?> font-medium hover:bg-purple-500 hover:text-white transition border border-gray-300">Interior</a>
      <a href="render-art.php?cat=3d_modeling" class="px-6 py-2 rounded-full <?= ($_GET['cat'] ?? '')==='3d_modeling' ? 'bg-purple-600 text-white' : 'bg-white text-gray-700' ?> font-medium hover:bg-purple-500 hover:text-white transition border border-gray-300">3D Modeling</a>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      <?php if (!$render_items): ?>
        <!-- Jika belum ada data -->
        <div class="col-span-3 text-center text-gray-500 py-12">
          <div class="text-6xl mb-4">🎨</div>
          <p class="text-xl font-medium">Belum ada karya render yang tersedia.</p>
          <p class="text-sm mt-2">Silakan cek kembali nanti atau hubungi kami untuk informasi lebih lanjut.</p>
        </div>
      <?php else: ?>
        <?php foreach ($render_items as $item): ?>
          <?php 
            $imageUrl = getImageUrl($item['image_path']);
            $hasImage = !empty($imageUrl);
          ?>
          <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="aspect-video bg-gradient-to-br from-purple-200 to-indigo-200 relative overflow-hidden">
              <?php if ($hasImage): ?>
                <img 
                  src="<?= htmlspecialchars($imageUrl) ?>" 
                  alt="<?= htmlspecialchars($item['title']) ?>" 
                  class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                  onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'absolute inset-0 flex items-center justify-center text-gray-400 text-sm\'><div class=\'text-center\'><i class=\'fas fa-image text-4xl mb-2\'></i><p>Image not found</p><p class=\'text-xs mt-1\'><?= htmlspecialchars($imageUrl) ?></p></div></div>';">
              <?php else: ?>
                <div class="absolute inset-0 flex items-center justify-center text-gray-400 text-sm">
                  <div class="text-center">
                    <i class="fas fa-image text-4xl mb-2"></i>
                    <p>No Image</p>
                  </div>
                </div>
              <?php endif; ?>
              <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors"><?= htmlspecialchars($item['title']) ?></h3>
              <?php if (!empty($item['description'])): ?>
                <p class="text-gray-600 text-sm mb-4 line-clamp-3"><?= nl2br(htmlspecialchars($item['description'])) ?></p>
              <?php endif; ?>
              <div class="flex items-center justify-between">
                <?php
                  $colorMap = [
                    'eksterior' => ['text' => 'text-purple-600', 'bg' => 'bg-purple-100'],
                    'interior' => ['text' => 'text-indigo-600', 'bg' => 'bg-indigo-100'],
                    '3d_modeling' => ['text' => 'text-blue-600', 'bg' => 'bg-blue-100']
                  ];
                  $color = $colorMap[$item['category']] ?? ['text' => 'text-gray-600', 'bg' => 'bg-gray-100'];
                ?>
                <span class="text-xs font-semibold <?= $color['text'] ?> <?= $color['bg'] ?> px-3 py-1 rounded-full">
                  <?= htmlspecialchars($categoryLabels[$item['category']] ?? ucfirst($item['category'])) ?>
                </span>
                <button onclick="alert('Detail untuk: <?= htmlspecialchars($item['title']) ?>')" class="text-purple-600 hover:text-purple-800 font-medium text-sm flex items-center gap-1 group/btn">
                  <span>Lihat Detail</span>
                  <i class="fas fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>

    <!-- Debug Info (hapus setelah selesai debugging) -->
    <?php if (!empty($render_items) && isset($_GET['debug'])): ?>
      <div class="mt-8 bg-gray-800 text-white p-4 rounded-lg text-xs overflow-auto">
        <h3 class="font-bold mb-2">Debug Info:</h3>
        <pre><?php print_r($render_items); ?></pre>
      </div>
    <?php endif; ?>

    <!-- CTA Section -->
    <div class="mt-16 text-center bg-gradient-to-r from-purple-600 to-indigo-600 rounded-3xl p-12 text-white shadow-xl">
      <h2 class="text-3xl font-bold mb-4">Butuh Render Art untuk Proyek Anda?</h2>
      <p class="text-lg mb-8 opacity-90">Hubungi kami untuk konsultasi gratis dan dapatkan visualisasi terbaik untuk proyek Anda</p>
      <div class="flex flex-wrap justify-center gap-4">
        <a href="kontak.php" class="inline-flex items-center px-8 py-3 bg-white text-purple-600 font-bold rounded-xl hover:bg-gray-100 transition shadow-lg">
          <i class="fas fa-envelope mr-2"></i>
          Hubungi Sekarang
        </a>
        <a href="tel:+6281234567890" class="inline-flex items-center px-8 py-3 bg-transparent border-2 border-white text-white font-bold rounded-xl hover:bg-white hover:text-purple-600 transition">
          <i class="fas fa-phone mr-2"></i>
          0812-3456-7890
        </a>
      </div>
    </div>

    <!-- Info Section -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="text-center p-6 bg-white rounded-2xl border border-gray-200">
        <div class="text-4xl mb-3">🏗️</div>
        <h3 class="font-bold text-gray-900 mb-2">Arsitektur Berkualitas</h3>
        <p class="text-sm text-gray-600">Visualisasi detail dengan presisi tinggi untuk setiap proyek</p>
      </div>
      <div class="text-center p-6 bg-white rounded-2xl border border-gray-200">
        <div class="text-4xl mb-3">⚡</div>
        <h3 class="font-bold text-gray-900 mb-2">Pengerjaan Cepat</h3>
        <p class="text-sm text-gray-600">Komitmen deadline dan hasil memuaskan</p>
      </div>
      <div class="text-center p-6 bg-white rounded-2xl border border-gray-200">
        <div class="text-4xl mb-3">💎</div>
        <h3 class="font-bold text-gray-900 mb-2">Hasil Profesional</h3>
        <p class="text-sm text-gray-600">Render berkualitas studio untuk presentasi maksimal</p>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>