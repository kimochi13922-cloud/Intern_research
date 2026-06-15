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
            <button type="button" class="hidden sm:inline-flex items-center px-3 py-1.5 border border-transparent rounded-md text-xs font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all shadow-sm">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                เผยแพร่ผลงาน (Publish)
            </button>
        </div>
    </div>

    <!-- 2-Column Grid for Details and Abstract -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Compact Info List -->
        <div class="border border-gray-200 rounded-lg overflow-hidden h-fit">
            <dl class="divide-y divide-gray-200 text-sm">
                
                <!-- Field 1 -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    ชื่อผลงานตีพิมพ์
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <span>Development of AI Models for Healthcare Predictive Analytics</span>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 2 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    รายชื่อผู้วิจัย
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <span>Dr. Jane Doe, Dr. John Smith</span>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 2.5 (Faculty) -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    หน่วยงาน
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <span>คณะแพทยศาสตร์</span>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    ประเภท
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <span>งานวิจัย</span>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    สถานะโครงการ
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-bold">กำลังดำเนินการ (In Progress)</span>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 3 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    ชื่อวารสาร
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <div class="flex items-center">
                        Journal of Medical AI 
                        <span class="ml-2 px-1.5 py-0.5 bg-green-100 text-green-800 rounded text-[10px] font-bold">Q1</span>
                    </div>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 4 -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    ปีที่ตีพิมพ์
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <span>2023</span>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 4.5 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    ปีที่เผยแพร่
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <span>2024</span>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 5 -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                    จำนวน Citation
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <span>15 ครั้ง</span>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 5.5 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    งบประมาณ (Budget)
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <span>50,000 บาท</span>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 5.75 (Funding Source) -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    แหล่งทุน (Funding Source)
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <span>กองทุนพัฒนาการวิจัย มหาวิทยาลัย</span>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 6 (Link) -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    Link บทความ
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <a href="#" target="_blank" class="text-orange-600 hover:text-orange-800 underline flex items-center w-max transition-colors">
                        คลิกเพื่ออ่านบทความ
                        <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            <!-- Field 6.5 (Contract / Tracking File) -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    สัญญา/ติดตาม
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center justify-between">
                    <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                        <svg class="w-4 h-4 mr-1.5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                        ดาวน์โหลดเอกสารสัญญา (PDF)
                    </a>
                    <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-50" title="แก้ไข">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                </dd>
            </div>

            </dl>
        </div>

        <!-- Abstract Box (2nd Column) -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 h-fit shadow-sm">
            <div class="flex items-center justify-between mb-3 border-b border-gray-200 pb-2">
                <h3 class="font-bold text-slate-800 flex items-center text-base">
                    <svg class="w-5 h-5 mr-1.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    บทคัดย่อ (Abstract)
                </h3>
                <button type="button" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-md hover:bg-blue-100" title="แก้ไข">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </button>
            </div>
            <div class="text-sm text-slate-700 leading-relaxed space-y-3">
                <p>การศึกษานี้ได้สำรวจและวิเคราะห์การประยุกต์ใช้ปัญญาประดิษฐ์ (AI) ในการพยากรณ์ความเสี่ยงด้านสุขภาพจากข้อมูลผู้ป่วยในอดีต (This study explores the application of artificial intelligence in early disease detection and predictive analytics using historical patient data.) โดยผลลัพธ์แสดงให้เห็นถึงความแม่นยำในการคาดการณ์ที่สูงถึง 92% ซึ่งมีนัยสำคัญในการนำไปใช้ในโรงพยาบาลระดับประเทศต่อไป.</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sed, dicta inventore itaque ratione molestias quisquam impedit laudantium architecto dolores officiis minus officia rerum, nam beatae repudiandae est sit repellendus eaque!</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam sit itaque earum sequi aut aperiam vel, saepe, pariatur voluptatibus quas quibusdam quisquam beatae neque. Accusamus harum illum suscipit voluptas esse.</p>
            </div>
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
            <table class="w-full divide-y divide-gray-200 text-xs">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th scope="col" class="px-3 py-2 text-left font-semibold whitespace-nowrap">ชื่อตัวชี้วัด</th>
                        <th scope="col" class="px-3 py-2 text-center font-semibold whitespace-nowrap">เป้าหมาย</th>
                        <th scope="col" class="px-3 py-2 text-center font-semibold whitespace-nowrap">ผลงานจริง</th>
                        <th scope="col" class="px-3 py-2 text-center font-semibold whitespace-nowrap">ความคืบหน้า</th>
                        <th scope="col" class="px-3 py-2 text-center font-semibold whitespace-nowrap">สถานะ</th>
                        <th scope="col" class="px-3 py-2 text-center font-semibold whitespace-nowrap">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- KPI Row 1 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-3 py-1.5 font-medium text-slate-800">จำนวนการอ้างอิง (Citations)</td>
                        <td class="px-3 py-1.5 text-center text-slate-600">10</td>
                        <td class="px-3 py-1.5 text-center text-indigo-600 font-bold">15</td>
                        <td class="px-3 py-1.5 text-center">
                            <div class="w-full bg-gray-200 rounded-full h-2 max-w-[80px] mx-auto">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                            </div>
                        </td>
                        <td class="px-3 py-1.5 text-center">
                            <span class="px-1.5 py-0.5 bg-green-100 text-green-800 rounded-full text-[10px] font-bold">บรรลุเป้าหมาย</span>
                        </td>
                        <td class="px-3 py-1.5 text-center whitespace-nowrap">
                            <button type="button" class="text-blue-500 hover:text-blue-700 mx-1 transition-colors" title="แก้ไข"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                            <button type="button" class="text-red-500 hover:text-red-700 mx-1 transition-colors" title="ลบ"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </td>
                    </tr>
                    <!-- KPI Row 2 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-3 py-1.5 font-medium text-slate-800">จำนวนดาวน์โหลด (Downloads)</td>
                        <td class="px-3 py-1.5 text-center text-slate-600">500</td>
                        <td class="px-3 py-1.5 text-center text-indigo-600 font-bold">342</td>
                        <td class="px-3 py-1.5 text-center">
                            <div class="w-full bg-gray-200 rounded-full h-2 max-w-[80px] mx-auto">
                                <div class="bg-orange-400 h-2 rounded-full" style="width: 68%"></div>
                            </div>
                        </td>
                        <td class="px-3 py-1.5 text-center">
                            <span class="px-1.5 py-0.5 bg-orange-100 text-orange-800 rounded-full text-[10px] font-bold">กำลังดำเนินการ</span>
                        </td>
                        <td class="px-3 py-1.5 text-center whitespace-nowrap">
                            <button type="button" class="text-blue-500 hover:text-blue-700 mx-1 transition-colors" title="แก้ไข"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                            <button type="button" class="text-red-500 hover:text-red-700 mx-1 transition-colors" title="ลบ"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </td>
                    </tr>
                    <!-- KPI Row 3 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-3 py-1.5 font-medium text-slate-800">Q-Score Journal</td>
                        <td class="px-3 py-1.5 text-center text-slate-600">Q2</td>
                        <td class="px-3 py-1.5 text-center text-indigo-600 font-bold">Q1</td>
                        <td class="px-3 py-1.5 text-center">
                            <div class="w-full bg-gray-200 rounded-full h-2 max-w-[80px] mx-auto">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                            </div>
                        </td>
                        <td class="px-3 py-1.5 text-center">
                            <span class="px-1.5 py-0.5 bg-green-100 text-green-800 rounded-full text-[10px] font-bold">เกินเป้าหมาย</span>
                        </td>
                        <td class="px-3 py-1.5 text-center whitespace-nowrap">
                            <button type="button" class="text-blue-500 hover:text-blue-700 mx-1 transition-colors" title="แก้ไข"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                            <button type="button" class="text-red-500 hover:text-red-700 mx-1 transition-colors" title="ลบ"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </td>
                    </tr>
                </tbody>
            </table>
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
            <button type="button" onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="mt-3 sm:mt-0 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                อัปโหลดไฟล์
            </button>
        </div>
        
        <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
            <table class="w-full divide-y divide-gray-200 text-xs">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th scope="col" class="px-3 py-2 text-left font-semibold whitespace-nowrap">วันที่ดำเนินการ</th>
                        <th scope="col" class="px-3 py-2 text-left font-semibold whitespace-nowrap">ผู้ดำเนินการ</th>
                        <th scope="col" class="px-3 py-2 text-left font-semibold whitespace-nowrap">ประเภทเอกสาร</th>
                        <th scope="col" class="px-3 py-2 text-left font-semibold whitespace-nowrap">คำอธิบาย</th>
                        <th scope="col" class="px-3 py-2 text-center font-semibold whitespace-nowrap">ไฟล์เอกสาร</th>
                        <th scope="col" class="px-3 py-2 text-center font-semibold whitespace-nowrap">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Example Row 1 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-3 py-1.5 text-slate-600 whitespace-nowrap">15/10/2023 14:30</td>
                        <td class="px-3 py-1.5 text-slate-800 font-medium whitespace-nowrap">Admin สมชาย</td>
                        <td class="px-3 py-1.5 text-slate-600 whitespace-nowrap">
                            <span class="px-1.5 py-0.5 bg-blue-100 text-blue-800 rounded text-[10px] font-semibold">รายงานฉบับสมบูรณ์</span>
                        </td>
                        <td class="px-3 py-1.5 text-slate-600">อัปโหลดรายงานวิจัยฉบับสมบูรณ์ (Final Report)</td>
                        <td class="px-3 py-1.5 text-center whitespace-nowrap">
                            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                ดาวน์โหลด
                            </a>
                        </td>
                        <td class="px-3 py-1.5 text-center whitespace-nowrap">
                            <button type="button" class="text-blue-500 hover:text-blue-700 mx-1 transition-colors" title="แก้ไข"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                            <button type="button" class="text-red-500 hover:text-red-700 mx-1 transition-colors" title="ลบ"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </td>
                    </tr>
                    <!-- Example Row 2 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-3 py-1.5 text-slate-600 whitespace-nowrap">10/10/2023 09:15</td>
                        <td class="px-3 py-1.5 text-slate-800 font-medium whitespace-nowrap">Admin สมศรี</td>
                        <td class="px-3 py-1.5 text-slate-600 whitespace-nowrap">
                            <span class="px-1.5 py-0.5 bg-green-100 text-green-800 rounded text-[10px] font-semibold">เอกสารเบิกจ่าย</span>
                        </td>
                        <td class="px-3 py-1.5 text-slate-600">หลักฐานการเบิกงบประมาณงวดที่ 1</td>
                        <td class="px-3 py-1.5 text-center whitespace-nowrap">
                            <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                <svg class="w-4 h-4 mr-1 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                ดาวน์โหลด
                            </a>
                        </td>
                        <td class="px-3 py-1.5 text-center whitespace-nowrap">
                            <button type="button" class="text-blue-500 hover:text-blue-700 mx-1 transition-colors" title="แก้ไข"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                            <button type="button" class="text-red-500 hover:text-red-700 mx-1 transition-colors" title="ลบ"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                        </td>
                    </tr>
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
                                <form action="#" method="POST" enctype="multipart/form-data">
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">ประเภทเอกสาร (Document Type) <span class="text-red-500">*</span></label>
                                        <select required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2 border">
                                            <option value="">เลือกประเภทเอกสาร</option>
                                            <option value="report">รายงานฉบับสมบูรณ์</option>
                                            <option value="expense">เอกสารเบิกจ่าย</option>
                                            <option value="other">อื่นๆ</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">คำอธิบาย (Description)</label>
                                        <textarea rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2 border" placeholder="รายละเอียดเพิ่มเติม..."></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">ไฟล์เอกสาร (File) <span class="text-red-500">*</span></label>
                                        <input type="file" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-md p-1">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-bold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors" onclick="document.getElementById('uploadModal').classList.add('hidden')">
                        บันทึก (Save)
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-bold text-slate-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors" onclick="document.getElementById('uploadModal').classList.add('hidden')">
                        ยกเลิก (Cancel)
                    </button>
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
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-bold text-slate-800" id="modal-title">
                                เพิ่มตัวชี้วัดผลงาน (Add KPI)
                            </h3>
                            <div class="mt-4 w-full">
                                <form action="#" method="POST">
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">ชื่อตัวชี้วัด (Metric Name) <span class="text-red-500">*</span></label>
                                        <input type="text" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2 border" placeholder="เช่น จำนวนการอ้างอิง">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-1">เป้าหมาย (Target)</label>
                                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2 border" placeholder="เช่น 10">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-slate-700 mb-1">ผลงานจริง (Actual)</label>
                                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2 border" placeholder="เช่น 15">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">สถานะ (Status)</label>
                                        <select class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2 border">
                                            <option value="achieved">บรรลุเป้าหมาย (Achieved)</option>
                                            <option value="in_progress">กำลังดำเนินการ (In Progress)</option>
                                            <option value="exceeded">เกินเป้าหมาย (Exceeded)</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-bold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors" onclick="document.getElementById('kpiModal').classList.add('hidden')">
                        บันทึก (Save)
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-bold text-slate-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors" onclick="document.getElementById('kpiModal').classList.add('hidden')">
                        ยกเลิก (Cancel)
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php
require_once ROOT_DIR . '/includes/footer.php';
?>
