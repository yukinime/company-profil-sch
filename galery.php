<?php
// ====== DATA ======
require_once __DIR__ . '/models/Gallery.php';
$gal = new Gallery();

// Normalisasi kategori dari query (?category=...)
$category = strtolower(trim($_GET['category'] ?? ''));
$validCats = ['tk','sd','smp','sma'];
if (!in_array($category, $validCats, true)) {
  $category = '';
}

// Ambil data guru (status active), filter kategori jika ada
$items = $gal->all([
  'status'   => 'active',
  'category' => $category ?: null,
]);

// Pastikan $items berupa array agar aman dipakai di foreach
if (!is_array($items)) { $items = []; }

$catLabels = [
  'tk'  => 'Guru TK',
  'sd'  => 'Guru SD',
  'smp' => 'Guru SMP',
  'sma' => 'Guru SMA',
];

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
?>
<?php include 'includes/header.php'; ?>

<!-- ====== KONTEN GALERI (tanpa <main>) ====== -->
<div class="max-w-7xl mx-auto px-6 py-12">
  <!-- Header rata tengah -->
  <div class="text-center mb-10">
    <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-2">
      Galeri Tenaga Pendidik
    </h1>
    <p class="text-gray-600 max-w-2xl mx-auto">
      Temukan profil guru berdasarkan jenjang. Gunakan tab kategori atau kolom pencarian untuk memfilter.
    </p>
  </div>

  <!-- Tabs kategori (tetap di tengah) -->
  <div class="flex flex-wrap justify-center gap-3 mb-10">
    <!-- Tombol Semua -->
    <a href="galery.php"
       class="px-5 py-2 rounded-full border text-sm font-medium transition
              <?= $category === '' ? 'bg-purple-600 border-purple-600 text-white shadow' : 'border-gray-300 text-gray-700 hover:bg-purple-50 hover:border-purple-400' ?>">
      Semua
    </a>
    <?php foreach ($catLabels as $key => $label): ?>
      <a href="?category=<?= h($key) ?>"
         class="px-5 py-2 rounded-full border text-sm font-medium transition
                <?= $category === $key
                  ? 'bg-purple-600 border-purple-600 text-white shadow'
                  : 'border-gray-300 text-gray-700 hover:bg-purple-50 hover:border-purple-400' ?>">
        <?= h($label) ?>
      </a>
    <?php endforeach; ?>
  </div>

  <!-- Grid kartu guru -->
  <?php if (!empty($items)): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
      <?php foreach ($items as $it): if (!is_array($it)) continue; ?>
        <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden border border-gray-100">
          <?php if (!empty($it['image_path'])): ?>
            <img src="<?= h($it['image_path']) ?>"
                 alt="<?= h($it['title'] ?? 'Guru') ?>"
                 class="h-56 w-full object-cover">
          <?php else: ?>
            <div class="h-56 w-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm">Tanpa Foto</div>
          <?php endif; ?>

          <div class="p-5 text-center">
            <h3 class="text-lg font-semibold text-gray-900 mb-1"><?= h($it['title'] ?? 'Nama Guru') ?></h3>
            <p class="text-sm text-gray-500 mb-3"><?= h($it['description'] ?? '-') ?></p>

            <?php
              $catKey = isset($it['category']) ? strtolower($it['category']) : '';
              if (isset($catLabels[$catKey])):
            ?>
              <span class="inline-block text-xs font-medium px-3 py-1 rounded-full bg-purple-100 text-purple-700">
                <?= h($catLabels[$catKey]) ?>
              </span>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
      <p class="text-gray-500">Belum ada data guru untuk kategori ini.</p>
    </div>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
