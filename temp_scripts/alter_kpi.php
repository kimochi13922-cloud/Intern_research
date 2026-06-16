<?php
require 'config/database.php';
global $conn;
$conn->query("ALTER TABLE research_list MODIFY kpi_1file LONGBLOB");
$conn->query("ALTER TABLE research_list MODIFY kpi_2file LONGBLOB");
$conn->query("ALTER TABLE research_list MODIFY kpi_1 TEXT");
$conn->query("ALTER TABLE research_list MODIFY kpi_2 TEXT");
echo "Done";
?>
