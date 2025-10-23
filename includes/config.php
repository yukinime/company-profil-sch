<?php
/**
 * Global config untuk URL/Path
 * - Auto-deteksi subfolder deploy (tidak perlu set '/site' manual)
 * - Semua file cukup pakai url('...') / asset('...')
 */

// --- Deteksi scheme & host ---
$__scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$__host   = $_SERVER['HTTP_HOST'] ?? 'localhost';

// --- Hitung SUBDIR berdasarkan posisi folder app terhadap DOCUMENT_ROOT ---
$docRoot   = isset($_SERVER['DOCUMENT_ROOT']) ? rtrim(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])), '/') : '';
$appDir    = str_replace('\\', '/', dirname(__DIR__)); // parent dari includes/ = folder "site"
$subdir    = '';
if ($docRoot && str_starts_with($appDir, $docRoot)) {
  $subdir = substr($appDir, strlen($docRoot)); // hasil: '/site' atau ''
  $subdir = rtrim($subdir, '/');
}
if ($subdir === false || $subdir === null) $subdir = '';
if ($subdir !== '' && $subdir[0] !== '/') $subdir = '/' . $subdir;

// (opsional) override via ENV jika perlu (mis. di reverse proxy yang DOCUMENT_ROOT-nya beda)
if (!empty($_ENV['APP_SUBDIR'])) {
  $tmp = trim($_ENV['APP_SUBDIR']);
  if ($tmp !== '') {
    $subdir = '/' . ltrim($tmp, '/');
    $subdir = rtrim($subdir, '/');
  }
}

// BASE_URL selalu berakhiran '/'
define('BASE_URL', rtrim("$__scheme://$__host$subdir", '/') . '/');

// --- Konstanta direktori relatif web root (bisa disesuaikan) ---
define('ASSETS_DIR', 'assets');
define('IMAGES_DIR', ASSETS_DIR . '/img');
define('UPLOADS_DIR', 'uploads');
define('VIDEOS_DIR', ASSETS_DIR . '/videos');

// --- Helper URL ---
function url($path = '') {
  $path = ltrim((string)$path, '/');
  return BASE_URL . $path;
}
function asset($path = '') {
  $path = ltrim((string)$path, '/');
  return BASE_URL . $path;
}
