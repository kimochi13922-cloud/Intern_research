<?php
// 1. Reset detail_admin.php
exec('git checkout views/admin/detail_admin.php');

// 2. Run inject_inline_v3 to make it dynamic
require 'inject_inline_v3.php';

// 3. Run fix_inline.php for missing fields
require 'fix_inline.php';

// 4. Do specific modifications on detail_admin.php
$file = 'c:/AppServ/www/intern_research/views/admin/detail_admin.php';
$content = file_get_contents($file);

// 4.1 Remove Main Edit Button
$content = preg_replace(
    '/<a href="<\?php echo BASE_URL; \?>admin\/editresearch\?id=<\?php echo escape_html\(\$id\); \?>" class="hidden sm:inline-flex.*?<\/a>/s',
    '',
    $content
);

// 4.2 Replace Publish Button with Toggle Form
$publish_original = <<<EOT
            <button type="button" class="hidden sm:inline-flex items-center px-3 py-1.5 border border-transparent rounded-md text-xs font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all shadow-sm">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                เผยแพร่ผลงาน (Publish)
            </button>
EOT;

$publish_form = <<<EOT
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
$content = str_replace($publish_original, $publish_form, $content);

// 4.3 Replace the JS script block with the advanced file upload JS
$old_script_start = "<script>\n    const BASE_URL";
$old_script_full = substr($content, strpos($content, $old_script_start));
$old_script_full = substr($old_script_full, 0, strpos($old_script_full, "</script>") + 9);

$new_script = <<<EOT
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
            
            const isFile = field === 'successpdf' || field === 'contract';
            const isTextarea = field === 'abstract' || field === 'authors';
            const numRows = field === 'abstract' ? 10 : 3;

            let inputHtml = '';
            if (isFile) {
                inputHtml = `<input type="file" name="file_upload" class="w-full text-sm text-slate-500 file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">`;
            } else if (isTextarea) {
                inputHtml = `<textarea name="value" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500" rows="\${numRows}">\${originalText}</textarea>`;
            } else {
                inputHtml = `<input type="text" name="value" value="\${safeText}" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500">`;
            }

            const encType = isFile ? 'enctype="multipart/form-data"' : '';
            
            dd.innerHTML = `
                <form method="POST" action="\${BASE_URL}admin/research" \${encType} class="flex items-center gap-2 w-full mt-2">
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

$content = str_replace($old_script_full, $new_script, $content);

file_put_contents($file, $content);
echo "Ultimate fix applied successfully!\n";
?>
