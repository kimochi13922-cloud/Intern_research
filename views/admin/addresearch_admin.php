<?php
require_once ROOT_DIR . '/functions/common.php';
require_once ROOT_DIR . '/includes/header.php';
?>

<section class="max-w-4xl mx-auto my-8 bg-white p-6 md:p-8 rounded-xl shadow-md border border-gray-100">
    <div class="mb-6 flex items-center justify-between pb-4 border-b border-gray-200">
        <h2 class="text-2xl font-bold text-slate-800">เพิ่มข้อมูลงานวิจัย (Add Research)</h2>
        <a href="<?php echo BASE_URL; ?>admin/research" class="text-sm font-semibold text-orange-600 hover:text-orange-800 transition-colors flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            กลับหน้ารายการ
        </a>
    </div>

    <form action="<?php echo BASE_URL; ?>admin/research" method="POST">
        <input type="hidden" name="action" value="add">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">ชื่อผลงานตีพิมพ์ <span class="text-red-500">*</span></label>
                <input type="text" name="title" required class="w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm">
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">รายชื่อผู้วิจัย <span class="text-red-500">*</span></label>
                <textarea name="authors" required rows="3" class="w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">ปีที่ตีพิมพ์ <span class="text-red-500">*</span></label>
                <input type="text" name="year" required class="w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm" placeholder="เช่น 2023">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">ปีเผยแพร่</label>
                <input type="text" name="publish_year" class="w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm" placeholder="เช่น 2024">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">วันเริ่มต้น - สิ้นสุดโครงการ</label>
                <input type="text" name="project_duration" class="w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm" placeholder="เช่น 1 ม.ค. 2024 - 31 ธ.ค. 2024">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">ค่า Quartile</label>
                <input type="text" name="quartile" class="w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm" placeholder="เช่น Q1, Q2, Q3, Q4...">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">ค่า Citation</label>
                <input type="number" name="citation" class="w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm" placeholder="ระบุตัวเลข Citation...">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">ตัวชี้วัดที่ 1 (KPI 1)</label>
                <select name="kpi_1" onchange="this.value === 'อื่นๆ' ? this.nextElementSibling.classList.remove('hidden') : this.nextElementSibling.classList.add('hidden')" class="w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm">
                    <option value="">เลือกตัวชี้วัด...</option>
                    <option value="จำนวนการอ้างอิง (Citations)">จำนวนการอ้างอิง (Citations)</option>
                    <option value="จำนวนดาวน์โหลด (Downloads)">จำนวนดาวน์โหลด (Downloads)</option>
                    <option value="Q-Score Journal">Q-Score Journal</option>
                    <option value="อื่นๆ">อื่นๆ</option>
                </select>
                <input type="text" name="kpi_1_other" class="hidden mt-2 w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm" placeholder="ระบุตัวชี้วัดอื่นๆ...">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">ตัวชี้วัดที่ 2 (KPI 2)</label>
                <select name="kpi_2" onchange="this.value === 'อื่นๆ' ? this.nextElementSibling.classList.remove('hidden') : this.nextElementSibling.classList.add('hidden')" class="w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm">
                    <option value="">เลือกตัวชี้วัด...</option>
                    <option value="จำนวนการอ้างอิง (Citations)">จำนวนการอ้างอิง (Citations)</option>
                    <option value="จำนวนดาวน์โหลด (Downloads)">จำนวนดาวน์โหลด (Downloads)</option>
                    <option value="Q-Score Journal">Q-Score Journal</option>
                    <option value="อื่นๆ">อื่นๆ</option>
                </select>
                <input type="text" name="kpi_2_other" class="hidden mt-2 w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm" placeholder="ระบุตัวชี้วัดอื่นๆ...">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">การดำเนินการ (หน่วยงาน)</label>
                <input type="text" name="operation" class="w-full px-4 py-2 bg-slate-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all text-sm" placeholder="เช่น คณะแพทยศาสตร์...">
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">รายงานวิจัยฉบับสมบูรณ์ (PDF/Word)</label>
                <input type="file" name="final_report" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 border border-gray-300 rounded-lg p-1 bg-slate-50">
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8 pt-5 border-t border-gray-200">
            <a href="<?php echo BASE_URL; ?>admin/research" class="px-5 py-2.5 bg-white border border-gray-300 text-slate-700 font-bold rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors shadow-sm">
                ยกเลิก
            </a>
            <button type="submit" class="px-5 py-2.5 bg-orange-600 text-white font-bold rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm transition-colors">
                บันทึกข้อมูล
            </button>
        </div>
    </form>
</section>

<?php
require_once ROOT_DIR . '/includes/footer.php';
?>
