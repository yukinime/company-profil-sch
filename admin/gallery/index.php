<?php
require_once __DIR__ . '/../_auth.php';
require_once __DIR__ . '/../_csrf.php';
require_once __DIR__ . '/../../models/Gallery.php';

$gallery = new Gallery();

$q = $_GET['q'] ?? '';
$category = $_GET['category'] ?? '';
$status = $_GET['status'] ?? '';

$items = $gallery->all([
  'q' => $q,
  'category' => $category,
  'status' => $status,
]);

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Gallery</title>
  <link rel="stylesheet" href="/site/assets/css/style.css">
  <style>
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; border-bottom: 1px solid #eee; text-align: left; }
    .topbar { display: flex; gap: 12px; align-items: center; margin: 16px 0; flex-wrap: wrap; }
    .btn { padding: 8px 12px; border-radius: 8px; border: 1px solid #ddd; text-decoration: none; display: inline-block; }
    .btn-primary { background: #2d6a4f; color: #fff; border-color: #2d6a4f; }
    .filters input, .filters select { padding: 8px; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Gallery</h1>
    <div class="topbar">
      <a href="/site/admin/dashboard.php" class="btn">← Dashboard</a>
      <a class="btn btn-primary" href="create.php">+ Tambah Item</a>
      <form class="filters" method="get">
        <input type="text" name="q" placeholder="Cari..." value="<?= h($q) ?>">
        <select name="category">
          <option value="">Semua Kategori</option>
          <?php foreach (['school','events','activities','achievements'] as $opt): ?>
            <option value="<?= $opt ?>" <?= $opt===$category?'selected':'' ?>><?= ucfirst($opt) ?></option>
          <?php endforeach; ?>
        </select>
        <select name="status">
          <option value="">Semua Status</option>
          <?php foreach (['active','inactive'] as $opt): ?>
            <option value="<?= $opt ?>" <?= $opt===$status?'selected':'' ?>><?= ucfirst($opt) ?></option>
          <?php endforeach; ?>
        </select>
        <button class="btn">Terapkan</button>
      </form>
    </div>
    <table>
      <thead>
        <tr><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Dibuat</th><th>Aksi</th></tr>
      </thead>
      <tbody>
        <?php foreach ($items as $it): ?>
          <tr>
            <td><?php if ($it['image_path']): ?><img src="/site/<?= h($it['image_path']) ?>" alt="" style="height:60px"><?php endif; ?></td>
            <td><?= h($it['title']) ?></td>
            <td><?= h($it['category']) ?></td>
            <td><?= h($it['status']) ?></td>
            <td><?= h($it['created_at']) ?></td>
            <td>
              <a class="btn" href="edit.php?id=<?= (int)$it['id'] ?>">Edit</a>
              <form action="delete.php" method="post" style="display:inline" onsubmit="return confirm('Hapus item ini?')">
                <?php csrf_field(); ?>
                <input type="hidden" name="id" value="<?= (int)$it['id'] ?>">
                <button class="btn" type="submit">Hapus</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$items): ?>
          <tr><td colspan="6">Belum ada data.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
