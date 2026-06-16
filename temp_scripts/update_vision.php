<?php
require 'config/database.php';
global $conn;
$conn->query("ALTER TABLE research_list MODIFY COLUMN vision INT(1) DEFAULT 0");
echo "Column default updated.";
?>
