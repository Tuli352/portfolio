<?php
include('../config/db_connect.php');
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
include('../includes/admin_header.php');
?>

<div class="container py-4">
    <h2 class="fw-bold mb-4">Messages</h2>
    <table class="table table-bordered">
        <tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>
        <?php while($msg = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $msg['name'] ?></td>
            <td><?= $msg['email'] ?></td>
            <td><?= nl2br($msg['message']) ?></td>
            <td><?= date("d M Y", strtotime($msg['created_at'])) ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include('../includes/admin_footer.php'); ?>
