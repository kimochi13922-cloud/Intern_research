<?php
require 'config/database.php';
global $conn;

// 1. Alter id to be AUTO_INCREMENT
$res1 = $conn->query("ALTER TABLE research_file MODIFY id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY");
if ($res1) {
    echo "id altered to AUTO_INCREMENT.\n";
} else {
    echo "Error on id: " . $conn->error . "\n";
}

// 2. Change file to LONGBLOB
$res2 = $conn->query("ALTER TABLE research_file MODIFY file LONGBLOB");
if ($res2) {
    echo "file altered to LONGBLOB.\n";
} else {
    echo "Error on file: " . $conn->error . "\n";
}
?>
