<?php
include('../config/db_connect.php');
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];

    $res = $conn->query("SELECT * FROM admin WHERE username='{$_SESSION['admin_name']}'");
    $admin = $res->fetch_assoc();

    if (password_verify($old, $admin['password'])) {
        $hash = password_hash($new, PASSWORD_DEFAULT);
        $conn->query("UPDATE admin SET password='$hash' WHERE id={$admin['id']}");
        $message = "<div class='alert alert-success'>Password updated successfully.</div>";
    } else {
        $message = "<div class='alert alert-danger'>Incorrect old password.</div>";
    }
}

include('../includes/admin_header.php');
?>

<div class="container py-4">
    <h2>Account Settings</h2>
    <?= $message ?>
    <form method="POST" style="max-width: 400px;">
        <div class="mb-3">
            <label>Old Password</label>
            <input type="password" name="old_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Update Password</button>
    </form>
</div>

<?php include('../includes/admin_footer.php'); ?>
