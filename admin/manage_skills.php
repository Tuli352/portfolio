<?php
include('../config/db_connect.php');
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $skill = $conn->real_escape_string($_POST['skill']);
    $level = intval($_POST['level']);
    $conn->query("INSERT INTO skills (skill_name, level) VALUES ('$skill', $level)");
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM skills WHERE id=$id");
}

$result = $conn->query("SELECT * FROM skills ORDER BY id DESC");
include('../includes/admin_header.php');
?>

<div class="container py-4">
    <h2 class="fw-bold mb-4">Manage Skills</h2>
    <form method="POST" class="d-flex mb-4">
        <input type="text" name="skill" placeholder="Skill name" class="form-control me-2" required>
        <input type="number" name="level" placeholder="Level %" class="form-control me-2" required>
        <button class="btn btn-primary">Add Skill</button>
    </form>

    <table class="table table-striped">
        <tr><th>#</th><th>Skill</th><th>Level (%)</th><th>Actions</th></tr>
        <?php while($s = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= $s['skill_name'] ?></td>
            <td><?= $s['level'] ?>%</td>
            <td><a href="?delete=<?= $s['id'] ?>" class="btn btn-sm btn-danger" 
                   onclick="return confirm('Delete skill?')">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include('../includes/admin_footer.php'); ?>
