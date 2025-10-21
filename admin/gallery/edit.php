<?php
require_once __DIR__ . '/../_auth.php';
require_once __DIR__ . '/../_csrf.php';
require_once __DIR__ . '/../../models/Gallery.php';

csrf_verify();
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$gal = new Gallery();
$id = (int)($_GET['id'] ?? 0);
$item = $gal->find($id);
if (!$item) { http_response_code(404); exit('Data tidak ditemukan'); }

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $category = $_POST['category'] ?? 'school';
  $status = $_POST['status'] ?? 'active';
  $image_path = '';

  if (!empty($_FILES['image']['name'])) {
    $f = $_FILES['image'];
    if ($f['error'] === UPLOAD_ERR_OK) {
      $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
      $allowed = ['jpg','jpeg','png','gif','webp'];
      if (!in_array($ext, $allowed)) $err = 'Ekstensi file tidak didukung.';
      elseif ($f['size'] > 5*1024*1024) $err = 'Ukuran file terlalu besar.';
      else {
        $destDir = __DIR__ . '/../../uploads/gallery';
        if (!is_dir($destDir)) mkdir($destDir, 0775, true);
        $safe = preg_replace('/[^a-z0-9-]+/i','-', strtolower(pathinfo($f['name'], PATHINFO_FILENAME)));
        $filename = $safe . '-' . uniqid() . '.' . $ext;
        $target = $destDir . '/' . $filename;
        if (move_uploaded_file($f['tmp_name'], $target)) {
          $image_path = 'uploads/gallery/' . $filename;
        } else $err = 'Gagal menyimpan file upload.';
      }
    } else $err = 'Upload error kode: '.$f['error'];
  }

  if (!$err) {
    $ok = $gal->update($id, [
      'title' => $title,
      'description' => $description,
      'category' => $category,
      'status' => $status,
      'image_path' => $image_path,
    ]);
    if ($ok) { header('Location: index.php'); exit; }
    $err = 'Gagal memperbarui data.';
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Gallery</title>
  <link rel="stylesheet" href="/site/assets/css/style.css">
  <style>.form-control{padding:8px;width:100%;}.row{margin-bottom:12px;}.btn{padding:8px 12px;border:1px solid #ddd;border-radius:8px;}.btn-primary{background:#2d6a4f;color:#fff;border-color:#2d6a4f;}</style>
</head>
<body>
  <div class="container">
    <h1>Edit Gallery</h1>
    <a class="btn" href="index.php">← Kembali</a>
    <?php if ($err): ?><div style="color:#b00020;"><?= h($err) ?></div><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
      <?php csrf_field(); ?>
      <div class="row">
        <label>Judul</label>
        <input class="form-control" type="text" name="title" value="<?= h($item['title']) ?>" required>
      </div>
      <div class="row">
        <label>Deskripsi</label>
        <textarea class="form-control" name="description" rows="4"><?= h($item['description']) ?></textarea>
      </div>
      <div class="row">
        <label>Gambar</label><br>
        <?php if ($item['image_path']): ?><img src="/site/<?= h($item['image_path']) ?>" style="height:80px"><br><?php endif; ?>
        <input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png,.gif,.webp">
        <small>Biarkan kosong jika tidak ingin mengubah.</small>
      </div>
      <div class="row">
        <label>Kategori</label>
        <select class="form-control" name="category">
          <?php foreach (['school','events','activities','achievements'] as $opt): ?>
            <option value="<?= $opt ?>" <?= $opt===$item['category']?'selected':'' ?>><?= ucfirst($opt) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="row">
        <label>Status</label>
        <select class="form-control" name="status">
          <?php foreach (['active','inactive'] as $opt): ?>
            <option value="<?= $opt ?>" <?= $opt===$item['status']?'selected':'' ?>><?= ucfirst($opt) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </form>
  </div>
</body>
</html>
