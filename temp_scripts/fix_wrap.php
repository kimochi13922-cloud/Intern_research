<?php
$file = 'views/admin/detail_admin.php';
$content = file_get_contents($file);

// Replace the previously set span classes with the ones that force flex to allow wrapping
$content = str_replace('<span class="break-words whitespace-normal">', '<span class="break-words whitespace-normal flex-1 min-w-0 pr-2 block">', $content);

// For the abstract
$content = str_replace('<div class="text-sm text-slate-700 leading-relaxed space-y-3">', '<div class="text-sm text-slate-700 leading-relaxed space-y-3 break-words whitespace-normal">', $content);

file_put_contents($file, $content);
echo "Done";
