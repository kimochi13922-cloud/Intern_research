<?php
require 'config/database.php';
global $conn;
$res = $conn->query("SHOW COLUMNS FROM research_list");
while($row = $res->fetch_assoc()) {
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
?>
