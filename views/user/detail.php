<?php
require_once ROOT_DIR . '/functions/common.php';
require_once ROOT_DIR . '/includes/header.php';

if (!isset($row) || !$row) {
    echo '<div class="max-w-4xl mx-auto my-8 p-6 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg shadow-sm font-semibold">ไม่พบข้อมูล หรือ ID ไม่ถูกต้อง (Invalid ID)</div>';
    require_once ROOT_DIR . '/includes/footer.php';
    exit;
}
$id = $row['id'];
?>

<section class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 max-w-4xl mx-auto my-6">
    <!-- Header / Back button -->
    <div class="flex items-center justify-between mb-5 pb-4 border-b border-gray-200">
        <div>
            <span class="inline-block px-2 py-0.5 mb-2 text-[10px] font-bold text-orange-600 bg-orange-100 rounded-full">Record ID: <?php echo escape_html($id); ?></span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">รายละเอียดข้อมูล (Detail View)</h2>
        </div>
        <a href="<?php echo BASE_URL; ?>user/research" class="hidden sm:inline-flex items-center px-3 py-1.5 border border-slate-300 rounded-md text-xs font-bold text-slate-600 bg-white hover:bg-slate-50 hover:text-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all shadow-sm">
            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            กลับสู่หน้ารายการ
        </a>
    </div>

    <!-- Compact Info List -->
    <div class="border border-gray-200 rounded-lg overflow-hidden">
        <dl class="divide-y divide-gray-200 text-sm">
            
            <!-- Field 1 -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    ชื่อผลงานตีพิมพ์
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2"><?php echo escape_html($row['name']); ?></dd>
            </div>

            <!-- Field 2 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    รายชื่อผู้วิจัย
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2"><?php echo escape_html($row['authors']); ?></dd>
            </div>

            <!-- Field 2.5 (Faculty) -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    หน่วยงาน
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2"><?php echo escape_html($row['departments']); ?></dd>
            </div>

            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    ประเภท
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2"><?php echo escape_html($row['categories']); ?></dd>
            </div>

            <!-- Field 3 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    ชื่อวารสาร
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center">
                    <?php echo escape_html($row['journal']); ?> 
                    
                </dd>
            </div>

            <!-- Field 4 -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    ปีที่ตีพิมพ์
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2"><?php echo escape_html($row['publication_year']); ?></dd>
            </div>

            <!-- Field 4.5 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    ปีที่เผยแพร่
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2"><?php echo escape_html($row['release_year']); ?></dd>
            </div>

            <!-- Field 6 (Link) -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    Link บทความ
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">
                    <?php if (!empty($row['successpdf'])): ?>
                    <a href="<?php echo escape_html(BASE_URL . "user/download?id=" . $id . "&field=successpdf"); ?>" target="_blank" class="text-orange-600 hover:text-orange-800 underline flex items-center w-max transition-colors">
                        คลิกเพื่ออ่านบทความ
                        <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    <?php else: ?>
                    <span class="text-slate-400 text-sm font-normal italic">- ไม่มีไฟล์แนบ -</span>
                    <?php endif; ?>
                </dd>
            </div>

            <!-- Field 6.75 (Final Report) -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    รายงานฉบับสมบูรณ์
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">
                    <?php if (!empty($row['contract'])): ?>
                    <a href="<?php echo escape_html(BASE_URL . "user/download?id=" . $id . "&field=contract"); ?>" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                        <svg class="w-4 h-4 mr-1.5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                        ดาวน์โหลดรายงานฉบับสมบูรณ์ (PDF)
                    </a>
                    <?php else: ?>
                    <span class="text-slate-400 text-sm font-normal italic">- ไม่มีไฟล์แนบ -</span>
                    <?php endif; ?>
                </dd>
            </div>

            <!-- Field 7 (Full width) -->
            <div class="bg-white px-4 py-4 sm:px-6">
                <dt class="font-bold text-slate-500 flex items-center mb-2">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    บทคัดย่อ (Abstract)
                </dt>
                <dd class="text-sm text-slate-700 leading-relaxed">
                    <?php echo nl2br(escape_html($row['abstract'])); ?>
                </dd>
            </div>

        </dl>
    </div>

</section>

<!-- Mobile Back Button -->
<div class="mt-6 mb-6 text-center sm:hidden max-w-4xl mx-auto">
    <a href="<?php echo BASE_URL; ?>user/research" class="inline-flex items-center px-4 py-2 border border-slate-300 rounded-md text-xs font-bold text-slate-600 bg-white hover:bg-slate-50 transition-all shadow-sm">
        กลับสู่หน้ารายการ
    </a>
</div>

<?php
require_once ROOT_DIR . '/includes/footer.php';
?>
