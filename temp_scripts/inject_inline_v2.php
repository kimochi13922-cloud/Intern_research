<?php
$file = 'c:/AppServ/www/intern_research/views/admin/detail_admin.php';
$content = file_get_contents($file);

// 1. Add publish toggle in the header
$publish_original = <<<EOT
            <button type="button" class="hidden sm:inline-flex items-center px-3 py-1.5 border border-transparent rounded-md text-xs font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all shadow-sm">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                เผยแพร่ผลงาน (Publish)
            </button>
EOT;

$publish_replacement = <<<EOT
            <form action="<?php echo BASE_URL; ?>admin/research" method="POST" class="inline-block">
                <input type="hidden" name="action" value="publish">
                <input type="hidden" name="id" value="<?php echo escape_html(\$id); ?>">
                <input type="hidden" name="redirect_to" value="detail">
                
                <?php if (isset(\$row['vision']) && \$row['vision'] == 1): ?>
                    <input type="hidden" name="vision" value="0">
                    <button type="submit" class="hidden sm:inline-flex items-center px-3 py-1.5 border border-transparent rounded-md text-xs font-bold text-slate-700 bg-slate-200 hover:bg-slate-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-400 transition-all shadow-sm">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                        ยกเลิกเผยแพร่ (Unpublish)
                    </button>
                <?php else: ?>
                    <input type="hidden" name="vision" value="1">
                    <button type="submit" class="hidden sm:inline-flex items-center px-3 py-1.5 border border-transparent rounded-md text-xs font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all shadow-sm">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        เผยแพร่ผลงาน (Publish)
                    </button>
                <?php endif; ?>
            </form>
EOT;
$content = str_replace($publish_original, $publish_replacement, $content);

// 2. Inject Javascript for Inline Editing
$script = <<<EOT
<script>
    const BASE_URL = '<?php echo BASE_URL; ?>';
    const RECORD_ID = '<?php echo \$id; ?>';
    
    document.querySelectorAll('.edit-inline-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const dd = this.closest('dd, div.relative');
            if (!dd || dd.querySelector('form')) return; // already editing
            
            const span = dd.querySelector('span:first-child');
            const originalText = span.innerText.trim();
            const field = this.dataset.field;
            
            const isTextarea = field === 'abstract' || field === 'authors';
            const inputHtml = isTextarea 
                ? `<textarea name="value" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500" rows="4">\${originalText}</textarea>`
                : `<input type="text" name="value" value="\${originalText}" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500">`;

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

// 3. Replace all regular field buttons with class edit-inline-btn and data-field
$fields = array(
    'name', 'authors', 'departments', 'categories', 'progress', 
    'publication_year', 'release_year', 'journal', 'period', 'quartile', 
    'funding_source', 'budget', 'citation'
);

foreach ($fields as $field) {
    if ($field == 'budget') {
        $pattern = '/<span><\?php echo number_format\(\$row\[\'' . $field . '\'\]\); \?> บาท<\/span>\s*<button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">\s*<svg[^>]+>.*?<\/svg>\s*<\/button>/s';
        $replacement = '<span><?php echo isset($row[\'' . $field . '\']) ? escape_html($row[\'' . $field . '\']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="' . $field . '" title="แก้ไข"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>';
    } else {
        $pattern = '/<span><\?php echo escape_html\(\$row\[\'' . $field . '\'\](?: \?\? \'\')?\); \?><\/span>\s*<button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">\s*<svg[^>]+>.*?<\/svg>\s*<\/button>/s';
        $replacement = '<span><?php echo isset($row[\'' . $field . '\']) ? escape_html($row[\'' . $field . '\']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="' . $field . '" title="แก้ไข"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>';
    }
    $content = preg_replace($pattern, $replacement, $content);
}

// 4. Abstract block replacement
$abstract_pattern = '/<p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line"><\?php echo escape_html\(\$row\[\'abstract\'\]\); \?><\/p>\s*<button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">\s*<svg[^>]+>.*?<\/svg>\s*<\/button>/s';
$abstract_replace = '<span class="hidden"><?php echo escape_html($row[\'abstract\']); ?></span><p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line"><?php echo escape_html($row[\'abstract\']); ?></p>
<button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block mt-2" data-field="abstract" title="แก้ไข"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>';
$content = preg_replace($abstract_pattern, $abstract_replace, $content);

file_put_contents($file, $content);
echo "Injected inline edit logic successfully.\n";
?>
