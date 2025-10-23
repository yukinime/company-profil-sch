<?php
require_once __DIR__ . '/../includes/config.php';
?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<main class="min-h-screen">
<!-- HERO: Fasilitas -->
<section class="relative rounded-2xl overflow-hidden border border-gray-200 shadow-lg">
  <div class="h-64 md:h-80 relative">
    <img src="<?= asset('assets/img/banner.jpg') ?>" alt="Fasilitas Sekolah ISR Resinda"
         class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black opacity-60"></div>

    <div class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center p-6 md:p-10 text-white">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Fasilitas Sekolah</h1>
      <p class="mt-3 md:mt-4 text-base md:text-lg opacity-95">
        Lingkungan belajar modern & nyaman · Mendukung pengembangan potensi siswa
      </p>

      <div class="mt-5 flex flex-col sm:flex-row gap-3">
        <a href="<?= url('fasilitas/contoh.php') ?>"
           class="inline-flex items-center justify-center px-5 py-3 rounded-xl text-sm font-semibold text-white shadow-md transition"
           style="background-color:#6D28D9">Lihat Contoh</a>

        <a href="https://api.whatsapp.com/send/?phone=623815432987&text&type=phone_number&app_absent=0"
           target="_blank" rel="noopener"
           class="inline-flex items-center justify-center px-5 py-3 rounded-xl text-sm font-semibold text-white shadow-md transition"
           style="background-color:#25D366">
          <!-- WhatsApp icon -->
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


  <!-- HIGHLIGHTS (responsif) -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-14">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
      <?php
      $highlights = [
        ['icon' => '🏫', 'title' => 'Ruang Kelas Nyaman', 'desc' => 'Ventilasi baik & pencahayaan cukup.'],
        ['icon' => '💻', 'title' => 'Lab Komputer',       'desc' => 'Perangkat terkini pembelajaran digital.'],
        ['icon' => '📚', 'title' => 'Perpustakaan',       'desc' => 'Koleksi kurikulum & literasi siswa.'],
        ['icon' => '⚽', 'title' => 'Area Olahraga',      'desc' => 'Lapangan serbaguna & alat olahraga.'],
      ];
      foreach ($highlights as $h): ?>
        <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
          <div class="text-3xl"><?= $h['icon'] ?></div>
          <h3 class="mt-3 font-semibold text-gray-900"><?= htmlspecialchars($h['title']) ?></h3>
          <p class="mt-1 text-gray-600 text-sm sm:text-base"><?= htmlspecialchars($h['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- GRID FASILITAS (responsif + aspect ratio) -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-14">
    <div class="flex items-end justify-between mb-4 sm:mb-6">
      <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Galeri Fasilitas</h2>
      <a href="<?= url('galery.php?category=sd') ?>" class="text-purple-600 hover:text-purple-800 text-sm sm:text-base">Lihat Galeri →</a>
    </div>

    <?php
    $fasilitas = [
      ['img' => 'assets/img/fasilitas-kelas.jpg',   'title' => 'Ruang Kelas',    'desc' => 'Kursi ergonomis & proyektor.'],
      ['img' => 'assets/img/fasilitas-perpus.jpg',  'title' => 'Perpustakaan',   'desc' => 'Ruang baca tenang & koleksi lengkap.'],
      ['img' => 'assets/img/fasilitas-lab.jpg',     'title' => 'Lab Komputer',   'desc' => 'Internet stabil & perangkat memadai.'],
      ['img' => 'assets/img/fasilitas-uks.jpg',     'title' => 'UKS',            'desc' => 'Fasilitas kesehatan & P3K.'],
      ['img' => 'assets/img/fasilitas-ibadah.jpg',  'title' => 'Ruang Ibadah',   'desc' => 'Nyaman & kondusif.'],
      ['img' => 'assets/img/fasilitas-olahraga.jpg','title' => 'Area Olahraga',  'desc' => 'Lapangan & peralatan lengkap.'],
    ];
    ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
      <?php foreach ($fasilitas as $f): ?>
        <article class="group rounded-2xl overflow-hidden bg-white border border-gray-100 shadow-sm hover:shadow-lg transition">
          <div class="aspect-[16/10] sm:aspect-[16/9] overflow-hidden">
            <img src="<?= asset($f['img']) ?>" alt="<?= htmlspecialchars($f['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
          </div>
          <div class="p-4 sm:p-5">
            <h3 class="font-semibold text-gray-900"><?= htmlspecialchars($f['title']) ?></h3>
            <p class="mt-1 text-gray-600 text-sm sm:text-base"><?= htmlspecialchars($f['desc']) ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-12 sm:py-14 bg-gradient-to-r from-purple-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">Ingin Tur Fasilitas?</h3>
      <p class="text-gray-600 mt-2 max-w-2xl mx-auto text-sm sm:text-base">Jadwalkan kunjungan sekolah untuk melihat langsung.</p>
      <a href="<?= url('kontak.php#daftar') ?>" class="inline-flex mt-6 px-5 sm:px-6 py-3 rounded-xl bg-purple-600 text-white hover:bg-purple-700 transition">Jadwalkan Kunjungan</a>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
