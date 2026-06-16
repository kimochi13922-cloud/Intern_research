<?php
$file = 'c:/AppServ/www/intern_research/views/admin/detail_admin.php';
$content = file_get_contents($file);

// Replace static content with dynamic content and inline edit buttons

// 1. Name
$content = str_replace(
    '<span>Development of AI Models for Healthcare Predictive Analytics</span>',
    '<span><?php echo isset($row[\'name\']) ? escape_html($row[\'name\']) : ""; ?></span>',
    $content
);

// 2. Authors
$content = str_replace(
    '<span>Dr. Jane Doe, Dr. John Smith</span>',
    '<span><?php echo isset($row[\'authors\']) ? escape_html($row[\'authors\']) : ""; ?></span>',
    $content
);

// 3. Departments
$content = str_replace(
    '<span>คณะแพทยศาสตร์</span>',
    '<span><?php echo isset($row[\'departments\']) ? escape_html($row[\'departments\']) : ""; ?></span>',
    $content
);

// 4. Categories
$content = str_replace(
    '<span>งานวิจัย</span>',
    '<span><?php echo isset($row[\'categories\']) ? escape_html($row[\'categories\']) : ""; ?></span>',
    $content
);

// 5. Progress
$content = preg_replace(
    '/<span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-bold">กำลังดำเนินการ \(In Progress\)<\/span>/',
    '<span><?php echo isset($row[\'progress\']) ? escape_html($row[\'progress\']) : ""; ?></span>',
    $content
);

// 6. Journal and Quartile (Combined in the same block)
$content = preg_replace(
    '/<div class="flex items-center">\s*Journal of Medical AI\s*<span class="ml-2 px-1\.5 py-0\.5 bg-green-100 text-green-800 rounded text-\[10px\] font-bold">Q1<\/span>\s*<\/div>/s',
    '<span><?php echo isset($row[\'journal\']) ? escape_html($row[\'journal\']) : ""; ?></span>',
    $content
);

// 7. Publication Year
$content = preg_replace(
    '/<span>2023<\/span>/',
    '<span><?php echo isset($row[\'publication_year\']) ? escape_html($row[\'publication_year\']) : ""; ?></span>',
    $content,
    1
);

// 8. Release Year
$content = preg_replace(
    '/<span>2024<\/span>/',
    '<span><?php echo isset($row[\'release_year\']) ? escape_html($row[\'release_year\']) : ""; ?></span>',
    $content,
    1
);

// 9. Period
$content = str_replace(
    '<span>1 ม.ค. 2024 - 31 ธ.ค. 2024</span>',
    '<span><?php echo isset($row[\'period\']) ? escape_html($row[\'period\']) : ""; ?></span>',
    $content
);

// 10. Funding Source
$content = str_replace(
    '<span>กองทุนสนับสนุนการวิจัย (สกว.)</span>',
    '<span><?php echo isset($row[\'funding_source\']) ? escape_html($row[\'funding_source\']) : ""; ?></span>',
    $content
);

// 11. Budget
$content = str_replace(
    '<span>1,500,000 บาท</span>',
    '<span><?php echo isset($row[\'budget\']) ? escape_html($row[\'budget\']) : ""; ?></span>',
    $content
);

// 12. Abstract
$content = preg_replace(
    '/<p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line">This research explores(.*?)<\/p>/s',
    '<span class="hidden"><?php echo isset($row[\'abstract\']) ? escape_html($row[\'abstract\']) : ""; ?></span><p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line"><?php echo isset($row[\'abstract\']) ? escape_html($row[\'abstract\']) : ""; ?></p>',
    $content
);

// 13. KPIs
$content = preg_replace(
    '/<p class="font-medium text-slate-800">จำนวนการอ้างอิง \(Citations\)(.*?)<\/p>/s',
    '<p class="font-medium text-slate-800"><?php echo isset($row[\'kpi_1\']) ? escape_html($row[\'kpi_1\']) : ""; ?></p>',
    $content
);
$content = preg_replace(
    '/<p class="font-medium text-slate-800">การตีพิมพ์ในวารสารวิชาการระดับนานาชาติ(.*?)<\/p>/s',
    '<p class="font-medium text-slate-800"><?php echo isset($row[\'kpi_2\']) ? escape_html($row[\'kpi_2\']) : ""; ?></p>',
    $content
);

$script = <<<EOT
<script>
    const BASE_URL = '<?php echo BASE_URL; ?>';
    const RECORD_ID = '<?php echo \$id; ?>';
    
    document.querySelectorAll('.edit-inline-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const dd = this.closest('dd, div.relative');
            if (!dd || dd.querySelector('form')) return; 
            
            const span = dd.querySelector('span:first-child');
            const originalText = span ? span.innerText.trim() : '';
            const safeText = originalText.replace(/"/g, '&quot;');
            const field = this.dataset.field;
            
            const isTextarea = field === 'abstract' || field === 'authors';
            const inputHtml = isTextarea 
                ? `<textarea name="value" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500" rows="4">\${originalText}</textarea>`
                : `<input type="text" name="value" value="\${safeText}" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500">`;

            const originalHTML = dd.innerHTML;
            
            dd.innerHTML = `
                <form method="POST" action="\${BASE_URL}admin/research" class="flex items-center gap-2 w-full mt-2">
                    <input type="hidden" name="action" value="inline_edit">
                    <input type="hidden" name="id" value="\${RECORD_ID}">
                    <input type="hidden" name="field" value="\${field}">
                    \${inputHtml}
                    <button type="submit" class="text-green-600 hover:text-green-800 p-1" title="บันทึก"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></button>
                    <button type="button" class="cancel-edit text-red-600 hover:text-red-800 p-1" title="ยกเลิก"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </form>
            `;

            dd.querySelector('.cancel-edit').addEventListener('click', () => {
                location.reload(); 
            });
        });
    });
</script>
EOT;

$content = str_replace("<?php\r\nrequire_once ROOT_DIR . '/includes/footer.php';", $script . "\n<?php\r\nrequire_once ROOT_DIR . '/includes/footer.php';", $content);
$content = str_replace("<?php\nrequire_once ROOT_DIR . '/includes/footer.php';", $script . "\n<?php\nrequire_once ROOT_DIR . '/includes/footer.php';", $content);

// Add data-field manually.
$fields = array('name', 'authors', 'departments', 'categories', 'progress', 'journal', 'publication_year', 'release_year', 'period', 'funding_source', 'budget');
foreach ($fields as $field) {
    $pattern = '/<span><\?php echo isset\(\$row\[\'' . $field . '\'\]\) \? escape_html\(\$row\[\'' . $field . '\'\]\) : ""; \?><\/span>\s*<button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">/s';
    $replacement = '<span><?php echo isset($row[\'' . $field . '\']) ? escape_html($row[\'' . $field . '\']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="' . $field . '" title="แก้ไข">';
    $content = preg_replace($pattern, $replacement, $content);
}

// Abstract
$content = preg_replace('/<button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">\s*<svg class="w-4 h-4"(.*?)<\/svg>\s*<\/button>/s', '<button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="abstract" title="แก้ไข"><svg class="w-4 h-4"$1</svg></button>', $content, 1);

file_put_contents($file, $content);
echo "Replaced static fields with dynamic + inline edits.\n";
?>
