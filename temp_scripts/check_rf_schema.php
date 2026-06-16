<?php
require 'config/database.php';
global $conn;
$res = $conn->query("SHOW COLUMNS FROM research_file");
while($row = $res->fetch_assoc()) {
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
?>
