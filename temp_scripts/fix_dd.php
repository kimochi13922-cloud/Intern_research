<?php
$file = 'views/admin/detail_admin.php';
$content = file_get_contents($file);

// Add min-w-0 to the dd elements that are flex containers
$content = str_replace('sm:col-span-2 flex items-center justify-between', 'sm:col-span-2 flex items-center justify-between min-w-0', $content);

file_put_contents($file, $content);
echo "Done dd";
