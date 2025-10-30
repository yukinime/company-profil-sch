<?php
// ====== AUTH & DEPENDENCIES ======
// Untuk Memunculkan GAMBAR DI Localhost KITA Harus setup dulu pathnya CONTOH <img src="/<?= h($it['image_path']) isi ('/') dengan nama folder project rootnya
require_once __DIR__ . '/_auth.php';
require_once __DIR__ . '/_csrf.php';
require_once __DIR__ . '/../models/Gallery.php';
require_once __DIR__ . '/../models/Kegiatan.php';
require_once __DIR__ . '/../models/RenderArt.php';

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

$gal = new Gallery();
$kegiatan = new Kegiatan();
$renderArt = new RenderArt();
$err = '';
$kErr = '';
$rErr = '';

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

$catLabels = ['tk'=>'Guru TK','sd'=>'Guru SD','smp'=>'Guru SMP','sma'=>'Guru SMA'];
$kCatLabels = ['umum'=>'Umum','berita'=>'Berita','artikel'=>'Artikel','pengumuman'=>'Pengumuman'];
$rCatLabels = ['eksterior'=>'Eksterior','interior'=>'Interior','3d_modeling'=>'3D Modeling'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard</title>
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
        <a href="#" id="link-gallery" class="flex items-center px-6 py-3 hover:bg-purple-700 hover:text-white <?= $tab==='gallery'?'bg-purple-700 text-white':'' ?>">
          <i class="fas fa-images mr-3"></i> Kelola Galeri
        </a>
        <a href="#" id="link-kegiatan" class="flex items-center px-6 py-3 hover:bg-purple-700 hover:text-white <?= $tabk==='kegiatan'?'bg-purple-700 text-white':'' ?>">
          <i class="fas fa-newspaper mr-3"></i> Kelola Kegiatan
        </a>
        <a href="#" id="link-render" class="flex items-center px-6 py-3 hover:bg-purple-700 hover:text-white <?= $tab==='render'?'bg-purple-700 text-white':'' ?>">
          <i class="fas fa-cube mr-3"></i> Event Sekolah
        </a>      
      <a href="dashboard_berita.php?tab=berita" class="flex items-center px-6 py-3 hover:bg-purple-700 hover:text-white"><i class="fas fa-rss mr-3"></i> Kelola Berita</a>
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
        <section id="tab-overview" class="<?= ($tab==='gallery' || $tab==='render') ? 'hidden' : '' ?>">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
              <div class="text-sm text-gray-500">Total Gallery</div>
              <div class="mt-2 text-3xl font-bold text-gray-900"><?= (int)count($gal->all([])) ?></div>
              <div class="mt-4">
                <a href="#" id="shortcut-gallery" class="text-purple-700 hover:text-purple-900 text-sm font-medium">Kelola →</a>
              </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
              <div class="text-sm text-gray-500">Total Render Art</div>
              <div class="mt-2 text-3xl font-bold text-gray-900"><?= (int)count($renderArt->all([])) ?></div>
              <div class="mt-4">
                <a href="#" id="shortcut-render" class="text-purple-700 hover:text-purple-900 text-sm font-medium">Kelola →</a>
              </div>
            </div>
          </div>
        </section>

        <!-- ================== GALLERY ================== -->
        <section id="tab-gallery" class="<?= $tab==='gallery' ? '' : 'hidden' ?>">
          <?php if (!empty($_GET['flash'])): ?>
            <div class="rounded-xl border border-green-200 bg-green-50 text-green-800 px-4 py-3 mb-4">
              <?php if ($_GET['flash']==='created') echo 'Berhasil menambah data.'; ?>
              <?php if ($_GET['flash']==='updated') echo 'Berhasil memperbarui data.'; ?>
              <?php if ($_GET['flash']==='deleted') echo 'Berhasil menghapus data.'; ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($err)): ?>
            <div class="rounded-xl border border-red-200 bg-red-50 text-red-800 px-4 py-3 mb-4"><?= h($err) ?></div>
          <?php endif; ?>

          <div class="flex flex-wrap items-center gap-3 mb-4">
            <a href="?tab=gallery&mode=create" class="inline-flex items-center px-4 py-2 rounded-xl bg-green-600 text-white hover:bg-green-700">+ Tambah</a>

            <form method="get" class="flex flex-wrap items-center gap-2">
              <input type="hidden" name="tab" value="gallery">
              <input type="text" name="gq" value="<?= h($gq) ?>" placeholder="Cari nama / deskripsi..." class="px-3 py-2 rounded-lg border border-gray-300">
              <select name="gcat" class="px-3 py-2 rounded-lg border border-gray-300">
                <option value="">Semua Kategori</option>
                <option value="tk" <?= $gcat==='tk'?'selected':'' ?>>Guru TK</option>
                <option value="sd" <?= $gcat==='sd'?'selected':'' ?>>Guru SD</option>
                <option value="smp" <?= $gcat==='smp'?'selected':'' ?>>Guru SMP</option>
                <option value="sma" <?= $gcat==='sma'?'selected':'' ?>>Guru SMA</option>
              </select>
              <select name="gstatus" class="px-3 py-2 rounded-lg border border-gray-300">
                <option value="">Semua Status</option>
                <option value="active" <?= $gstatus==='active'?'selected':'' ?>>Active</option>
                <option value="inactive" <?= $gstatus==='inactive'?'selected':'' ?>>Inactive</option>
              </select>
              <button class="px-4 py-2 rounded-lg border border-gray-300">Terapkan</button>
              <a href="?tab=gallery" class="px-4 py-2 rounded-lg border border-gray-300">Reset</a>
            </form>
          </div>

          <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">Foto</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Dibuat</th>
                    <th class="px-6 py-3"></th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                  <?php if (!$items): ?>
                    <tr><td colspan="6" class="px-6 py-6 text-center text-gray-500">Tidak ada data.</td></tr>
                  <?php else: foreach ($items as $it): ?>
                    <tr class="hover:bg-gray-50">
                      <td class="px-6 py-3">
                        <?php if (!empty($it['image_path'])): ?>
                          <img src="/<?= h($it['image_path']) ?>" class="h-12 w-12 object-cover rounded-lg border border-gray-200" alt="">
                        <?php else: ?>
                          <div class="h-12 w-12 rounded-lg bg-gray-100 border border-gray-200"></div>
                        <?php endif; ?>
                      </td>
                      <td class="px-6 py-3">
                        <div class="text-sm font-medium text-gray-900"><?= h($it['title']) ?></div>
                        <?php if (!empty($it['description'])): ?>
                          <div class="text-xs text-gray-500"><?= nl2br(h($it['description'])) ?></div>
                        <?php endif; ?>
                      </td>
                      <td class="px-6 py-3 text-sm text-gray-700">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border">
                          <?= h($catLabels[$it['category']] ?? ucfirst($it['category'])) ?>
                        </span>
                      </td>
                      <td class="px-6 py-3">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border">
                          <?= h(ucfirst($it['status'])) ?>
                        </span>
                      </td>
                      <td class="px-6 py-3 text-sm text-gray-500"><?= !empty($it['created_at']) ? h(date('d M Y', strtotime($it['created_at']))) : '-' ?></td>
                      <td class="px-6 py-3 text-right">
                        <a href="?tab=gallery&mode=edit&id=<?= (int)$it['id'] ?>&gq=<?= urlencode($gq) ?>&gcat=<?= urlencode($gcat) ?>&gstatus=<?= urlencode($gstatus) ?>&gpage=<?= (int)$gpage ?>"
                           class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg border border-gray-300 hover:bg-gray-50">Edit</a>
                        <form action="?tab=gallery&mode=delete" method="post" class="inline" onsubmit="return confirm('Hapus item ini?')">
                          <?php csrf_field(); ?>
                          <input type="hidden" name="id" value="<?= (int)$it['id'] ?>">
                          <button class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg border border-red-300 text-red-700 hover:bg-red-50">Hapus</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; endif; ?>
                </tbody>
              </table>
            </div>

            <div class="px-6 py-4 flex items-center justify-between border-t border-gray-100">
              <div class="text-sm text-gray-500">
                Menampilkan <span class="font-medium"><?= $total ? ($offset+1) : 0 ?></span>–
                <span class="font-medium"><?= min($offset + $perPage, $total) ?></span> dari
                <span class="font-medium"><?= $total ?></span>
              </div>
              <div class="flex items-center gap-2">
                <?php
                  $base = ['tab'=>'gallery','gq'=>$gq,'gcat'=>$gcat,'gstatus'=>$gstatus];
                  $prev = $gpage>1 ? '?'.http_build_query($base+['gpage'=>$gpage-1]) : '';
                  $next = $gpage<$pages ? '?'.http_build_query($base+['gpage'=>$gpage+1]) : '';
                ?>
                <a href="<?= $prev?:'javascript:void(0)' ?>" class="px-3 py-1.5 rounded-lg border <?= $prev?'border-gray-300 hover:bg-gray-50 text-gray-700':'border-gray-200 text-gray-300 cursor-not-allowed' ?>">Prev</a>
                <span class="text-sm text-gray-500">Hal <?= (int)$gpage ?> / <?= (int)$pages ?></span>
                <a href="<?= $next?:'javascript:void(0)' ?>" class="px-3 py-1.5 rounded-lg border <?= $next?'border-gray-300 hover:bg-gray-50 text-gray-700':'border-gray-200 text-gray-300 cursor-not-allowed' ?>">Next</a>
              </div>
            </div>
          </div>

          <?php if ($mode==='create' || ($mode==='edit' && $editingItem)): ?>
            <div class="mt-6 bg-white border border-gray-200 rounded-2xl p-6">
              <h3 class="text-lg font-semibold mb-3"><?= $mode==='create'?'Tambah Guru':'Edit Guru' ?></h3>
              <?php $backUrl = '?'.http_build_query(['tab'=>'gallery','gq'=>$gq,'gcat'=>$gcat,'gstatus'=>$gstatus,'gpage'=>$gpage]); ?>
              <form method="post" enctype="multipart/form-data">
                <?php csrf_field(); ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="title" required
                           value="<?= $mode==='edit' ? h($editingItem['title']) : '' ?>"
                           class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                      <?php foreach (['tk'=>'Guru TK','sd'=>'Guru SD','smp'=>'Guru SMP','sma'=>'Guru SMA'] as $val=>$lab): ?>
                        <option value="<?= $val ?>" <?= ($mode==='edit' && $editingItem['category']===$val)?'selected':'' ?>><?= $lab ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Deskripsi / Mapel / Jabatan</label>
                    <textarea name="description" rows="4" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300"><?= $mode==='edit' ? h($editingItem['description']) : '' ?></textarea>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                      <option value="active" <?= ($mode==='edit' && $editingItem['status']==='active')?'selected':'' ?>>Active</option>
                      <option value="inactive" <?= ($mode==='edit' && $editingItem['status']==='inactive')?'selected':'' ?>>Inactive</option>
                    </select>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Foto (opsional)</label>
                    <?php if ($mode==='edit' && !empty($editingItem['image_path'])): ?>
                      <div class="flex items-center gap-3 mt-1">
                        <img src="/<?= h($editingItem['image_path']) ?>" class="h-12 w-12 object-cover rounded-lg border border-gray-200" alt="">
                        <span class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti</span>
                      </div>
                    <?php endif; ?>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif,.webp" class="mt-2">
                  </div>
                </div>

                <div class="mt-4 flex items-center justify-end gap-3">
                  <a href="<?= h($backUrl) ?>" class="px-4 py-2 rounded-lg border border-gray-300">Batal</a>
                  <button class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700"><?= $mode==='create'?'Simpan':'Update' ?></button>
                </div>
              </form>
            </div>
          <?php endif; ?>
        </section>

        <!-- ================== KEGIATAN ================== -->
        <section id="tab-kegiatan" class="<?= ($tabk==='kegiatan') ? '' : 'hidden' ?>">
          <?php if (!empty($_GET['kflash'])): ?>
            <div class="rounded-xl border border-green-200 bg-green-50 text-green-800 px-4 py-3 mb-4">
              <?= $_GET['kflash']==='created' ? 'Konten berhasil ditambahkan.' : ($_GET['kflash']==='updated' ? 'Konten berhasil diperbarui.' : 'Konten berhasil dihapus.'); ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($kErr)): ?>
            <div class="rounded-xl border border-red-200 bg-red-50 text-red-800 px-4 py-3 mb-4"><?= h($kErr) ?></div>
          <?php endif; ?>

          <div class="flex flex-wrap items-center gap-3 mb-4">
            <a href="?tab=kegiatan&kmode=create" class="inline-flex items-center px-4 py-2 rounded-xl bg-purple-600 text-white hover:bg-purple-700">+ Tambah</a>

            <form method="get" class="flex flex-wrap items-center gap-2">
              <input type="hidden" name="tab" value="kegiatan">
              <input type="text" name="kq" value="<?= h($kq) ?>" placeholder="Cari judul / isi..." class="px-3 py-2 rounded-lg border border-gray-300">
              <select name="kcat" class="px-3 py-2 rounded-lg border border-gray-300">
                <option value="">Semua Kategori</option>
                <?php foreach ($kCatLabels as $val=>$lab): ?>
                  <option value="<?= $val ?>" <?= $kcat===$val?'selected':'' ?>><?= $lab ?></option>
                <?php endforeach; ?>
              </select>
              <select name="kstatus" class="px-3 py-2 rounded-lg border border-gray-300">
                <option value="">Semua Status</option>
                <option value="active" <?= $kstatus==='active'?'selected':'' ?>>Active</option>
                <option value="inactive" <?= $kstatus==='inactive'?'selected':'' ?>>Inactive</option>
              </select>
              <button class="px-4 py-2 rounded-lg border border-gray-300">Terapkan</button>
              <a href="?tab=kegiatan" class="px-4 py-2 rounded-lg border border-gray-300">Reset</a>
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
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Dibuat</th>
                    <th class="px-6 py-3"></th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                  <?php if (!$kItems): ?>
                    <tr><td colspan="6" class="px-6 py-6 text-center text-gray-500">Belum ada konten.</td></tr>
                  <?php else: foreach ($kItems as $p): ?>
                    <tr class="hover:bg-gray-50">
                      <td class="px-6 py-3">
                        <?php if (!empty($p['image_path'])): ?>
                          <img src="/<?= h($p['image_path']) ?>" class="h-12 w-12 object-cover rounded-lg border border-gray-200" alt="">
                        <?php else: ?>
                          <div class="h-12 w-12 rounded-lg bg-gray-100 border border-gray-200"></div>
                        <?php endif; ?>
                      </td>
                      <td class="px-6 py-3">
                        <div class="text-sm font-medium text-gray-900"><?= h($p['title']) ?></div>
                        <?php if (!empty($p['excerpt'])): ?>
                          <div class="text-xs text-gray-500 line-clamp-2"><?= h($p['excerpt']) ?></div>
                        <?php endif; ?>
                      </td>
                      <td class="px-6 py-3 text-sm text-gray-700">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border">
                          <?= h($kCatLabels[strtolower($p['category'] ?? '')] ?? 'Umum') ?>
                        </span>
                      </td>
                      <td class="px-6 py-3">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border"><?= h(ucfirst($p['status'])) ?></span>
                      </td>
                      <td class="px-6 py-3 text-sm text-gray-500"><?= !empty($p['created_at']) ? h(date('d M Y', strtotime($p['created_at']))) : '-' ?></td>
                      <td class="px-6 py-3 text-right">
                        <a href="?tab=kegiatan&kmode=edit&kid=<?= (int)$p['id'] ?>&kq=<?= urlencode($kq) ?>&kcat=<?= urlencode($kcat) ?>&kstatus=<?= urlencode($kstatus) ?>&kpage=<?= (int)$kpage ?>"
                          class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg border border-gray-300 hover:bg-gray-50">Edit</a>
                        <form action="?tab=kegiatan&kmode=delete" method="post" class="inline" onsubmit="return confirm('Hapus konten ini?')">
                          <?php csrf_field(); ?>
                          <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                          <button class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg border border-red-300 text-red-700 hover:bg-red-50">Hapus</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; endif; ?>
                </tbody>
              </table>
            </div>

            <div class="px-6 py-4 flex items-center justify-between border-t border-gray-100">
              <div class="text-sm text-gray-500">
                Menampilkan <span class="font-medium"><?= $kTotal ? ($kOffset+1) : 0 ?></span>–
                <span class="font-medium"><?= min($kOffset + $kPerPage, $kTotal) ?></span> dari
                <span class="font-medium"><?= $kTotal ?></span>
              </div>
              <div class="flex items-center gap-2">
                <?php
                  $kBase = ['tab'=>'kegiatan','kq'=>$kq,'kcat'=>$kcat,'kstatus'=>$kstatus];
                  $kPrev = $kpage>1 ? '?'.http_build_query($kBase+['kpage'=>$kpage-1]) : '';
                  $kNext = $kpage<$kPages ? '?'.http_build_query($kBase+['kpage'=>$kpage+1]) : '';
                ?>
                <a href="<?= $kPrev?:'javascript:void(0)' ?>" class="px-3 py-1.5 rounded-lg border <?= $kPrev?'border-gray-300 hover:bg-gray-50 text-gray-700':'border-gray-200 text-gray-300 cursor-not-allowed' ?>">Prev</a>
                <span class="text-sm text-gray-500">Hal <?= (int)$kpage ?> / <?= (int)$kPages ?></span>
                <a href="<?= $kNext?:'javascript:void(0)' ?>" class="px-3 py-1.5 rounded-lg border <?= $kNext?'border-gray-300 hover:bg-gray-50 text-gray-700':'border-gray-200 text-gray-300 cursor-not-allowed' ?>">Next</a>
              </div>
            </div>
          </div>

          <?php if ($kmode==='create' || ($kmode==='edit' && $kEditing)): ?>
            <div class="mt-6 bg-white border border-gray-200 rounded-2xl p-6">
              <h3 class="text-lg font-semibold mb-3"><?= $kmode==='create'?'Tambah Konten':'Edit Konten' ?></h3>
              <?php $kBack = '?'.http_build_query(['tab'=>'kegiatan','kq'=>$kq,'kcat'=>$kcat,'kstatus'=>$kstatus,'kpage'=>$kpage]); ?>
              <form method="post" enctype="multipart/form-data">
                <?php csrf_field(); ?>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" required value="<?= $kmode==='edit' ? h($kEditing['title']) : '' ?>" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Slug (opsional)</label>
                    <input type="text" name="slug" value="<?= $kmode==='edit' ? h($kEditing['slug']) : '' ?>" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300" placeholder="otomatis dari judul bila kosong">
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                      <?php foreach ($kCatLabels as $val=>$lab): ?>
                        <option value="<?= $val ?>" <?= ($kmode==='edit' && strtolower($kEditing['category'])===$val)?'selected':'' ?>><?= $lab ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                      <option value="active" <?= ($kmode==='edit' && $kEditing['status']==='active')?'selected':'' ?>>Active</option>
                      <option value="inactive" <?= ($kmode==='edit' && $kEditing['status']==='inactive')?'selected':'' ?>>Inactive</option>
                    </select>
                  </div>
                  <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Ringkas (Excerpt)</label>
                    <textarea name="excerpt" rows="3" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300"><?= $kmode==='edit' ? h($kEditing['excerpt']) : '' ?></textarea>
                  </div>
                  <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Konten</label>
                    <textarea name="content" rows="6" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300"><?= $kmode==='edit' ? h($kEditing['content']) : '' ?></textarea>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">
                      Gambar Profil (thumbnail)
                      <span class="text-xs text-gray-400">(ditampilkan sebagai gambar utama kartu di frontend)</span>
                    </label>
                    <?php if ($kmode==='edit' && !empty($kEditing['image_path'])): ?>
                      <div class="flex items-center gap-3 mt-1">
                        <img src="/<?= h($kEditing['image_path']) ?>" class="h-16 w-16 object-cover rounded-lg border border-gray-200" alt="">
                        <span class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti</span>
                      </div>
                    <?php endif; ?>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif,.webp" class="mt-2">
                  </div>
                  <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Foto Tambahan (bisa banyak, opsional)</label>
                    <input type="file" name="images[]" accept=".jpg,.jpeg,.png,.gif,.webp" multiple class="mt-1">
                    <p class="text-xs text-gray-500 mt-1">Tahan Ctrl/Command untuk pilih banyak file. Maks 5MB/file.</p>

                    <?php if ($kmode==='edit' && $kEditing): ?>
                      <?php $existing = kegiatan_list_photos((int)$kEditing['id']); ?>
                      <?php if ($existing): ?>
                        <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                          <?php foreach ($existing as $ph): ?>
                            <div class="group relative border rounded-lg overflow-hidden">
                              <img src="/<?= h($ph['image_path']) ?>" class="h-24 w-full object-cover" alt="">
                              <form action="?tab=kegiatan&kmode=delphoto" method="post"
                                    class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition"
                                    onsubmit="return confirm('Hapus foto ini?')">
                                <?php csrf_field(); ?>
                                <input type="hidden" name="photo_id" value="<?= (int)$ph['id'] ?>">
                                <input type="hidden" name="kid" value="<?= (int)$kEditing['id'] ?>">
                                <button class="px-2 py-1 text-xs rounded bg-red-600 text-white">Hapus</button>
                              </form>
                            </div>
                          <?php endforeach; ?>
                        </div>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="mt-4 flex items-center justify-end gap-3">
                  <a href="<?= h($kBack) ?>" class="px-4 py-2 rounded-lg border border-gray-300">Batal</a>
                  <button class="px-4 py-2 rounded-lg bg-purple-600 text-white hover:bg-purple-700"><?= $kmode==='create'?'Simpan':'Update' ?></button>
                </div>
              </form>
            </div>
          <?php endif; ?>
        </section>

        <!-- ================== RENDER ART ================== -->
        <section id="tab-render" class="<?= $tab==='render' ? '' : 'hidden' ?>">
          <?php if (!empty($_GET['flash'])): ?>
            <div class="rounded-xl border border-green-200 bg-green-50 text-green-800 px-4 py-3 mb-4">
              <?php if ($_GET['flash']==='created') echo 'Berhasil menambah render art.'; ?>
              <?php if ($_GET['flash']==='updated') echo 'Berhasil memperbarui render art.'; ?>
              <?php if ($_GET['flash']==='deleted') echo 'Berhasil menghapus render art.'; ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($rErr)): ?>
            <div class="rounded-xl border border-red-200 bg-red-50 text-red-800 px-4 py-3 mb-4"><?= h($rErr) ?></div>
          <?php endif; ?>

          <div class="flex flex-wrap items-center gap-3 mb-4">
            <a href="?tab=render&mode=create" class="inline-flex items-center px-4 py-2 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700">+ Tambah Render</a>

            <form method="get" class="flex flex-wrap items-center gap-2">
              <input type="hidden" name="tab" value="render">
              <input type="text" name="rq" value="<?= h($rq) ?>" placeholder="Cari judul / deskripsi..." class="px-3 py-2 rounded-lg border border-gray-300">
              <select name="rcat" class="px-3 py-2 rounded-lg border border-gray-300">
                <option value="">Semua Kategori</option>
                <?php foreach ($rCatLabels as $val=>$lab): ?>
                  <option value="<?= $val ?>" <?= $rcat===$val?'selected':'' ?>><?= $lab ?></option>
                <?php endforeach; ?>
              </select>
              <select name="rstatus" class="px-3 py-2 rounded-lg border border-gray-300">
                <option value="">Semua Status</option>
                <option value="active" <?= $rstatus==='active'?'selected':'' ?>>Active</option>
                <option value="inactive" <?= $rstatus==='inactive'?'selected':'' ?>>Inactive</option>
              </select>
              <button class="px-4 py-2 rounded-lg border border-gray-300">Terapkan</button>
              <a href="?tab=render" class="px-4 py-2 rounded-lg border border-gray-300">Reset</a>
            </form>
          </div>

          <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">Preview</th>
                    <th class="px-6 py-3">Judul</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Dibuat</th>
                    <th class="px-6 py-3"></th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                  <?php if (!$rItems): ?>
                    <tr><td colspan="6" class="px-6 py-6 text-center text-gray-500">Belum ada render art.</td></tr>
                  <?php else: foreach ($rItems as $r): ?>
                    <tr class="hover:bg-gray-50">
                      <td class="px-6 py-3">
                        <?php if (!empty($r['image_path'])): ?>
                          <img src="/<?= h($r['image_path']) ?>" class="h-16 w-24 object-cover rounded-lg border border-gray-200" alt="">
                        <?php else: ?>
                          <div class="h-16 w-24 rounded-lg bg-gray-100 border border-gray-200"></div>
                        <?php endif; ?>
                      </td>
                      <td class="px-6 py-3">
                        <div class="text-sm font-medium text-gray-900"><?= h($r['title']) ?></div>
                        <?php if (!empty($r['description'])): ?>
                          <div class="text-xs text-gray-500 line-clamp-2"><?= nl2br(h($r['description'])) ?></div>
                        <?php endif; ?>
                      </td>
                      <td class="px-6 py-3 text-sm text-gray-700">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border">
                          <?= h($rCatLabels[$r['category']] ?? ucfirst($r['category'])) ?>
                        </span>
                      </td>
                      <td class="px-6 py-3">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border">
                          <?= h(ucfirst($r['status'])) ?>
                        </span>
                      </td>
                      <td class="px-6 py-3 text-sm text-gray-500"><?= !empty($r['created_at']) ? h(date('d M Y', strtotime($r['created_at']))) : '-' ?></td>
                      <td class="px-6 py-3 text-right">
                        <a href="?tab=render&mode=edit&id=<?= (int)$r['id'] ?>&rq=<?= urlencode($rq) ?>&rcat=<?= urlencode($rcat) ?>&rstatus=<?= urlencode($rstatus) ?>&rpage=<?= (int)$rpage ?>"
                           class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg border border-gray-300 hover:bg-gray-50">Edit</a>
                        <form action="?tab=render&mode=delete" method="post" class="inline" onsubmit="return confirm('Hapus render art ini?')">
                          <?php csrf_field(); ?>
                          <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                          <button class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg border border-red-300 text-red-700 hover:bg-red-50">Hapus</button>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; endif; ?>
                </tbody>
              </table>
            </div>

            <div class="px-6 py-4 flex items-center justify-between border-t border-gray-100">
              <div class="text-sm text-gray-500">
                Menampilkan <span class="font-medium"><?= $rTotal ? ($rOffset+1) : 0 ?></span>–
                <span class="font-medium"><?= min($rOffset + $rPerPage, $rTotal) ?></span> dari
                <span class="font-medium"><?= $rTotal ?></span>
              </div>
              <div class="flex items-center gap-2">
                <?php
                  $rBase = ['tab'=>'render','rq'=>$rq,'rcat'=>$rcat,'rstatus'=>$rstatus];
                  $rPrev = $rpage>1 ? '?'.http_build_query($rBase+['rpage'=>$rpage-1]) : '';
                  $rNext = $rpage<$rPages ? '?'.http_build_query($rBase+['rpage'=>$rpage+1]) : '';
                ?>
                <a href="<?= $rPrev?:'javascript:void(0)' ?>" class="px-3 py-1.5 rounded-lg border <?= $rPrev?'border-gray-300 hover:bg-gray-50 text-gray-700':'border-gray-200 text-gray-300 cursor-not-allowed' ?>">Prev</a>
                <span class="text-sm text-gray-500">Hal <?= (int)$rpage ?> / <?= (int)$rPages ?></span>
                <a href="<?= $rNext?:'javascript:void(0)' ?>" class="px-3 py-1.5 rounded-lg border <?= $rNext?'border-gray-300 hover:bg-gray-50 text-gray-700':'border-gray-200 text-gray-300 cursor-not-allowed' ?>">Next</a>
              </div>
            </div>
          </div>

          <?php if ($mode==='create' || ($mode==='edit' && $rEditing)): ?>
            <div class="mt-6 bg-white border border-gray-200 rounded-2xl p-6">
              <h3 class="text-lg font-semibold mb-3"><?= $mode==='create'?'Tambah Render Art':'Edit Render Art' ?></h3>
              <?php $rBack = '?'.http_build_query(['tab'=>'render','rq'=>$rq,'rcat'=>$rcat,'rstatus'=>$rstatus,'rpage'=>$rpage]); ?>
              <form method="post" enctype="multipart/form-data">
                <?php csrf_field(); ?>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Karya</label>
                    <input type="text" name="title" required
                           value="<?= $mode==='edit' ? h($rEditing['title']) : '' ?>"
                           class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                      <?php foreach ($rCatLabels as $val=>$lab): ?>
                        <option value="<?= $val ?>" <?= ($mode==='edit' && $rEditing['category']===$val)?'selected':'' ?>><?= $lab ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" rows="4" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300"><?= $mode==='edit' ? h($rEditing['description']) : '' ?></textarea>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" class="mt-1 w-full px-3 py-2 rounded-lg border border-gray-300">
                      <option value="active" <?= ($mode==='edit' && $rEditing['status']==='active')?'selected':'' ?>>Active</option>
                      <option value="inactive" <?= ($mode==='edit' && $rEditing['status']==='inactive')?'selected':'' ?>>Inactive</option>
                    </select>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700">Gambar Render</label>
                    <?php if ($mode==='edit' && !empty($rEditing['image_path'])): ?>
                      <div class="flex items-center gap-3 mt-1">
                        <img src="/<?= h($rEditing['image_path']) ?>" class="h-20 w-32 object-cover rounded-lg border border-gray-200" alt="">
                        <span class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti</span>
                      </div>
                    <?php endif; ?>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif,.webp" class="mt-2">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF, WebP. Maks 5MB.</p>
                  </div>
                </div>

                <div class="mt-4 flex items-center justify-end gap-3">
                  <a href="<?= h($rBack) ?>" class="px-4 py-2 rounded-lg border border-gray-300">Batal</a>
                  <button class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700"><?= $mode==='create'?'Simpan':'Update' ?></button>
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
      var gal = document.getElementById('tab-gallery');
      var keg = document.getElementById('tab-kegiatan');
      var ren = document.getElementById('tab-render');

      if (!over || !gal || !keg || !ren) return;

      over.classList.add('hidden');
      gal.classList.add('hidden');
      keg.classList.add('hidden');
      ren.classList.add('hidden');

      if (tab === 'gallery') gal.classList.remove('hidden');
      else if (tab === 'kegiatan') keg.classList.remove('hidden');
      else if (tab === 'render') ren.classList.remove('hidden');
      else over.classList.remove('hidden');
    }

    function setQuery(key, val){
      var url = new URL(window.location.href);
      if (val==null) url.searchParams.delete(key);
      else url.searchParams.set(key, val);
      history.pushState({}, '', url.toString());
    }

    function clearGalleryQuery(){
      var url = new URL(window.location.href);
      ['mode','id','gq','gcat','gstatus','gpage'].forEach(k=>url.searchParams.delete(k));
      url.searchParams.set('tab','gallery');
      history.replaceState({}, '', url.toString());
    }

    function clearRenderQuery(){
      var url = new URL(window.location.href);
      ['mode','id','rq','rcat','rstatus','rpage'].forEach(k=>url.searchParams.delete(k));
      url.searchParams.set('tab','render');
      history.replaceState({}, '', url.toString());
    }

    var linkOverview = document.getElementById('link-overview');
    var linkGallery = document.getElementById('link-gallery');
    var linkKegiatan = document.getElementById('link-kegiatan');
    var linkRender = document.getElementById('link-render');
    var shortcut = document.getElementById('shortcut-gallery');
    var shortcutRender = document.getElementById('shortcut-render');

    if (linkGallery) linkGallery.addEventListener('click', function(e){
      e.preventDefault(); switchTab('gallery'); clearGalleryQuery();
    });
    if (shortcut) shortcut.addEventListener('click', function(e){
      e.preventDefault(); switchTab('gallery'); clearGalleryQuery();
    });
    if (linkOverview) linkOverview.addEventListener('click', function(e){
      e.preventDefault(); switchTab('overview'); setQuery('tab','overview');
    });
    if (linkKegiatan) linkKegiatan.addEventListener('click', function(e){
      e.preventDefault(); switchTab('kegiatan'); setQuery('tab','kegiatan');
    });
    if (linkRender) linkRender.addEventListener('click', function(e){
      e.preventDefault(); switchTab('render'); clearRenderQuery();
    });
    if (shortcutRender) shortcutRender.addEventListener('click', function(e){
      e.preventDefault(); switchTab('render'); clearRenderQuery();
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