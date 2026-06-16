<?php
require 'config/database.php';
global $conn;
$res = $conn->query("SET GLOBAL max_allowed_packet=157286400");
if ($res) {
    echo "Successfully updated max_allowed_packet to 150MB.\n";
} else {
    echo "Failed: " . $conn->error . "\n";
}
$res2 = $conn->query("SHOW VARIABLES LIKE 'max_allowed_packet'");
if ($row = $res2->fetch_assoc()) {
    echo "Current max_allowed_packet: " . $row['Value'] . " bytes\n";
}
?>
