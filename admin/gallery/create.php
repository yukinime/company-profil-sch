<?php
require_once __DIR__ . '/../_auth.php';
require_once __DIR__ . '/../_csrf.php';
require_once __DIR__ . '/../../models/Gallery.php';

csrf_verify();
$err = '';

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$MAX_FILE_SIZE_MB = 5;
$ALLOWED_EXT = ['jpg','jpeg','png','gif','webp'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $category = $_POST['category'] ?? 'school';
  $status = $_POST['status'] ?? 'active';
  $created_by = $_SESSION['admin_id'] ?? null;

  // Upload handling
  $image_path = '';
  if (!empty($_FILES['image']['name'])) {
    $f = $_FILES['image'];
    if ($f['error'] === UPLOAD_ERR_OK) {
      $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
      if (!in_array($ext, $ALLOWED_EXT)) {
        $err = 'Ekstensi file tidak didukung.';
      } elseif ($f['size'] > $MAX_FILE_SIZE_MB*1024*1024) {
        $err = 'Ukuran file terlalu besar.';
      } else {
        $destDir = __DIR__ . '/../../uploads/gallery';
        if (!is_dir($destDir)) mkdir($destDir, 0775, true);
        $safe = preg_replace('/[^a-z0-9-]+/i','-', strtolower(pathinfo($f['name'], PATHINFO_FILENAME)));
        $filename = $safe . '-' . uniqid() . '.' . $ext;
        $target = $destDir . '/' . $filename;
        if (move_uploaded_file($f['tmp_name'], $target)) {
          $image_path = 'uploads/gallery/' . $filename;
        } else {
          $err = 'Gagal menyimpan file upload.';
        }
      }
    } else {
      $err = 'Upload error kode: ' . $f['error'];
    }
  }

  if (!$err) {
    $gal = new Gallery();
    $ok = $gal->create([
      'title' => $title,
      'description' => $description,
      'image_path' => $image_path,
      'category' => $category,
      'status' => $status,
      'created_by' => $created_by,
    ]);
    if ($ok) { header('Location: index.php'); exit; }
    $err = 'Gagal menambah data.';
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Gallery</title>
  <link rel="stylesheet" href="/site/assets/css/style.css">
  <style>.form-control{padding:8px;width:100%;}.row{margin-bottom:12px;}.btn{padding:8px 12px;border:1px solid #ddd;border-radius:8px;}.btn-primary{background:#2d6a4f;color:#fff;border-color:#2d6a4f;}</style>
</head>
<body>
  <div class="container">
    <h1>Tambah Gallery</h1>
    <a class="btn" href="index.php">← Kembali</a>
    <?php if ($err): ?><div style="color:#b00020;"><?= h($err) ?></div><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
      <?php csrf_field(); ?>
      <div class="row">
        <label>Judul</label>
        <input class="form-control" type="text" name="title" required>
      </div>
      <div class="row">
        <label>Deskripsi</label>
        <textarea class="form-control" name="description" rows="4"></textarea>
      </div>
      <div class="row">
        <label>Gambar</label>
        <input class="form-control" type="file" name="image" accept=".jpg,.jpeg,.png,.gif,.webp">
      </div>
      <div class="row">
        <label>Kategori</label>
        <select class="form-control" name="category">
          <option value="school">School</option>
          <option value="events">Events</option>
          <option value="activities">Activities</option>
          <option value="achievements">Achievements</option>
        </select>
      </div>
      <div class="row">
        <label>Status</label>
        <select class="form-control" name="status">
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
      </div>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </form>
  </div>
</body>
</html>
