<?php
require_once __DIR__ . '/includes/config.php'; 
include 'includes/header.php'; 

// Ambil berita terbaru
require_once __DIR__ . '/models/Berita.php';
$beritaModel = new Berita();
$latestBerita = $beritaModel->getLatest(6);
?>

<style>
  .berita-section-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
    transition: all 0.4s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .berita-section-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 50px rgba(34, 139, 34, 0.2);
  }

  .berita-section-card-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    position: relative;
  }

  .berita-section-card-body {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .berita-section-category {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    background: rgba(34, 139, 34, 0.1);
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 700;
    color: #228B22;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
    width: fit-content;
  }

  .berita-section-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 0.85rem;
    color: #666;
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid #f0f0f0;
  }

  .berita-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(8px);
    z-index: 99999;
    overflow-y: auto;
    padding: 2rem;
  }

  .berita-modal.active {
    display: flex;
    align-items: flex-start;
    justify-content: center;
  }

  .berita-modal-content {
    background: white;
    border-radius: 24px;
    max-width: 900px;
    width: 100%;
    margin: 2rem auto;
    position: relative;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.5);
    overflow: hidden;
  }

  .berita-modal-close {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.95);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }

  .berita-modal-close:hover {
    background: #ff4444;
    transform: rotate(90deg) scale(1.1);
  }

  .berita-modal-close svg {
    width: 24px;
    height: 24px;
    stroke: #333;
    transition: stroke 0.3s ease;
  }

  .berita-modal-close:hover svg {
    stroke: white;
  }

  .berita-modal-header-img {
    width: 100%;
    height: 400px;
    object-fit: cover;
  }

  .berita-modal-body {
    padding: 2rem 3rem 3rem;
    max-height: 70vh;
    overflow-y: auto;
  }

  .berita-modal-body::-webkit-scrollbar {
    width: 8px;
  }

  .berita-modal-body::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  .berita-modal-body::-webkit-scrollbar-thumb {
    background: #228B22;
    border-radius: 4px;
  }

  .berita-modal-body::-webkit-scrollbar-thumb:hover {
    background: #1a6b1a;
  }

  .berita-content {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #333;
  }

  .berita-content p {
    margin-bottom: 1rem;
  }

  @media (max-width: 768px) {
    .berita-modal-content {
      margin: 1rem;
    }
    
    .berita-modal-header-img {
      height: 250px;
    }

    .berita-modal-body {
      padding: 1.5rem;
    }

    .berita-modal-close {
      top: 1rem;
      right: 1rem;
      width: 40px;
      height: 40px;
    }
  }

  /* Custom Animations */
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
  }

  @keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
  }

  @keyframes slideInRight {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
  }

  @keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
  }

  .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
  .animate-float { animation: float 3s ease-in-out infinite; }
  .animate-slide-in-left { animation: slideInLeft 0.8s ease-out forwards; }
  .animate-slide-in-right { animation: slideInRight 0.8s ease-out forwards; }
  .animate-pulse { animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }

  /* PMB Popup Overlay */
  .pmb-popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(8px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.4s ease;
  }

  .pmb-popup-overlay.active {
    opacity: 1;
    visibility: visible;
  }

  .pmb-popup-container {
    position: relative;
    max-width: 95vw;
    max-height: 95vh;
    width: auto;
    height: auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.5);
    overflow: hidden;
    transform: scale(0.9);
    transition: transform 0.4s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .pmb-popup-overlay.active .pmb-popup-container {
    transform: scale(1);
  }

  .pmb-close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.95);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }

  .pmb-close-btn:hover {
    background: #ff4444;
    transform: rotate(90deg) scale(1.1);
  }

  .pmb-close-btn svg {
    width: 24px;
    height: 24px;
    stroke: #333;
    transition: stroke 0.3s ease;
  }

  .pmb-close-btn:hover svg {
    stroke: white;
  }

  .pmb-popup-content {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: auto;
    max-height: 95vh;
  }

  .pmb-popup-content img {
    max-width: 100%;
    max-height: 95vh;
    width: auto;
    height: auto;
    object-fit: contain;
    display: block;
  }

  .pmb-floating-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
    border-radius: 15px;
    cursor: pointer;
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9998;
    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    transition: all 0.3s ease;
    overflow: hidden;
  }

  .pmb-floating-btn.active {
    display: flex;
  }

  .pmb-floating-btn:hover {
    transform: scale(1.1) translateY(-5px);
    box-shadow: 0 12px 35px rgba(255, 107, 53, 0.6);
  }

  .pmb-floating-btn img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  @keyframes pulseRing {
    0% {
      transform: scale(1);
      opacity: 1;
    }
    100% {
      transform: scale(1.5);
      opacity: 0;
    }
  }

  .pmb-floating-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 15px;
    border: 3px solid #FF6B35;
    animation: pulseRing 2s infinite;
  }

  @media (max-width: 768px) {
    .pmb-popup-container {
      max-width: 98vw;
      max-height: 98vh;
      border-radius: 15px;
    }

    .pmb-popup-content img {
      max-height: 98vh;
    }

    .pmb-close-btn {
      width: 40px;
      height: 40px;
      top: 10px;
      right: 10px;
    }

    .pmb-floating-btn {
      width: 60px;
      height: 60px;
      bottom: 20px;
      right: 20px;
      border-radius: 12px;
    }

    .pmb-floating-btn::before {
      border-radius: 12px;
    }
  }

  .pmb-popup-content::-webkit-scrollbar {
    width: 8px;
    height: 8px;
  }

  .pmb-popup-content::-webkit-scrollbar-track {
    background: #f1f1f1;
  }

  .pmb-popup-content::-webkit-scrollbar-thumb {
    background: #FF6B35;
    border-radius: 4px;
  }

  .pmb-popup-content::-webkit-scrollbar-thumb:hover {
    background: #F7931E;
  }

  .video-hero {
    position: relative;
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    height: 85vh;
    min-height: 600px;
    max-height: 900px;
    overflow: hidden;
  }

  .video-hero video {
    position: absolute;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    transform: translate(-50%, -50%);
    object-fit: cover;
  }

  .video-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(34, 139, 34, 0.6) 100%);
    z-index: 1;
  }

  .video-content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .gradient-text {
    background: linear-gradient(90deg, #228B22, #FFD700);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .welcome-bg {
    background: linear-gradient(135deg, #228B22 0%, #32CD32 100%);
    border-radius: 30px;
    position: relative;
    overflow: hidden;
  }

  .welcome-bg::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    animation: float 6s ease-in-out infinite;
  }

  .welcome-bg::after {
    content: '';
    position: absolute;
    bottom: -50%;
    left: -50%;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
    animation: float 8s ease-in-out infinite reverse;
  }

  .timeline-item {
    position: relative;
    padding-left: 50px;
    margin-bottom: 2.5rem;
  }

  .timeline-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 5px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: linear-gradient(135deg, #228B22, #FFD700);
    box-shadow: 0 0 0 6px rgba(34, 139, 34, 0.15);
  }

  .timeline-item::after {
    content: '';
    position: absolute;
    left: 8px;
    top: 25px;
    width: 2px;
    height: calc(100% + 15px);
    background: linear-gradient(180deg, #228B22, transparent);
  }

  .timeline-item:last-child::after {
    display: none;
  }

  .modern-card {
    background: white;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease;
    overflow: hidden;
    position: relative;
    border: 1px solid rgba(34, 139, 34, 0.1);
  }

  .modern-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, #228B22, #FFD700);
    transform: scaleX(0);
    transition: transform 0.4s ease;
  }

  .modern-card:hover::before {
    transform: scaleX(1);
  }

  .modern-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(34, 139, 34, 0.2);
    border-color: rgba(34, 139, 34, 0.3);
  }

  .stat-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 20px;
    padding: 32px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
  }

  .stat-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
  }

  .stat-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 20px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
  }

  .section-spacing {
    padding: 5rem 1rem;
  }

  @media (max-width: 768px) {
    .section-spacing {
      padding: 3rem 1rem;
    }
    .video-hero {
      height: 70vh;
      min-height: 500px;
    }
  }

  .announcement-card {
    background: white;
    border-radius: 20px;
    padding: 28px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
    display: flex;
    gap: 24px;
    align-items: start;
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
  }

  .announcement-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 45px rgba(34, 139, 34, 0.15);
    border-color: rgba(34, 139, 34, 0.2);
  }

  .announcement-icon {
    flex-shrink: 0;
    width: 72px;
    height: 72px;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #f0fff0, #e0ffe0);
    padding: 4px;
    border: 2px solid rgba(34, 139, 34, 0.1);
  }

  .announcement-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
  }

  .partner-logo {
    filter: grayscale(100%);
    opacity: 0.6;
    transition: all 0.3s ease;
  }

  .partner-logo:hover {
    filter: grayscale(0%);
    opacity: 1;
    transform: scale(1.08);
  }

  .history-card {
    background: white;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
  }

  .scroll-reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s ease;
  }

  .scroll-reveal.active {
    opacity: 1;
    transform: translateY(0);
  }

  .cta-btn {
    position: relative;
    overflow: hidden;
  }

  .cta-btn::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
  }

  .cta-btn:hover::after {
    width: 300px;
    height: 300px;
  }

  .video-wrapper {
    position: relative;
    background: #000;
  }

  .badge-modern {
    display: inline-flex;
    align-items: center;
    padding: 8px 20px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .pmb-banner {
    background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
    border-radius: 25px;
    padding: 40px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(255, 107, 53, 0.3);
  }

  .pmb-banner::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite;
  }

  .pmb-banner::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite reverse;
  }

  .pmb-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    padding: 10px 25px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.9rem;
    letter-spacing: 1px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    animation: pulse 2s ease-in-out infinite;
  }

  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-slide-up {
    animation: slideUp 0.8s ease-out forwards;
  }

@media (max-width: 640px){
  .video-hero { height: 78vh; min-height: 480px; }
  .section-spacing { padding: 3.5rem 1rem; }
}
@media (max-width: 480px){
  .video-hero { height: 72vh; min-height: 420px; }
}
</style>

<!-- PMB Popup Overlay -->
<div class="pmb-popup-overlay" id="pmbPopup">
  <div class="pmb-popup-container">
    <button class="pmb-close-btn" id="closePmbPopup" aria-label="Close">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
    <div class="pmb-popup-content">
      <img src="<?= asset('assets/img/pmb.jpg') ?>" alt="Brosur Penerimaan Murid Baru 2025/2026" loading="eager">
    </div>
  </div>
</div>

<!-- PMB Floating Button -->
<div class="pmb-floating-btn" id="pmbFloatingBtn">
  <img src="<?= asset('assets/img/pmb.jpg') ?>" alt="PMB">
</div>

<!-- Full Width Video Hero Section -->
<section class="video-hero">
  <video autoplay muted loop playsinline>
    <source src="<?= asset('assets/video/profil.mp4') ?>" type="video/mp4">
  </video>
  <div class="video-overlay"></div>
  <div class="video-content">
    <div class="max-w-5xl mx-auto px-6 py-16 md:py-24 lg:py-28 text-center text-white">
      <div class="animate-fade-in-up">
        <div class="badge-modern inline-flex items-center mb-6">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
          </svg>
          Terakreditasi A
        </div>
        
        <h1 class="text-3xl sm:text-2xl md:text-4xl lg:text-5xl lg:text-7xl font-extrabold mb-6 leading-tight tracking-tight">
            Ignatius Slamet Riyadi
        </h1>
        
        <p class="text-xl md:text-3xl mb-3 font-bold opacity-95">
          Yayasan Salib Suci
        </p>
    
        <p class="text-base md:text-lg mb-8 md:mb-12 opacity-85 max-w-3xl mx-auto leading-relaxed">
          Modern, Profesional, & Berkarakter dengan Kurikulum Merdeka & Entrepreneurship
        </p>
        
        <div class="flex flex-wrap gap-4 justify-center">
          <a href="#tentang" class="cta-btn inline-flex items-center px-10 py-5 rounded-full text-lg font-bold bg-green-500 text-white hover:bg-green-400 transition-all transform hover:scale-105 shadow-2xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            Jelajahi Sekolah Kami
          </a>
          <a href="#daftar" class="cta-btn text-black inline-flex items-center px-10 py-5 rounded-full text-lg font-bold border-2 border-white hover:bg-white hover:text-green-600 transition-all backdrop-blur-sm bg-white/10">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Daftar Sekarang
          </a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
    <svg class="w-8 h-8 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
    </svg>
  </div>
</section>

<div class="max-w-7xl mx-auto px-4 md:px-6 py-8">

  <!-- PMB Information Section -->
  <section class="section-spacing scroll-reveal" id="pmb">
    <div class="pmb-banner text-white relative z-10">
      <div class="relative z-10">
        <div class="text-center mb-8">
          <div class="pmb-badge mb-6">
            🎓 PENERIMAAN PESERTA DIDIK BARU 2025/2026
          </div>
          <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-6 leading-tight">
            Bergabunglah Bersama Kami!
          </h2>
          <p class="text-xl md:text-2xl mb-10 opacity-95 max-w-3xl mx-auto">
            Pendaftaran dibuka untuk TK/SD/SMP/SMA. Raih masa depan gemilang bersama ISR Resinda Karawang.
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-10">
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border-2 border-white/20 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-white/20 rounded-full flex items-center justify-center">
              <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
              </svg>
            </div>
            <h3 class="text-2xl font-bold mb-2">Beasiswa Tersedia</h3>
            <p class="opacity-90">Program beasiswa untuk siswa berprestasi</p>
          </div>
        </div>

        <div class="text-center">
          <a href="<?= url('kontak.php#daftar') ?>" class="inline-flex items-center px-12 py-5 text-orange-600  bg-dark rounded-full text-lg font-bold hover:bg-gray-100 transition-all transform hover:scale-105 shadow-2xl">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Daftar Sekarang - PMB 2025/2026
          </a>
          <p class="mt-6 text-sm opacity-90">
            <strong>Hubungi Kami:</strong> (0267) 8604065 | info@smaslametriyadi-karawang.sch.id
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Welcome Section -->
  <section class="section-spacing scroll-reveal" id="welcome">
    <div class="welcome-bg text-white p-10 md:p-20 relative">
      <div class="relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-12">
          <div class="md:w-1/3 text-center">
            <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 inline-block">
              <img src="<?= asset('assets/img/yayasan.png') ?>" alt="Logo SD Ignatius Slamet Riyadi" class="w-56 h-56 mx-auto animate-float drop-shadow-2xl">
            </div>
          </div>
          <div class="md:w-2/3">
            <div class="mb-8">
              <div class="inline-block px-6 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white font-semibold mb-4">
                Sambutan Kepala Sekolah
              </div>
              <h2 class="text-3xl md:text-5xl font-extrabold mb-6 leading-tight">
                SELAMAT DATANG DI WEBSITE<br> YAYASAN SALIB SUCI
              </h2>
              <h3 class="text-xl md:text-2xl font-bold mb-6">
                IGNATIUS SLAMET RIYADI RESINDA KARAWANG
              </h3>
            </div>
            
            <div class="space-y-5 text-base md:text-lg leading-relaxed opacity-95">
              <p class="font-semibold text-yellow-300">
                Yayasan Salib Suci merupakan sebuah Yayasan Pendidikan penyelenggara pendidikan dasar dan menengah dengan jumlah sekolah, murid, dan guru paling banyak di wilayah Kabupaten Bandung, dengan sekolah-sekolah yang tersebar di semua wilayah di mana terdapat umat Katolik.
              </p>
              
              <p>
                Karya besar penyelenggaraan pendidikan sampai hari ini terus berlangsung. Tercatat <strong class="text-yellow-400">69 sekolah</strong> yang tersebar di Jawa Barat, di antaranya Bandung, Kabupaten Bandung, Purwakarta, Karawang, Subang, Pamanukan, Jatibarang, Indramayu, Cirebon, Ciledug, Cigugur, Cisantana.
              </p>
              
              <p>
                 Dikelola oleh lebih dari <strong class="text-yellow-400">1.100 guru/pegawai</strong>, dan melayani lebih dari <strong class="text-yellow-400">12.000 siswa</strong> di seluruh Jawa Barat.
              </p>
              
              <p>
                Website ini hadir sebagai jendela informasi terdepan mengenai seluruh program, prestasi, dan perkembangan sekolah Ignatius Slamet Riyadi. Tujuan kehadiran website ini adalah untuk menyampaikan informasi kegiatan sekolah sehingga seluruh orang tua, calon peserta didik, alumni, dan masyarakat luas dapat mengikuti perkembangan terkini seputar sekolah Ignatius Slamet Riyadi Resinda Karawang.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sejarah Section -->
  <section class="section-spacing bg-white rounded-3xl scroll-reveal" id="sejarah">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-20">
        <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
          Sejarah Kami
        </div>
        <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-6">
          <span class="gradient-text">Sejarah</span> Yayasan Salib Suci
        </h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
          Perjalanan panjang dedikasi dalam dunia pendidikan sejak 1927
        </p>
      </div>

      <div class="grid md:grid-cols-2 gap-16 items-center">
        <div class="order-2 md:order-1">
          <div class="history-card">
            <div class="space-y-6">
              <div class="timeline-item">
                <h3 class="text-2xl font-bold mb-3 text-gray-900">9 Februari 1927</h3>
                <p class="text-gray-700 leading-relaxed">
                  Sejarah berawal ketika tiga orang Imam Ordo Salib Suci tiba di Bandung: <strong>Pst. J. H. Goumans, OSC</strong>, <strong>Pst. M. Nillesen, OSC</strong>, dan <strong>Pst. J. de Rooj, OSC</strong>.
                </p>
              </div>

              <div class="timeline-item">
                <h3 class="text-2xl font-bold mb-3 text-gray-900">Agustus 1927</h3>
                <p class="text-gray-700 leading-relaxed">
                  Pada masa awal tugasnya, Pst. J. H. Goumans memusatkan perhatian pada pendirian sekolah-sekolah dengan bermodalkan uang sebesar <strong>100 gulden</strong>, dengan tujuan untuk memperluas karya misi di bidang sosial.
                </p>
              </div>

              <div class="timeline-item">
                <h3 class="text-2xl font-bold mb-3 text-gray-900">17 Agustus 1927</h3>
                <p class="text-gray-700 leading-relaxed">
                  Dibentuk suatu badan yang diberi nama <strong>Heilige Kruis Stichting</strong> untuk penyelenggaraan sekolah, rumah sakit, dan rumah yatim piatu yang sangat dibutuhkan masyarakat. Susunan pengurus pertama diketuai oleh <strong>Pst. J. H. Goumans, OSC</strong> sebagai ketua dan <strong>Pst. M. Nillesen</strong> sebagai sekretaris.
                </p>
              </div>

              <div class="timeline-item">
                <h3 class="text-2xl font-bold mb-3 text-gray-900">Hingga Kini</h3>
                <p class="text-gray-700 leading-relaxed">
                  Yayasan terus berkembang dan memberikan kontribusi nyata dalam dunia pendidikan di berbagai wilayah Jawa Barat, melayani ribuan siswa dengan dedikasi penuh.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="order-1 md:order-2">
          <div class="relative rounded-3xl overflow-hidden shadow-2xl">
            <img src="<?= asset('assets/img/sejarah.png') ?>" alt="Sejarah Yayasan Salib Suci" class="w-full h-auto">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-10 text-white">
              <p class="text-3xl font-bold mb-2 bg-dark">Lebih dari 95 Tahun</p>
              <p class="text-xl opacity-90 bg-dark">Melayani Pendidikan Indonesia</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Jenjang Pendidikan -->
  <section class="section-spacing scroll-reveal" id="jenjang">
    <div class="text-center mb-20">
      <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
        Jenjang Pendidikan
      </div>
      <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-6">
        Jenjang <span class="gradient-text">Pendidikan</span>
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Kurikulum Merdeka & Entrepreneurship dengan Sistem SKS
      </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
      <div class="modern-card p-10">
        <div class="text-center mb-6">
          <div class="w-28 h-28 mx-auto mb-6 rounded-full bg-gradient-to-br from-pink-400 to-pink-600 flex items-center justify-center text-white text-4xl font-extrabold shadow-xl">
            TK
          </div>
        </div>
        <h3 class="text-2xl font-bold mb-5 text-center">Taman Kanak-Kanak</h3>
        <p class="text-gray-600 mb-8 text-center leading-relaxed">
          Humaniora School, Basic Life Skill, Full Day School, Environmental Learning Activity
        </p>
        <a href="<?=url('tk.php') ?>" class="block w-full text-center px-6 py-4 rounded-full bg-gradient-to-r from-pink-400 to-pink-600 text-white font-bold hover:shadow-2xl transition-all transform hover:scale-105">
          Pelajari Lebih Lanjut →
        </a>
      </div>

      <div class="modern-card p-10">
        <div class="text-center mb-6">
          <div class="w-28 h-28 mx-auto mb-6 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-white text-4xl font-extrabold shadow-xl">
            SD
          </div>
        </div>
        <h3 class="text-2xl font-bold mb-5 text-center">Sekolah Dasar</h3>
        <p class="text-gray-600 mb-8 text-center leading-relaxed">
          Green School Project, Healthy Lunch Program, Kompetisi Akademik & Non-Akademik, Digital Learning Corner
        </p>
        <a href="<?=url('sd.php') ?>" class="block w-full text-center px-6 py-4 rounded-full bg-gradient-to-r from-green-400 to-green-600 text-white font-bold hover:shadow-2xl transition-all transform hover:scale-105">
          Pelajari Lebih Lanjut →
        </a>
      </div>

      <div class="modern-card p-10">
        <div class="text-center mb-6">
          <div class="w-28 h-28 mx-auto mb-6 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-4xl font-extrabold shadow-xl">
            SMP
          </div>
        </div>
        <h3 class="text-2xl font-bold mb-5 text-center">Sekolah Menengah Pertama</h3>
        <p class="text-gray-600 mb-8 text-center leading-relaxed">
          Talent Development, English Program, Good Relationship, Character & Leadership Building
        </p>
        <a href="<?=url('smp.php') ?>" class="block w-full text-center px-6 py-4 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 text-white font-bold hover:shadow-2xl transition-all transform hover:scale-105">
          Pelajari Lebih Lanjut →
        </a>
      </div>

      <div class="modern-card p-10">
        <div class="text-center mb-6">
          <div class="w-28 h-28 mx-auto mb-6 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-white text-4xl font-extrabold shadow-xl">
            SMA
          </div>
        </div>
        <h3 class="text-2xl font-bold mb-5 text-center">Sekolah Menengah Atas</h3>
        <p class="text-gray-600 mb-8 text-center leading-relaxed">
          School of Entrepreneurship, Project Based Learning, Moving Class, Pengembangan Minat & Bakat
        </p>
        <a href="<?=url('sma.php') ?>" class="block w-full text-center px-6 py-4 rounded-full bg-gradient-to-r from-yellow-400 to-yellow-600 text-white font-bold hover:shadow-2xl transition-all transform hover:scale-105">
          Pelajari Lebih Lanjut →
        </a>
      </div>
    </div>
  </section>

  <!-- Tentang Sekolah -->
  <section id="tentang" class="section-spacing bg-white rounded-3xl scroll-reveal">
    <div class="max-w-5xl mx-auto px-6">
      <div class="text-center mb-12">
        <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
          Profil Sekolah
        </div>
        <h2 class="text-2xl md:text-4xl font-extrabold mb-6">Tentang <span class="gradient-text">Sekolah</span></h2>
        <p class="text-lg text-gray-700 leading-relaxed mb-10 max-w-4xl mx-auto">
          Ignatius Slamet Riyadi didirikan pada tahun 2006, dan telah meluluskan ribuan lulusan, banyak di antaranya adalah profesional di institusi terbaik di Indonesia. Sekolah kami menerapkan Kurikulum Merdeka serta Entrepreneurship, dengan sistem SKS, sebagai satu-satunya sekolah di Karawang yang menerapkan sistem ini.
        </p>
      </div>
<div class="relative rounded-3xl overflow-hidden shadow-2xl video-wrapper">
  <div class="relative w-full" style="padding-top:56.25%;">
    <video id="heroVideo" class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline preload="auto" poster="<?= asset('assets/img/banner.jpg') ?>">
      <source src="<?= asset('assets/video/profil.mp4') ?>" type="video/mp4">
      Browser Anda tidak mendukung pemutar video HTML5.
    </video>

    <!-- Tombol nyalakan suara -->
    <button id="unmuteBtn"
      class="absolute bottom-6 left-6 bg-black/60 text-white px-4 py-2 rounded-lg text-sm backdrop-blur-sm hover:bg-black/80 transition">
      🔊 Nyalakan Suara
    </button>
  </div>
</div>

<script>
  const video = document.getElementById('heroVideo');
  const btn = document.getElementById('unmuteBtn');

  btn.addEventListener('click', () => {
    video.muted = false;
    video.play();
    btn.style.display = 'none';
  });
</script>

    </div>
  </section>

  <!-- Announcement ISR -->
  <section id="announcement" class="section-spacing scroll-reveal">
    <div class="text-center mb-20">
      <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
        Program Unggulan
      </div>
      <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-6">
        <span class="gradient-text">Announcement</span> ISR
      </h2>
      <p class="text-xl text-gray-600">
        Ignatius Slamet Riyadi - Program Unggulan
      </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div class="announcement-card">
        <div class="announcement-icon">
          <img src="<?= asset('assets/img/AnnouncementSdSmpSma.png') ?>" alt="TK">
        </div>
        <div>
          <h5 class="text-xl font-bold mb-3 text-gray-900">TK</h5>
          <p class="text-gray-600 leading-relaxed">
            Humaniora School, Basic Life Skill, Full Day School, Environmental Learning Activity
          </p>
        </div>
      </div>

      <div class="announcement-card">
        <div class="announcement-icon">
          <img src="<?= asset('assets/img/AnnouncementSdSmpSma.png') ?>" alt="SD">
        </div>
        <div>
          <h5 class="text-xl font-bold mb-3 text-gray-900">SD</h5>
          <p class="text-gray-600 leading-relaxed">
            Green School Project, Healthy Lunch Program, Kompetisi Akademik & Non-Akademik, Digital Learning Corner
          </p>
        </div>
      </div>

      <div class="announcement-card">
        <div class="announcement-icon">
          <img src="<?= asset('assets/img/AnnouncementSdSmpSma.png') ?>" alt="SMP">
        </div>
        <div>
          <h5 class="text-xl font-bold mb-3 text-gray-900">SMP</h5>
          <p class="text-gray-600 leading-relaxed">
            Talent Development, English Program, Good Relationship, Character & Leadership Building
          </p>
        </div>
      </div>

      <div class="announcement-card">
        <div class="announcement-icon">
          <img src="<?= asset('assets/img/AnnouncementSdSmpSma.png') ?>" alt="SMA">
        </div>
        <div>
          <h5 class="text-xl font-bold mb-3 text-gray-900">SMA</h5>
          <p class="text-gray-600 leading-relaxed">
            School of Entrepreneurship, Project Based Learning, Pembelajaran Digital, Moving Class
          </p>
        </div>
      </div>

      <div class="announcement-card">
        <div class="announcement-icon">
          <img src="<?= asset('assets/img/Announcementketakwaan.jpg') ?>" alt="Ketaqwaan">
        </div>
        <div>
          <h5 class="text-xl font-bold mb-3 text-gray-900">Ketaqwaan kepada Tuhan YME</h5>
          <p class="text-gray-600 leading-relaxed">
            Memfasilitasi ibadah sesuai agama & kepercayaan masing-masing
          </p>
        </div>
      </div>

      <div class="announcement-card">
        <div class="announcement-icon">
          <img src="<?= asset('assets/img/AnnouncementPenguasaan.png') ?>" alt="IPTEK">
        </div>
        <div>
          <h5 class="text-xl font-bold mb-3 text-gray-900">Penguasaan IPTEK</h5>
          <p class="text-gray-600 leading-relaxed">
            Peserta didik menguasai ilmu pengetahuan & teknologi dengan baik
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Statistics -->
  <!--<section class="section-spacing bg-white rounded-3xl scroll-reveal" id="prestasi">-->
  <!--  <div class="text-center mb-20">-->
  <!--    <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">-->
  <!--      Pencapaian Kami-->
  <!--    </div>-->
  <!--    <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-6">-->
  <!--      Prestasi & <span class="gradient-text">Pencapaian</span>-->
  <!--    </h2>-->
  <!--    <p class="text-xl text-gray-600 max-w-3xl mx-auto">-->
  <!--      Angka-angka yang menunjukkan komitmen kami dalam memberikan layanan terbaik-->
  <!--    </p>-->
  <!--  </div>-->

  <!--  <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">-->
  <!--    <div class="stat-card">-->
  <!--      <div class="stat-icon bg-gradient-to-br from-pink-400 to-pink-600">-->
  <!--        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">-->
  <!--          <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>-->
  <!--        </svg>-->
  <!--      </div>-->
  <!--      <div class="text-5xl font-extrabold text-gray-900 mb-3 counter" data-count="3472">0</div>-->
  <!--      <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Happy Customers</div>-->
  <!--    </div>-->

  <!--    <div class="stat-card">-->
  <!--      <div class="stat-icon bg-gradient-to-br from-green-400 to-green-600">-->
  <!--        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">-->
  <!--          <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>-->
  <!--        </svg>-->
  <!--      </div>-->
  <!--      <div class="text-5xl font-extrabold text-gray-900 mb-3 counter" data-count="4537">0</div>-->
  <!--      <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Expert Employees</div>-->
  <!--    </div>-->

  <!--    <div class="stat-card">-->
  <!--      <div class="stat-icon bg-gradient-to-br from-blue-400 to-blue-600">-->
  <!--        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">-->
  <!--          <path d="M17 3H7v3H3v3c0 3.31 2.69 6 6 6h6c3.31 0 6-2.69 6-6V6h-4V3zM8 21h8v-2H8v2z"/>-->
  <!--        </svg>-->
  <!--      </div>-->
  <!--      <div class="text-5xl font-extrabold text-gray-900 mb-3 counter" data-count="2654">0</div>-->
  <!--      <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Awards Won</div>-->
  <!--    </div>-->

  <!--    <div class="stat-card">-->
  <!--      <div class="stat-icon bg-gradient-to-br from-yellow-400 to-yellow-600">-->
  <!--        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">-->
  <!--          <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM3.18 12.4L1 13.5 12 19l3.5-1.86V15L12 18 3.18 12.4z"/>-->
  <!--        </svg>-->
  <!--      </div>-->
  <!--      <div class="text-5xl font-extrabold text-gray-900 mb-3 counter" data-count="1789">0</div>-->
  <!--      <div class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Graduated Students</div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</section>-->

  <!-- Berita Terkini Section -->
  <section class="section-spacing scroll-reveal" id="berita">
    <div class="text-center mb-20">
      <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
        📰 Berita & Informasi
      </div>
      <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-6">
        <span class="gradient-text">Berita</span> Terkini
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Update terbaru tentang kegiatan, prestasi, dan pencapaian Ignatius Slamet Riyadi
      </p>
    </div>

    <?php if (empty($latestBerita)): ?>
      <div class="text-center py-16">
        <div class="text-6xl mb-4">📭</div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Berita</h3>
        <p class="text-gray-600">Berita akan segera hadir. Stay tuned!</p>
      </div>
    <?php else: ?>
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($latestBerita as $berita): ?>
          <article class="berita-section-card">
            <div class="relative overflow-hidden">
              <?php if (!empty($berita['image_path'])): ?>
                <img src="<?= asset($berita['image_path']) ?>" 
                     alt="<?= htmlspecialchars($berita['title']) ?>" 
                     class="berita-section-card-image">
              <?php else: ?>
                <div class="berita-section-card-image bg-gradient-to-br from-green-400 to-green-600"></div>
              <?php endif; ?>
              <div class="absolute top-4 left-4">
                <span class="berita-section-category">
                  <?php
                    $catIcons = [
                      'akademik' => '📚 Akademik',
                      'prestasi' => '🏆 Prestasi',
                      'kegiatan' => '🎉 Kegiatan',
                      'pengumuman' => '📢 Pengumuman'
                    ];
                    echo $catIcons[$berita['category']] ?? '📰 Berita';
                  ?>
                </span>
              </div>
            </div>
            
            <div class="berita-section-card-body">
              <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                <?= htmlspecialchars($berita['title']) ?>
              </h3>
              
              <?php if (!empty($berita['excerpt'])): ?>
                <p class="text-gray-600 mb-4 line-clamp-3 flex-1">
                  <?= htmlspecialchars($berita['excerpt']) ?>
                </p>
              <?php endif; ?>
              
              <div class="berita-section-meta">
                <span>
                  <i class="far fa-calendar mr-1"></i> 
                  <?= date('d M Y', strtotime($berita['created_at'])) ?>
                </span>
                <span>
                  <i class="far fa-eye mr-1"></i> 
                  <?= number_format($berita['views']) ?>
                </span>
              </div>
              
              <button onclick="openBeritaModal(<?= $berita['id'] ?>)" 
                      class="mt-4 inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors">
                Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
              </button>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
      
      <div class="text-center mt-12">
        <a href="<?= url('berita.php') ?>" class="inline-flex items-center px-8 py-4 bg-green-600 text-white rounded-full font-bold hover:bg-green-700 transition-all transform hover:scale-105 shadow-lg">
          Lihat Semua Berita
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </a>
      </div>
    <?php endif; ?>
  </section>

  <!-- Modal untuk Detail Berita -->
  <div id="beritaModal" class="berita-modal">
    <div class="berita-modal-content">
      <button class="berita-modal-close" onclick="closeBeritaModal()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
      <div id="beritaModalContent"></div>
    </div>
  </div>

<!-- ===================== Testimoni Alumni ===================== -->
<?php
$__alumniDir = __DIR__ . '/assets/img/alumni';
$__alumniFiles = [];
if (is_dir($__alumniDir)) {
    $__alumniFiles = glob($__alumniDir . '/*.{jpg,jpeg,png,webp,gif}', GLOB_BRACE) ?: [];
}
$__alumniUrls = array_map(function($p){
    return 'assets/img/alumni/' . basename($p);
}, $__alumniFiles);

// Data testimoni (bisa kamu edit/extend)
$__alumniQuotes = [
    ["nama" => "Jerry Zhonathan", "univ" => "dari Universitas Indonesia", "quote" => "Sekolah ini benar-benar bagus—guru suportif, fasilitas lengkap, dan budaya yang membentuk karakter."],
    ["nama" => "Rizky Amelia", "univ" => "dari Universitas Gajah Mada", "quote" => "Lingkungannya kondusif buat berkembang. Banyak proyek nyata yang berguna saat masuk dunia kerja."],
    ["nama" => "Ahmad Fadhil", "univ" => "dari Universitas Brawijaya", "quote" => "Kurikulumnya relevan, pembelajaran kolaboratif, dan peluang organisasi yang luas."],
    ["nama" => "Clara Putri", "univ" => "dari Universitas Padjajaran", "quote" => "Saya suka pendekatan praktisnya. Mentor dan kakak kelasnya sangat membantu."]
    
];

// Ambil maksimal 5 testimoni
$__alumniQuotes = array_slice($__alumniQuotes, 0, 5);
?>

<section id="alumni-testimoni" class="relative mx-auto max-w-7xl px-4 md:px-6 lg:px-8 my-16 md:my-24">
  <div class="rounded-3xl border border-green-100 bg-green-50/70 p-6 md:p-10">
    <div class="text-center mb-8 md:mb-10">
      <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-6">
        <span class="gradient-text">Testimoni</span> Alumni
      </h2>
      <p class="mt-2 text-base md:text-lg text-gray-600">Para alumni yang sudah lulus — bangga jadi bagian dari ISR.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
      <?php foreach ($__alumniQuotes as $index => $item): 
        $img = isset($__alumniUrls[$index]) ? $__alumniUrls[$index] : null; ?>
        <figure class="bg-white rounded-2xl border border-green-100 shadow-sm hover:shadow-md transition-all p-5 md:p-6 flex flex-col">
          <div class="flex items-center gap-4">
            <?php if ($img): ?>
              <img src="<?= htmlspecialchars($img, ENT_QUOTES, 'UTF-8') ?>"
                   alt="<?= htmlspecialchars($item['nama']) ?>"
                   class="w-14 h-14 md:w-16 md:h-16 rounded-full object-cover ring-2 ring-green-200 shadow-sm">
            <?php else: ?>
              <div class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-semibold">
                <?= strtoupper(substr($item['nama'], 0, 1)) ?>
              </div>
            <?php endif; ?>
            <div class="min-w-0">
              <figcaption class="font-semibold text-gray-900 text-[clamp(0.95rem,2.4vw,1.125rem)] leading-tight break-words"><?= htmlspecialchars($item['nama']) ?></figcaption>
              <p class="text-xs md:text-sm text-green-700/80 leading-tight break-words"><?= htmlspecialchars($item['univ']) ?></p>
            </div>
          </div>
          <blockquote class="mt-4 text-gray-700 text-sm md:text-base leading-relaxed italic">
            “<?= htmlspecialchars($item['quote']) ?>”
          </blockquote>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- =================== / Testimoni Alumni =================== -->


  <!-- CTA Section -->
  <section class="section-spacing scroll-reveal" id="daftar">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-green-600 via-green-500 to-emerald-500 p-16 md:p-24 text-center text-white shadow-2xl">
      <div class="absolute top-0 right-0 w-96 h-96 bg-white opacity-5 rounded-full -mr-48 -mt-48"></div>
      <div class="absolute bottom-0 left-0 w-80 h-80 bg-white opacity-5 rounded-full -ml-40 -mb-40"></div>
      <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full">
        <div class="absolute top-0 left-1/4 w-2 h-2 bg-white rounded-full animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-3 h-3 bg-white rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
        <div class="absolute top-1/3 right-1/3 w-2 h-2 bg-white rounded-full animate-pulse" style="animation-delay: 1s;"></div>
      </div>
      <div class="relative z-10">
        <div class="inline-block px-6 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white font-semibold mb-6">
          Pendaftaran Terbuka
        </div>
        <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-8 leading-tight">
          Siap Bergabung dengan Kami?
        </h2>
        <p class="text-xl md:text-2xl mb-12 opacity-95 max-w-3xl mx-auto leading-relaxed">
          Daftarkan putra-putri Anda sekarang dan jadilah bagian dari keluarga besar ISR Resinda
        </p>
        <div class="flex flex-wrap gap-5 justify-center">
          <a href="<?= url('kontak.php#daftar') ?>" class="cta-btn inline-flex items-center px-12 py-5 rounded-full text-lg font-bold bg-white text-green-600 hover:bg-gray-100 transition-all transform hover:scale-105 shadow-2xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Daftar Sekarang
          </a>
          <a href="<?=url('profil.php') ?>" class="cta-btn inline-flex items-center px-12 py-5 rounded-full text-lg font-bold border-2 border-white hover:bg-white hover:text-green-600 transition-all backdrop-blur-sm bg-white/10">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Lihat Profil Lengkap
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- Partnership -->
  <section class="section-spacing scroll-reveal" id="partnership">
    <div class="text-center mb-20">
      <div class="inline-block px-6 py-2 bg-green-50 rounded-full text-green-600 font-semibold mb-4">
        Mitra Kami
      </div>
      <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold mb-6">
        <span class="gradient-text">Partnership</span>
      </h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Bekerja sama dengan institusi terbaik untuk memberikan pendidikan berkualitas
      </p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-12 items-center justify-items-center">
      <div class="flex justify-center">
        <img src="<?= asset('assets/img/Patnership1.png') ?>" alt="Partner 1" class="partner-logo w-40 md:w-52 h-auto">
      </div>
      <div class="flex justify-center">
        <img src="<?= asset('assets/img/Patnership2.png') ?>" alt="Partner 2" class="partner-logo w-40 md:w-52 h-auto">
      </div>
      <div class="flex justify-center">
        <img src="<?= asset('assets/img/Patnership3.png') ?>" alt="Partner 3" class="partner-logo w-40 md:w-52 h-auto">
      </div>
      <div class="flex justify-center">
        <img src="<?= asset('assets/img/Patnership4.png') ?>" alt="Partner 4" class="partner-logo w-40 md:w-52 h-auto">
      </div>
    </div>
  </section>
  
</div>

<?php include 'includes/footer.php'; ?>
<!-- JavaScript -->
<script>
// Data berita untuk modal
const beritaData = {
  <?php foreach ($latestBerita as $index => $berita): ?>
    <?= $berita['id'] ?>: {
      id: <?= $berita['id'] ?>,
      slug: <?= json_encode($berita['slug'] ?? '') ?>,
      title: <?= json_encode($berita['title']) ?>,
      category: <?= json_encode($berita['category']) ?>,
      image: <?= json_encode($berita['image_path'] ?? '') ?>,
      excerpt: <?= json_encode($berita['excerpt'] ?? '') ?>,
      content: <?= json_encode($berita['content'] ?? '') ?>,
      author: <?= json_encode($berita['author_name'] ?? 'Admin') ?>,
      date: <?= json_encode(date('d F Y', strtotime($berita['created_at']))) ?>,
      views: <?= (int)$berita['views'] ?>
    }<?= $index < count($latestBerita) - 1 ? ',' : '' ?>
  <?php endforeach; ?>
};

// Fungsi untuk membuka modal berita
function openBeritaModal(id) {
  const berita = beritaData[id];
  if (!berita) return;

  const modal = document.getElementById('beritaModal');
  const content = document.getElementById('beritaModalContent');
  
  const catIcons = {
    'akademik': '📚 Akademik',
    'prestasi': '🏆 Prestasi',
    'kegiatan': '🎉 Kegiatan',
    'pengumuman': '📢 Pengumuman'
  };
  
  const categoryLabel = catIcons[berita.category] || '📰 Berita';
  
  // Konversi line break menjadi paragraf
  const contentParagraphs = berita.content
    .split('\n')
    .filter(p => p.trim())
    .map(p => `<p>${p}</p>`)
    .join('');
  
  // Gunakan slug jika tersedia, fallback ke id
  const detailUrl = berita.slug 
    ? `berita-detail.php?slug=${encodeURIComponent(berita.slug)}`
    : `berita-detail.php?id=${berita.id}`;
  
  content.innerHTML = `
    ${berita.image ? `<img src="<?= url('') ?>${berita.image}" alt="${berita.title}" class="berita-modal-header-img">` : '<div class="berita-modal-header-img bg-gradient-to-br from-green-400 to-green-600"></div>'}
    <div class="berita-modal-body">
      <div class="mb-4">
        <span class="berita-section-category">${categoryLabel}</span>
      </div>
      <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
        ${berita.title}
      </h2>
      <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6 pb-6 border-b-2 border-gray-100">
        <span><i class="fas fa-user mr-2"></i>${berita.author}</span>
        <span><i class="fas fa-calendar mr-2"></i>${berita.date}</span>
        <span><i class="fas fa-eye mr-2"></i>${berita.views.toLocaleString()} views</span>
      </div>
      
      ${berita.excerpt ? `
        <div class="text-xl text-gray-700 font-medium mb-6 pb-6 border-b-2 border-gray-100">
          ${berita.excerpt}
        </div>
      ` : ''}
      
      <div class="berita-content">
        ${contentParagraphs}
      </div>
      
      <div class="mt-8 pt-8 border-t-2 border-gray-100">
        <a href="${detailUrl}" class="inline-flex items-center px-8 py-4 bg-green-600 text-white rounded-full font-bold hover:bg-green-700 transition-all transform hover:scale-105 shadow-lg">
          Lihat Detail Lengkap
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </a>
      </div>
    </div>
  `;
  
  modal.classList.add('active');
  document.body.style.overflow = 'hidden';
  
  // Increment view count
  incrementBeritaView(id);
}

// Fungsi untuk menutup modal berita
function closeBeritaModal() {
  const modal = document.getElementById('beritaModal');
  modal.classList.remove('active');
  document.body.style.overflow = '';
}

// Fungsi untuk increment view count
function incrementBeritaView(id) {
  fetch('<?= url('api/berita-view.php') ?>?id=' + id, {
    method: 'POST'
  }).catch(() => {});
}

// Close modal ketika klik di luar content
document.getElementById('beritaModal').addEventListener('click', function(e) {
  if (e.target === this) {
    closeBeritaModal();
  }
});

// Close modal dengan ESC key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeBeritaModal();
  }
});

// PMB Popup Management
document.addEventListener("DOMContentLoaded", () => {
  const pmbPopup = document.getElementById('pmbPopup');
  const closePmbPopup = document.getElementById('closePmbPopup');
  const pmbFloatingBtn = document.getElementById('pmbFloatingBtn');
  
  // Show popup on page load with delay
  setTimeout(() => {
    pmbPopup.classList.add('active');
    document.body.style.overflow = 'hidden';
  }, 1000);
  
  // Close popup function
  const closePopup = () => {
    pmbPopup.classList.remove('active');
    document.body.style.overflow = '';
    pmbFloatingBtn.classList.add('active');
  };
  
  // Close button click
  closePmbPopup.addEventListener('click', closePopup);
  
  // Close when clicking outside
  pmbPopup.addEventListener('click', (e) => {
    if (e.target === pmbPopup) {
      closePopup();
    }
  });
  
  // Close with ESC key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && pmbPopup.classList.contains('active')) {
      closePopup();
    }
  });
  
  // Reopen popup from floating button
  pmbFloatingBtn.addEventListener('click', () => {
    pmbPopup.classList.add('active');
    pmbFloatingBtn.classList.remove('active');
    document.body.style.overflow = 'hidden';
  });
});

// Counter Animation
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll(".counter");
  const options = { threshold: 0.6 };

  const animateCounter = (el) => {
    const target = parseInt(el.dataset.count);
    let current = 0;
    const increment = Math.max(1, Math.floor(target / 100));
    
    const updateCounter = () => {
      current += increment;
      if (current >= target) {
        el.textContent = target.toLocaleString();
      } else {
        el.textContent = current.toLocaleString();
        requestAnimationFrame(updateCounter);
      }
    };
    updateCounter();
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, options);

  counters.forEach(counter => observer.observe(counter));
});

// Scroll Reveal Animation
const scrollReveal = () => {
  const reveals = document.querySelectorAll('.scroll-reveal');
  
  reveals.forEach(element => {
    const windowHeight = window.innerHeight;
    const elementTop = element.getBoundingClientRect().top;
    const elementVisible = 150;
    
    if (elementTop < windowHeight - elementVisible) {
      element.classList.add('active');
    }
  });
};

window.addEventListener('scroll', scrollReveal);
scrollReveal(); // Initial check

// Smooth Scroll
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
