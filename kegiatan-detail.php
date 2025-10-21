<?php
require_once __DIR__ . '/models/Kegiatan.php';
require_once __DIR__ . '/config/database.php';

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$slug = trim($_GET['slug'] ?? '');
$kg   = new Kegiatan();
$post = $slug ? $kg->findBySlug($slug) : null;

function kegiatan_photos($kegiatan_id){
  $db = (new Database())->getConnection();
  $s  = $db->prepare("SELECT id, image_path FROM kegiatan_foto WHERE kegiatan_id = :id ORDER BY id DESC");
  $s->execute([':id'=>$kegiatan_id]);
  return $s->fetchAll(PDO::FETCH_ASSOC);
}

$catLabels = [
  'umum'       => 'Umum',
  'berita'     => 'Berita',
  'artikel'    => 'Artikel',
  'pengumuman' => 'Pengumuman',
];
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<div class="max-w-4xl mx-auto px-6 py-12">
  <?php if (!$post): ?>
    <div class="text-center py-24">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Konten Tidak Ditemukan</h1>
      <p class="text-gray-600 mb-6">Halaman yang Anda cari mungkin telah dihapus atau dipindahkan.</p>
      <a href="kegiatan.php" class="inline-flex items-center px-4 py-2 rounded-xl bg-purple-600 text-white hover:bg-purple-700">← Kembali ke Kegiatan</a>
    </div>
  <?php else: ?>
    <?php
      $title   = $post['title'] ?? '-';
      $excerpt = $post['excerpt'] ?? '';
      $content = $post['content'] ?? '';
      $thumb   = $post['image_path'] ?? '';
      $catKey  = strtolower($post['category'] ?? '');
      $catName = $catLabels[$catKey] ?? 'Umum';
      $dateStr = !empty($post['created_at']) ? date('d F Y', strtotime($post['created_at'])) : '';
      $photos  = kegiatan_photos((int)$post['id']);
    ?>

    <article class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-10">
      <!-- Meta Info -->
      <div class="text-center mb-6">
        <a href="kegiatan.php" class="text-sm text-purple-600 hover:text-purple-800 inline-flex items-center mb-3">← Kembali</a>
        <div class="flex justify-center gap-3 flex-wrap text-sm text-gray-500 mb-2">
          <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 rounded-full font-medium"><?= h($catName) ?></span>
          <?php if ($dateStr): ?><span><?= h($dateStr) ?></span><?php endif; ?>
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-snug"><?= h($title) ?></h1>
        <?php if ($excerpt): ?>
          <p class="text-gray-600 mt-3 max-w-2xl mx-auto text-base italic"><?= h($excerpt) ?></p>
        <?php endif; ?>
      </div>

      <!-- Thumbnail (diperkecil & dipusatkan) -->
      <?php if ($thumb): ?>
        <div class="mb-8">
          <div class="max-w-2xl mx-auto">
            <img src="<?= h($thumb) ?>" alt="<?= h($title) ?>"
                 class="w-full h-56 sm:h-64 object-cover rounded-xl border border-gray-200 shadow-sm">
          </div>
        </div>
      <?php endif; ?>

      <!-- Konten -->
      <div class="prose prose-lg mx-auto text-justify text-gray-800 leading-relaxed">
        <?= nl2br(h($content)) ?>
      </div>

      <!-- Galeri -->
      <?php if ($photos): ?>
        <div class="mt-12">
          <h2 class="text-xl font-semibold text-gray-900 mb-5 border-b border-gray-200 pb-2">Galeri Kegiatan</h2>
          <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            <?php foreach ($photos as $ph): ?>
              <a href="<?= h($ph['image_path']) ?>" target="_blank" rel="noopener"
                 class="group block rounded-lg overflow-hidden border border-gray-200 hover:shadow transition">
                <img src="<?= h($ph['image_path']) ?>" alt="" class="h-36 w-full object-cover group-hover:scale-[1.03] transform transition">
              </a>
            <?php endforeach; ?>
          </div>
          <p class="text-xs text-gray-400 mt-2 text-center">Klik foto untuk melihat ukuran penuh</p>
        </div>
      <?php endif; ?>
    </article>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
