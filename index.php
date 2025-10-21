<style>
/* === ISR Sections Responsive Grid === */
.isr-container{max-width:1200px;margin:0 auto;padding:0 16px}
.isr-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;align-items:stretch}
.isr-card{background:#fff;border:1px solid #eaeaea;border-radius:16px;box-shadow:0 10px 24px rgba(0,0,0,.06);padding:22px;display:flex;gap:14px;transition:transform .2s ease,box-shadow .2s ease}
.isr-card:hover{transform:translateY(-4px);box-shadow:0 16px 36px rgba(0,0,0,.08)}
.isr-icon{flex:0 0 56px;width:56px;height:56px;border-radius:50%;background:#f6f7fb;display:flex;align-items:center;justify-content:center;overflow:hidden}
.isr-icon img{width:100%;height:100%;object-fit:cover;border-radius:50%}
.isr-card h5{margin:0 0 6px;font-weight:700;color:#111}
.isr-card p{margin:0;color:#4b5563;line-height:1.55}

/* Metrics (Prestasi) */
.metrics-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px}
.metric-card{background:#fff;border:1px solid #eaeaea;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,.06);padding:26px;text-align:center;transition:transform .2s ease,box-shadow .2s ease}
.metric-card:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(0,0,0,.08)}
.metric-badge{width:52px;height:52px;border-radius:14px;margin:0 auto 10px;display:flex;align-items:center;justify-content:center;color:#fff}
.badge-pink{background:linear-gradient(135deg,#f78ca0,#f9748f)}
.badge-green{background:linear-gradient(135deg,#56ab2f,#a8e063)}
.badge-blue{background:linear-gradient(135deg,#4facfe,#00f2fe)}
.badge-yellow{background:linear-gradient(135deg,#f6d365,#fda085)}
.metric-value{font-size:34px;font-weight:800;color:#111}
.metric-label{font-size:13px;color:#6b7280}

/* Partnership */
.partner-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(120px,1fr));gap:24px;align-items:center;justify-items:center}
.partner-grid img{max-height:64px;width:auto;opacity:.95;transition:transform .2s ease,opacity .2s ease}
.partner-grid img:hover{transform:translateY(-2px);opacity:1}
/* === ISR Headings (aman, tidak mengubah layout lain) === */
.isr-title{font-weight:800;letter-spacing:.2px;color:#111;margin-bottom:.25rem}
.isr-title .accent{
  background:linear-gradient(90deg,#0d6efd,#00b4d8);
  -webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent;
}
.isr-subtitle{color:#64748b;font-size:15.5px;line-height:1.6;margin:.25rem auto 1.25rem;max-width:720px}
@media (min-width:992px){.isr-title{font-size:32px}.isr-subtitle{font-size:16px}}
@media (max-width:991.98px){.isr-title{font-size:26px}}
/* Konsistensi padding vertikal section ISR */
.isr-sec{
  /* 2rem (32px) di HP → 3rem (48px) di desktop */
  padding-top: clamp(2rem, 3vw, 3rem) !important;
  padding-bottom: clamp(2rem, 3vw, 3rem) !important;
}
/* Jarak atas-bawah lebih ketat (opsional) */
.isr-sec-tight{
  padding-top: clamp(1.5rem, 2.5vw, 2.25rem) !important;
  padding-bottom: clamp(1.5rem, 2.5vw, 2.25rem) !important;
}
/* === Vertical rhythm ISR: rapetin jarak antar section === */

/* 1) Tentang Sekolah: kecilkan padding bawah */
#tentang{
  padding-bottom: 1.5rem !important;
  margin-bottom: 0 !important;
}

/* 2) Semua section SETELAH Tentang Sekolah dirapatkan bagian atasnya */
#tentang ~ section{
  margin-top: 0 !important;
  padding-top: 1.5rem !important;         /* HP */
}
@media (min-width: 992px){
  #tentang ~ section{
    padding-top: 1.75rem !important;      /* Desktop */
  }
}

/* 3) Standar padding vertikal untuk section-section bawah */
.isr-sec{
  padding-bottom: 1.75rem !important;     /* bawah seragam */
}
@media (max-width: 991.98px){
  .isr-sec{ padding-bottom: 1.5rem !important; }
}

/* 4) Jarak antar section bawah (Announcement → Prestasi → Partnership) */
.isr-sec + .isr-sec{
  margin-top: 0 !important;
  padding-top: 1.25rem !important;        /* lebih rapat antar section berurutan */
}

/* 5) (Opsional) rapetin jarak ke footer */
.footer-tight{ margin-top: 2.5rem !important; } /* ganti mt-16 → class ini */
#heroCarousel { position: relative; }
#heroCarousel .carousel-slide{
  position: absolute; inset: 0;
  opacity: 0; transition: opacity 1s ease-in-out;
}
#heroCarousel .carousel-slide.is-active{
  opacity: 1;
  z-index: 2; /* di atas slide lainnya */
}
</style>
<script>
document.addEventListener("DOMContentLoaded", function(){
  const items = document.querySelectorAll(".metric-value");
  const io = new IntersectionObserver((ents, obs)=>{
    ents.forEach(e=>{
      if(e.isIntersecting){
        const el=e.target, target=+el.dataset.count; let cur=0;
        const inc=Math.max(1,Math.floor(target/120));
        const step=()=>{cur+=inc; if(cur>=target){el.textContent=target.toLocaleString();}
                        else{el.textContent=cur.toLocaleString(); requestAnimationFrame(step);} };
        step(); obs.unobserve(el);
      }
    });
  },{threshold:.6});
  items.forEach(i=>io.observe(i));
});
</script>

<?php include("includes/header.php"); ?>

<!-- Banner Index dengan Overlay Gelap (Tailwind v2 compatible) -->
<section class="relative rounded-2xl overflow-hidden border border-gray-200">
  <!-- Carousel wrapper -->
  <div class="relative w-full h-72 md:h-96 overflow-hidden"  id="heroCarousel">
    <!-- Slide 1 -->
<div class="absolute inset-0 transition-opacity duration-1000 ease-in-out carousel-slide is-active">
  <img src="./assets/img/banner.jpg" alt="ISR Resinda" class="w-full h-full object-cover">
  <div class="absolute inset-0 bg-black bg-opacity-60"></div>
</div>

    <!-- Slide 2 -->
<div class="absolute inset-0 transition-opacity duration-1000 ease-in-out carousel-slide">
  <img src="./assets/img/banner2.jpg" alt="ISR Pengetahuan" class="w-full h-full object-cover">
  <div class="absolute inset-0 bg-black bg-opacity-60"></div>
</div>


  </div>

  <!-- ✅ Teks & tombol tetap di bawah (posisi aslinya) -->
<!-- Overlay teks: dorong ke atas dengan padding-bottom -->
<div class="absolute inset-0 z-10 flex items-end">
  <div class="w-full text-white px-6 md:px-10 pb-14 md:pb-24">
    <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight">
      Ignatius Slamet Riyadi (ISR Resinda)
    </h1>
    <p class="mt-3 md:mt-4 text-base md:text-lg opacity-95">
      TK • SD • SMP • SMA — Modern, Profesional, &amp; Berkarakter
    </p>
    <div class="mt-5 flex gap-3">
      <a href="./profil.php"
         class="inline-flex items-center px-5 py-3 rounded-xl text-sm font-semibold bg-yellow-500 text-black hover:opacity-90">
        Lihat Profil
      </a>
      <a href="./kontak.php#daftar"
         class="inline-flex items-center px-5 py-3 rounded-xl text-sm font-semibold border border-white hover:border-white">
        Daftar
      </a>
    </div>
  </div>
</div>

  <!-- Dots (v2: pakai opacity util) -->
  <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
    <button class="w-3 h-3 rounded-full bg-white opacity-70 hover:opacity-100 transition" data-slide="0"></button>
    <button class="w-3 h-3 rounded-full bg-white opacity-40 hover:opacity-100 transition" data-slide="1"></button>

  </div>
</section>

<!-- Script Carousel -->
<script>
(function(){
  var slides = Array.from(document.querySelectorAll('#heroCarousel .carousel-slide'));
  if (!slides.length) return;

  // Dots yang valid = sebanyak jumlah slide
  var dots = Array.from(document.querySelectorAll('[data-slide]')).slice(0, slides.length);
  var current = Math.max(0, slides.findIndex(s => s.classList.contains('is-active')));
  if (current === -1) { current = 0; slides[0].classList.add('is-active'); }

  function show(i){
    i = (i % slides.length + slides.length) % slides.length;
    if (i === current) return;
    slides[current].classList.remove('is-active');
    slides[i].classList.add('is-active');
    dots.forEach((d, idx)=>{
      d.classList.toggle('opacity-70', idx === i);
      d.classList.toggle('opacity-40', idx !== i);
    });
    current = i;
  }

  function next(){ show(current + 1); }

  var timer = setInterval(next, 5000);
  dots.forEach((dot, i)=>{
    dot.addEventListener('click', function(){
      clearInterval(timer);
      show(i);
      timer = setInterval(next, 5000);
    });
  });
})();
</script>


<!-- END -->

<section class="grid md:grid-cols-4 gap-6">
  
  <a href="./tk.php" class="group rounded-2xl border border-gray-200 bg-white hover:shadow p-6 flex flex-col">
    <div class="text-sm text-gray-500">Jenjang</div>
    <div class="mt-1 text-xl font-bold">TK</div>
    <p class="mt-2 text-gray-600 flex-1">Kurikulum Merdeka & Entrepreneurship dengan sistem SKS.</p>
    <div class="mt-4 inline-flex items-center gap-2 text-sm font-semibold group-hover:gap-3">
      Pelajari lebih lanjut →
    </div>
  </a>
  <a href="./sd.php" class="group rounded-2xl border border-gray-200 bg-white hover:shadow p-6 flex flex-col">
    <div class="text-sm text-gray-500">Jenjang</div>
    <div class="mt-1 text-xl font-bold">SD</div>
    <p class="mt-2 text-gray-600 flex-1">Kurikulum Merdeka & Entrepreneurship dengan sistem SKS.</p>
    <div class="mt-4 inline-flex items-center gap-2 text-sm font-semibold group-hover:gap-3">
      Pelajari lebih lanjut →
    </div>
  </a>
  <a href="./smp.php" class="group rounded-2xl border border-gray-200 bg-white hover:shadow p-6 flex flex-col">
    <div class="text-sm text-gray-500">Jenjang</div>
    <div class="mt-1 text-xl font-bold">SMP</div>
    <p class="mt-2 text-gray-600 flex-1">Kurikulum Merdeka & Entrepreneurship dengan sistem SKS.</p>
    <div class="mt-4 inline-flex items-center gap-2 text-sm font-semibold group-hover:gap-3">
      Pelajari lebih lanjut →
    </div>
  </a>
  <a href="./sma.php" class="group rounded-2xl border border-gray-200 bg-white hover:shadow p-6 flex flex-col">
    <div class="text-sm text-gray-500">Jenjang</div>
    <div class="mt-1 text-xl font-bold">SMA</div>
    <p class="mt-2 text-gray-600 flex-1">Kurikulum Merdeka & Entrepreneurship dengan sistem SKS.</p>
    <div class="mt-4 inline-flex items-center gap-2 text-sm font-semibold group-hover:gap-3">
      Pelajari lebih lanjut →
    </div>
  </a>
</section>

<section id="tentang" class="rounded-2xl border border-gray-200 bg-white p-6 md:p-10">
  <h2 class="text-center text-2xl md:text-3xl font-extrabold">Tentang Sekolah</h2>
  <p class="text-center mt-4 text-gray-700">Ignatius Slamet Riyadi didirikan pada tahun 2006, dan telah meluluskan 10 lulusan, banyak di antaranya adalah profesional di institusi terbaik di Indonesia. Sekolah kami menerapkan Kurikulum Merdeka serta Entrepreneurship, dengan sistem SKS, sebagai satu-satunya sekolah di Karawang yang menerapkan sistem ini.</p>
  <div class="mt-6 md:mt-8">
  <div class="relative rounded-xl overflow-hidden border border-gray-200 shadow-sm">
    <p class="sr-only">Video Profil Sekolah</p>
    <div class="relative w-full" style="padding-top:56.25%;">
      <video class="absolute inset-0 w-full h-full"
             controls preload="metadata" playsinline
             poster="./assets/img/banner.jpg">
        <source src="./assets/video/profil.mp4" type="video/mp4">
        Browser Anda tidak mendukung pemutar video HTML5.
      </video>
    </div>
  </div>
</div>
</section>

<!-- Announcement ISR (responsive grid) -->
<section id="announcement" class="wrapper bg-light py-10 isr-sec">
  <div class="isr-container">
    <div class="text-center mb-4">
      <h2 class="isr-title"><span class="accent">Announcement</span> ISR</h2>
      <p class="isr-subtitle">Ignatius Slamet Riyadi</p>
    </div>

    <div class="isr-grid">
      <div class="isr-card">
        <div class="isr-icon"><img src="./assets/img/AnnouncementSdSmpSma.png" alt="TK"></div>
        <div><h5>TK</h5><p>Humaniora School, Basic Life Skill, Full Day School, Environmental Learning Activity</p></div>
      </div>
      <div class="isr-card">
        <div class="isr-icon"><img src="./assets/img/AnnouncementSdSmpSma.png" alt="SD"></div>
        <div><h5>SD</h5><p>Green School Project, Healthy Lunch Program, Kompetisi Akademik & Non-Akademik, Show Your Talent Day, Digital Learning Corner, Bilingual Exposure</p></div>
      </div>
      <div class="isr-card">
        <div class="isr-icon"><img src="./assets/img/AnnouncementSdSmpSma.png" alt="SMP"></div>
        <div><h5>SMP</h5><p>Talent development, English Program, Good Relationship, Good Character & Leadership Building</p></div>
      </div>
      <div class="isr-card">
        <div class="isr-icon"><img src="./assets/img/AnnouncementSdSmpSma.png" alt="SMA"></div>
        <div><h5>SMA</h5><p>School of Entrepreneurship, Project Based Learning, Pembelajaran Digital, Moving Class, Kelas Kecil, Layanan Prima, Pengembangan Minat & Bakat</p></div>
      </div>
      <div class="isr-card">
        <div class="isr-icon"><img src="./assets/img/Announcementketakwaan.jpg" alt="Ketaqwaan"></div>
        <div><h5>Ketaqwaan kepada Tuhan YME</h5><p>Memfasilitasi ibadah sesuai agama & kepercayaan masing-masing.</p></div>
      </div>
      <div class="isr-card">
        <div class="isr-icon"><img src="./assets/img/AnnouncementPenguasaan.png" alt="IPTEK"></div>
        <div><h5>Penguasaan Ilmu Pengetahuan dan Teknologi</h5><p>Peserta didik dituntut menguasai ilmu pengetahuan & teknologi dengan baik.</p></div>
      </div>
    </div>
  </div>
</section>

<!-- Prestasi & Pencapaian Kami (responsive metrics) -->
<section id="prestasi" class="wrapper bg-light py-5 isr-sec">
  <div class="isr-container">
    <div class="text-center mb-4">
      <h2 class="isr-title">Prestasi &amp; Pencapaian Kami</h2>
      <p class="isr-subtitle">Angka-angka berikut menunjukkan komitmen kami dalam memberikan pelayanan dan kualitas terbaik.</p>
    </div>

    <div class="metrics-grid">
      <div class="metric-card">
        <div class="metric-badge badge-pink">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="7" r="4"/><path d="M7 18c0-2.761 2.239-5 5-5h4c2.761 0 5 2.239 5 5v2H7v-2z"/></svg>
        </div>
        <div class="metric-value" data-count="3472">0</div>
        <div class="metric-label">Happy Customers</div>
      </div>

      <div class="metric-card">
        <div class="metric-badge badge-green">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.2l-3.5-3.5L4 14.2 9 19l11-11-1.5-1.5z"/></svg>
        </div>
        <div class="metric-value" data-count="4537">0</div>
        <div class="metric-label">Expert Employees</div>
      </div>

      <div class="metric-card">
        <div class="metric-badge badge-blue">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M17 3H7v3H3v3c0 3.31 2.69 6 6 6h6c3.31 0 6-2.69 6-6V6h-4V3zM8 21h8v-2H8v2z"/></svg>
        </div>
        <div class="metric-value" data-count="2654">0</div>
        <div class="metric-label">Awards Won</div>
      </div>

      <div class="metric-card">
        <div class="metric-badge badge-yellow">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM3.18 12.4L1 13.5 12 19l3.5-1.86V15L12 18 3.18 12.4z"/></svg>
        </div>
        <div class="metric-value" data-count="1789">0</div>
        <div class="metric-label">Graduated Students</div>
      </div>
    </div>
  </div>
</section>
<style>
.metric-card{background:#fff;border:0;box-shadow:0 10px 30px rgba(0,0,0,.06);border-radius:16px;padding:28px;display:flex;flex-direction:column;align-items:center;gap:10px;transition:transform .25s ease,box-shadow .25s ease}
.metric-card:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(0,0,0,.08)}
.metric-icon{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;color:#fff;margin-bottom:8px}
.bg-gradient-pink{background:linear-gradient(135deg,#f78ca0,#f9748f)}
.bg-gradient-green{background:linear-gradient(135deg,#56ab2f,#a8e063)}
.bg-gradient-blue{background:linear-gradient(135deg,#4facfe,#00f2fe)}
.bg-gradient-yellow{background:linear-gradient(135deg,#f6d365,#fda085)}
.metric-value{font-size:34px;font-weight:800;color:#1f2937;line-height:1}
.metric-label{font-size:13px;color:#6b7280}
</style>
<script>
document.addEventListener("DOMContentLoaded", () => { 
  const counters = document.querySelectorAll(".metric-value");
  const opt = { threshold: 0.6 };
  const animate = (el) => { const target = +el.dataset.count; let cur = 0; const inc = Math.max(1, Math.floor(target/120));
    const step = () => { cur += inc; if(cur >= target){ el.textContent = target.toLocaleString(); } else { el.textContent = cur.toLocaleString(); requestAnimationFrame(step);} }; step(); };
  const io = new IntersectionObserver((ents, obs)=>{ ents.forEach(e=>{ if(e.isIntersecting){ animate(e.target); obs.unobserve(e.target);} }); }, opt);
  counters.forEach(c=>io.observe(c));
});
</script>

<!-- Partnership (responsive enlarged logos) -->
<section id="partnership" class="wrapper bg-light py-8 isr-sec">
  <div class="isr-container">
    <div class="text-center mb-6">
      <h2 class="isr-title">Partnership</h2>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 items-center justify-items-center">
      <img src="./assets/img/Patnership1.png" alt="Partner 1"
           class="w-32 sm:w-40 md:w-48 lg:w-56 h-auto object-contain transition-transform transform hover:scale-105">
      <img src="./assets/img/Patnership2.png" alt="Partner 2"
           class="w-32 sm:w-40 md:w-48 lg:w-56 h-auto object-contain transition-transform transform hover:scale-105">
      <img src="./assets/img/Patnership3.png" alt="Partner 3"
           class="w-32 sm:w-40 md:w-48 lg:w-56 h-auto object-contain transition-transform transform hover:scale-105">
      <img src="./assets/img/Patnership4.png" alt="Partner 4"
           class="w-32 sm:w-40 md:w-48 lg:w-56 h-auto object-contain transition-transform transform hover:scale-105">
    </div>
  </div>
</section>
<?php include("includes/footer.php"); ?>