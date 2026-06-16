<?php
require 'config/database.php';
global $conn;
$res = $conn->query("ALTER TABLE research_file ADD COLUMN file_name VARCHAR(255) NULL AFTER description");
if ($conn->error) {
    echo $conn->error;
} else {
    echo "OK";
}
?>
