<?php
require_once __DIR__ . '/config/database.php';
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$id = (int)($_GET['id'] ?? 0);
$db = (new Database())->getConnection();
$stmt = $id ? $db->prepare("SELECT * FROM render_art WHERE id = :id AND status='active'") : null;
$post = null;
if ($stmt) { $stmt->execute([':id'=>$id]); $post = $stmt->fetch(PDO::FETCH_ASSOC); }

function getImageUrl($imagePath){
  if (!$imagePath) return '';
  if (preg_match('#^https?://#i', $imagePath)) return $imagePath;
  // Struktur kamu: /site/uploads/...
  return '/site/' . ltrim($imagePath, '/');
}
?>
<?php include 'includes/header.php'; ?>

<section class="py-12">
  <div class="max-w-4xl mx-auto px-4">
    <?php if (!$post): ?>
      <p>Tidak ditemukan.</p>
    <?php else: 
      $img = getImageUrl($post['image_path'] ?? '');
    ?>
      <a href="render-art.php" class="text-sm text-indigo-600 hover:underline">← Kembali</a>
      <h1 class="text-3xl font-bold mt-3 mb-4"><?= h($post['title'] ?? '') ?></h1>
      <?php if ($img): ?>
        <div class="w-full overflow-hidden rounded-xl bg-gray-100 mb-6" style="aspect-ratio:16/9">
          <img src="<?= h($img) ?>" alt="<?= h($post['title'] ?? '') ?>" class="w-full h-full object-cover">
        </div>
      <?php endif; ?>
      <div class="prose max-w-none text-gray-700">
        <?= nl2br(h($post['description'] ?? '')) ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
