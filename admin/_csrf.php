<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

function csrf_token() {
  if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
  }
  return $_SESSION['csrf'];
}

function csrf_field() {
  $token = htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8');
  echo '<input type="hidden" name="csrf" value="'.$token.'">';
}

function csrf_verify() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf'] ?? '';
    if (!$token || !hash_equals($_SESSION['csrf'] ?? '', $token)) {
      http_response_code(403);
      exit('Invalid CSRF token');
    }
  }
}
