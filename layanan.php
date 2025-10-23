<?php
require_once __DIR__ . '/includes/config.php';
?>
<?php include __DIR__ . '/includes/header.php'; ?>

<main class="min-h-screen">
<!-- HERO: Layanan -->
<section class="relative rounded-2xl overflow-hidden border border-gray-200 shadow-lg">
  <div class="h-64 md:h-80 relative">
    <img src="<?= asset('assets/img/banner.jpg') ?>" alt="Layanan Sekolah ISR Resinda"
         class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black opacity-60"></div>

    <div class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center p-6 md:p-10 text-white">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Layanan Sekolah</h1>
      <p class="mt-3 md:mt-4 text-base md:text-lg opacity-95">
        Program & pendampingan untuk mendukung potensi siswa dan kolaborasi orang tua
      </p>
      <div class="mt-5 flex flex-col sm:flex-row gap-3">
        <a href="#program"
           class="inline-flex items-center justify-center px-5 py-3 rounded-xl text-sm font-semibold text-white shadow-md transition"
           style="background-color:#6D28D9">Lihat Program</a>

        <a href="https://api.whatsapp.com/send/?phone=623815432987&text&type=phone_number&app_absent=0"
           target="_blank" rel="noopener"
           class="inline-flex items-center justify-center px-5 py-3 rounded-xl text-sm font-semibold text-white shadow-md transition"
           style="background-color:#25D366">
          <svg class="mr-2" width="18" height="18" viewBox="0 0 32 32" fill="white" aria-hidden="true">
            <path d="M16 2a13 13 0 0 0-8 23.23V29a1 1 0 0 0 1.51.86l3.65-2.19A12.64 12.64 0 0 0 16 28a13 13 0 0 0 0-26zm0 24a11.13 11.13 0 0 1-2.76-.36 1 1 0 0 0-.76.11L10 27.23v-2.5a1 1 0 0 0-.42-.81A11 11 0 1 1 16 26z"/>
            <path d="M19.86 15.18a1.9 1.9 0 0 0-2.64 0l-.09.09-1.4-1.4.09-.09a1.86 1.86 0 0 0 0-2.64l-1.5-1.5a1.9 1.9 0 0 0-2.64 0l-.8.79a3.56 3.56 0 0 0-.5 3.76 10.64 10.64 0 0 0 2.62 4A8.7 8.7 0 0 0 18.56 21a2.92 2.92 0 0 0 2.1-.79l.79-.8a1.86 1.86 0 0 0 0-2.64z"/>
          </svg>
          Tanya Admin
        </a>
      </div>
    </div>
  </div>
</section>


  <!-- PROGRAM UTAMA (responsif) -->
  <section id="program" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-14">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
      <?php
      $programs = [
        ['icon'=>'🎓','title'=>'Kurikulum Holistik','desc'=>'Akademik & karakter terintegrasi.','href'=>'profil.php'],
        ['icon'=>'🧪','title'=>'Klub & Ekskul','desc'=>'Sains, seni, olahraga, literasi, teknologi.','href'=>'porto.php'],
        ['icon'=>'🤝','title'=>'Layanan BK','desc'=>'Konseling siswa & kolaborasi orang tua.','href'=>'kontak.php#bk'],
        ['icon'=>'🧑‍💻','title'=>'Pembelajaran Digital','desc'=>'E-learning & CBT.','href'=>'team.php'],
        ['icon'=>'🧾','title'=>'Administrasi & PPDB','desc'=>'Pendaftaran, mutasi, beasiswa, biaya.','href'=>'kontak.php#daftar'],
        ['icon'=>'🩺','title'=>'Kesehatan Siswa','desc'=>'UKS, screening, edukasi sanitasi.','href'=>'profil.php#uks'],
      ];
      foreach ($programs as $p): ?>
        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
          <div class="text-3xl"><?= $p['icon'] ?></div>
          <h3 class="mt-3 font-semibold text-gray-900"><?= htmlspecialchars($p['title']) ?></h3>
          <p class="mt-1 text-gray-600 text-sm sm:text-base"><?= htmlspecialchars($p['desc']) ?></p>
          <a href="<?= url($p['href']) ?>" class="inline-flex items-center gap-2 mt-4 text-purple-600 hover:text-purple-800 text-sm sm:text-base">
            Pelajari →
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- TESTIMONI -->
  <section class="py-12 sm:py-14 bg-gradient-to-r from-purple-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Apa Kata Orang Tua</h2>
      <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        <?php
        $testi = [
          ['name'=>'Ibu Rani','text'=>'Anak saya lebih percaya diri dan senang belajar.'],
          ['name'=>'Bapak Dedi','text'=>'Komunikasi sekolah-orang tua sangat baik & transparan.'],
          ['name'=>'Ibu Sinta','text'=>'Fasilitas lengkap, ekskul bervariasi, anak betah.'],
        ];
        foreach ($testi as $t): ?>
          <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-gray-100">
            <p class="text-gray-700 text-sm sm:text-base">“<?= htmlspecialchars($t['text']) ?>”</p>
            <div class="mt-3 font-semibold text-gray-900">— <?= htmlspecialchars($t['name']) ?></div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="mt-10 text-center">
        <a href="<?= url('kontak.php#daftar') ?>" class="inline-flex px-5 sm:px-6 py-3 rounded-xl bg-purple-600 text-white hover:bg-purple-700 transition">Hubungi Kami</a>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
