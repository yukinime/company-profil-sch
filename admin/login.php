<?php
session_start();
require_once '../config/database.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($username) && !empty($password)) {
        $database = new Database();
        $db = $database->getConnection();
        
        $query = "SELECT * FROM admins WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->rowCount() == 1) {
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verify password (using password_verify for hashed passwords)
            if ($username === '4dm1n' && $password === '4dm1n123') {
            // For demo purposes - in production use password_verify($password, $admin['password'])
                
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_role'] = $admin['role'];
                $_SESSION['admin_name'] = $admin['full_name'];
                
                // Update last login
                $update_query = "UPDATE admins SET last_login = NOW() WHERE id = :id";
                $update_stmt = $db->prepare($update_query);
                $update_stmt->bindParam(':id', $admin['id']);
                $update_stmt->execute();
                
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Password yang Anda masukkan salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
    } else {
        $error = "Silakan isi username dan password!";
    }
}

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
    <title>Login Admin - ISR School</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <!-- Logo dan Judul -->
            <div class="text-center mb-8">
                <div class="inline-block p-4 bg-white rounded-full shadow-lg mb-4">
                    <i class="fas fa-lock text-3xl text-purple-600"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Admin Panel</h1>
                <p class="text-white opacity-90">Ignatius Slamet Riyadi School</p>
            </div>

            <!-- Login Card -->
            <div class="login-card rounded-2xl shadow-2xl p-8">
                <?php if ($error): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <i class="fas fa-check-circle mr-2"></i>
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            <i class="fas fa-user mr-2"></i>Username
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200"
                            placeholder="Masukkan username Anda"
                            required
                        >
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            <i class="fas fa-lock mr-2"></i>Password
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200"
                            placeholder="Masukkan password Anda"
                            required
                        >
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 transform hover:-translate-y-0.5"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="<?php echo $base_url; ?>index.php" class="text-purple-600 hover:text-purple-800 text-sm">
                        <i class="fas fa-arrow-left mr-1"></i>Kembali ke Beranda
                    </a>
                </div>

                <!-- Demo Credentials -->
                <div class="mt-6 p-4 bg-gray-100 rounded-lg">
                    <p class="text-sm text-gray-600 text-center">
                        <strong>Demo Login:</strong><br>
                        Username: <code>4dm1n</code><br>
                        Password: <code>4dm1n123</code>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            
            if (!username || !password) {
                e.preventDefault();
                alert('Silakan isi username dan password!');
            }
        });
    </script>
</body>
</html>