<?php
// config/database.php

/**
 * ==========================================
 * HOW TO RE-LINK YOUR DATABASE LATER:
 * ==========================================
 * 1. Delete or comment out the entire "Mock Database Connection" class at the bottom of this file.
 * 2. Remove the `/*` and `*/` block comments around the real database connection below.
 * 3. Update the `$db_host`, `$db_user`, `$db_pass`, and `$db_name` variables to match your actual MySQL credentials.
 */

// --- REAL DATABASE CONNECTION (Currently Disabled) ---
/*
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'intern_research';

// Using MySQLi which is available in PHP 5.0+ and much better than the deprecated mysql_*
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Set charset
$conn->set_charset("utf8");
*/


// The mock database connection has been entirely removed per user request.
