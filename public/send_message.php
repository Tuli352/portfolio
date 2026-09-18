<?php
include('../config/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if ($conn->query($sql)) {
        header("Location: contact.php?success=1");
        exit();
    } else {
        header("Location: contact.php?error=1");
        exit();
    }
}
?>
