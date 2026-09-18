<?php
session_start();
include('../config/db_connect.php');

// Fetch profile image for background
$about_sql = "SELECT * FROM about WHERE id = 1 LIMIT 1";
$about_result = $conn->query($about_sql);
$about = $about_result ? $about_result->fetch_assoc() : null;
$profile_image = !empty($about['profile_image']) ? '../' . htmlspecialchars($about['profile_image']) : '../assets/default-profile.jpg';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM admins WHERE username = '$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_name'] = $admin['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Tuli Moses Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
            position: relative;
        }
        
        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        
        .profile-background {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(8px) brightness(0.7);
            transform: scale(1.1);
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .profile-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            overflow: hidden;
            border: 4px solid rgba(103, 126, 234, 0.3);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .login-title {
            color: #333;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .login-subtitle {
            color: #666;
            font-size: 0.9rem;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #e1e5e9;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 0.5rem;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(102, 126, 234, 0.5);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(102, 126, 234, 0.1);
            animation: float 6s ease-in-out infinite;
        }
        
        .shape-1 {
            width: 80px;
            height: 80px;
            top: -20px;
            right: -20px;
            animation-delay: 0s;
        }
        
        .shape-2 {
            width: 60px;
            height: 60px;
            bottom: -10px;
            left: -10px;
            animation-delay: 2s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(180deg); }
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #777;
            cursor: pointer;
        }
        
        .password-container {
            position: relative;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            color: #777;
            font-size: 0.85rem;
        }
        
        @media (max-width: 576px) {
            .login-container {
                margin: 1rem;
                padding: 2rem 1.5rem;
            }
            
            body {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="background-container">
        <div class="profile-background" style="background-image: url('<?php echo $profile_image; ?>');"></div>
    </div>
    
    <div class="login-container">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
        </div>
        
        <div class="login-header">
            <div class="profile-avatar">
                <img src="<?php echo $profile_image; ?>" alt="Tuli Moses Kimatu">
            </div>
            <h2 class="login-title">Admin Login</h2>
            <p class="login-subtitle">Tuli Moses Portfolio Dashboard</p>
        </div>
        
        <?php if($error): ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <div><?= $error ?></div>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-user text-muted"></i>
                    </span>
                    <input type="text" name="username" id="username" class="form-control border-start-0" placeholder="Enter your username" required autofocus>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="password-container">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-lock text-muted"></i>
                        </span>
                        <input type="password" name="password" id="password" class="form-control border-start-0 pe-5" placeholder="Enter your password" required>
                    </div>
                    <button type="button" class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <button class="btn btn-login w-100 py-2 mb-3" type="submit">
                <i class="fas fa-sign-in-alt me-2"></i> Login to Dashboard
            </button>
        </form>
        
        <div class="footer-text">
            <p>&copy; <?php echo date('Y'); ?> Tuli Moses Portfolio. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        // Add focus effect to form inputs
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('focused');
            });
        });
        
        // Add subtle animation to login container on load
        document.addEventListener('DOMContentLoaded', function() {
            const loginContainer = document.querySelector('.login-container');
            loginContainer.style.opacity = '0';
            loginContainer.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                loginContainer.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                loginContainer.style.opacity = '1';
                loginContainer.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>