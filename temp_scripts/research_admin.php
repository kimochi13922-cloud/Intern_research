<?php
require_once 'config/database.php';
require_once 'functions/common.php';

// Check admin authentication here if necessary
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: " . BASE_URL . "login");
    exit;
}

// Handle CRUD Operations
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'add') {
            $year = $conn->real_escape_string($_POST['year']);
            $title = $conn->real_escape_string($_POST['title']);
            $authors = $conn->real_escape_string($_POST['authors']);
            $operation = isset($_POST['operation']) ? $conn->real_escape_string($_POST['operation']) : '';
            $project_duration = isset($_POST['project_duration']) ? $conn->real_escape_string($_POST['project_duration']) : '';
            $quartile = isset($_POST['quartile']) ? $conn->real_escape_string($_POST['quartile']) : '';
            $citation = isset($_POST['citation']) ? $conn->real_escape_string($_POST['citation']) : '';

            $sql = "INSERT INTO research (year, title, authors, operation, project_duration, quartile, citation) VALUES ('$year', '$title', '$authors', '$operation', '$project_duration', '$quartile', '$citation')";
            if ($conn->query($sql) === TRUE) {
                $msg = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>เพิ่มข้อมูลสำเร็จ</div>";
            } else {
                $msg = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>Error: " . $conn->error . "</div>";
            }
        } elseif ($action === 'edit') {
            $id = (int)$_POST['id'];
            $year = $conn->real_escape_string($_POST['year']);
            $title = $conn->real_escape_string($_POST['title']);
            $authors = $conn->real_escape_string($_POST['authors']);
            $operation = isset($_POST['operation']) ? $conn->real_escape_string($_POST['operation']) : '';
            $project_duration = isset($_POST['project_duration']) ? $conn->real_escape_string($_POST['project_duration']) : '';
            $quartile = isset($_POST['quartile']) ? $conn->real_escape_string($_POST['quartile']) : '';
            $citation = isset($_POST['citation']) ? $conn->real_escape_string($_POST['citation']) : '';

            $sql = "UPDATE research SET year='$year', title='$title', authors='$authors', operation='$operation', project_duration='$project_duration', quartile='$quartile', citation='$citation' WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                $msg = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>อัพเดทข้อมูลสำเร็จ</div>";
            } else {
                $msg = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>Error: " . $conn->error . "</div>";
            }
        } elseif ($action === 'delete') {
            $id = (int)$_POST['id'];
            $sql = "DELETE FROM research WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                $msg = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>ลบข้อมูลสำเร็จ</div>";
            } else {
                $msg = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>Error: " . $conn->error . "</div>";
            }
        }
    }
}

// Fetch Records
$searchQuery = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $searchQuery = " WHERE title LIKE '%$search%' OR authors LIKE '%$search%' OR year LIKE '%$search%'";
}
$sql = "SELECT * FROM research" . $searchQuery . " ORDER BY id DESC";
$result = $conn->query($sql);

require_once 'includes/header.php';
?>

<section class="bg-white p-6 rounded-xl shadow-md border border-gray-100 mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-slate-800">จัดการข้อมูลงานวิจัย</h2>

        <div class="flex gap-2 w-full sm:w-auto">
            <!-- Search Bar -->
            <form action="" method="GET" class="relative w-full sm:w-72">
                <input type="text" name="search" value="<?php echo isset($_GET['search']) ? escape_html($_GET['search']) : ''; ?>" placeholder="ค้นหางานวิจัย, ชื่อผู้แต่ง..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all text-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <button type="submit" class="absolute inset-y-0 right-0 px-3 text-sm font-semibold text-orange-600 hover:text-orange-800 focus:outline-none">
                    ค้นหา
                </button>
            </form>

            <button onclick="openModal('addModal')" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm text-sm whitespace-nowrap transition-colors">
                + เพิ่มข้อมูล
            </button>
        </div>
    </div>

    <?php echo $msg; ?>

    <div class="rounded-lg border border-gray-200 shadow-sm overflow-x-auto">
        <table class="w-full divide-y divide-gray-200 text-sm whitespace-nowrap">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">ชื่อผลงานตีพิมพ์</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">รายชื่อผู้วิจัย</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">ปีที่ตีพิมพ์</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">วันเริ่มต้น - สิ้นสุดโครงการ</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">ค่า Quartile</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">ค่า Citation</th>
                    <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-700 border-b border-gray-200 leading-tight">การดำเนินการ</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 font-medium text-slate-900"><?php echo escape_html($row['title']); ?></td>
                            <td class="px-4 py-3 text-slate-600"><?php echo escape_html($row['authors']); ?></td>
                            <td class="px-4 py-3"><?php echo escape_html($row['year']); ?></td>
                            <td class="px-4 py-3 text-slate-600"><?php echo escape_html($row['project_duration']); ?></td>
                            <td class="px-4 py-3 text-slate-600">
                                <?php if(!empty($row['quartile'])): ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-purple-100 text-purple-800 border border-purple-200 shadow-sm">
                                        <?php echo escape_html($row['quartile']); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-slate-600">
                                <?php if($row['citation'] !== '' && $row['citation'] !== null): ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200 shadow-sm">
                                        <?php echo escape_html($row['citation']); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-slate-600"><?php echo escape_html($row['operation']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-slate-500">ไม่พบข้อมูล</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-xl bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-bold text-slate-900 mb-4">เพิ่มข้อมูลงานวิจัย</h3>
            <form action="" method="POST">
                <input type="hidden" name="action" value="add">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">ชื่อผลงานตีพิมพ์</label>
                    <input type="text" name="title" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">รายชื่อผู้วิจัย</label>
                    <textarea name="authors" required rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">ปีที่ตีพิมพ์</label>
                    <input type="text" name="year" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">วันเริ่มต้น - สิ้นสุดโครงการ</label>
                    <input type="text" name="project_duration" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">ค่า Quartile</label>
                    <input type="text" name="quartile" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="เช่น Q1, Q2, Q3, Q4...">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">ค่า Citation</label>
                    <input type="text" name="citation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="ระบุตัวเลข Citation...">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">การดำเนินการ</label>
                    <textarea name="operation" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="closeModal('addModal')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium transition-colors">ยกเลิก</button>
                    <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 font-medium transition-colors">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

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