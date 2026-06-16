<?php
$file = 'c:/AppServ/www/intern_research/views/admin/detail_admin.php';
$content = file_get_contents($file);

// Add an ID and script at the bottom of the file
$script = <<<EOT
<script>
    const BASE_URL = '<?php echo BASE_URL; ?>';
    const RECORD_ID = '<?php echo \$id; ?>';
    
    document.querySelectorAll('.edit-inline-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const dd = this.closest('dd');
            if (dd.querySelector('form')) return; // already editing
            
            const span = dd.querySelector('span:first-child');
            const originalText = span.innerText.trim();
            const field = this.dataset.field;
            
            // For abstract, use textarea
            const isTextarea = field === 'abstract' || field === 'authors';
            const inputHtml = isTextarea 
                ? `<textarea name="value" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500" rows="4">\${originalText}</textarea>`
                : `<input type="text" name="value" value="\${originalText}" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500">`;

            const originalHTML = dd.innerHTML;
            
            dd.innerHTML = `
                <form method="POST" action="\${BASE_URL}admin/research" class="flex items-center gap-2 w-full">
                    <input type="hidden" name="action" value="inline_edit">
                    <input type="hidden" name="id" value="\${RECORD_ID}">
                    <input type="hidden" name="field" value="\${field}">
                    \${inputHtml}
                    <button type="submit" class="text-green-600 hover:text-green-800 p-1" title="บันทึก"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></button>
                    <button type="button" class="cancel-edit text-red-600 hover:text-red-800 p-1" title="ยกเลิก"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </form>
            `;

            dd.querySelector('.cancel-edit').addEventListener('click', () => {
                dd.innerHTML = originalHTML;
                // reattach event listener by refreshing page or we just let it be since it's a simple cancel, but actually it destroys the button listener.
                // It's easier to just reload the page on cancel, or we can use event delegation.
                location.reload(); 
            });
        });
    });
</script>
EOT;

// I will just use preg_replace to inject data-field into each specific block based on the row variable name
// First, replace all the edit buttons with a class 'edit-inline-btn' instead of standard link.
// Wait, I can identify the field by looking at the preceding span!
// e.g. <span><?php echo escape_html($row['name']); ? ></span>

$pattern = '/<span><\?php\s+echo\s+(?:escape_html\(|number_format\()?\$row\[\'(.*?)\'\](?:.*?)\s*\?>.*?<\/span>\s*<a href="<\?php echo BASE_URL; \?>admin\/editresearch\?id=<\?php echo escape_html\(\$id\); \?>" class="(.*?)" title="แก้ไข">/s';

$replacement = '<span><?php echo isset($row[\'$1\']) ? escape_html($row[\'$1\']) : ""; ?></span>
<a href="#" class="$2 edit-inline-btn" data-field="$1" title="แก้ไข">';

$content = preg_replace($pattern, $replacement, $content);

// For abstract, the structure is slightly different:
// <p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line"><?php echo escape_html($row['abstract']); ? ></p>
$abstract_pattern = '/<p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line"><\?php echo escape_html\(\$row\[\'abstract\'\]\); \?><\/p>\s*<a href="<\?php echo BASE_URL; \?>admin\/editresearch\?id=<\?php echo escape_html\(\$id\); \?>" class="(.*?)" title="แก้ไข">/s';
$abstract_replace = '<span class="hidden"><?php echo escape_html($row[\'abstract\']); ?></span><p class="text-slate-600 leading-relaxed text-sm whitespace-pre-line"><?php echo escape_html($row[\'abstract\']); ?></p>
<a href="#" class="$1 edit-inline-btn" data-field="abstract" title="แก้ไข">';
$content = preg_replace($abstract_pattern, $abstract_replace, $content);

// Add script before footer
$content = str_replace('<?php', $script . "\n<?php", $content); 
// Wait, str_replace('<?php') will replace the FIRST <?php at the top. I need to put it before the require footer.
$content = preg_replace('/<\?php\s+require_once ROOT_DIR \. \'\/includes\/footer\.php\';/', $script . "\n<?php\nrequire_once ROOT_DIR . '/includes/footer.php';", $content);


file_put_contents($file, $content);
echo "Injected inline edit logic.\n";
?>
