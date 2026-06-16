<?php
require 'config/database.php';
global $conn;
$res = $conn->query("SHOW TABLES");
while($row = $res->fetch_array()) {
    echo $row[0] . "\n";
}
?>
