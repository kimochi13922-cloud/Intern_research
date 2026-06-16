<?php
require 'config/database.php';
global $conn;

// 1. Alter id to be AUTO_INCREMENT without redefining PRIMARY KEY if it's already one
$res1 = $conn->query("ALTER TABLE research_file MODIFY id INT(11) NOT NULL AUTO_INCREMENT");
if ($res1) {
    echo "id altered to AUTO_INCREMENT.\n";
} else {
    echo "Error on id: " . $conn->error . "\n";
}
?>
