<?php
require_once __DIR__ . '/../_auth.php';
require_once __DIR__ . '/../_csrf.php';
require_once __DIR__ . '/../../models/Gallery.php';

csrf_verify();
$id = (int)($_POST['id'] ?? 0);
if (!$id) { http_response_code(400); exit('Bad request'); }

$gal = new Gallery();
$gal->delete($id);
header('Location: index.php');
exit;
    