<?php
/**
 * Database Connection File
 * ---------------------------------
 * Connects your PHP portfolio system to MySQL (phpMyAdmin)
 * Database: tuli_portfolio
 * Author: Tuli Moses Kimatu
 * ---------------------------------
 */

// ==== DATABASE CONFIGURATION ====
$host = "sql101.infinityfree.com";            // Usually 'localhost' for XAMPP or local server
$user = "if0_40234962";                 // Default username for local MySQL
$pass = "3JfnUF2taUHlpI";                     // Leave empty if no password set
$dbname = "if0_40234962_tuli_portfolio";     // Database name (must exist in phpMyAdmin)
// Database connection using PDO

// ==== CONNECTION ====
$conn = new mysqli($host, $user, $pass, $dbname);

// ==== ERROR HANDLING ====
if ($conn->connect_error) {
    // Log the error for security (don’t show details to users)
    error_log("Database connection failed: " . $conn->connect_error, 3, __DIR__ . "/error_log.txt");

    // Show user-friendly message
    die("<h2 style='font-family: Arial; color: #c0392b;'>⚠️ Database Connection Error</h2>
         <p>We’re currently unable to connect to the server. Please try again later.</p>");
}

// ==== CHARACTER SET (UTF-8 for emojis, special chars, etc.) ====
if (!$conn->set_charset("utf8mb4")) {
    error_log("Error loading character set utf8mb4: " . $conn->error, 3, __DIR__ . "/error_log.txt");
}

// ==== OPTIONAL DEBUGGING (Turn on for local testing only) ====
// Uncomment below to check successful connection
// echo "✅ Database connected successfully.";

?>
