<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../models/Berita.php';

// Set JSON header
header('Content-Type: application/json');

// Cek method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode([
    'success' => false,
    'message' => 'Method not allowed'
  ]);
  exit;
}

// Cek parameter ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo json_encode([
    'success' => false,
    'message' => 'ID berita tidak ditemukan'
  ]);
  exit;
}

$beritaId = (int)$_GET['id'];

try {
  $beritaModel = new Berita();
  
  // Cek apakah berita exists
  $berita = $beritaModel->findById($beritaId);
  
  if (!$berita) {
    echo json_encode([
      'success' => false,
      'message' => 'Berita tidak ditemukan'
    ]);
    exit;
  }
  
  // Increment views
  $result = $beritaModel->incrementViews($beritaId);
  
  if ($result) {
    echo json_encode([
      'success' => true,
      'message' => 'View count updated',
      'berita_id' => $beritaId,
      'views' => $berita['views'] + 1
    ]);
  } else {
    echo json_encode([
      'success' => false,
      'message' => 'Gagal update view count'
    ]);
  }
  
} catch (Exception $e) {
  echo json_encode([
    'success' => false,
    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
  ]);
}