<?php
// kontak.php - Halaman Kontak Sekolah
$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi form
    $nama = trim($_POST['nama'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $pesan = trim($_POST['pesan'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    // Validasi form sederhana
    if (empty($nama) || empty($pesan)) {
        $error_message = "Nama dan pesan harus diisi!";
    } else {
        // Format pesan WhatsApp
        $formatted_message = "Assalamu'alaikum\n\nPerkenalkan nama saya {$nama} saya ingin bertanya mengenai {$pesan}";
        
        // Encode untuk URL WhatsApp
        $whatsapp_message = urlencode($formatted_message);
        
        // Nomor WhatsApp admin (ganti dengan nomor admin sekolah)
        $admin_phone = "623815432987"; // Ganti dengan nomor WhatsApp admin sekolah
        
        // Generate link WhatsApp
        $whatsapp_link = "https://wa.me/{$admin_phone}?text={$whatsapp_message}";
        
        // Redirect ke WhatsApp
        echo "<script>window.location.href = '{$whatsapp_link}';</script>";
        
        // Tampilkan pesan sukses jika JavaScript dinonaktifkan
        $success_message = "Pesan berhasil dibuat! Klik <a href='{$whatsapp_link}' target='_blank'>di sini</a> jika Anda tidak dialihkan secara otomatis.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kontak Kami - Ignatius Slamet Riyadi</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  
  <style>
    .page-title {
      text-align: center;
      color: #2d6a4f;
      margin-bottom: 40px;
      font-size: 2.2rem;
      font-weight: 700;
      position: relative;
      padding-bottom: 15px;
    }

    .page-title:after {
      content: '';
      position: absolute;
      width: 80px;
      height: 3px;
      background-color: #2d6a4f;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
    }
    
    .kontak-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 40px 20px;
    }
    
    .kontak-wrapper {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      margin-top: 40px;
    }
    
    .kontak-info {
      flex: 1;
      min-width: 300px;
    }
    
    .kontak-form {
      flex: 2;
      min-width: 300px;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .info-item {
      display: flex;
      margin-bottom: 25px;
      align-items: flex-start;
    }
    
    .info-icon {
      width: 50px;
      height: 50px;
      background-color: #e6f7ed;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
      color: #2d6a4f;
      font-size: 20px;
    }
    
    .info-text h4 {
      margin: 0 0 8px;
      color: #2d6a4f;
      font-size: 18px;
    }
    
    .info-text p {
      margin: 0;
      color: #555;
      line-height: 1.6;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 8px;
      color: #333;
    }
    
    .form-control {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
      transition: border-color 0.3s;
    }
    
    .form-control:focus {
      outline: none;
      border-color: #2d6a4f;
    }
    
    textarea.form-control {
      resize: vertical;
      min-height: 120px;
    }
    
    .submit-btn {
      background-color: #2d6a4f;
      color: white;
      border: none;
      padding: 14px 25px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      display: inline-flex;
      align-items: center;
    }
    
    .submit-btn i {
      margin-left: 8px;
    }
    
    .submit-btn:hover {
      background-color: #1b4332;
    }
    
    .required {
      color: #e74c3c;
    }
    
    .alert {
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
    }
    
    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    
    .alert-danger {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    
    .social-links {
      display: flex;
      gap: 15px;
      margin-top: 10px;
    }
    
    .social-link {
      width: 40px;
      height: 40px;
      background-color: #e6f7ed;
      color: #2d6a4f;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      transition: all 0.3s;
    }
    
    .social-link:hover {
      background-color: #2d6a4f;
      color: white;
    }
    
    @media (max-width: 768px) {
      .page-title {
        font-size: 1.8rem;
      }
      
      .kontak-wrapper {
        flex-direction: column-reverse;
      }
      
      .info-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
      }
    }
  </style>
</head>
<body>

  <?php include 'includes/header.php'; ?>

  <!-- Kontak Section -->
  <section class="kontak-section">
    <div class="kontak-container">
      <h2 class="page-title">Hubungi Kami</h2>
      
      <?php if (!empty($success_message)): ?>
      <div class="alert alert-success">
        <?php echo $success_message; ?>
      </div>
      <?php endif; ?>
      
      <?php if (!empty($error_message)): ?>
      <div class="alert alert-danger">
        <?php echo $error_message; ?>
      </div>
      <?php endif; ?>
      
      <div class="kontak-wrapper">
        <div class="kontak-info">
          <div class="info-item">
            <div class="info-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="info-text">
              <h4>Alamat Kami</h4>
              <p>Jl.Pandawa No.5 Perum Resinda Karawang 41361,</p>
            </div>
          </div>
          
          <div class="info-item">
            <div class="info-icon">
              <i class="fas fa-phone-alt"></i>
            </div>
            <div class="info-text">
              <h4>Telepon</h4>
              <p>(026) 7860-4065</p>
            </div>
          </div>
          
          <div class="info-item">
            <div class="info-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="info-text">
              <h4>Email</h4>
              <p>info@smaslametriyadi-karawang.sch.id</p>
            </div>
          </div>
          
          <div class="info-item">
            <div class="info-icon">
              <i class="fas fa-clock"></i>
            </div>
            <div class="info-text">
              <h4>Jam Operasional</h4>
              <p>Senin - Jumat: 07.30 - 16.15</p>
            </div>
          </div>
          
        </div>
        
        <div class="kontak-form">
          <h3>Kirim Pesan</h3>
          <p>Ada pertanyaan atau informasi yang ingin ditanyakan? Silakan isi formulir di bawah ini.</p>
          
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
              <label for="nama">Nama Lengkap <span class="required">*</span></label>
              <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            
            <div class="form-group">
              <label for="phone">Nomor Telepon</label>
              <input type="tel" class="form-control" id="phone" name="phone">
            </div>
            
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            
            <div class="form-group">
              <label for="pesan">Pesan <span class="required">*</span></label>
              <textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
            </div>
            
            <button type="submit" class="submit-btn">
              Kirim Pesan <i class="fas fa-paper-plane"></i>
            </button>
          </form>
        </div>
      </div>
      
      <!-- Maps Section -->
      <div class="map-section" style="margin-top: 60px;">
        <h3 style="color: #2d6a4f; margin-bottom: 20px;">Lokasi Kami</h3>
        <div style="border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.770591913919!2d107.26689527409731!3d-6.293851261599122!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699d48f5896f89%3A0x6fdcbcfc5179f35!2sCatholic%20High%20School%20Ignatius%20Slamet%20Riyadi%20Karawang!5e0!3m2!1sid!2sid!4v1760899261389!5m2!1sid!2sid" width="100%" height="250" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>

  <!-- Script JS -->
  <script src="assets/js/script.js"></script>

</body>
</html>