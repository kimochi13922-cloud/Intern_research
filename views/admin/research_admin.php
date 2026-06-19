<?php
require_once ROOT_DIR . '/functions/common.php';
require_once ROOT_DIR . '/includes/header.php';
$msg = isset($msg) ? $msg : '';
?>

<section class="bg-white p-6 rounded-xl shadow-md border border-gray-100 mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
        <h2 class="text-2xl font-bold text-slate-800">จัดการข้อมูลงานวิจัย</h2>
        <a href="<?php echo BASE_URL; ?>admin/addresearch" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm text-sm whitespace-nowrap transition-colors">
            + เพิ่มข้อมูล
        </a>
    </div>

    <?php
    $hasAdvanced = (!empty($_GET['year']) || !empty($_GET['publish_year']) || !empty($_GET['department']) || !empty($_GET['period']) || !empty($_GET['quartile']) || (isset($_GET['citation']) && $_GET['citation'] !== '') || !empty($_GET['progress']) || (isset($_GET['vision']) && $_GET['vision'] !== ''));
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
                <!-- Year -->
                <div class="w-full sm:w-32">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">ปีที่ตีพิมพ์</label>
                    <select name="year" class="w-full py-2 px-3 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition-colors">
                        <option value="">ทั้งหมด</option>
                        <?php if (isset($years_list)) { foreach($years_list as $yl): ?>
                            <option value="<?php echo escape_html($yl); ?>" <?php echo (isset($_GET['year']) && $_GET['year'] == $yl) ? 'selected' : ''; ?>><?php echo escape_html($yl); ?></option>
                        <?php endforeach; } ?>
                    </select>
                </div>

                <!-- Publish Year -->
                <div class="w-full sm:w-32">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">ปีเผยแพร่</label>
                    <select name="publish_year" class="w-full py-2 px-3 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition-colors">
                        <option value="">ทั้งหมด</option>
                        <?php if (isset($years_list)) { foreach($years_list as $yl): ?>
                            <option value="<?php echo escape_html($yl); ?>" <?php echo (isset($_GET['publish_year']) && $_GET['publish_year'] == $yl) ? 'selected' : ''; ?>><?php echo escape_html($yl); ?></option>
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
                
                <!-- Period -->
                <div class="w-full sm:w-40">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">ระยะเวลาโครงการ</label>
                    <input type="text" name="period" value="<?php echo isset($_GET['period']) ? escape_html($_GET['period']) : ''; ?>" placeholder="เช่น 1 ปี" class="w-full py-2 px-3 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition-colors">
                </div>

                <!-- Quartile -->
                <div class="w-full sm:w-32">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Quartile</label>
                    <select name="quartile" class="w-full py-2 px-3 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition-colors">
                        <option value="">ทั้งหมด</option>
                        <option value="Q1" <?php echo (isset($_GET['quartile']) && $_GET['quartile'] == 'Q1') ? 'selected' : ''; ?>>Q1</option>
                        <option value="Q2" <?php echo (isset($_GET['quartile']) && $_GET['quartile'] == 'Q2') ? 'selected' : ''; ?>>Q2</option>
                        <option value="Q3" <?php echo (isset($_GET['quartile']) && $_GET['quartile'] == 'Q3') ? 'selected' : ''; ?>>Q3</option>
                        <option value="Q4" <?php echo (isset($_GET['quartile']) && $_GET['quartile'] == 'Q4') ? 'selected' : ''; ?>>Q4</option>
                    </select>
                </div>

                

                <!-- Progress -->
                <div class="w-full sm:w-40">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">สถานะโครงการ</label>
                    <select name="progress" class="w-full py-2 px-3 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition-colors">
                        <option value="">ทั้งหมด</option>
                        <option value="เสนอโครงร่าง" <?php echo (isset($_GET['progress']) && $_GET['progress'] == 'เสนอโครงร่าง') ? 'selected' : ''; ?>>เสนอโครงร่าง</option>
                        <option value="กำลังดำเนินการ" <?php echo (isset($_GET['progress']) && $_GET['progress'] == 'กำลังดำเนินการ') ? 'selected' : ''; ?>>กำลังดำเนินการ</option>
                        <option value="รอตีพิมพ์" <?php echo (isset($_GET['progress']) && $_GET['progress'] == 'รอตีพิมพ์') ? 'selected' : ''; ?>>รอตีพิมพ์</option>
                        <option value="อยู่ระหว่างตีพิมพ์" <?php echo (isset($_GET['progress']) && $_GET['progress'] == 'อยู่ระหว่างตีพิมพ์') ? 'selected' : ''; ?>>อยู่ระหว่างตีพิมพ์</option>
                        <option value="ตีพิมพ์แล้ว" <?php echo (isset($_GET['progress']) && $_GET['progress'] == 'ตีพิมพ์แล้ว') ? 'selected' : ''; ?>>ตีพิมพ์แล้ว</option>
                        <option value="เสร็จสิ้น" <?php echo (isset($_GET['progress']) && $_GET['progress'] == 'เสร็จสิ้น') ? 'selected' : ''; ?>>เสร็จสิ้น</option>
                        <option value="เสร็จสมบูรณ์" <?php echo (isset($_GET['progress']) && $_GET['progress'] == 'เสร็จสมบูรณ์') ? 'selected' : ''; ?>>เสร็จสมบูรณ์</option>
                        <option value="ยกเลิก" <?php echo (isset($_GET['progress']) && $_GET['progress'] == 'ยกเลิก') ? 'selected' : ''; ?>>ยกเลิก</option>
                    </select>
                </div>

                <!-- Vision (Status) -->
                <div class="w-full sm:w-32">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">สถานะ</label>
                    <select name="vision" class="w-full py-2 px-3 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm transition-colors">
                        <option value="">ทั้งหมด</option>
                        <option value="1" <?php echo (isset($_GET['vision']) && $_GET['vision'] == '1') ? 'selected' : ''; ?>>เผยแพร่แล้ว</option>
                        <option value="0" <?php echo (isset($_GET['vision']) && $_GET['vision'] == '0') ? 'selected' : ''; ?>>ยังไม่เผยแพร่</option>
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

    <?php echo $msg; ?>

    <div class="rounded-lg border border-gray-200 shadow-sm overflow-x-auto">
        <table class="w-full divide-y divide-gray-200 text-xs">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">ชื่อผลงานตีพิมพ์</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">รายชื่อผู้วิจัย</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">ปีที่ตีพิมพ์</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">ปีเผยแพร่</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">วันเริ่มต้น - สิ้นสุดโครงการ</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">ค่า Quartile</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight max-w-[200px] whitespace-normal break-words">แหล่งทุน</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">หน่วยงาน</th>
                    <th scope="col" class="px-4 py-3 text-center font-semibold text-slate-700 border-b border-gray-200 leading-tight">สถานะ</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 font-medium text-slate-900">
                                <a href="<?php echo BASE_URL; ?>admin/detail?id=<?php echo $row['id']; ?>" class="text-orange-600 hover:text-orange-800 hover:underline transition-colors">
                                    <?php echo escape_html($row['name']); ?>
                                </a>
                            </td>
                            <td class="px-4 py-3 text-slate-600"><?php echo escape_html($row['authors']); ?></td>
                            <td class="px-4 py-3"><?php echo escape_html($row['publication_year']); ?></td>
                            <td class="px-4 py-3 text-slate-600"><?php echo escape_html(isset($row['release_year']) ? $row['release_year'] : ''); ?></td>
                            <td class="px-4 py-3 text-slate-600"><?php echo escape_html($row['period']); ?></td>
                            <td class="px-4 py-3 text-slate-600">
                                <?php if(!empty($row['quartile'])): ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-purple-100 text-purple-800 border border-purple-200 shadow-sm">
                                        <?php echo escape_html($row['quartile']); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-slate-600 max-w-[200px] whitespace-normal break-words">
                                <?php if(!empty($row['funding_source'])): ?>
                                    <?php echo escape_html($row['funding_source']); ?>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-slate-600"><?php echo escape_html($row['departments']); ?></td>
                            <td class="px-4 py-3 text-center">
                                <?php if (isset($row['vision']) && $row['vision'] == 1): ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                        เผยแพร่แล้ว
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200 shadow-sm">
                                        ยังไม่เผยแพร่
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="px-4 py-8 text-center text-slate-500">ไม่พบข้อมูล</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>



<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-xl bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-bold text-slate-900 mb-4">แก้ไขข้อมูลงานวิจัย</h3>
            <form action="" method="POST">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="edit_id">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลงานตีพิมพ์</label>
                    <input type="text" name="title" id="edit_title" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">รายชื่อผู้วิจัย</label>
                    <textarea name="authors" id="edit_authors" required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">ปีที่ตีพิมพ์</label>
                    <input type="text" name="year" id="edit_year" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">วันเริ่มต้น - สิ้นสุดโครงการ</label>
                    <input type="text" name="project_duration" id="edit_project_duration" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">ค่า Quartile</label>
                    <input type="text" name="quartile" id="edit_quartile" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">ค่า Citation</label>
                    <input type="text" name="citation" id="edit_citation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">การดำเนินการ</label>
                    <textarea name="operation" id="edit_operation" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium transition-colors">ยกเลิก</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium transition-colors">บันทึกการแก้ไข</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function openEditModal(data) {
        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_year').value = data.year;
        if (document.getElementById('edit_project_duration')) {
            document.getElementById('edit_project_duration').value = data.project_duration || '';
        }
        if (document.getElementById('edit_quartile')) {
            document.getElementById('edit_quartile').value = data.quartile || '';
        }
        if (document.getElementById('edit_citation')) {
            document.getElementById('edit_citation').value = data.citation || '';
        }
        document.getElementById('edit_title').value = data.title;
        document.getElementById('edit_authors').value = data.authors;
        if (document.getElementById('edit_operation')) {
            document.getElementById('edit_operation').value = data.operation || '';
        }
        openModal('editModal');
    }
</script>

<?php
require_once 'includes/footer.php';
?>