<?php
require_once __DIR__ . '/includes/config.php';
// kegiatan.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dokumentasi Kegiatan - Ignatius Slamet Riyadi</title>
  <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <style>
    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding: 120px 0 80px;
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
      opacity: 0.3;
    }

    .hero-content {
      position: relative;
      z-index: 1;
    }

    .hero h2 {
      font-size: 1.2rem;
      font-weight: 500;
      margin-bottom: 10px;
      opacity: 0.9;
    }

    .hero h1 {
      font-size: 2.8rem;
      font-weight: 700;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .hero p {
      font-size: 1.1rem;
      margin-bottom: 30px;
      opacity: 0.95;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    .cta-button {
      display: inline-block;
      padding: 14px 40px;
      background: white;
      color: #667eea;
      text-decoration: none;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .cta-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }

    /* Activities Section */
    .activities-section {
      padding: 80px 0;
      background: #f8f9fa;
    }

    .section-title {
      text-align: center;
      font-size: 2.5rem;
      color: #2d3748;
      margin-bottom: 50px;
      position: relative;
      padding-bottom: 20px;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, #667eea, #764ba2);
      border-radius: 2px;
    }

    .activity-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
      padding: 0 20px;
    }

    .activity-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0,0,0,0.07);
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .activity-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }

    .activity-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .activity-card:hover img {
      transform: scale(1.05);
    }

    .activity-content {
      padding: 25px;
    }

    .activity-content h3 {
      font-size: 1.3rem;
      color: #2d3748;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .activity-content p {
      color: #718096;
      line-height: 1.6;
      font-size: 0.95rem;
    }

    .photo-count {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-top: 12px;
      color: #667eea;
      font-size: 0.9rem;
      font-weight: 500;
    }

    .photo-count i {
      font-size: 1rem;
    }

    /* Back to Top */
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .back-to-top.show {
      opacity: 1;
      visibility: visible;
    }

    .back-to-top:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 16px rgba(102, 126, 234, 0.6);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2rem;
      }

      .hero p {
        font-size: 1rem;
      }

      .section-title {
        font-size: 2rem;
      }

      .activity-cards {
        grid-template-columns: 1fr;
        gap: 20px;
      }
    }
  
/* === Center fixes for Kegiatan (especially mobile) === */
.activities-section .container{
  max-width: 1100px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 16px;
  padding-right: 16px;
  box-sizing: border-box;
}
.activities-section .activity-cards{
  justify-items: center; /* center grid items horizontally */
}
.activities-section .activity-card{
  width: 100%;
  max-width: 720px; /* prevent overly-wide single card */
}
@media (max-width: 768px){
  .activities-section { padding-left: 0; padding-right: 0; }
  .activities-section .activity-cards{ padding-left: 0; padding-right: 0; gap: 16px; }
  .activities-section .activity-card{ max-width: 600px; }
}
/* === /Center fixes === */

</style>
</head>
<body>

  <!-- Header -->
  <?php include 'includes/header.php'; ?>



  <!-- Activities Section -->
  <section id="kegiatan" class="activities-section">
    <div class="container">
      <h2 class="section-title">Dokumentasi Kegiatan Sekolah</h2>
      <div class="activity-cards">

        <!-- Konten Main -->
<?php
require_once __DIR__ . '/models/Kegiatan.php';
require_once __DIR__ . '/config/database.php'; // untuk hitung foto (opsional)

if (!function_exists('h')) {
  function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
}

$kg = new Kegiatan();

// (opsional) filter kategori/pencarian dari query string
$validCats = ['umum','berita','artikel','pengumuman'];
$category = strtolower(trim($_GET['category'] ?? '')); if (!in_array($category,$validCats,true)) $category='';
$q = trim($_GET['q'] ?? '');

$posts = $kg->all([
  'status'   => 'active',
  'category' => $category ?: null,
  'q'        => $q ?: null
]);

// --- Hitung jumlah foto per konten (opsional: jika ada tabel kegiatan_foto)
$photoCount = [];
try {
  $ids = array_column($posts, 'id');
  if ($ids) {
    $db = (new Database())->getConnection();
    $in = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $db->prepare("SELECT kegiatan_id, COUNT(*) AS c FROM kegiatan_foto WHERE kegiatan_id IN ($in) GROUP BY kegiatan_id");
    $stmt->execute($ids);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $r) {
      $photoCount[(int)$r['kegiatan_id']] = (int)$r['c'];
    }
  }
} catch (Throwable $e) {
  // diamkan saja; fallback di bawah
}

// --- Render kartu
if (!empty($posts)):
  foreach ($posts as $p):
    if (!is_array($p)) continue;
    $thumb = $p['image_path'] ?? '';
    $title = $p['title'] ?? '';
    $excerpt = $p['excerpt'] ?? '';
    $slug = $p['slug'] ?? '';
    $count = $photoCount[$p['id']] ?? ($thumb ? 1 : 0); // fallback kalau tak ada tabel kegiatan_foto
?>
  <div class="activity-card">
    <a href="<?= url('kegiatan-detail.php?slug=' . rawurlencode($slug)) ?>">
      <img src="<?= h($thumb ?: 'assets/img/placeholder.jpg') ?>" alt="<?= h($title) ?>" />
    </a>
    <div class="activity-content">
      <h3>
        <a href="<?= url('kegiatan-detail.php?slug=' . rawurlencode($slug)) ?>"><?= h($title) ?></a>
      </h3>
      <p><?= $excerpt !== '' ? h($excerpt) : h(mb_strimwidth(strip_tags($p['content'] ?? ''), 0, 120, '…')) ?></p>
      <span class="photo-count"><i class="fas fa-images"></i> <?= (int)$count ?> foto</span>
    </div>
  </div>
<?php
  endforeach;
else:
?>
  <div class="activity-card">
    <div class="activity-content">
      <p>Tidak ada kegiatan untuk saat ini.</p>
    </div>
  </div>
<?php endif; ?>
<!-- END -->

      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

  <a href="#" class="back-to-top" title="Kembali ke atas"><i class="fas fa-chevron-up"></i></a>

  <script>
    // Back to top button
    const backToTop = document.querySelector('.back-to-top');
    
    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 300) {
        backToTop.classList.add('show');
      } else {
        backToTop.classList.remove('show');
      }
    });

    backToTop.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  </script>
</body>
</html>