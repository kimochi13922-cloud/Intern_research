<?php
$file = 'views/admin/detail_admin.php';
$content = file_get_contents($file);

$content = str_replace('class="break-words whitespace-normal', 'class="break-words break-all whitespace-normal', $content);

file_put_contents($file, $content);
echo "Done";
