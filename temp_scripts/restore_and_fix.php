<?php
// Run inject_inline_v3 logic
require 'inject_inline_v3.php';

$file = 'c:/AppServ/www/intern_research/views/admin/detail_admin.php';
$content = file_get_contents($file);

// Remove main edit button
$content = preg_replace(
    '/<a href="<\?php echo BASE_URL; \?>admin\/editresearch\?id=<\?php echo escape_html\(\$id\); \?>" class="hidden sm:inline-flex.*?<\/a>/s',
    '',
    $content
);

file_put_contents($file, $content);

// Run fix_inline logic
require 'fix_inline.php';

// Expand abstract field
$content = file_get_contents($file);
$content = str_replace(
    "const isTextarea = field === 'abstract' || field === 'authors';",
    "const isTextarea = field === 'abstract' || field === 'authors';\n            const numRows = field === 'abstract' ? 10 : 3;",
    $content
);
$content = str_replace(
    '<textarea name="value" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500" rows="4">${originalText}</textarea>',
    '<textarea name="value" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500" rows="${numRows}">${originalText}</textarea>',
    $content
);

file_put_contents($file, $content);
echo "Restored and fixed everything!\n";
?>
