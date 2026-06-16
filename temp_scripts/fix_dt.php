<?php
$file = 'views/admin/detail_admin.php';
$content = file_get_contents($file);

// Ensure dt can break words
$content = str_replace('<dt class="font-bold text-slate-500 flex items-center">', '<dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">', $content);

file_put_contents($file, $content);
echo "Done dt replace";
