<?php

require_once 'functions/common.php';
require_once 'includes/header.php';
?>

<section class="bg-white p-6 rounded-xl shadow-md border border-gray-100 mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
        <h2 class="text-2xl font-bold text-slate-800">ข้อมูลงานวิจัย</h2>
    </div>

    <?php
    $hasAdvanced = (!empty($_GET['year']) || !empty($_GET['publish_year']) || !empty($_GET['department']) || !empty($_GET['period']) || !empty($_GET['quartile']) || (isset($_GET['citation']) && $_GET['citation'] !== '') || !empty($_GET['progress']));
    ?>
    <!-- Filters Bar -->
    <div class="bg-slate-50 p-4 rounded-xl border border-gray-200 mb-6">
        <form action="" method="GET" class="w-full">
            <!-- Basic Search Row -->
            <div class="flex flex-wrap gap-3 items-end">
                <!-- Search -->
                <div class="flex-grow min-w-[200px]">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">ค้นหา (Search)</label>
                    <div class="relative">
                        <input type="text" name="search" value="<?php echo isset($_GET['search']) ? escape_html($_GET['search']) : ''; ?>" placeholder="ค้นหางานวิจัย, ชื่อผู้แต่ง..." class="w-full pl-9 pr-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition-colors">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white font-semibold rounded-lg shadow-sm text-sm transition-colors">
                    ค้นหา
                </button>
                <button type="button" onclick="toggleAdvancedFilters()" class="w-full sm:w-auto px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-slate-700 font-semibold rounded-lg shadow-sm text-sm transition-colors flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    ตัวกรองขั้นสูง
                </button>
            </div>

            <!-- Advanced Filters Row -->
            <div id="advancedFilters" class="<?php echo $hasAdvanced ? 'flex' : 'hidden'; ?> flex-wrap gap-4 items-end pt-4 mt-4 border-t border-gray-200">
                <!-- Publication Year -->
                <div class="w-full sm:w-32">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">ปีที่ตีพิมพ์</label>
                    <select name="year" class="w-full py-2 px-3 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition-colors">
                        <option value="">ทั้งหมด</option>
                        <?php if (isset($years_list)) { foreach($years_list as $yl): ?>
                            <option value="<?php echo escape_html($yl); ?>" <?php echo (isset($_GET['year']) && $_GET['year'] == $yl) ? 'selected' : ''; ?>><?php echo escape_html($yl); ?></option>
                        <?php endforeach; } ?>
                    </select>
                </div>

                <!-- Department -->
                <div class="w-full sm:w-48">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">หน่วยงาน</label>
                    <select name="department" class="w-full py-2 px-3 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition-colors">
                        <option value="">ทุกหน่วยงาน</option>
                        <?php if (isset($depts_list)) { foreach($depts_list as $dl): ?>
                            <option value="<?php echo escape_html($dl); ?>" <?php echo (isset($_GET['department']) && $_GET['department'] == $dl) ? 'selected' : ''; ?>><?php echo escape_html($dl); ?></option>
                        <?php endforeach; } ?>
                    </select>
                </div>

                
                <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white font-semibold rounded-lg shadow-sm text-sm transition-colors flex items-center justify-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    นำไปใช้
                </button>
                <a href="?" class="w-full sm:w-auto px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-slate-700 font-semibold rounded-lg shadow-sm text-sm transition-colors text-center">
                    ล้างค่า
                </a>
            </div>
        </form>
    </div>

    <script>
        function toggleAdvancedFilters() {
            const el = document.getElementById('advancedFilters');
            if(el.classList.contains('hidden')) {
                el.classList.remove('hidden');
                el.classList.add('flex');
            } else {
                el.classList.add('hidden');
                el.classList.remove('flex');
            }
        }
    </script>

    <div class="rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        <table class="w-full divide-y divide-gray-200 text-xs">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight w-32">ปีที่ตีพิมพ์</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">ชื่อผลงานตีพิมพ์</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight w-1/4">รายชื่อผู้วิจัย</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight w-1/4">หน่วยงาน</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (isset($result) && $result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 text-slate-600 align-top"><?php echo htmlspecialchars($row['publication_year']); ?></td>
                            <td class="px-4 py-3 text-slate-800 font-medium align-top leading-relaxed">
                                <a href="<?php echo BASE_URL; ?>user/detail?id=<?php echo $row['id']; ?>" class="text-orange-600 hover:text-orange-800 hover:underline transition-colors block mb-1">
                                    <?php echo htmlspecialchars($row['name']); ?>
                                </a>
                            </td>
                            <td class="px-4 py-3 text-slate-500 align-top"><?php echo htmlspecialchars($row['authors']); ?></td>
                            <td class="px-4 py-3 text-slate-500 align-top"><?php echo htmlspecialchars($row['departments']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500 bg-slate-50">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-10 h-10 text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>ไม่พบข้อมูลงานวิจัย</span>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php
require_once 'includes/footer.php';
?>