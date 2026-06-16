<?php
require 'config/database.php';
global $conn;
$res2 = $conn->query("SHOW VARIABLES LIKE 'max_allowed_packet'");
if ($row = $res2->fetch_assoc()) {
    echo "Current max_allowed_packet for new connection: " . $row['Value'] . " bytes\n";
}
?>
