<?php

// === PATH GAMBAR BERITA: contek pola dashboard.php (relatif dari /admin → ../) ===
if (!function_exists('berita_src')) {
  function berita_src($p) {
    $p = trim((string)$p);
    if ($p === '') return '../assets/img/placeholder.png';
    if (preg_match('#^https?://#i', $p)) return $p; // sudah absolut
    $p = ltrim(str_replace('\\','/',$p), '/');
    if (strpos($p, 'uploads/berita/') === false) {
      $p = 'uploads/berita/' . basename($p);
    }
    return '../' . $p; // hasil: ../uploads/berita/xxx.jpg
  }
}


// ==== ROBUST IMAGE HELPER (fix thumbnail tidak muncul) ====
// Sesuaikan kalau subfolder proyek kamu bukan /company-profil-sd
if (!defined('APP_WEB_ROOT')) define('APP_WEB_ROOT', '/');
// Root filesystem proyek (folder yang berisi /admin dan /uploads)
if (!defined('APP_FS_ROOT'))  define('APP_FS_ROOT', realpath(__DIR__ . '/..'));

/**
 * Kembalikan [fs_path, web_url] untuk sebuah relative path seperti "uploads/berita/xxx.jpg".
 * - Cek di beberapa kemungkinan lokasi fisik:
 *   1) {root}/uploads/...
 *   2) {root}/admin/uploads/...            (kalau dulu tersimpan di bawah /admin)
 *   3) {root}/../uploads/...               (kalau strukturmu naik satu folder)
 */
function berita_resolve($rel) {
  $rel = ltrim(str_replace('\\','/', (string)$rel), '/');          // "uploads/berita/xxx.jpg"
  $candidates = [
    APP_FS_ROOT . '/' . $rel,                                      // {root}/uploads/...
    APP_FS_ROOT . '/admin/' . $rel,                                 // {root}/admin/uploads/...
    dirname(APP_FS_ROOT) . '/' . $rel,                              // {root}/../uploads/...
  ];
  foreach ($candidates as $fs) {
    if (is_file($fs)) {
      // FS -> URL absolut
      $web = APP_WEB_ROOT . '/' . $rel;                             // "/company-profil-sd/uploads/..."
      return [$fs, $web];
    }
  }
  // Kalau tidak ketemu file fisik, tetap kembalikan URL yang "masuk akal"
  return [null, APP_WEB_ROOT . '/' . $rel];
}

function berita_img_url($path) {
  if (empty($path)) return APP_WEB_ROOT . '/assets/img/placeholder.png';
  if (preg_match('#^https?://#i', $path)) return $path;             // sudah absolut
  [, $web] = berita_resolve($path);
  return $web;
}



// ====== AUTH & DEPENDENCIES ======
require_once __DIR__ . '/_auth.php';
require_once __DIR__ . '/_csrf.php';
require_once __DIR__ . '/../models/Gallery.php';
require_once __DIR__ . '/../models/Kegiatan.php';
require_once __DIR__ . '/../models/RenderArt.php';
require_once __DIR__ . '/../models/Berita.php';
// --- Ensure unique slug for Berita (auto -2, -3, ...) ---
if (!function_exists('ensure_unique_slug')) {
  function ensure_unique_slug(string $slug, Berita $model): string {
    $base = $slug;
    $i = 2;
    while ($model->findBySlug($slug)) {
      $slug = $base . '-' . $i;
      $i++;
    }
    return $slug;
  }
}


// ===== [KEGIATAN: HELPERS UPLOAD] =====
if (!class_exists('Database')) {
  require_once __DIR__ . '/../config/database.php';
}
if (!defined('KEGIATAN_HELPERS')) {
  define('KEGIATAN_HELPERS', 1);

  if (!function_exists('upload_kegiatan_main')) {
    function upload_kegiatan_main($file){
      if (empty($file['name'])) return '';
      if ($file['error'] !== UPLOAD_ERR_OK) throw new RuntimeException('Upload error: '.$file['error']);
      $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
      $allowed = ['jpg','jpeg','png','gif','webp'];
      if (!in_array($ext, $allowed)) throw new RuntimeException('Ekstensi tidak didukung.');
      if ($file['size'] > 5*1024*1024) throw new RuntimeException('Ukuran > 5MB.');
      $dir = __DIR__ . '/../uploads/kegiatan';
      if (!is_dir($dir)) mkdir($dir, 0775, true);
      $safe = preg_replace('/[^a-z0-9-]+/i','-', strtolower(pathinfo($file['name'], PATHINFO_FILENAME)));
      $name = $safe . '-' . uniqid() . '.' . $ext;
      if (!move_uploaded_file($file['tmp_name'], $dir . '/' . $name)) {
        throw new RuntimeException('Gagal menyimpan file.');
      }
      return 'uploads/kegiatan/' . $name;
    }
  }
  if (!function_exists('upload_kegiatan_many')) {
    function upload_kegiatan_many($files){
      $out = [];
      if (empty($files['name']) || !is_array($files['name'])) return $out;
      $N = count($files['name']);
      for ($i=0; $i<$N; $i++){
        if (empty($files['name'][$i])) continue;
        $f = [
          'name'     => $files['name'][$i],
          'type'     => $files['type'][$i],
          'tmp_name' => $files['tmp_name'][$i],
          'error'    => $files['error'][$i],
          'size'     => $files['size'][$i],
        ];
        try { $out[] = upload_kegiatan_main($f); } catch (\Throwable $e) {}
      }
      return $out;
    }
  }
  if (!function_exists('kegiatan_add_photos')) {
    function kegiatan_add_photos($kid, array $paths){
      if (!$paths) return;
      $db = (new Database())->getConnection();
      $stmt = $db->prepare("INSERT INTO kegiatan_foto (kegiatan_id, image_path) VALUES (:kid, :p)");
      foreach ($paths as $p) { $stmt->execute([':kid'=>$kid, ':p'=>$p]); }
    }
  }
  if (!function_exists('kegiatan_list_photos')) {
    function kegiatan_list_photos($kid){
      $db = (new Database())->getConnection();
      $q = $db->prepare("SELECT id, image_path FROM kegiatan_foto WHERE kegiatan_id=:id ORDER BY id DESC");
      $q->execute([':id'=>$kid]);
      return $q->fetchAll(PDO::FETCH_ASSOC);
    }
  }
  if (!function_exists('kegiatan_delete_photo')) {
    function kegiatan_delete_photo($pid){
      $db = (new Database())->getConnection();
      $q = $db->prepare("SELECT image_path FROM kegiatan_foto WHERE id=:id LIMIT 1");
      $q->execute([':id'=>$pid]);
      if ($row = $q->fetch(PDO::FETCH_ASSOC)) {
        $path = __DIR__ . '/../' . $row['image_path'];
        if (is_file($path)) @unlink($path);
      }
      $db->prepare("DELETE FROM kegiatan_foto WHERE id=:id")->execute([':id'=>$pid]);
    }
  }
}

// ===== [RENDER ART: HELPERS UPLOAD] =====
if (!function_exists('upload_render_art')) {
  function upload_render_art($file){
    if (empty($file['name'])) return '';
    if ($file['error'] !== UPLOAD_ERR_OK) throw new RuntimeException('Upload error: '.$file['error']);
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','gif','webp'];
    if (!in_array($ext, $allowed)) throw new RuntimeException('Ekstensi tidak didukung.');
    if ($file['size'] > 5*1024*1024) throw new RuntimeException('Ukuran > 5MB.');
    $dir = __DIR__ . '/../uploads/render';
    if (!is_dir($dir)) mkdir($dir, 0775, true);
    $safe = preg_replace('/[^a-z0-9-]+/i','-', strtolower(pathinfo($file['name'], PATHINFO_FILENAME)));
    $name = $safe . '-' . uniqid() . '.' . $ext;
    if (!move_uploaded_file($file['tmp_name'], $dir . '/' . $name)) {
      throw new RuntimeException('Gagal menyimpan file.');
    }
    return 'uploads/render/' . $name;
  }
}

// ===== [BERITA: HELPERS UPLOAD] =====
if (!function_exists('upload_berita_main')) {
  function upload_berita_main($file){
    if (empty($file['name'])) return '';
    if ($file['error'] !== UPLOAD_ERR_OK) throw new RuntimeException('Upload error: '.$file['error']);
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','gif','webp'];
    if (!in_array($ext, $allowed)) throw new RuntimeException('Ekstensi tidak didukung.');
    if ($file['size'] > 5*1024*1024) throw new RuntimeException('Ukuran > 5MB.');
    $dir = __DIR__ . '/../uploads/berita';
    if (!is_dir($dir)) mkdir($dir, 0775, true);
    $safe = preg_replace('/[^a-z0-9-]+/i','-', strtolower(pathinfo($file['name'], PATHINFO_FILENAME)));
    $name = $safe . '-' . uniqid() . '.' . $ext;
    if (!move_uploaded_file($file['tmp_name'], $dir . '/' . $name)) {
      throw new RuntimeException('Gagal menyimpan file.');
    }
    return 'uploads/berita/' . $name;
  }
}

if (!function_exists('upload_berita_many')) {
  function upload_berita_many($files){
    $out = [];
    if (empty($files['name']) || !is_array($files['name'])) return $out;
    $N = count($files['name']);
    for ($i=0; $i<$N; $i++){
      if (empty($files['name'][$i])) continue;
      $f = [
        'name'     => $files['name'][$i],
        'type'     => $files['type'][$i],
        'tmp_name' => $files['tmp_name'][$i],
        'error'    => $files['error'][$i],
        'size'     => $files['size'][$i],
      ];
      try { $out[] = upload_berita_main($f); } catch (\Throwable $e) {}
    }
    return $out;
  }
}

// ====== UTILS ======
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function back_to($params=[]) {
  $url = 'dashboard.php' . ($params ? '?'.http_build_query($params) : '');
  header("Location: {$url}");
  exit;
}
function normalize_category($cat){
  $cat = strtolower(trim((string)$cat));
  $map = [
    'tk' => 'tk', 't.k' => 'tk', 't-k' => 'tk', 'guru tk' => 'tk', 'kindergarten' => 'tk',
    'sd' => 'sd', 's.d' => 'sd', 's-d' => 'sd', 'guru sd' => 'sd', 'elementary' => 'sd',
    'smp' => 'smp', 's.m.p' => 'smp', 'guru smp' => 'smp', 'junior' => 'smp',
    'sma' => 'sma', 's.m.a' => 'sma', 'guru sma' => 'sma', 'senior' => 'sma',
  ];
  return $map[$cat] ?? (in_array($cat, ['tk','sd','smp','sma']) ? $cat : '');
}
function normalize_kategori_kegiatan($cat){
  $cat = strtolower(trim((string)$cat));
  $allowed = ['umum','berita','artikel','pengumuman'];
  return in_array($cat, $allowed, true) ? $cat : 'umum';
}
function normalize_render_category($cat){
  $cat = strtolower(trim((string)$cat));
  $allowed = ['eksterior','interior','3d_modeling'];
  return in_array($cat, $allowed, true) ? $cat : 'eksterior';
}
function normalize_kategori_berita($cat){
  $cat = strtolower(trim((string)$cat));
  $allowed = ['akademik','prestasi','kegiatan','pengumuman'];
  return in_array($cat, $allowed, true) ? $cat : 'akademik';
}
function slugify($text){
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('UTF-8','ASCII//TRANSLIT',$text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);
  return $text ?: ('post-'.uniqid());
}

// ====== UI STATE ======
$tab = $_GET['tab'] ?? 'overview';
$mode = $_GET['mode'] ?? '';
$edit_id = (int)($_GET['id'] ?? 0);

// Filter & pagination Gallery
$gq = trim($_GET['gq'] ?? '');
$gcat = $_GET['gcat'] ?? '';
$gstatus = $_GET['gstatus'] ?? '';
$gpage = max(1, (int)($_GET['gpage'] ?? 1));
$perPage = 12;

// Filter & pagination Kegiatan
$tabk = $_GET['tab'] ?? 'overview';
$kmode = $_GET['kmode'] ?? '';
$kedit_id = (int)($_GET['kid'] ?? 0);
$kq = trim($_GET['kq'] ?? '');
$kcat = $_GET['kcat'] ?? '';
$kstatus = $_GET['kstatus'] ?? '';
$kpage = max(1, (int)($_GET['kpage'] ?? 1));
$kPerPage = 10;

// Filter & pagination Render Art
$rq = trim($_GET['rq'] ?? '');
$rcat = $_GET['rcat'] ?? '';
$rstatus = $_GET['rstatus'] ?? '';
$rpage = max(1, (int)($_GET['rpage'] ?? 1));
$rPerPage = 12;

// Filter & pagination Berita
$btab = $_GET['tab'] ?? 'overview';
$bmode = $_GET['bmode'] ?? '';
$bedit_id = (int)($_GET['bid'] ?? 0);
$bq = trim($_GET['bq'] ?? '');
$bcat = $_GET['bcat'] ?? '';
$bstatus = $_GET['bstatus'] ?? '';
$bpage = max(1, (int)($_GET['bpage'] ?? 1));
$bPerPage = 10;

$gal = new Gallery();
$kegiatan = new Kegiatan();
$renderArt = new RenderArt();
$beritaModel = new Berita();
$err = '';
$kErr = '';
$rErr = '';
$bErr = '';

// ===== [KEGIATAN: HAPUS FOTO TAMBAHAN] =====
if (($tabk ?? '') === 'kegiatan' && ($kmode ?? '') === 'delphoto' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_verify();
  $pid = (int)($_POST['photo_id'] ?? 0);
  $kid = (int)($_POST['kid'] ?? 0);
  if ($pid) kegiatan_delete_photo($pid);
  $back = ['tab'=>'kegiatan','kmode'=>'edit','kid'=>$kid,'kq'=>$kq??'','kcat'=>$kcat??'','kstatus'=>$kstatus??'','kpage'=>$kpage??1];
  header('Location: ?' . http_build_query($back));
  exit;
}

// ===== [BERITA: HAPUS FOTO TAMBAHAN] =====
if (($btab ?? '') === 'berita' && ($bmode ?? '') === 'delphoto' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_verify();
  $pid = (int)($_POST['photo_id'] ?? 0);
  $bid = (int)($_POST['bid'] ?? 0);
  if ($pid) $beritaModel->deletePhoto($pid);
  $back = ['tab'=>'berita','bmode'=>'edit','bid'=>$bid,'bq'=>$bq??'','bcat'=>$bcat??'','bstatus'=>$bstatus??'','bpage'=>$bpage??1];
  header('Location: ?' . http_build_query($back));
  exit;
}

// ====== HANDLERS CRUD GALLERY ======
if ($tab==='gallery' && $mode==='create' && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $title = trim($_POST['title'] ?? '');
  $desc = trim($_POST['description'] ?? '');
  $cat = normalize_category($_POST['category'] ?? 'sd');
  if ($cat === '') { $err = 'Kategori tidak valid. Pilih TK/SD/SMP/SMA.'; }
  $stat = $_POST['status'] ?? 'active';
  $created_by = $_SESSION['admin_id'] ?? null;

  $image_path = '';
  if (!empty($_FILES['image']['name'])) {
    $f = $_FILES['image'];
    if ($f['error'] === UPLOAD_ERR_OK) {
      $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
      $allowed = ['jpg','jpeg','png','gif','webp'];
      if (!in_array($ext, $allowed)) $err = 'Ekstensi tidak didukung.';
      elseif ($f['size'] > 5*1024*1024) $err = 'Ukuran file > 5MB.';
      else {
        $destDir = __DIR__ . '/../uploads/gallery';
        if (!is_dir($destDir)) mkdir($destDir, 0775, true);
        $safe = preg_replace('/[^a-z0-9-]+/i','-', strtolower(pathinfo($f['name'], PATHINFO_FILENAME)));
        $filename = $safe . '-' . uniqid() . '.' . $ext;
        if (move_uploaded_file($f['tmp_name'], $destDir . '/' . $filename)) {
          $image_path = 'uploads/gallery/' . $filename;
        } else $err = 'Gagal menyimpan file upload.';
      }
    } else $err = 'Upload error: '.$f['error'];
  }

  if (!$err) {
    $ok = $gal->create(['title'=>$title,'description'=>$desc,'image_path'=>$image_path,'category'=>$cat,'status'=>$stat,'created_by'=>$created_by]);
    if ($ok) back_to(['tab'=>'gallery','flash'=>'created']);
    $err = 'Gagal menambah data.';
  }
}

if ($tab==='gallery' && $mode==='edit' && $edit_id && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $title = trim($_POST['title'] ?? '');
  $desc = trim($_POST['description'] ?? '');
  $cat = normalize_category($_POST['category'] ?? 'sd');
  if ($cat === '') { $err = 'Kategori tidak valid. Pilih TK/SD/SMP/SMA.'; }
  $stat = $_POST['status'] ?? 'active';
  $image_path = '';

  if (!empty($_FILES['image']['name'])) {
    $f = $_FILES['image'];
    if ($f['error'] === UPLOAD_ERR_OK) {
      $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
      $allowed = ['jpg','jpeg','png','gif','webp'];
      if (!in_array($ext, $allowed)) $err = 'Ekstensi tidak didukung.';
      elseif ($f['size'] > 5*1024*1024) $err = 'Ukuran file > 5MB.';
      else {
        $destDir = __DIR__ . '/../uploads/gallery';
        if (!is_dir($destDir)) mkdir($destDir, 0775, true);
        $safe = preg_replace('/[^a-z0-9-]+/i','-', strtolower(pathinfo($f['name'], PATHINFO_FILENAME)));
        $filename = $safe . '-' . uniqid() . '.' . $ext;
        if (move_uploaded_file($f['tmp_name'], $destDir . '/' . $filename)) {
          $image_path = 'uploads/gallery/' . $filename;
        } else $err = 'Gagal menyimpan file upload.';
      }
    } else $err = 'Upload error: '.$f['error'];
  }

  if (!$err) {
    $ok = $gal->update($edit_id, ['title'=>$title,'description'=>$desc,'category'=>$cat,'status'=>$stat,'image_path'=>$image_path]);
    if ($ok) back_to(['tab'=>'gallery','flash'=>'updated','gq'=>$gq,'gcat'=>$gcat,'gstatus'=>$gstatus,'gpage'=>$gpage]);
    $err = 'Gagal memperbarui data.';
  }
}

if ($tab==='gallery' && $mode==='delete' && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $id = (int)($_POST['id'] ?? 0);
  if ($id) $gal->delete($id);
  back_to(['tab'=>'gallery','flash'=>'deleted','gq'=>$gq,'gcat'=>$gcat,'gstatus'=>$gstatus,'gpage'=>$gpage]);
}

// ====== HANDLERS CRUD KEGIATAN ======
if ($tabk==='kegiatan' && $kmode==='create' && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $title = trim($_POST['title'] ?? '');
  $slug = slugify($_POST['slug'] ?? $title);
  $excerpt = trim($_POST['excerpt'] ?? '');
  $content = trim($_POST['content'] ?? '');
  $cat = normalize_kategori_kegiatan($_POST['category'] ?? 'umum');
  $stat = $_POST['status'] ?? 'active';
  $author_id = $_SESSION['admin_id'] ?? null;

  $image_path = '';
  try {
    $image_path = upload_kegiatan_main($_FILES['image'] ?? []);
  } catch (\Throwable $e) {
    $kErr = $e->getMessage();
  }

  if (!$kErr) {
    $ok = $kegiatan->create(['title'=>$title,'slug'=>$slug,'excerpt'=>$excerpt,'content'=>$content,'image_path'=>$image_path,'category'=>$cat,'status'=>$stat,'author_id'=>$author_id]);
    if ($ok) {
      $created = $kegiatan->findBySlug($slug);
      $kid = (int)($created['id'] ?? 0);
      if ($kid) {
        $more = upload_kegiatan_many($_FILES['images'] ?? []);
        kegiatan_add_photos($kid, $more);
      }
      header('Location: dashboard.php?tab=kegiatan&kflash=created');
      exit;
    }
    $kErr = 'Gagal menambah konten.';
  }
}

if ($tabk==='kegiatan' && $kmode==='edit' && $kedit_id && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $title = trim($_POST['title'] ?? '');
  $slug = slugify($_POST['slug'] ?? $title);
  $excerpt = trim($_POST['excerpt'] ?? '');
  $content = trim($_POST['content'] ?? '');
  $cat = normalize_kategori_kegiatan($_POST['category'] ?? 'umum');
  $stat = $_POST['status'] ?? 'active';
  $image_path = '';
  try {
    if (!empty($_FILES['image']['name'])) {
      $image_path = upload_kegiatan_main($_FILES['image']);
    }
  } catch (\Throwable $e) {
    $kErr = $e->getMessage();
  }

  if (!$kErr) {
    $ok = $kegiatan->update($kedit_id, ['title'=>$title,'slug'=>$slug,'excerpt'=>$excerpt,'content'=>$content,'category'=>$cat,'status'=>$stat,'image_path'=>$image_path]);
    if ($ok) {
      $more = upload_kegiatan_many($_FILES['images'] ?? []);
      if ($more) kegiatan_add_photos($kedit_id, $more);
      header('Location: dashboard.php?tab=kegiatan&kflash=updated&kq='.urlencode($kq).'&kcat='.urlencode($kcat).'&kstatus='.urlencode($kstatus).'&kpage='.$kpage);
      exit;
    }
    $kErr = 'Gagal memperbarui konten.';
  }
}

if ($tabk==='kegiatan' && $kmode==='delete' && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $id = (int)($_POST['id'] ?? 0);
  if ($id) $kegiatan->delete($id);
  header('Location: dashboard.php?tab=kegiatan&kflash=deleted&kq='.urlencode($kq).'&kcat='.urlencode($kcat).'&kstatus='.urlencode($kstatus).'&kpage='.$kpage);
  exit;
}

// ====== HANDLERS CRUD RENDER ART ======
if ($tab==='render' && $mode==='create' && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $title = trim($_POST['title'] ?? '');
  $desc = trim($_POST['description'] ?? '');
  $cat = normalize_render_category($_POST['category'] ?? 'eksterior');
  $stat = $_POST['status'] ?? 'active';
  $created_by = $_SESSION['admin_id'] ?? null;

  $image_path = '';
  try {
    $image_path = upload_render_art($_FILES['image'] ?? []);
  } catch (\Throwable $e) {
    $rErr = $e->getMessage();
  }

  if (!$rErr) {
    $ok = $renderArt->create(['title'=>$title,'description'=>$desc,'image_path'=>$image_path,'category'=>$cat,'status'=>$stat,'created_by'=>$created_by]);
    if ($ok) back_to(['tab'=>'render','flash'=>'created']);
    $rErr = 'Gagal menambah data render.';
  }
}

if ($tab==='render' && $mode==='edit' && $edit_id && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $title = trim($_POST['title'] ?? '');
  $desc = trim($_POST['description'] ?? '');
  $cat = normalize_render_category($_POST['category'] ?? 'eksterior');
  $stat = $_POST['status'] ?? 'active';
  $image_path = '';

  try {
    if (!empty($_FILES['image']['name'])) {
      $image_path = upload_render_art($_FILES['image']);
    }
  } catch (\Throwable $e) {
    $rErr = $e->getMessage();
  }

  if (!$rErr) {
    $ok = $renderArt->update($edit_id, ['title'=>$title,'description'=>$desc,'category'=>$cat,'status'=>$stat,'image_path'=>$image_path]);
    if ($ok) back_to(['tab'=>'render','flash'=>'updated','rq'=>$rq,'rcat'=>$rcat,'rstatus'=>$rstatus,'rpage'=>$rpage]);
    $rErr = 'Gagal memperbarui data render.';
  }
}

if ($tab==='render' && $mode==='delete' && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $id = (int)($_POST['id'] ?? 0);
  if ($id) $renderArt->delete($id);
  back_to(['tab'=>'render','flash'=>'deleted','rq'=>$rq,'rcat'=>$rcat,'rstatus'=>$rstatus,'rpage'=>$rpage]);
}

// ====== HANDLERS CRUD BERITA ======
if ($btab==='berita' && $bmode==='create' && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $title = trim($_POST['title'] ?? '');
  $slug = slugify($_POST['slug'] ?? $title);
  $slug = ensure_unique_slug($slug, $beritaModel);
  $excerpt = trim($_POST['excerpt'] ?? '');
  $content = trim($_POST['content'] ?? '');
  $cat = normalize_kategori_berita($_POST['category'] ?? 'akademik');
  $stat = $_POST['status'] ?? 'active';
  $author_id = $_SESSION['admin_id'] ?? null;

  $image_path = '';
  try {
    $image_path = upload_berita_main($_FILES['image'] ?? []);
  } catch (\Throwable $e) {
    $bErr = $e->getMessage();
  }

  if (!$bErr) {
    try {
    $ok = $beritaModel->create(['title'=>$title,'slug'=>$slug,'excerpt'=>$excerpt,'content'=>$content,'image_path'=>$image_path,'category'=>$cat,'status'=>$stat,'author_id'=>$author_id]);
  } catch (Throwable $e) {
    $bErr = 'DB error: ' . $e->getMessage();
    $ok = false;
  }
    if ($ok) {
      $created = $beritaModel->findBySlug($slug);
      $bid = (int)($created['id'] ?? 0);
      if ($bid) {
        $more = upload_berita_many($_FILES['images'] ?? []);
        foreach ($more as $img) {
          $beritaModel->addPhoto($bid, $img);
        }
      }
      header('Location: dashboard_berita.php?tab=berita&bflash=created');
      exit;
    }
    $bErr = 'Gagal menambah berita.';
  }
}

if ($btab==='berita' && $bmode==='edit' && $bedit_id && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $title = trim($_POST['title'] ?? '');
  $slug = slugify($_POST['slug'] ?? $title);
  $excerpt = trim($_POST['excerpt'] ?? '');
  $content = trim($_POST['content'] ?? '');
  $cat = normalize_kategori_berita($_POST['category'] ?? 'akademik');
  $stat = $_POST['status'] ?? 'active';
  $image_path = '';
  try {
    if (!empty($_FILES['image']['name'])) {
      $image_path = upload_berita_main($_FILES['image']);
    }
  } catch (\Throwable $e) {
    $bErr = $e->getMessage();
  }

  if (!$bErr) {
    $ok = $beritaModel->update($bedit_id, ['title'=>$title,'slug'=>$slug,'excerpt'=>$excerpt,'content'=>$content,'category'=>$cat,'status'=>$stat,'image_path'=>$image_path]);
    if ($ok) {
      $more = upload_berita_many($_FILES['images'] ?? []);
      if ($more) {
        foreach ($more as $img) {
          $beritaModel->addPhoto($bedit_id, $img);
        }
      }
      header('Location: dashboard.php?tab=berita&bflash=updated&bq='.urlencode($bq).'&bcat='.urlencode($bcat).'&bstatus='.urlencode($bstatus).'&bpage='.$bpage);
      exit;
    }
    $bErr = 'Gagal memperbarui berita.';
  }
}

if ($btab==='berita' && $bmode==='delete' && $_SERVER['REQUEST_METHOD']==='POST') {
  csrf_verify();
  $id = (int)($_POST['id'] ?? 0);
  if ($id) $beritaModel->delete($id);
  header('Location: dashboard.php?tab=berita&bflash=deleted&bq='.urlencode($bq).'&bcat='.urlencode($bcat).'&bstatus='.urlencode($bstatus).'&bpage='.$bpage);
  exit;
}

// ====== DATA UNTUK TAMPILAN ======
$filters = ['q'=>$gq?:null,'category'=>$gcat?:null,'status'=>$gstatus?:null];
$allItems = $gal->all($filters);
$total = count($allItems);
$pages = max(1, (int)ceil($total / $perPage));
$offset = ($gpage - 1) * $perPage;
$items = array_slice($allItems, $offset, $perPage);
$editingItem = null;
if ($tab==='gallery' && $mode==='edit' && $edit_id) {
  $editingItem = $gal->find($edit_id);
}

$kFilters = ['q'=>$kq?:null,'category'=>$kcat?:null,'status'=>$kstatus?:null];
$kAll = $kegiatan->all($kFilters);
$kTotal = count($kAll);
$kPages = max(1, (int)ceil($kTotal / $kPerPage));
$kOffset = ($kpage - 1) * $kPerPage;
$kItems = array_slice($kAll, $kOffset, $kPerPage);
$kEditing = null;
if ($tabk==='kegiatan' && $kmode==='edit' && $kedit_id) {
  $kEditing = $kegiatan->findById($kedit_id);
}

$rFilters = ['q'=>$rq?:null,'category'=>$rcat?:null,'status'=>$rstatus?:null];
$rAll = $renderArt->all($rFilters);
$rTotal = count($rAll);
$rPages = max(1, (int)ceil($rTotal / $rPerPage));
$rOffset = ($rpage - 1) * $rPerPage;
$rItems = array_slice($rAll, $rOffset, $rPerPage);
$rEditing = null;
if ($tab==='render' && $mode==='edit' && $edit_id) {
  $rEditing = $renderArt->find($edit_id);
}

$bFilters = ['q'=>$bq?:null,'category'=>$bcat?:null,'status'=>$bstatus?:null];
$bAll = $beritaModel->all($bFilters);
$bTotal = count($bAll);
$bPages = max(1, (int)ceil($bTotal / $bPerPage));
$bOffset = ($bpage - 1) * $bPerPage;
$bItems = array_slice($bAll, $bOffset, $bPerPage);
$bEditing = null;
if ($btab==='berita' && $bmode==='edit' && $bedit_id) {
  $bEditing = $beritaModel->findById($bedit_id);
}

$catLabels = ['tk'=>'Guru TK','sd'=>'Guru SD','smp'=>'Guru SMP','sma'=>'Guru SMA'];
$kCatLabels = ['umum'=>'Umum','berita'=>'Berita','artikel'=>'Artikel','pengumuman'=>'Pengumuman'];
$rCatLabels = ['eksterior'=>'Eksterior','interior'=>'Interior','3d_modeling'=>'3D Modeling'];
$bCatLabels = ['akademik'=>'Akademik','prestasi'=>'Prestasi','kegiatan'=>'Kegiatan','pengumuman'=>'Pengumuman'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard - Berita</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
  <div class="flex">
    <!-- ===== SIDEBAR ===== -->
    <aside class="w-64 bg-purple-800 text-purple-100 min-h-screen">
      <div class="px-6 py-5 text-lg font-bold">Admin Panel</div>
      <nav class="space-y-1">
        <a href="#" id="link-overview" class="flex items-center px-6 py-3 hover:bg-purple-700 hover:text-white <?= $tab==='overview'?'bg-purple-700 text-white':'' ?>">
          <i class="fas fa-home mr-3"></i> Overview
        </a>
        <a href="./dashboard.php?tab=gallery" id="link-gallery" class="flex items-center px-6 py-3 hover:bg-purple-700 hover:text-white <?= $tab==='gallery'?'bg-purple-700 text-white':'' ?>">
          <i class="fas fa-images mr-3"></i> Kelola Galeri
        </a>
        <a href="./dashboard.php?tab=kegiatan" id="link-kegiatan" class="flex items-center px-6 py-3 hover:bg-purple-700 hover:text-white <?= $tabk==='kegiatan'?'bg-purple-700 text-white':'' ?>">
          <i class="fas fa-newspaper mr-3"></i> Kelola Kegiatan
        </a>
        <a href="./dashboard.php?tab=render" id="link-render" class="flex items-center px-6 py-3 hover:bg-purple-700 hover:text-white <?= $tab==='render'?'bg-purple-700 text-white':'' ?>">
          <i class="fas fa-cube mr-3"></i> Event Sekolah
        </a>
        <a href="#" id="link-berita" class="flex items-center px-6 py-3 hover:bg-purple-700 hover:text-white <?= $btab==='berita'?'bg-purple-700 text-white':'' ?>">
          <i class="fas fa-rss mr-3"></i> Kelola Berita
        </a>
        <a href="logout.php" class="flex items-center px-6 py-3 hover:bg-purple-700 hover:text-white">
          <i class="fas fa-right-from-bracket mr-3"></i> Logout
        </a>
      </nav>
    </aside>

    <!-- ===== CONTENT ===== -->
    <main class="flex-1">
      <header class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-5">
          <h1 class="text-2xl font-extrabold text-gray-900">Dashboard</h1>
          <p class="text-gray-600">Kelola konten situs dari satu tempat.</p>
        </div>
      </header>

      <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- ================== OVERVIEW ================== -->
        <section id="tab-overview" class="<?= ($tab==='gallery' || $tab==='render' || $btab==='berita') ? 'hidden' : '' ?>">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
              <div class="text-sm text-gray-500">Total Gallery</div>
              <div class="mt-2 text-3xl font-bold text-gray-900"><?= (int)count($gal->all([])) ?></div>
              <div class="mt-4">
                <a href="#" id="shortcut-gallery" class="text-purple-700 hover:text-purple-900 text-sm font-medium">Kelola →</a>
              </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
              <div class="text-sm text-gray-500">Total Kegiatan</div>
              <div class="mt-2 text-3xl font-bold text-gray-900"><?= (int)count($kegiatan->all([])) ?></div>
              <div class="mt-4">
                <a href="#" id="shortcut-kegiatan" class="text-purple-700 hover:text-purple-900 text-sm font-medium">Kelola →</a>
              </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
              <div class="text-sm text-gray-500">Total Render Art</div>
              <div class="mt-2 text-3xl font-bold text-gray-900"><?= (int)count($renderArt->all([])) ?></div>
              <div class="mt-4">
                <a href="#" id="shortcut-render" class="text-purple-700 hover:text-purple-900 text-sm font-medium">Kelola →</a>
              </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
              <div class="text-sm text-gray-500">Total Berita</div>
              <div class="mt-2 text-3xl font-bold text-gray-900"><?= (int)count($beritaModel->all([])) ?></div>
              <div class="mt-4">
                <a href="#" id="shortcut-berita" class="text-purple-700 hover:text-purple-900 text-sm font-medium">Kelola →</a>
              </div>
            </div>
          </div>
        </section>

        <!-- ================== BERITA SECTION ================== -->
        <section id="tab-berita" class="<?= ($btab==='berita') ? '' : 'hidden' ?>">
          <?php if (!empty($_GET['bflash'])): ?>
            <div class="rounded-xl border border-green-200 bg-green-50 text-green-800 px-4 py-3 mb-4">
              <?= $_GET['bflash']==='created' ? '✅ Berita berhasil ditambahkan.' : ($_GET['bflash']==='updated' ? '✅ Berita berhasil diperbarui.' : '✅ Berita berhasil dihapus.'); ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($bErr)): ?>
            <div class="rounded-xl border border-red-200 bg-red-50 text-red-800 px-4 py-3 mb-4">❌ <?= h($bErr) ?></div>
          <?php endif; ?>

          <div class="flex flex-wrap items-center gap-3 mb-4">
            <a href="?tab=berita&bmode=create" class="inline-flex items-center px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 font-semibold shadow-lg">
              <i class="fas fa-plus mr-2"></i> Tambah Berita
            </a>

            <form method="get" class="flex flex-wrap items-center gap-2">
              <input type="hidden" name="tab" value="berita">
              <input type="text" name="bq" value="<?= h($bq) ?>" placeholder="Cari judul / isi..." class="px-3 py-2 rounded-lg border border-gray-300">
              <select name="bcat" class="px-3 py-2 rounded-lg border border-gray-300">
                <option value="">Semua Kategori</option>
                <?php foreach ($bCatLabels as $val=>$lab): ?>
                  <option value="<?= $val ?>" <?= $bcat===$val?'selected':'' ?>><?= $lab ?></option>
                <?php endforeach; ?>
              </select>
              <select name="bstatus" class="px-3 py-2 rounded-lg border border-gray-300">
                <option value="">Semua Status</option>
                <option value="active" <?= $bstatus==='active'?'selected':'' ?>>Active</option>
                <option value="inactive" <?= $bstatus==='inactive'?'selected':'' ?>>Inactive</option>
              </select>
              <button class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                <i class="fas fa-search mr-1"></i> Terapkan
              </button>
              <a href="dashboard_berita.php?tab=berita" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                <i class="fas fa-redo mr-1"></i> Reset
              </a>
            </form>
          </div>

          <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">Gambar</th>
                    <th class="px-6 py-3">Judul</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Views</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Dibuat</th>
                    <th class="px-6 py-3"></th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                  <?php if (!$bItems): ?>
                    <tr><td colspan="7" class="px-6 py-6 text-center text-gray-500">Belum ada berita.</td></tr>
                  <?php else: foreach ($bItems as $p): ?>
                    <tr class="hover:bg-gray-50">
                      <td class="px-6 py-3">
                        <?php if (!empty($p['image_path'])): ?>
                          <img src="<?= h(berita_src($p['image_path'] ?? '')) ?>" class="h-12 w-12 object-cover rounded-lg border border-gray-200" alt="" onerror="this.onerror=null;this.src=\'../assets/img/placeholder.png\';">
                        <?php else: ?>
                          <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 border border-gray-200"></div>
                        <?php endif; ?>
                      </td>
                      <td class="px-6 py-3">
                        <div class="text-sm font-medium text-gray-900"><?= h($p['title']) ?></div>
                        <?php if (!empty($p['excerpt'])): ?>
                          <div class="text-xs text-gray-500 line-clamp-1"><?= h($p['excerpt']) ?></div>
                        <?php endif; ?>
                      </td>
                      <td class="px-6 py-3 text-sm text-gray-700">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border">
                          <?php
                            $catIcons = ['akademik'=>'📚','prestasi'=>'🏆','kegiatan'=>'🎉','pengumuman'=>'📢'];
                            echo ($catIcons[$p['category']] ?? '📰') . ' ';
                          ?>
                          <?= h($bCatLabels[strtolower($p['category'] ?? '')] ?? 'Berita') ?>
                        </span>
                      </td>
                      <td class="px-6 py-3 text-sm text-gray-700">
                        <span class="inline-flex items-center">
                          <i class="far fa-eye mr-1"></i> <?= number_format($p['views']) ?>
                        </span>
                      </td>
                      <td class="px-6 py-3">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border <?= $p['status']==='active'?'bg-green-50 text-green-700 border-green-200':'bg-gray-50 text-gray-700 border-gray-200' ?>">
                          <?= h(ucfirst($p['status'])) ?>
                        </span>
                      </td>
                      <td class="px-6 py-3 text-sm text-gray-500">
                        <?= !empty($p['created_at']) ? h(date('d M Y', strtotime($p['created_at']))) : '-' ?>
                      </td>
                      <td class="px-6 py-3 text-right">
                        <a href="?tab=berita&bmode=edit&bid=<?= (int)$p['id'] ?>&bq=<?= urlencode($bq) ?>&bcat=<?= urlencode($bcat) ?>&bstatus=<?= urlencode($bstatus) ?>&bpage=<?= (int)$bpage ?>"
                          class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg border border-blue-300 text-blue-700 hover:bg-blue-50">
                          <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <form action="?tab=berita&bmode=delete" method="post" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                          <?php csrf_field(); ?>
                          <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                          <button class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg border border-red-300 text-red-700 hover:bg-red-50">
                            <i class="fas fa-trash mr-1"></i> Hapus
                          </button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; endif; ?>
                </tbody>
              </table>
            </div>

            <div class="px-6 py-4 flex items-center justify-between border-t border-gray-100">
              <div class="text-sm text-gray-500">
                Menampilkan <span class="font-medium"><?= $bTotal ? ($bOffset+1) : 0 ?></span>–
                <span class="font-medium"><?= min($bOffset + $bPerPage, $bTotal) ?></span> dari
                <span class="font-medium"><?= $bTotal ?></span>
              </div>
              <div class="flex items-center gap-2">
                <?php
                  $bBase = ['tab'=>'berita','bq'=>$bq,'bcat'=>$bcat,'bstatus'=>$bstatus];
                  $bPrev = $bpage>1 ? '?'.http_build_query($bBase+['bpage'=>$bpage-1]) : '';
                  $bNext = $bpage<$bPages ? '?'.http_build_query($bBase+['bpage'=>$bpage+1]) : '';
                ?>
                <a href="<?= $bPrev?:'javascript:void(0)' ?>" class="px-3 py-1.5 rounded-lg border <?= $bPrev?'border-gray-300 hover:bg-gray-50 text-gray-700':'border-gray-200 text-gray-300 cursor-not-allowed' ?>">Prev</a>
                <span class="text-sm text-gray-500">Hal <?= (int)$bpage ?> / <?= (int)$bPages ?></span>
                <a href="<?= $bNext?:'javascript:void(0)' ?>" class="px-3 py-1.5 rounded-lg border <?= $bNext?'border-gray-300 hover:bg-gray-50 text-gray-700':'border-gray-200 text-gray-300 cursor-not-allowed' ?>">Next</a>
              </div>
            </div>
          </div>

          <?php if ($bmode==='create' || ($bmode==='edit' && $bEditing)): ?>
            <div class="mt-6 bg-white border border-gray-200 rounded-2xl p-6">
              <h3 class="text-lg font-semibold mb-3">
                <i class="fas fa-newspaper mr-2"></i>
                <?= $bmode==='create'?'Tambah Berita':'Edit Berita' ?>
              </h3>
              <?php $bBack = '?'.http_build_query(['tab'=>'berita','bq'=>$bq,'bcat'=>$bcat,'bstatus'=>$bstatus,'bpage'=>$bpage]); ?>
              <form method="post" enctype="multipart/form-data">
                <?php csrf_field(); ?>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                  <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Judul Berita *</label>
                    <input type="text" name="title" required value="<?= $bmode==='edit' ? h($bEditing['title']) : '' ?>" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Slug (URL)</label>
                    <input type="text" name="slug" value="<?= $bmode==='edit' ? h($bEditing['slug']) : '' ?>" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="otomatis dari judul bila kosong">
                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong untuk generate otomatis dari judul</p>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori *</label>
                    <select name="category" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                      <?php foreach ($bCatLabels as $val=>$lab): ?>
                        <option value="<?= $val ?>" <?= ($bmode==='edit' && strtolower($bEditing['category'])===$val)?'selected':'' ?>>
                          <?php
                            $catIcons = ['akademik'=>'📚','prestasi'=>'🏆','kegiatan'=>'🎉','pengumuman'=>'📢'];
                            echo ($catIcons[$val] ?? '📰') . ' ' . $lab;
                          ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Status *</label>
                    <select name="status" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                      <option value="active" <?= ($bmode==='edit' && $bEditing['status']==='active')?'selected':'' ?>>✅ Active (Tampil di website)</option>
                      <option value="inactive" <?= ($bmode==='edit' && $bEditing['status']==='inactive')?'selected':'' ?>>⏸️ Inactive (Draft)</option>
                    </select>
                  </div>
                  <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Ringkasan (Excerpt)</label>
                    <textarea name="excerpt" rows="3" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ringkasan singkat berita yang akan ditampilkan di daftar berita..."><?= $bmode==='edit' ? h($bEditing['excerpt']) : '' ?></textarea>
                    <p class="text-xs text-gray-500 mt-1">Ringkasan singkat untuk ditampilkan di card berita (maks 200 karakter)</p>
                  </div>
                  <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Konten Berita *</label>
                    <textarea name="content" rows="10" required class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono text-sm" placeholder="Tulis konten berita lengkap di sini..."><?= $bmode==='edit' ? h($bEditing['content']) : '' ?></textarea>
                    <p class="text-xs text-gray-500 mt-1">Konten lengkap berita. Gunakan Enter untuk paragraf baru.</p>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">
                      <i class="fas fa-image mr-1"></i> Gambar Utama
                      <span class="text-xs text-gray-400">(ditampilkan sebagai thumbnail)</span>
                    </label>
                    <?php if ($bmode==='edit' && !empty($bEditing['image_path'])): ?>
                      <div class="flex items-center gap-3 mt-1 mb-2">
                        <img src="/company-profil-sd/<?= h($bEditing['image_path']) ?>" class="h-20 w-32 object-cover rounded-lg border border-gray-200" alt="" onerror="this.onerror=null;this.src=\'../assets/img/placeholder.png\';">
                        <span class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti</span>
                      </div>
                    <?php endif; ?>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif,.webp" class="mt-1 block w-full text-sm text-gray-500
                      file:mr-4 file:py-2 file:px-4
                      file:rounded-full file:border-0
                      file:text-sm file:font-semibold
                      file:bg-blue-50 file:text-blue-700
                      hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF, WebP. Maks 5MB. Rekomendasi ukuran: 1200x800px</p>
                  </div>
                  <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">
                      <i class="fas fa-images mr-1"></i> Foto Tambahan (Galeri)
                    </label>
                    <input type="file" name="images[]" accept=".jpg,.jpeg,.png,.gif,.webp" multiple class="mt-1 block w-full text-sm text-gray-500
                      file:mr-4 file:py-2 file:px-4
                      file:rounded-full file:border-0
                      file:text-sm file:font-semibold
                      file:bg-green-50 file:text-green-700
                      hover:file:bg-green-100">
                    <p class="text-xs text-gray-500 mt-1">Tahan Ctrl/Command untuk pilih banyak file. Maks 5MB per file. Foto akan ditampilkan di galeri berita.</p>

                    <?php if ($bmode==='edit' && $bEditing): ?>
                      <?php $existing = $beritaModel->getPhotos((int)$bEditing['id']); ?>
                      <?php if ($existing): ?>
                        <div class="mt-4">
                          <h4 class="text-sm font-semibold text-gray-700 mb-2">Foto yang sudah ada:</h4>
                          <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                            <?php foreach ($existing as $ph): ?>
                              <div class="group relative border rounded-lg overflow-hidden hover:border-blue-500 transition-all">
                                <img src="/company-profil-sd/<?= h($ph['image_path']) ?>" class="h-24 w-full object-cover" alt="" onerror="this.onerror=null;this.src=\'../assets/img/placeholder.png\';">
                                <form action="?tab=berita&bmode=delphoto" method="post"
                                      class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center"
                                      onsubmit="return confirm('Hapus foto ini?')">
                                  <?php csrf_field(); ?>
                                  <input type="hidden" name="photo_id" value="<?= (int)$ph['id'] ?>">
                                  <input type="hidden" name="bid" value="<?= (int)$bEditing['id'] ?>">
                                  <button class="px-3 py-1.5 text-xs rounded bg-red-600 text-white hover:bg-red-700 font-semibold">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                  </button>
                                </form>
                              </div>
                            <?php endforeach; ?>
                          </div>
                        </div>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-3">
                  <a href="<?= h($bBack) ?>" class="inline-flex items-center px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition-all">
                    <i class="fas fa-times mr-2"></i> Batal
                  </a>
                  <button class="inline-flex items-center px-6 py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition-all shadow-lg">
                    <i class="fas fa-save mr-2"></i> <?= $bmode==='create'?'Simpan Berita':'Update Berita' ?>
                  </button>
                </div>
              </form>
            </div>
          <?php endif; ?>
        </section>

      </div>
    </main>
  </div>

  <script>
  (function() {
    function switchTab(tab){
      var over = document.getElementById('tab-overview');
      var berita = document.getElementById('tab-berita');
      if (!over || !berita) return;

      over.classList.add('hidden');
      berita.classList.add('hidden');

      if (tab === 'berita') berita.classList.remove('hidden');
      else over.classList.remove('hidden');
    }

    function setQuery(key, val){
      var url = new URL(window.location.href);
      if (val==null) url.searchParams.delete(key);
      else url.searchParams.set(key, val);
      history.pushState({}, '', url.toString());
    }

    function clearBeritaQuery(){
      var url = new URL(window.location.href);
      ['bmode','bid','bq','bcat','bstatus','bpage'].forEach(k=>url.searchParams.delete(k));
      url.searchParams.set('tab','berita');
      history.replaceState({}, '', url.toString());
    }

    var linkOverview = document.getElementById('link-overview');
    var linkBerita = document.getElementById('link-berita');
    var shortcutBerita = document.getElementById('shortcut-berita');

    if (linkBerita) linkBerita.addEventListener('click', function(e){
      e.preventDefault(); switchTab('berita'); clearBeritaQuery();
    });
    if (shortcutBerita) shortcutBerita.addEventListener('click', function(e){
      e.preventDefault(); switchTab('berita'); clearBeritaQuery();
    });
    if (linkOverview) linkOverview.addEventListener('click', function(e){
      e.preventDefault(); switchTab('overview'); setQuery('tab','overview');
    });

    var tab = new URLSearchParams(location.search).get('tab') || 'overview';
    switchTab(tab);

    window.addEventListener('popstate', function(){
      var t = new URLSearchParams(location.search).get('tab') || 'overview';
      switchTab(t);
    });
  })();
  </script>

</body>
</html>