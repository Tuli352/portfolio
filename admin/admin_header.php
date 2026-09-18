<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Restrict access if not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Portfolio CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f8fa;
        }
        .admin-sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .admin-sidebar a {
            color: #bbb;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .admin-sidebar a:hover,
        .admin-sidebar a.active {
            background-color: #495057;
            color: #fff;
        }
        .admin-content {
            margin-left: 250px;
            padding: 20px;
        }
        .topbar {
            background: white;
            padding: 15px 25px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar h5 {
            margin: 0;
            font-weight: 600;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="admin-sidebar">
    <h4 class="text-center mb-4">⚙️ Admin Panel</h4>
    <a href="../admin/dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="../admin/manage_projects.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_projects.php' ? 'active' : '' ?>">
        <i class="bi bi-kanban"></i> Projects
    </a>
    <a href="../admin/manage_skills.php" class="<?= basename($_SERVER['PHP_SELF']) == 'manage_skills.php' ? 'active' : '' ?>">
        <i class="bi bi-lightning-charge"></i> Skills
    </a>
    <a href="../admin/edit_about.php" class="<?= basename($_SERVER['PHP_SELF']) == 'edit_about.php' ? 'active' : '' ?>">
        <i class="bi bi-person"></i> About
    </a>
    <a href="../admin/view_messages.php" class="<?= basename($_SERVER['PHP_SELF']) == 'view_messages.php' ? 'active' : '' ?>">
        <i class="bi bi-envelope"></i> Messages
    </a>
    <a href="../admin/settings.php" class="<?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">
        <i class="bi bi-gear"></i> Settings
    </a>
    <a href="../admin/logout.php" class="text-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</div>

<!-- Topbar -->
<div class="admin-content">
    <div class="topbar">
        <h5><?= ucfirst($_SESSION['admin_name']) ?>’s Dashboard</h5>
        <span class="text-muted small">
            <i class="bi bi-clock"></i> <?= date("l, d M Y") ?>
        </span>
    </div>
