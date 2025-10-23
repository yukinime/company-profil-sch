<?php
require_once __DIR__ . '/includes/config.php';
// File: site/render-art.php
include 'includes/header.php';
require_once __DIR__ . '/config/database.php';

/* ======================= Helpers ======================= */
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

/**
 * Gambar kamu berada di C:\xampp\htdocs\site\uploads\render
 * => URL yang benar: /site/uploads/...
 */
function getImageUrl($imagePath){
  if (empty($imagePath)) return '';
  if (preg_match('#^https?://#i', $imagePath)) return $imagePath; // CDN/S3
  return '/site/' . ltrim($imagePath, '/'); // -> /site/uploads/...
}

/** ringkas teks untuk cuplikan kartu */
function excerpt($text, $len = 100){
  $text = (string)$text;
  // hilangkan newline beruntun agar rapi
  $text = trim(preg_replace("/\s+/u", " ", $text));
  if (function_exists('mb_strimwidth')) {
    return mb_strimwidth($text, 0, $len, '…', 'UTF-8');
  }
  return strlen($text) > $len ? substr($text, 0, $len) . '…' : $text;
}

/* ======================= DB & Filter ======================= */
$db = (new Database())->getConnection();

$filter  = $_GET['cat'] ?? '';
$allowed = ['eksterior','interior','3d_modeling'];

$sql    = "SELECT * FROM render_art WHERE status = 'active'";
$params = [];

if (!empty($filter) && in_array($filter, $allowed, true)) {
  $sql .= " AND category = :cat";
  $params[':cat'] = $filter;
}

/* Urutkan yang terbaru */
$sql .= " ORDER BY created_at DESC, id DESC";

$stmt = $db->prepare($sql);
$stmt->execute($params);
$render_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* Dedup by id (jika ada data kembar dari query/seed) */
$seen = [];
$render_items = array_values(array_filter($render_items, function($row) use (&$seen){
  $id = (int)($row['id'] ?? 0);
  if (!$id) return false;
  if (isset($seen[$id])) return false;
  $seen[$id] = true;
  return true;
}));

/* Warna kategori */
$colorMap = [
  'eksterior'   => ['text' => 'text-purple-700', 'bg' => 'bg-purple-100', 'label' => 'Eksterior'],
  'interior'    => ['text' => 'text-indigo-700', 'bg' => 'bg-indigo-100', 'label' => 'Interior'],
  '3d_modeling' => ['text' => 'text-blue-700',   'bg' => 'bg-blue-100',   'label' => '3D Modeling'],
];
?>
<section class="py-16 bg-gradient-to-br from-purple-50 via-white to-indigo-50">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Render Art Commission</h1>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">
        Karya seni digital render berkualitas tinggi untuk berbagai kebutuhan visualisasi arsitektur dan desain interior
      </p>
    </div>

    <!-- Filter Kategori -->
    <div class="flex flex-wrap justify-center gap-3 mb-12">
      <?php
        $tabs = [
          ['label'=>'Semua',      'val'=>''],
          ['label'=>'Eksterior',  'val'=>'eksterior'],
          ['label'=>'Interior',   'val'=>'interior'],
          ['label'=>'3D Modeling','val'=>'3d_modeling'],
        ];
        foreach ($tabs as $t):
          $active = ($t['val'] === ($filter ?? ''));
          $href = url('render-art.php') . ($t['val'] ? ('?cat=' . rawurlencode($t['val'])) : '');
      ?>
        <a href="<?= h($href) ?>"
           class="px-6 py-2 rounded-full border transition <?=
                  $active
                  ? 'bg-indigo-600 text-white border-indigo-600'
                  : 'border-gray-300 text-gray-700 hover:bg-indigo-600 hover:text-white' ?>">
          <?= h($t['label']) ?>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      <?php if (empty($render_items)): ?>
        <!-- Kosong -->
        <div class="col-span-3 text-center text-gray-500 py-12">
          <div class="text-6xl mb-4">🎨</div>
          <p class="text-xl font-medium">Belum ada karya render yang tersedia.</p>
          <p class="text-sm mt-2">Silakan cek kembali nanti atau hubungi kami untuk informasi lebih lanjut.</p>
        </div>

      <?php else: ?>
        <?php foreach ($render_items as $item): ?>
          <?php
            $id      = (int)($item['id'] ?? 0);
            $title   = $item['title'] ?? '';
            $desc    = $item['description'] ?? '';
            $catKey  = strtolower($item['category'] ?? '');
            $cat     = $colorMap[$catKey] ?? ['text'=>'text-gray-700','bg'=>'bg-gray-100','label'=>ucwords(str_replace('_',' ', $catKey ?: 'Umum'))];
            $imageUrl= getImageUrl($item['image_path'] ?? '');
          ?>

          <!-- Satu Card, full-clickable -->
          <a href="<?= url('render-art-detail.php?id=' . rawurlencode($id)) ?>" class="block group">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 group-hover:-translate-y-1 group-hover:shadow-2xl">

              <!-- Gambar (rapi, tetap di dalam card) -->
              <div class="relative w-full overflow-hidden bg-gray-100" style="aspect-ratio:16/9">
                <?php if (!empty($imageUrl)): ?>
                  <img
                    src="<?= h($imageUrl) ?>"
                    alt="<?= h($title) ?>"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    loading="lazy"
                    onerror="this.onerror=null; this.style.display='none';">
                <?php else: ?>
                  <div class="absolute inset-0 flex items-center justify-center text-gray-400 text-sm">
                    <div class="text-center">
                      <i class="fas fa-image text-4xl mb-2"></i>
                      <p>No Image</p>
                    </div>
                  </div>
                <?php endif; ?>
              </div>

              <!-- Konten teks -->
              <div class="p-6">
                <div class="mb-3">
                  <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?= h($cat['text']) ?> <?= h($cat['bg']) ?>">
                    <?= h($cat['label']) ?>
                  </span>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-2">
                  <?= h($title) ?>
                </h3>

                <?php if ($desc !== ''): ?>
                  <p class="text-gray-600 text-sm">
                    <?= h(excerpt($desc, 100)) ?>
                  </p>
                <?php endif; ?>
              </div>

            </div>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>

  </div>
</section>

<?php
// (Opsional) Debug URL gambar: buka ?debug=1 untuk melihat URL yang dipakai
if (!empty($render_items) && isset($_GET['debug'])):
  echo '<div class="max-w-7xl mx-auto px-4 py-6 text-xs text-gray-600">';
  echo '<pre>';
  foreach ($render_items as $it) {
    echo ($it['id'] ?? '?') . '  ->  ' . getImageUrl($it['image_path'] ?? '') . PHP_EOL;
  }
  echo '</pre></div>';
endif;

include 'includes/footer.php';
