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

<?php if (!empty($msg)) echo $msg; ?>

<section class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 max-w-5xl mx-auto my-6">
    <!-- Header / Back button -->
    <div class="flex items-center justify-between mb-5 pb-4 border-b border-gray-200">
        <div>
            <span class="inline-block px-2 py-0.5 mb-2 text-[10px] font-bold text-orange-600 bg-orange-100 rounded-full">Record ID: <?php echo escape_html($id); ?></span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">รายละเอียดข้อมูล (Detail View)</h2>
        </div>
        <div class="flex flex-col items-end gap-2">
            <a href="<?php echo BASE_URL; ?>admin/research" class="hidden sm:inline-flex items-center px-3 py-1.5 border border-slate-300 rounded-md text-xs font-bold text-slate-600 bg-white hover:bg-slate-50 hover:text-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all shadow-sm">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                กลับสู่หน้ารายการ
            </a>
            <form action="<?php echo BASE_URL; ?>admin/research" method="POST" class="inline-block m-0 p-0">
                <input type="hidden" name="action" value="publish">
                <input type="hidden" name="id" value="<?php echo escape_html($id); ?>">
                <input type="hidden" name="redirect_to" value="detail">
                
                <?php if (isset($row['vision']) && $row['vision'] == 1): ?>
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
        </div>
    </div>

    <!-- 2-Column Grid for Details and Abstract -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Compact Info List -->
        <div class="border border-gray-200 rounded-lg overflow-hidden h-fit">
            <dl class="divide-y divide-gray-200 text-sm">
                
            <!-- Field 1 -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    ชื่อผลงานตีพิมพ์
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo isset($row['name']) ? escape_html($row['name']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="name" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    รายชื่อผู้วิจัย
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo isset($row['authors']) ? escape_html($row['authors']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="authors" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 2.5 (Faculty) -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    หน่วยงาน
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo isset($row['departments']) ? escape_html($row['departments']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="departments" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    ประเภท
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo isset($row['categories']) ? escape_html($row['categories']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="categories" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    สถานะโครงการ
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <?php
                    $prog = isset($row['progress']) ? $row['progress'] : "";
                    $progClass = "text-slate-900";
                    if ($prog == 'เสนอโครงร่าง' || $prog == 'รอรับทุน') $progClass = "bg-yellow-100 text-yellow-800 px-2.5 py-0.5 rounded-full text-xs font-bold";
                    elseif ($prog == 'กำลังดำเนินการ') $progClass = "bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-xs font-bold";
                    elseif ($prog == 'รอตีพิมพ์' || $prog == 'อยู่ระหว่างตีพิมพ์') $progClass = "bg-purple-100 text-purple-800 px-2.5 py-0.5 rounded-full text-xs font-bold";
                    elseif ($prog == 'ตีพิมพ์แล้ว' || $prog == 'เสร็จสิ้น') $progClass = "bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-xs font-bold";
                    elseif ($prog == 'ยกเลิก') $progClass = "bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-xs font-bold";
                    elseif (!empty($prog)) $progClass = "bg-gray-100 text-gray-800 px-2.5 py-0.5 rounded-full text-xs font-bold";
                    ?>
                    <span class="<?php echo $progClass; ?>"><?php echo escape_html($prog); ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="progress" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 3 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    ชื่อวารสาร
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo isset($row['journal']) ? escape_html($row['journal']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="journal" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 4 -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    ปีที่ตีพิมพ์
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo isset($row['publication_year']) ? escape_html($row['publication_year']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="publication_year" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 4.5 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    ปีที่เผยแพร่
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo isset($row['release_year']) ? escape_html($row['release_year']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="release_year" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 4.75 (Period) -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    วันเริ่มต้น - สิ้นสุดโครงการ
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo isset($row['period']) ? escape_html($row['period']) : "-"; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="period" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 5 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                    จำนวน Citation
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo (isset($row['citation']) && $row['citation'] !== '') ? escape_html($row['citation']) : "-"; ?></span>
                    <button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="citation" title="แก้ไข"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                </dd>
            </div>

            <!-- Field 5.5 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    งบประมาณ (Budget)
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo isset($row['budget']) ? escape_html($row['budget']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="budget" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 5.75 (Funding Source) -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    แหล่งทุน (Funding Source)
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo isset($row['funding_source']) ? escape_html($row['funding_source']) : ""; ?></span><button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="funding_source" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 6 (Link) -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    Link บทความ
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    
<span class="hidden"><?php echo (isset($row['successpdf']) && !empty($row['successpdf'])) ? "file" : ""; ?></span>
<?php if (isset($row['successpdf']) && !empty($row['successpdf'])): ?>
<a href="<?php echo escape_html(BASE_URL . "admin/download?id=" . $id . "&field=successpdf"); ?>" target="_blank" class="text-orange-600 hover:text-orange-800 underline flex items-center w-max transition-colors">คลิกเพื่ออ่านบทความ</a>
<?php else: ?>
<span class="text-slate-400 text-sm font-normal italic">- ไม่มีไฟล์แนบ -</span>
<?php endif; ?>
<button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="successpdf" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 6.5 (Contract / Tracking File) -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    สัญญา/ติดตาม
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                    
<span class="hidden"><?php echo (isset($row['contract']) && !empty($row['contract'])) ? "file" : ""; ?></span>
<?php if (isset($row['contract']) && !empty($row['contract'])): ?>
<a href="<?php echo escape_html(BASE_URL . "admin/download?id=" . $id . "&field=contract"); ?>" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">ดาวน์โหลดเอกสารสัญญา (PDF)</a>
<?php else: ?>
<span class="text-slate-400 text-sm font-normal italic">- ไม่มีไฟล์แนบ -</span>
<?php endif; ?>
<button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" data-field="contract" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            </dl>
        </div>

        <!-- Abstract Box (2nd Column) -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 h-fit shadow-sm relative">
    <span class="hidden"><?php echo isset($row['abstract']) ? escape_html($row['abstract']) : ""; ?></span>
    <div class="flex items-center justify-between mb-3 border-b border-gray-200 pb-2">
        <h3 class="font-bold text-slate-800 flex items-center text-base">
            <svg class="w-5 h-5 mr-1.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
            บทคัดย่อ (Abstract)
        </h3>
        <button type="button" class="edit-inline-btn text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-100" data-field="abstract" title="แก้ไข">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </button>
            </div>
            <div class="text-sm text-slate-700 leading-relaxed space-y-3 break-words whitespace-normal"><p><?php echo isset($row['abstract']) ? nl2br(escape_html($row['abstract'])) : "-"; ?></p></div>
        </div>
    </div>
</section>

<!-- KPI Table Container (Pulled out) -->
<section class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 max-w-5xl mx-auto my-6">
    <!-- KPI Table -->
    <div class="mb-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                ตัวชี้วัดผลงาน (KPI Metrics)
            </h3>
            <button type="button" onclick="document.getElementById('kpiModal').classList.remove('hidden')" class="mt-3 sm:mt-0 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                เพิ่มตัวชี้วัด
            </button>
        </div>
        <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
            <?php if (!empty($row['kpi_1']) || !empty($row['kpi_2'])): ?>
            <dl class="divide-y divide-gray-200 text-sm">
                <!-- KPI 1 -->
                <?php if (!empty($row['kpi_1'])): ?>
                <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                    <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                        <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        ตัวชี้วัด 1 (KPI 1)
                    </dt>
                    <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                        <div class="flex items-center space-x-3">
                            <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo escape_html($row['kpi_1']); ?></span>
                            <?php if (!empty($row['kpi_1file'])): ?>
                            <a href="<?php echo BASE_URL; ?>admin/download?id=<?php echo $row['id']; ?>&field=kpi_1file" target="_blank" class="inline-flex items-center text-xs px-2.5 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded border border-red-200 font-medium transition-colors shadow-sm" title="ดูไฟล์ PDF">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                ดู PDF
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="flex space-x-1">
                            <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" title="แก้ไข" onclick="openEditKpiModal('kpi_1', '<?php echo addslashes(htmlspecialchars($row['kpi_1'], ENT_QUOTES, 'UTF-8')); ?>')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <form action="<?php echo BASE_URL; ?>admin/research" method="POST" onsubmit="return confirm('ยืนยันการลบตัวชี้วัดนี้?');">
                                <input type="hidden" name="action" value="remove_kpi">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="kpi_slot" value="kpi_1">
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors p-1 rounded-md hover:bg-red-50 block" title="ลบ">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </dd>
                </div>
                <?php endif; ?>

                <!-- KPI 2 -->
                <?php if (!empty($row['kpi_2'])): ?>
                <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                    <dt class="font-bold text-slate-500 flex items-start break-words whitespace-normal pt-1">
                        <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        ตัวชี้วัด 2 (KPI 2)
                    </dt>
                    <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between min-w-0">
                        <div class="flex items-center space-x-3">
                            <span class="break-words break-all whitespace-normal flex-1 min-w-0 pr-2 block"><?php echo escape_html($row['kpi_2']); ?></span>
                            <?php if (!empty($row['kpi_2file'])): ?>
                            <a href="<?php echo BASE_URL; ?>admin/download?id=<?php echo $row['id']; ?>&field=kpi_2file" target="_blank" class="inline-flex items-center text-xs px-2.5 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded border border-red-200 font-medium transition-colors shadow-sm" title="ดูไฟล์ PDF">
                                <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                ดู PDF
                            </a>
                            <?php endif; ?>
                        </div>
                        <div class="flex space-x-1">
                            <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50 block" title="แก้ไข" onclick="openEditKpiModal('kpi_2', '<?php echo addslashes(htmlspecialchars($row['kpi_2'], ENT_QUOTES, 'UTF-8')); ?>')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <form action="<?php echo BASE_URL; ?>admin/research" method="POST" onsubmit="return confirm('ยืนยันการลบตัวชี้วัดนี้?');">
                                <input type="hidden" name="action" value="remove_kpi">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="kpi_slot" value="kpi_2">
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors p-1 rounded-md hover:bg-red-50 block" title="ลบ">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </dd>
                </div>
                <?php endif; ?>
            </dl>
            <?php else: ?>
            <div class="text-center py-6 text-slate-500 text-sm">
                ไม่มีข้อมูลตัวชี้วัด
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Document Upload Table Container (Pulled out) -->
<section class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 max-w-5xl mx-auto my-6">
    <!-- Document Upload Table -->
    <div class="mb-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-slate-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                ประวัติเอกสาร
            </h3>
            <button type="button" onclick="openUploadModal()" class="mt-3 sm:mt-0 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                อัปโหลดไฟล์
            </button>
        </div>
        
        <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
            <table class="w-full divide-y divide-gray-200 text-xs">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        
                        <th scope="col" class="px-3 py-2 text-left font-semibold whitespace-nowrap">ประเภทเอกสาร</th>
                        <th scope="col" class="px-3 py-2 text-left font-semibold whitespace-nowrap">คำอธิบาย</th>
                        <th scope="col" class="px-3 py-2 text-center font-semibold whitespace-nowrap">ไฟล์เอกสาร</th>
                        <th scope="col" class="px-3 py-2 text-center font-semibold whitespace-nowrap">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (isset($doc_files) && count($doc_files) > 0): ?>
                        <?php foreach($doc_files as $doc): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-3 py-1.5 text-slate-600 whitespace-nowrap">
                                <span class="px-1.5 py-0.5 bg-blue-100 text-blue-800 rounded text-[10px] font-semibold"><?php echo escape_html(isset($doc['categories']) && $doc['categories'] ? $doc['categories'] : "เอกสารอ้างอิง"); ?></span>
                            </td>
                            <td class="px-3 py-1.5 text-slate-600"><?php echo escape_html(isset($doc['description']) && $doc['description'] ? $doc['description'] : "-"); ?></td>
                            <td class="px-3 py-1.5 text-center whitespace-nowrap">
                                <a href="<?php echo BASE_URL; ?>admin/download?id=<?php echo $doc['id']; ?>&field=doc_file" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                    <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                    ดาวน์โหลด
                                </a>
                            </td>
                            <td class="px-3 py-1.5 text-center whitespace-nowrap">
                                <button type="button" onclick="openEditDocModal(<?php echo $doc['id']; ?>, '<?php echo htmlspecialchars(isset($doc['categories']) ? $doc['categories'] : '', ENT_QUOTES); ?>', '<?php echo htmlspecialchars(isset($doc['description']) ? $doc['description'] : '', ENT_QUOTES); ?>')" class="text-blue-500 hover:text-blue-700 mx-1 transition-colors" title="แก้ไข"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                <form action="<?php echo BASE_URL; ?>admin/research" method="POST" class="inline-block" onsubmit="return confirm('ยืนยันการลบเอกสารนี้?');">
                                    <input type="hidden" name="action" value="delete_doc">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="doc_id" value="<?php echo $doc['id']; ?>">
                                    <button type="submit" class="text-red-500 hover:text-red-700 mx-1 transition-colors" title="ลบ"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-3 py-4 text-center text-slate-500">ไม่มีประวัติเอกสาร</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Mobile Back Button -->
<div class="mt-6 mb-6 text-center sm:hidden max-w-5xl mx-auto">
    <a href="<?php echo BASE_URL; ?>admin/research" class="inline-flex items-center px-4 py-2 border border-slate-300 rounded-md text-xs font-bold text-slate-600 bg-white hover:bg-slate-50 transition-all shadow-sm">
            กลับสู่หน้ารายการ
        </a>
    </div>

    <!-- Danger Zone / Delete Button -->
    <div class="max-w-5xl mx-auto my-8 p-6 bg-red-50 border border-red-100 rounded-2xl shadow-sm flex flex-col sm:flex-row items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-red-800">Danger Zone</h3>
            <p class="text-sm text-red-600 mt-1">เมื่อลบข้อมูลแล้วจะไม่สามารถกู้คืนได้ (This action cannot be undone.)</p>
        </div>
        <form action="<?php echo BASE_URL; ?>admin/research" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลงานวิจัยนี้? (Are you sure you want to delete this research?)');" class="mt-4 sm:mt-0">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                ลบข้อมูลงานวิจัย (Delete Research)
            </button>
        </form>
    </div>

    <!-- Upload Modal -->
    <div id="uploadModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="document.getElementById('uploadModal').classList.add('hidden')"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-bold text-slate-800" id="modal-title">
                                อัปโหลดเอกสาร (Upload Document)
                            </h3>
                            <div class="mt-4 w-full">
                                <form action="<?php echo BASE_URL; ?>admin/research" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="upload_doc">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">ประเภทเอกสาร (Document Type) <span class="text-red-500">*</span></label>
                                        <select name="doc_type" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2 border">
                                            <option value="">เลือกประเภทเอกสาร</option>
                                            <option value="รายงานฉบับสมบูรณ์">รายงานฉบับสมบูรณ์</option>
                                            <option value="เอกสารเบิกจ่าย">เอกสารเบิกจ่าย</option>
                                            <option value="อื่นๆ">อื่นๆ</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">คำอธิบาย (Description)</label>
                                        <textarea name="description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2 border" placeholder="รายละเอียดเพิ่มเติม..."></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">ไฟล์เอกสาร (File) <span class="text-red-500">*</span></label>
                                        <input type="file" name="doc_file" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-md p-1" onchange="window.showFileAttached(this)">
                                        <div class="file-status text-green-600 text-sm font-bold mt-2 hidden flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span>แนบไฟล์แล้ว: <span class="file-name font-normal"></span></span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        บันทึก (Save)
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-bold text-slate-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors" onclick="document.getElementById('uploadModal').classList.add('hidden')">
                        ยกเลิก (Cancel)
                    </button>
                                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add KPI Modal -->
    <div id="kpiModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="document.getElementById('kpiModal').classList.add('hidden')"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="<?php echo BASE_URL; ?>admin/research" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="update_kpi">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                    เพิ่มตัวชี้วัดผลงาน (KPI)
                                </h3>
                                <div class="mt-4 space-y-4 text-left">
                                    <!-- Select slot -->
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">เลือกลำดับตัวชี้วัด</label>
                                        <select name="kpi_slot" class="w-full px-3 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-sm" required>
                                            <option value="kpi_1">ตัวชี้วัด 1 (KPI 1)</option>
                                            <option value="kpi_2">ตัวชี้วัด 2 (KPI 2)</option>
                                        </select>
                                    </div>
                                    <!-- Select KPI type -->
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">ประเภทตัวชี้วัด</label>
                                        <select name="kpi_type" onchange="this.value === 'อื่นๆ(ไม่ตรงตามตัวชี้วัด)' ? document.getElementById('kpi_other_container').classList.remove('hidden') : document.getElementById('kpi_other_container').classList.add('hidden')" class="w-full px-3 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-sm" required>
                                            <option value="">-- เลือกประเภทตัวชี้วัด --</option>
                                            <option value="paper scopus">paper scopus</option>
                                            <option value="สิทธิบัตร">สิทธิบัตร</option>
                                            <option value="อนุสิทธิบัตร">อนุสิทธิบัตร</option>
                                            <option value="อื่นๆ(ไม่ตรงตามตัวชี้วัด)">อื่นๆ(ไม่ตรงตามตัวชี้วัด)</option>
                                        </select>
                                    </div>
                                    <!-- Other text input -->
                                    <div id="kpi_other_container" class="hidden">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">โปรดระบุ</label>
                                        <input type="text" name="kpi_other" class="w-full px-3 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-sm" placeholder="ระบุตัวชี้วัดอื่นๆ...">
                                    </div>
                                    <!-- File upload -->
                                    <div>
                                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">แนบไฟล์หลักฐาน (PDF)</label>
                                        <input type="file" name="kpi_file" accept=".pdf" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors border border-gray-200 rounded-lg" onchange="window.showFileAttached(this)">
                                        <div class="file-status text-green-600 text-sm font-bold mt-2 hidden flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            <span>แนบไฟล์แล้ว: <span class="file-name font-normal"></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-bold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            บันทึก (Save)
                        </button>
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-bold text-slate-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors" onclick="document.getElementById('kpiModal').classList.add('hidden')">
                            ยกเลิก (Cancel)
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    const BASE_URL = '<?php echo BASE_URL; ?>';
    const RECORD_ID = '<?php echo $id; ?>';
    
    function openUploadModal() {
        const modal = document.getElementById('uploadModal');
        const title = modal.querySelector('h3');
        const form = modal.querySelector('form');
        const actionInput = form.querySelector('input[name="action"]');
        
        title.innerText = 'อัปโหลดเอกสาร (Upload Document)';
        actionInput.value = 'upload_doc';
        
        const docIdInput = form.querySelector('input[name="doc_id"]');
        if (docIdInput) docIdInput.remove();
        
        form.reset();
        
        const fileInput = form.querySelector('input[name="doc_file"]');
        fileInput.required = true;
        
        modal.classList.remove('hidden');
    }

    function openEditDocModal(docId, docType, docDesc) {
        const modal = document.getElementById('uploadModal');
        const title = modal.querySelector('h3');
        const form = modal.querySelector('form');
        const actionInput = form.querySelector('input[name="action"]');
        let docIdInput = form.querySelector('input[name="doc_id"]');
        
        if (!docIdInput) {
            docIdInput = document.createElement('input');
            docIdInput.type = 'hidden';
            docIdInput.name = 'doc_id';
            form.appendChild(docIdInput);
        }
        
        title.innerText = 'แก้ไขเอกสาร (Edit Document)';
        actionInput.value = 'edit_doc';
        docIdInput.value = docId;
        
        form.querySelector('select[name="doc_type"]').value = docType;
        form.querySelector('textarea[name="description"]').value = docDesc;
        
        const fileInput = form.querySelector('input[name="doc_file"]');
        fileInput.required = false; 
        
        modal.classList.remove('hidden');
    }
    
    window.showFileAttached = function(input) {
        const statusDiv = input.parentElement.querySelector('.file-status');
        if (!statusDiv) return;
        const nameSpan = statusDiv.querySelector('.file-name');
        if(input.files && input.files.length > 0) {
            nameSpan.textContent = input.files[0].name;
            statusDiv.classList.remove('hidden');
        } else {
            statusDiv.classList.add('hidden');
        }
    };

    window.updateInlinePeriod = function() {
        const start = document.getElementById('inline_start_date').value;
        const end = document.getElementById('inline_end_date').value;
        const valInput = document.getElementById('inline_period_value');
        
        const formatDate = (d) => {
            if(!d) return '';
            const p = d.split('-');
            if(p.length === 3) return p[2] + '/' + p[1] + '/' + p[0];
            return d;
        };
        
        const fStart = formatDate(start);
        const fEnd = formatDate(end);
        
        if (fStart && fEnd) valInput.value = fStart + ' - ' + fEnd;
        else if (fStart) valInput.value = fStart;
        else if (fEnd) valInput.value = fEnd;
        else valInput.value = '';
    };

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
            const isTextarea = field === 'abstract' || field === 'authors' || field === 'funding_source';
            const isProgress = field === 'progress';
            const isPeriod = field === 'period';
            const numRows = field === 'abstract' ? 10 : 3;

            let inputHtml = '';
            if (isFile) {
                inputHtml = `
                    <div class="w-full">
                        <input type="file" name="file_upload" class="w-full text-sm text-slate-500 file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" onchange="window.showFileAttached(this)">
                        <div class="file-status text-green-600 text-xs font-bold mt-1 hidden flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>แนบไฟล์แล้ว: <span class="file-name font-normal"></span></span>
                        </div>
                    </div>
                `;
            } else if (isProgress) {
                inputHtml = `
                <select name="value" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500">
                    <option value="เสนอโครงร่าง" ${originalText === 'เสนอโครงร่าง' ? 'selected' : ''}>เสนอโครงร่าง</option>
                    <option value="กำลังดำเนินการ" ${originalText === 'กำลังดำเนินการ' ? 'selected' : ''}>กำลังดำเนินการ</option>
                    <option value="รอตีพิมพ์" ${originalText === 'รอตีพิมพ์' ? 'selected' : ''}>รอตีพิมพ์</option>
                    <option value="อยู่ระหว่างตีพิมพ์" ${originalText === 'อยู่ระหว่างตีพิมพ์' ? 'selected' : ''}>อยู่ระหว่างตีพิมพ์</option>
                    <option value="ตีพิมพ์แล้ว" ${originalText === 'ตีพิมพ์แล้ว' ? 'selected' : ''}>ตีพิมพ์แล้ว</option>
                    <option value="เสร็จสิ้น" ${originalText === 'เสร็จสิ้น' ? 'selected' : ''}>เสร็จสิ้น</option>
                    <option value="ยกเลิก" ${originalText === 'ยกเลิก' ? 'selected' : ''}>ยกเลิก</option>
                </select>`;
            } else if (isTextarea) {
                inputHtml = `<textarea name="value" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500" rows="${numRows}">${originalText}</textarea>`;
            } else if (isPeriod) {
                let startVal = '';
                let endVal = '';
                if (originalText.includes(' - ')) {
                    const parts = originalText.split(' - ');
                    const parseDate = (d) => {
                        const p = d.split('/');
                        if(p.length === 3) return p[2] + '-' + p[1] + '-' + p[0];
                        return d.includes('-') ? d : '';
                    };
                    startVal = parseDate(parts[0].trim());
                    endVal = parseDate(parts[1].trim());
                } else if (originalText.includes('/')) {
                    const p = originalText.trim().split('/');
                    if(p.length === 3) startVal = p[2] + '-' + p[1] + '-' + p[0];
                } else {
                    startVal = originalText.trim();
                }
                
                inputHtml = `
                    <div class="flex flex-wrap items-center gap-2 w-full">
                        <input type="date" id="inline_start_date" value="${startVal}" class="flex-1 min-w-[120px] px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500" onchange="window.updateInlinePeriod()">
                        <span class="text-gray-500 font-bold">-</span>
                        <input type="date" id="inline_end_date" value="${endVal}" class="flex-1 min-w-[120px] px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500" onchange="window.updateInlinePeriod()">
                    </div>
                    <input type="hidden" name="value" id="inline_period_value" value="${safeText}">
                `;
            } else if (field === 'publication_year' || field === 'release_year') {
                inputHtml = `<input type="text" name="value" value="${safeText}" pattern="[0-9]*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500">`;
            } else {
                inputHtml = `<input type="text" name="value" value="${safeText}" class="w-full px-2 py-1 text-sm border border-orange-300 rounded focus:outline-none focus:ring-1 focus:ring-orange-500">`;
            }

            const encType = isFile ? 'enctype="multipart/form-data"' : '';
            
            dd.innerHTML = `
                <form method="POST" action="${BASE_URL}admin/research" ${encType} class="flex items-center gap-2 w-full mt-2">
                    <input type="hidden" name="action" value="inline_edit">
                    <input type="hidden" name="id" value="${RECORD_ID}">
                    <input type="hidden" name="field" value="${field}">
                    ${inputHtml}
                    <button type="submit" class="text-green-600 hover:text-green-800 p-1" title="บันทึก"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></button>
                    <button type="button" class="cancel-edit text-red-600 hover:text-red-800 p-1" title="ยกเลิก"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </form>
            `;

            dd.querySelector('.cancel-edit').addEventListener('click', () => {
                location.reload(); 
            });
        });
    });

    function openEditKpiModal(slot, value) {
        const modal = document.getElementById('kpiModal');
        const slotSelect = modal.querySelector('select[name="kpi_slot"]');
        const typeSelect = modal.querySelector('select[name="kpi_type"]');
        const otherContainer = document.getElementById('kpi_other_container');
        const otherInput = modal.querySelector('input[name="kpi_other"]');
        const title = document.getElementById('modal-title');
        
        if (title) title.innerText = 'แก้ไขตัวชี้วัดผลงาน (KPI)';
        
        if (slotSelect) slotSelect.value = slot;
        
        const standardOptions = ['paper scopus', 'สิทธิบัตร', 'อนุสิทธิบัตร'];
        if (value && standardOptions.includes(value)) {
            typeSelect.value = value;
            otherContainer.classList.add('hidden');
            otherInput.value = '';
        } else if (value) {
            typeSelect.value = 'อื่นๆ(ไม่ตรงตามตัวชี้วัด)';
            otherContainer.classList.remove('hidden');
            otherInput.value = value;
        } else {
            typeSelect.value = '';
            otherContainer.classList.add('hidden');
            otherInput.value = '';
        }
        
        modal.classList.remove('hidden');
    }
</script>
<?php
require_once ROOT_DIR . '/includes/footer.php';
?>
