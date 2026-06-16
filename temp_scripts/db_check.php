<?php
$conn = new mysqli('localhost', 'root', '');
if ($conn->connect_error) { 
    echo 'Connection failed: ' . $conn->connect_error; 
    exit; 
}
if($conn->select_db('research')) {
    echo "\nTABLES in research:\n";
    $res = $conn->query('SHOW TABLES;');
    while($row = $res->fetch_row()) { 
        echo $row[0] . "\n"; 
        $cols = $conn->query('DESCRIBE ' . $row[0]);
        while($col = $cols->fetch_assoc()) {
            echo '  - ' . $col['Field'] . ' (' . $col['Type'] . ")\n";
        }
    }
} else {
    echo "\nDatabase research does not exist.\n";
}
