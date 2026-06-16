<?php
$ini = 'C:/AppServ/MySQL/my.ini';
if (file_exists($ini)) {
    $content = file_get_contents($ini);
    // If it doesn't contain max_allowed_packet, append it under [mysqld]
    if (strpos($content, 'max_allowed_packet') === false) {
        $content = str_replace('[mysqld]', "[mysqld]\r\nmax_allowed_packet=150M", $content);
        file_put_contents($ini, $content);
        echo "Added max_allowed_packet=150M to my.ini\n";
    } else {
        // Replace existing
        $content = preg_replace('/max_allowed_packet\s*=\s*[a-zA-Z0-9]+/', 'max_allowed_packet=150M', $content);
        file_put_contents($ini, $content);
        echo "Updated max_allowed_packet=150M in my.ini\n";
    }
} else {
    echo "File not found.";
}
?>
