<?php
$file = 'c:/AppServ/www/intern_research/views/admin/detail_admin.php';
$content = file_get_contents($file);

// 1. Budget
$content = preg_replace(
    '/<span>50,000 บาท<\/span>\s*<button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">/s',
    '<span><?php echo isset($row[\'budget\']) ? escape_html($row[\'budget\']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="budget" title="แก้ไข">',
    $content
);

// 2. Funding Source
$content = preg_replace(
    '/<span>กองทุนพัฒนาการวิจัย มหาวิทยาลัย<\/span>\s*<button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">/s',
    '<span><?php echo isset($row[\'funding_source\']) ? escape_html($row[\'funding_source\']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="funding_source" title="แก้ไข">',
    $content
);

// 3. Link บทความ (successpdf)
// The HTML has:
// <a href="#" target="_blank" ...>คลิกเพื่ออ่านบทความ<svg...</a>
// <button type="button" ... title="แก้ไข"><svg...></button>
// We'll wrap the `a` tag in a div, and put a hidden span with the actual text value, because our JS looks for `span:first-child`!
// Actually, our JS: `const span = dd.querySelector('span:first-child');`
$link_pattern = '/<a href="#" target="_blank" class="text-orange-600 hover:text-orange-800 underline flex items-center w-max transition-colors">.*?<\/a>\s*<button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">/s';
$link_replace = '
<span class="hidden"><?php echo isset($row[\'successpdf\']) ? "file" : ""; ?></span>
<a href="<?php echo (isset($row[\'successpdf\']) && !empty($row[\'successpdf\'])) ? escape_html(BASE_URL . "admin/download?id=" . $id . "&field=successpdf") : "#"; ?>" target="_blank" class="text-orange-600 hover:text-orange-800 underline flex items-center w-max transition-colors">คลิกเพื่ออ่านบทความ</a>
<button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="successpdf" title="แก้ไข">';
$content = preg_replace($link_pattern, $link_replace, $content);

// 4. สัญญา/ติดตาม (contract)
$contract_pattern = '/<a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">.*?ดาวน์โหลดเอกสารสัญญา \(PDF\)[\s\n]*<\/a>\s*<button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">/s';
$contract_replace = '
<span class="hidden"><?php echo isset($row[\'contract\']) ? "file" : ""; ?></span>
<a href="<?php echo (isset($row[\'contract\']) && !empty($row[\'contract\'])) ? escape_html(BASE_URL . "admin/download?id=" . $id . "&field=contract") : "#"; ?>" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">ดาวน์โหลดเอกสารสัญญา (PDF)</a>
<button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="contract" title="แก้ไข">';
$content = preg_replace($contract_pattern, $contract_replace, $content);

// 5. Abstract
// Structure:
// <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 h-fit shadow-sm">
//   <div class="flex items-center justify-between mb-3 border-b border-gray-200 pb-2">
//      <h3 ...>บทคัดย่อ...</h3>
//      <button ... title="แก้ไข"><svg...></button>
//   </div>
//   <div class="text-sm text-slate-700 leading-relaxed space-y-3">
//      <p>การศึกษานี้...
//   </div>
// </div>
$abstract_pattern = '/<div class="bg-gray-50 border border-gray-200 rounded-lg p-5 h-fit shadow-sm">\s*<div class="flex items-center justify-between mb-3 border-b border-gray-200 pb-2">\s*<h3.*?<\/h3>\s*<button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-100" title="แก้ไข">/s';
$abstract_replace = '<div class="bg-gray-50 border border-gray-200 rounded-lg p-5 h-fit shadow-sm relative">
    <span class="hidden"><?php echo isset($row[\'abstract\']) ? escape_html($row[\'abstract\']) : ""; ?></span>
    <div class="flex items-center justify-between mb-3 border-b border-gray-200 pb-2">
        <h3 class="font-bold text-slate-800 flex items-center text-base">
            <svg class="w-5 h-5 mr-1.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
            บทคัดย่อ (Abstract)
        </h3>
        <button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-100" data-field="abstract" title="แก้ไข">';
$content = preg_replace($abstract_pattern, $abstract_replace, $content);

// And replace the static paragraphs in abstract:
$content = preg_replace(
    '/<div class="text-sm text-slate-700 leading-relaxed space-y-3">\s*<p>การศึกษานี้ได้สำรวจและวิเคราะห์การประยุกต์ใช้ปัญญาประดิษฐ์.*?<\/div>/s',
    '<div class="text-sm text-slate-700 leading-relaxed space-y-3"><p><?php echo isset($row[\'abstract\']) ? nl2br(escape_html($row[\'abstract\'])) : "-"; ?></p></div>',
    $content
);

file_put_contents($file, $content);
echo "Fixed missing inline edits.\n";
?>
