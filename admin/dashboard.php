<?php
include('../config/db_connect.php');
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$projects = $conn->query("SELECT COUNT(*) AS count FROM projects")->fetch_assoc()['count'];
$messages = $conn->query("SELECT COUNT(*) AS count FROM messages")->fetch_assoc()['count'];
$skills = $conn->query("SELECT COUNT(*) AS count FROM skills")->fetch_assoc()['count'];
?>

<?php include('../includes/admin_header.php'); ?>

<div class="container py-5">
    <h2 class="fw-bold mb-4">Dashboard Overview</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-4">
                <h5>Projects</h5>
                <h3><?= $projects ?></h3>
                <a href="manage_projects.php" class="btn btn-outline-primary btn-sm">Manage</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-4">
                <h5>Skills</h5>
                <h3><?= $skills ?></h3>
                <a href="manage_skills.php" class="btn btn-outline-primary btn-sm">Manage</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm text-center p-4">
                <h5>Messages</h5>
                <h3><?= $messages ?></h3>
                <a href="view_messages.php" class="btn btn-outline-primary btn-sm">View</a>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/admin_footer.php'); ?>
