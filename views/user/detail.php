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
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">Development of AI Models for Healthcare Predictive Analytics</dd>
            </div>

            <!-- Field 2 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    รายชื่อผู้วิจัย
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">Dr. Jane Doe, Dr. John Smith</dd>
            </div>

            <!-- Field 2.5 (Faculty) -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    หน่วยงาน
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">คณะแพทยศาสตร์</dd>
            </div>

            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    ประเภท
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">งานวิจัย</dd>
            </div>

            <!-- Field 3 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    ชื่อวารสาร
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2 flex items-center">
                    Journal of Medical AI 
                    <span class="ml-2 px-1.5 py-0.5 bg-green-100 text-green-800 rounded text-[10px] font-bold">Q1</span>
                </dd>
            </div>

            <!-- Field 4 -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    ปีที่ตีพิมพ์
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">2023</dd>
            </div>

            <!-- Field 4.5 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    ปีที่เผยแพร่
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">2024</dd>
            </div>

            <!-- Field 5 -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                    จำนวน Citation
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">15 ครั้ง</dd>
            </div>

            <!-- Field 5.5 -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    งบประมาณ (Budget)
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">50,000 บาท</dd>
            </div>

            <!-- Field 5.75 (Funding Source) -->
            <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    แหล่งทุน (Funding Source)
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">กองทุนพัฒนาการวิจัย มหาวิทยาลัย</dd>
            </div>

            <!-- Field 6 (Link) -->
            <div class="bg-white px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
                <dt class="font-bold text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    Link บทความ
                </dt>
                <dd class="mt-1 font-semibold text-slate-900 sm:mt-0 sm:col-span-2">
                    <a href="#" target="_blank" class="text-orange-600 hover:text-orange-800 underline flex items-center w-max transition-colors">
                        คลิกเพื่ออ่านบทความ
                        <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </a>
                </dd>
            </div>

            <!-- Field 7 (Full width) -->
            <div class="bg-white px-4 py-4 sm:px-6">
                <dt class="font-bold text-slate-500 flex items-center mb-2">
                    <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    บทคัดย่อ (Abstract)
                </dt>
                <dd class="text-sm text-slate-700 leading-relaxed">
                    การศึกษานี้ได้สำรวจและวิเคราะห์การประยุกต์ใช้ปัญญาประดิษฐ์ (AI) ในการพยากรณ์ความเสี่ยงด้านสุขภาพจากข้อมูลผู้ป่วยในอดีต (This study explores the application of artificial intelligence in early disease detection and predictive analytics using historical patient data.) โดยผลลัพธ์แสดงให้เห็นถึงความแม่นยำในการคาดการณ์ที่สูงถึง 92% ซึ่งมีนัยสำคัญในการนำไปใช้ในโรงพยาบาลระดับประเทศต่อไป.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sed, dicta inventore itaque ratione molestias quisquam impedit laudantium architecto dolores officiis minus officia rerum, nam beatae repudiandae est sit repellendus eaque!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam sit itaque earum sequi aut aperiam vel, saepe, pariatur voluptatibus quas quibusdam quisquam beatae neque. Accusamus harum illum suscipit voluptas esse.
                </dd>
            </div>

        </dl>
    </div>

</section>

<!-- Document Table Container -->
<section class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 max-w-4xl mx-auto my-6">
    <div class="mb-4">
        <div class="flex items-center mb-4">
            <h3 class="text-lg font-bold text-slate-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                ประวัติเอกสาร
            </h3>
        </div>
        
        <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
            <table class="w-full divide-y divide-gray-200 text-xs">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th scope="col" class="px-3 py-2 text-left font-semibold whitespace-nowrap">เอกสาร</th>
                        <th scope="col" class="px-3 py-2 text-left font-semibold whitespace-nowrap">คำอธิบาย</th>
                        <th scope="col" class="px-3 py-2 text-center font-semibold whitespace-nowrap">ไฟล์เอกสาร</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-slate-50 transition-colors">
                        
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
                    </tr>
                    
                </tbody>
            </table>
        </div>
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
