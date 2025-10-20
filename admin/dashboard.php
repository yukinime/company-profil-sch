<?php
session_start();
require_once '../config/database.php';

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();

// Get stats
$pages_count = $db->query("SELECT COUNT(*) FROM pages")->fetchColumn();
$gallery_count = $db->query("SELECT COUNT(*) FROM gallery")->fetchColumn();
$admins_count = $db->query("SELECT COUNT(*) FROM admins")->fetchColumn();

// Deteksi base URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$script_name = $_SERVER['SCRIPT_NAME'];
$project_folder = '/' . explode('/', trim($script_name, '/'))[0] . '/';
$base_url = $protocol . '://' . $host . $project_folder;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ISR School</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Mobile Menu Button -->
    <button class="md:hidden fixed top-4 left-4 z-50 bg-purple-600 text-white p-2 rounded-lg" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar fixed md:relative w-64 bg-purple-800 text-white h-full z-40">
            <div class="p-6 border-b border-purple-700">
                <h1 class="text-2xl font-bold">ISR Admin</h1>
                <p class="text-purple-200 text-sm">Management System</p>
            </div>
            
            <nav class="mt-6">
                <a href="dashboard.php" class="flex items-center px-6 py-3 bg-purple-900 border-l-4 border-yellow-400">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="pages.php" class="flex items-center px-6 py-3 text-purple-200 hover:bg-purple-700 hover:text-white">
                    <i class="fas fa-file-alt mr-3"></i>
                    Kelola Halaman
                </a>
                <a href="gallery.php" class="flex items-center px-6 py-3 text-purple-200 hover:bg-purple-700 hover:text-white">
                    <i class="fas fa-images mr-3"></i>
                    Kelola Galeri
                </a>
                <a href="users.php" class="flex items-center px-6 py-3 text-purple-200 hover:bg-purple-700 hover:text-white">
                    <i class="fas fa-users mr-3"></i>
                    Kelola Admin
                </a>
                <a href="settings.php" class="flex items-center px-6 py-3 text-purple-200 hover:bg-purple-700 hover:text-white">
                    <i class="fas fa-cog mr-3"></i>
                    Pengaturan
                </a>
            </nav>
            
            <div class="absolute bottom-0 w-full p-6 border-t border-purple-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-semibold"><?php echo $_SESSION['admin_name']; ?></p>
                        <p class="text-purple-200 text-sm"><?php echo $_SESSION['admin_role']; ?></p>
                    </div>
                    <a href="logout.php" class="text-purple-200 hover:text-white" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <?php echo date('l, d F Y'); ?>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Stats Cards -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg mr-4">
                                <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Halaman</p>
                                <h3 class="text-2xl font-bold text-gray-800"><?php echo $pages_count; ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-lg mr-4">
                                <i class="fas fa-images text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Foto Galeri</p>
                                <h3 class="text-2xl font-bold text-gray-800"><?php echo $gallery_count; ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-lg mr-4">
                                <i class="fas fa-users text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Admin Users</p>
                                <h3 class="text-2xl font-bold text-gray-800"><?php echo $admins_count; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="pages.php?action=new" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                            <i class="fas fa-plus text-green-600 text-xl mr-3"></i>
                            <div>
                                <p class="font-semibold">Tambah Halaman</p>
                                <p class="text-sm text-gray-600">Buat halaman baru</p>
                            </div>
                        </a>
                        
                        <a href="gallery.php?action=new" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                            <i class="fas fa-upload text-blue-600 text-xl mr-3"></i>
                            <div>
                                <p class="font-semibold">Upload Foto</p>
                                <p class="text-sm text-gray-600">Tambah ke galeri</p>
                            </div>
                        </a>
                        
                        <a href="users.php" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                            <i class="fas fa-user-plus text-purple-600 text-xl mr-3"></i>
                            <div>
                                <p class="font-semibold">Kelola Admin</p>
                                <p class="text-sm text-gray-600">Tambah admin baru</p>
                            </div>
                        </a>
                        
                        <a href="<?php echo $base_url; ?>index.php" target="_blank" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                            <i class="fas fa-external-link-alt text-orange-600 text-xl mr-3"></i>
                            <div>
                                <p class="font-semibold">Lihat Website</p>
                                <p class="text-sm text-gray-600">Pratinjau situs</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow p-6 mt-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Selamat Datang, <?php echo $_SESSION['admin_name']; ?>!</h3>
                    <p class="text-gray-600 mb-4">Anda login sebagai <span class="font-semibold text-purple-600"><?php echo $_SESSION['admin_role']; ?></span></p>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <i class="fas fa-info-circle text-yellow-400 mr-3 mt-1"></i>
                            <div>
                                <p class="text-sm text-yellow-700">
                                    <strong>Informasi:</strong> Sistem admin ISR School memungkinkan Anda untuk mengelola konten website dengan mudah.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const menuBtn = document.querySelector('button[onclick="toggleSidebar()"]');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !menuBtn.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>
</html>