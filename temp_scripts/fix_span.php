<?php
$file = 'views/admin/detail_admin.php';
$content = file_get_contents($file);

$content = preg_replace('/<span>(<\?php echo .*?\?>)<\/span>/s', '<span class="break-words whitespace-normal">$1</span>', $content);

$content = preg_replace('/<span>([^<]+)<\/span>/s', '<span class="break-words whitespace-normal">$1</span>', $content);

$content = str_replace('<span><?php echo escape_html($row[\'kpi_1\']); ?></span>', '<span class="break-words whitespace-normal flex-1 pr-2"><?php echo escape_html($row[\'kpi_1\']); ?></span>', $content);
$content = str_replace('<span><?php echo escape_html($row[\'kpi_2\']); ?></span>', '<span class="break-words whitespace-normal flex-1 pr-2"><?php echo escape_html($row[\'kpi_2\']); ?></span>', $content);

file_put_contents($file, $content);
echo "Done";
