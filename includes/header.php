<?php /* Modern header ISR */ ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ignatius Slamet Riyadi (ISR Resinda)</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css" />
  <style>body{font-family:'Inter',system-ui,-apple-system,'Segoe UI',Roboto,Helvetica,Arial}</style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
  <nav class="sticky top-0 z-50 bg-white/90 backdrop-filter backdrop-blur border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex items-center justify-between h-16">
        <a href="/index.php" class="flex items-center">
          <img src="./assets/img/logo.png" alt="ISR" class="h-10 w-auto object-contain">
        </a>
        <div class="hidden md:flex items-center gap-6">
          <a class="text-sm font-medium text-gray-600 hover:text-gray-900" href="./index.php">Beranda</a>
          <a class="text-sm font-medium text-gray-600 hover:text-gray-900" href="./profil.php">Profil</a>
          <a class="text-sm font-medium text-gray-600 hover:text-gray-900" href="./visi-misi.php">Visi &amp; Misi</a>
          <a class="text-sm font-medium text-gray-600 hover:text-gray-900" href="./kegiatan.php">Kegiatan</a>
          <a class="text-sm font-medium text-gray-600 hover:text-gray-900" href="./galery.php">Galeri</a>
          <a class="text-sm font-semibold text-gray-900" href="./tk.php">TK</a>
          <a class="text-sm font-semibold text-gray-900" href="./sd.php">SD</a>
          <a class="text-sm font-semibold text-gray-900" href="./smp.php">SMP</a>
          <a class="text-sm font-semibold text-gray-900" href="./sma.php">SMA</a>
        </div>
        <div class="hidden md:flex items-center gap-3">
          <a class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold border border-gray-300 hover:border-gray-900" href="./kontak.php">Kontak</a>
          <a class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-yellow-500 text-black hover:opacity-90" href="./kontak.php#daftar">Daftar</a>
        </div>
        <button class="md:hidden inline-flex items-center justify-center rounded-xl border border-gray-300 px-3 py-2" onclick="document.getElementById('mnav').classList.toggle('hidden')">
          <span class="sr-only">Menu</span>☰
        </button>
      </div>
    </div>
    <div id="mnav" class="md:hidden hidden border-t border-gray-200">
      <div class="max-w-7xl mx-auto px-4 py-2 grid grid-cols-2 gap-2 text-sm">
        <a class="py-2" href="./index.php">Beranda</a>
        <a class="py-2" href="./profil.php">Profil</a>
        <a class="py-2" href="./visi-misi.php">Visi &amp; Misi</a>
        <a class="py-2" href="./kegiatan.php">Kegiatan</a>
        <a class="py-2" href="./galery.php">Galeri</a>
        <a class="py-2 font-semibold" href="/tk.php">TK</a>
        <a class="py-2 font-semibold" href="/sd.php">SD</a>
        <a class="py-2 font-semibold" href="/smp.php">SMP</a>
        <a class="py-2 font-semibold" href="/sma.php">SMA</a>
        <a class="py-2 col-span-2 text-center rounded-xl border border-gray-300" href="./kontak.php">Kontak</a>
        <a class="py-2 col-span-2 text-center rounded-xl bg-yellow-500 text-black" href="./kontak.php#daftar">Daftar</a>
      </div>
    </div>
  </nav>
  <main class="max-w-7xl mx-auto px-4 py-8 space-y-12">
