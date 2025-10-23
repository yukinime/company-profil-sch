<?php
require_once __DIR__ . '/../includes/config.php';
?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<main class="min-h-screen">
<!-- HERO: Contoh Fasilitas -->
<section class="relative rounded-2xl overflow-hidden border border-gray-200 shadow-lg">
  <div class="h-64 md:h-80 relative">
    <img src="<?= asset('assets/img/banner.jpg') ?>" alt="Contoh Fasilitas"
         class="absolute inset-0 w-full h-full object-cover">
    <div class="absolute inset-0 bg-black opacity-60"></div>

    <div class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center p-6 md:p-10 text-white">
      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">Contoh Fasilitas: Lab Komputer</h1>
      <p class="mt-3 md:mt-4 text-base md:text-lg opacity-95">
        Perangkat terkini · Internet stabil · Project-based learning
      </p>
      <div class="mt-5 flex flex-col sm:flex-row gap-3">
        <a href="<?= url('fasilitas/index.php') ?>"
           class="inline-flex items-center justify-center px-5 py-3 rounded-xl text-sm font-semibold text-white shadow-md transition"
           style="background-color:#6D28D9">Kembali ke Fasilitas</a>

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


  <!-- KONTEN -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
    <div class="grid lg:grid-cols-2 gap-6 lg:gap-10">
      <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
        <div class="aspect-[16/10] sm:aspect-[16/9]">
          <img src="<?= asset('assets/img/fasilitas-lab.jpg') ?>" alt="Contoh Lab Komputer" class="w-full h-full object-cover">
        </div>
      </div>
      <div>
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Spesifikasi & Keunggulan</h2>
        <ul class="mt-4 space-y-2 text-gray-700 text-sm sm:text-base">
          <li>• 30+ unit komputer spesifikasi terbaru</li>
          <li>• Internet cepat & stabil</li>
          <li>• Proyektor & sistem audio</li>
          <li>• Pengawasan guru & SOP keamanan</li>
        </ul>

        <div class="mt-6 p-5 rounded-2xl bg-purple-50 border border-purple-100">
          <h3 class="font-semibold text-purple-900">Jadwalkan Kunjungan</h3>
          <p class="text-purple-800/80 mt-1 text-sm sm:text-base">Ingin melihat langsung? Kami siap atur jadwal tur fasilitas.</p>
          <a href="<?= url('kontak.php#daftar') ?>" class="inline-block mt-4 px-5 py-2.5 rounded-xl bg-purple-600 text-white hover:bg-purple-700">Hubungi Kami</a>
        </div>
      </div>
    </div>

    <!-- Lainnya -->
    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
      <?php
      $more = [
        ['img'=>'assets/img/fasilitas-olahraga.jpg','title'=>'Area Olahraga'],
        ['img'=>'assets/img/fasilitas-perpus.jpg', 'title'=>'Perpustakaan'],
        ['img'=>'assets/img/fasilitas-uks.jpg',    'title'=>'UKS'],
      ];
      foreach ($more as $m): ?>
        <div class="rounded-2xl overflow-hidden bg-white border border-gray-100 shadow-sm hover:shadow-md transition">
          <div class="aspect-[16/10]">
            <img src="<?= asset($m['img']) ?>" alt="<?= htmlspecialchars($m['title']) ?>" class="w-full h-full object-cover">
          </div>
          <div class="p-4">
            <div class="font-semibold text-gray-900"><?= htmlspecialchars($m['title']) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
