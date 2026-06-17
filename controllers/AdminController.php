<?php
class AdminController {
    public function research() {
        global $conn;
        // Get filters from URL
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $year = isset($_GET['year']) ? trim($_GET['year']) : '';
        $publish_year = isset($_GET['publish_year']) ? trim($_GET['publish_year']) : '';
        $department = isset($_GET['department']) ? trim($_GET['department']) : '';
        
        $period = isset($_GET['period']) ? trim($_GET['period']) : '';
        $quartile = isset($_GET['quartile']) ? trim($_GET['quartile']) : '';
        $citation = isset($_GET['citation']) ? trim($_GET['citation']) : '';
        $progress = isset($_GET['progress']) ? trim($_GET['progress']) : '';
        $vision = isset($_GET['vision']) ? trim($_GET['vision']) : '';

        $sql = "SELECT * FROM research_list WHERE 1=1";

        if (!empty($search)) {
            $searchEscaped = $conn->real_escape_string($search);
            $sql .= " AND (name LIKE '%$searchEscaped%' OR authors LIKE '%$searchEscaped%')";
        }
        if (!empty($year)) {
            $sql .= " AND publication_year = '" . $conn->real_escape_string($year) . "'";
        }
        if (!empty($publish_year)) {
            $sql .= " AND release_year = '" . $conn->real_escape_string($publish_year) . "'";
        }
        if (!empty($department)) {
            $sql .= " AND departments = '" . $conn->real_escape_string($department) . "'";
        }
        if (!empty($period)) {
            $sql .= " AND period LIKE '%" . $conn->real_escape_string($period) . "%'";
        }
        if (!empty($quartile)) {
            $sql .= " AND quartile = '" . $conn->real_escape_string($quartile) . "'";
        }
        if ($citation !== '') {
            $sql .= " AND citation = '" . $conn->real_escape_string($citation) . "'";
        }
        if (!empty($progress)) {
            $sql .= " AND progress = '" . $conn->real_escape_string($progress) . "'";
        }
        if ($vision !== '') {
            $sql .= " AND vision = '" . $conn->real_escape_string($vision) . "'";
        }

        $result = $conn->query($sql);
        
        // Get distinct publication years
        $year_res = $conn->query("SELECT DISTINCT publication_year FROM research_list WHERE publication_year IS NOT NULL AND publication_year != '' ORDER BY publication_year DESC");
        $years_list = array();
        if ($year_res) {
            while($y = $year_res->fetch_assoc()) {
                $years_list[] = $y['publication_year'];
            }
        }
        
        // Get distinct departments
        $dept_res = $conn->query("SELECT DISTINCT departments FROM research_list WHERE departments IS NOT NULL AND departments != '' ORDER BY departments ASC");
        $depts_list = array();
        if ($dept_res) {
            while($d = $dept_res->fetch_assoc()) {
                $depts_list[] = $d['departments'];
            }
        }

        $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
        unset($_SESSION['msg']);

        require_once ROOT_DIR . '/views/admin/research_admin.php';
    }

    public function handleCrud() {
        global $conn;
        
        if (empty($_POST) && isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 0) {
            die("Error: The uploaded file is too large and exceeds the server's post_max_size limit.");
        }

        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'add') {
                $name = isset($_POST['title']) ? $_POST['title'] : '';
                $authors = isset($_POST['authors']) ? $_POST['authors'] : '';
                $publication_year = isset($_POST['year']) ? $_POST['year'] : '';
                $release_year = isset($_POST['publish_year']) ? $_POST['publish_year'] : '';
                $period = isset($_POST['project_duration']) ? $_POST['project_duration'] : '';
                $quartile = isset($_POST['quartile']) ? $_POST['quartile'] : '';
                $citation = isset($_POST['citation']) ? $_POST['citation'] : '';
                $kpi_1 = isset($_POST['kpi_1']) ? $_POST['kpi_1'] : '';
                if ($kpi_1 === 'อื่นๆ') $kpi_1 = isset($_POST['kpi_1_other']) ? $_POST['kpi_1_other'] : '';
                $kpi_2 = isset($_POST['kpi_2']) ? $_POST['kpi_2'] : '';
                if ($kpi_2 === 'อื่นๆ') $kpi_2 = isset($_POST['kpi_2_other']) ? $_POST['kpi_2_other'] : '';
                $departments = isset($_POST['operation']) ? $_POST['operation'] : '';
                
                $stmt = $conn->prepare("INSERT INTO research_list (name, authors, publication_year, release_year, period, quartile, citation, kpi_1, kpi_2, departments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssss", $name, $authors, $publication_year, $release_year, $period, $quartile, $citation, $kpi_1, $kpi_2, $departments);
                
                if ($stmt->execute()) {
                    $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>เพิ่มข้อมูลสำเร็จ</div>";
                } else {
                    $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                }
            } elseif ($action === 'edit') {
                $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                $name = isset($_POST['title']) ? $_POST['title'] : '';
                $authors = isset($_POST['authors']) ? $_POST['authors'] : '';
                $abstract = isset($_POST['abstract']) ? $_POST['abstract'] : '';
                $publication_year = isset($_POST['year']) ? $_POST['year'] : '';
                $release_year = isset($_POST['publish_year']) ? $_POST['publish_year'] : '';
                $period = isset($_POST['project_duration']) ? $_POST['project_duration'] : '';
                $quartile = isset($_POST['quartile']) ? $_POST['quartile'] : '';
                $citation = isset($_POST['citation']) ? $_POST['citation'] : '';
                $kpi_1 = isset($_POST['kpi_1']) ? $_POST['kpi_1'] : '';
                if ($kpi_1 === 'อื่นๆ') $kpi_1 = isset($_POST['kpi_1_other']) ? $_POST['kpi_1_other'] : '';
                $kpi_2 = isset($_POST['kpi_2']) ? $_POST['kpi_2'] : '';
                if ($kpi_2 === 'อื่นๆ') $kpi_2 = isset($_POST['kpi_2_other']) ? $_POST['kpi_2_other'] : '';
                $departments = isset($_POST['operation']) ? $_POST['operation'] : '';
                
                if ($id > 0) {
                    $stmt = $conn->prepare("UPDATE research_list SET name=?, authors=?, abstract=?, publication_year=?, release_year=?, period=?, quartile=?, citation=?, kpi_1=?, kpi_2=?, departments=? WHERE id=?");
                    $stmt->bind_param("sssssssssssi", $name, $authors, $abstract, $publication_year, $release_year, $period, $quartile, $citation, $kpi_1, $kpi_2, $departments, $id);
                    
                    if ($stmt->execute()) {
                        $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>อัพเดทข้อมูลสำเร็จ</div>";
                    } else {
                        $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                    }
                } else {
                    $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>ไม่พบ ID สำหรับการแก้ไข</div>";
                }
                header("Location: " . BASE_URL . "admin/editresearch?id=" . $id);
                exit;
            } elseif ($action === 'delete') {
                $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                if ($id > 0) {
                    // Delete associated documents first
                    $stmt_doc = $conn->prepare("DELETE FROM research_file WHERE owner_id=?");
                    if ($stmt_doc) {
                        $stmt_doc->bind_param("i", $id);
                        $stmt_doc->execute();
                    }
                    
                    $stmt = $conn->prepare("DELETE FROM research_list WHERE id=?");
                    $stmt->bind_param("i", $id);
                    if ($stmt->execute()) {
                        $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>ลบข้อมูลและเอกสารที่เกี่ยวข้องสำเร็จ</div>";
                    } else {
                        $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                    }
                }
                header("Location: " . BASE_URL . "admin/research");
                exit;
            } elseif ($action === 'inline_edit') {
                $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                $field = isset($_POST['field']) ? $_POST['field'] : '';
                $value = isset($_POST['value']) ? $_POST['value'] : '';

                // Allowed fields mapping exactly to columns in DB
                $allowed_fields = array('name', 'authors', 'departments', 'categories', 'progress', 'publication_year', 'release_year', 'journal', 'period', 'quartile', 'funding_source', 'budget', 'citation', 'abstract', 'contract', 'successpdf');
                
                if ($id > 0 && in_array($field, $allowed_fields)) {
                    if ($field === 'successpdf' || $field === 'contract') {
                        if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
                            $ext = strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));
                            $mime = $_FILES['file_upload']['type'];
                            
                            if ($ext !== 'pdf' || $mime !== 'application/pdf') {
                                $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>ผิดพลาด: รองรับเฉพาะไฟล์ PDF เท่านั้น</div>";
                            } else {
                                $fileData = file_get_contents($_FILES['file_upload']['tmp_name']);
                                $stmt = $conn->prepare("UPDATE research_list SET {$field}=? WHERE id=?");
                                if ($stmt) {
                                    // Use 's' for binding binary data directly, avoids send_long_data complications
                                    $stmt->bind_param("si", $fileData, $id);
                                    if ($stmt->execute()) {
                                        $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>อัพโหลดไฟล์ " . htmlspecialchars($field, ENT_QUOTES, 'UTF-8') . " สำเร็จ</div>";
                                    } else {
                                        $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                                    }
                                }
                            }
                        } else {
                            $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>กรุณาเลือกไฟล์ที่ต้องการอัพโหลด</div>";
                        }
                    } else {
                        $stmt = $conn->prepare("UPDATE research_list SET {$field}=? WHERE id=?");
                        $stmt->bind_param("si", $value, $id);
                        if ($stmt->execute()) {
                            $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>แก้ไขข้อมูล " . htmlspecialchars($field, ENT_QUOTES, 'UTF-8') . " สำเร็จ</div>";
                        } else {
                            $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                        }
                    }
                }
                header("Location: " . BASE_URL . "admin/detail?id=" . $id);
                exit;
            } elseif ($action === 'publish') {
                $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                $vision = isset($_POST['vision']) ? intval($_POST['vision']) : 1;
                if ($id > 0) {
                    $stmt = $conn->prepare("UPDATE research_list SET vision = ? WHERE id = ?");
                    $stmt->bind_param("ii", $vision, $id);
                    if ($stmt->execute()) {
                        $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>" . ($vision == 1 ? "เผยแพร่ข้อมูลสำเร็จ" : "ยกเลิกการเผยแพร่ข้อมูลสำเร็จ") . "</div>";
                    } else {
                        $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                    }
                }
                
                if (isset($_POST['redirect_to']) && $_POST['redirect_to'] == 'detail') {
                    header("Location: " . BASE_URL . "admin/detail?id=" . $id);
                    exit;
                }
            } elseif ($action === 'update_kpi') {
                $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                $kpi_slot = isset($_POST['kpi_slot']) ? $_POST['kpi_slot'] : 'kpi_1';
                $kpi_type = isset($_POST['kpi_type']) ? $_POST['kpi_type'] : '';
                $kpi_value = $kpi_type;
                if ($kpi_type === 'อื่นๆ(ไม่ตรงตามตัวชี้วัด)') {
                    $kpi_value = isset($_POST['kpi_other']) ? $_POST['kpi_other'] : '';
                }
                
                if ($id > 0 && ($kpi_slot === 'kpi_1' || $kpi_slot === 'kpi_2')) {
                    $file_col = $kpi_slot . "file";
                    $file_data = null;
                    
                    $hasFile = isset($_FILES['kpi_file']) && $_FILES['kpi_file']['error'] === UPLOAD_ERR_OK;
                    
                    if ($hasFile) {
                        $fileType = $_FILES['kpi_file']['type'];
                        $fileExt = strtolower(pathinfo($_FILES['kpi_file']['name'], PATHINFO_EXTENSION));
                        
                        if ($fileExt !== 'pdf' || $fileType !== 'application/pdf') {
                            $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>ข้อผิดพลาด: โปรดอัปโหลดไฟล์ PDF เท่านั้น</div>";
                            header("Location: " . BASE_URL . "admin/detail?id=" . $id);
                            exit;
                        }
                        
                        $file_data = file_get_contents($_FILES['kpi_file']['tmp_name']);
                    }
                    
                    if ($hasFile) {
                        $stmt = $conn->prepare("UPDATE research_list SET {$kpi_slot} = ?, {$file_col} = ? WHERE id = ?");
                        $stmt->bind_param("ssi", $kpi_value, $file_data, $id);
                    } else {
                        $stmt = $conn->prepare("UPDATE research_list SET {$kpi_slot} = ? WHERE id = ?");
                        $stmt->bind_param("si", $kpi_value, $id);
                    }
                    
                    if ($stmt->execute()) {
                        $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>เพิ่มข้อมูลตัวชี้วัดสำเร็จ</div>";
                    } else {
                        $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                    }
                }
                header("Location: " . BASE_URL . "admin/detail?id=" . $id);
                exit;
            } elseif ($action === 'upload_doc') {
                $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                $doc_type = isset($_POST['doc_type']) ? $_POST['doc_type'] : '';
                $description = isset($_POST['description']) ? trim($_POST['description']) : '';
                
                if ($id > 0 && isset($_FILES['doc_file']) && $_FILES['doc_file']['error'] === UPLOAD_ERR_OK) {
                    $file_name = $_FILES['doc_file']['name'];
                    $file_data = file_get_contents($_FILES['doc_file']['tmp_name']);
                    $stmt = $conn->prepare("INSERT INTO research_file (owner_id, categories, description, file_name, file) VALUES (?, ?, ?, ?, ?)");
                    if ($stmt) {
                        $stmt->bind_param("issss", $id, $doc_type, $description, $file_name, $file_data);
                        if ($stmt->execute()) {
                            $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>อัปโหลดเอกสารสำเร็จ</div>";
                        } else {
                            $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                        }
                    } else {
                        $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL</div>";
                    }
                } else {
                    $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: ไม่พบไฟล์หรือไฟล์มีขนาดใหญ่เกินไป</div>";
                }
                header("Location: " . BASE_URL . "admin/detail?id=" . $id);
                exit;
            } elseif ($action === 'remove_kpi') {
                $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                $kpi_slot = isset($_POST['kpi_slot']) ? $_POST['kpi_slot'] : '';
                if ($id > 0 && ($kpi_slot === 'kpi_1' || $kpi_slot === 'kpi_2')) {
                    $file_col = $kpi_slot . "file";
                    // Using NULL for value to clear it
                    $stmt = $conn->prepare("UPDATE research_list SET {$kpi_slot} = NULL, {$file_col} = NULL WHERE id = ?");
                    if ($stmt) {
                        $stmt->bind_param("i", $id);
                        if ($stmt->execute()) {
                            $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>ลบตัวชี้วัดสำเร็จ</div>";
                        } else {
                            $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                        }
                    }
                }
                header("Location: " . BASE_URL . "admin/detail?id=" . $id);
                exit;
            } elseif ($action === 'delete_doc') {
                $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                $doc_id = isset($_POST['doc_id']) ? intval($_POST['doc_id']) : 0;
                if ($id > 0 && $doc_id > 0) {
                    $stmt = $conn->prepare("DELETE FROM research_file WHERE id = ? AND owner_id = ?");
                    if ($stmt) {
                        $stmt->bind_param("ii", $doc_id, $id);
                        if ($stmt->execute()) {
                            $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>ลบเอกสารสำเร็จ</div>";
                        } else {
                            $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                        }
                    }
                }
                header("Location: " . BASE_URL . "admin/detail?id=" . $id);
                exit;
            } elseif ($action === 'edit_doc') {
                $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
                $doc_id = isset($_POST['doc_id']) ? intval($_POST['doc_id']) : 0;
                $doc_type = isset($_POST['doc_type']) ? $_POST['doc_type'] : '';
                $description = isset($_POST['description']) ? trim($_POST['description']) : '';
                
                if ($id > 0 && $doc_id > 0) {
                    if (isset($_FILES['doc_file']) && $_FILES['doc_file']['error'] === UPLOAD_ERR_OK) {
                        $file_name = $_FILES['doc_file']['name'];
                        $file_data = file_get_contents($_FILES['doc_file']['tmp_name']);
                        $stmt = $conn->prepare("UPDATE research_file SET categories = ?, description = ?, file_name = ?, file = ? WHERE id = ? AND owner_id = ?");
                        if ($stmt) {
                            $stmt->bind_param("ssssii", $doc_type, $description, $file_name, $file_data, $doc_id, $id);
                            if ($stmt->execute()) {
                                $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>อัปเดตเอกสารและไฟล์สำเร็จ</div>";
                            } else {
                                $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                            }
                        }
                    } else {
                        $stmt = $conn->prepare("UPDATE research_file SET categories = ?, description = ? WHERE id = ? AND owner_id = ?");
                        if ($stmt) {
                            $stmt->bind_param("ssii", $doc_type, $description, $doc_id, $id);
                            if ($stmt->execute()) {
                                $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg'>อัปเดตรายละเอียดเอกสารสำเร็จ</div>";
                            } else {
                                $_SESSION['msg'] = "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>เกิดข้อผิดพลาด: " . $conn->error . "</div>";
                            }
                        }
                    }
                }
                header("Location: " . BASE_URL . "admin/detail?id=" . $id);
                exit;
            }
        }
        
        header("Location: " . BASE_URL . "admin/research");
        exit;
    }

    public function addresearch() {
        require_once ROOT_DIR . '/views/admin/addresearch_admin.php';
    }

    public function editresearch() {
        global $conn;
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        $row = null;
        if ($id > 0) {
            $res = $conn->query("SELECT * FROM research_list WHERE id = " . $id);
            if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
            }
        }

        if (!$row) {
            header("Location: " . BASE_URL . "admin/research");
            exit;
        }

        require_once ROOT_DIR . '/views/admin/editresearch_admin.php';
    }

    public function detail() {
        global $conn;
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        $row = null;
        if ($id > 0) {
            $res = $conn->query("SELECT * FROM research_list WHERE id = " . $id);
            if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
            }
        }
        
        $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
        unset($_SESSION['msg']);

        $files_res = $conn->query("SELECT id, categories, description FROM research_file WHERE owner_id = " . $id);
        $doc_files = array();
        if ($files_res && $files_res->num_rows > 0) {
            while($f = $files_res->fetch_assoc()) {
                $doc_files[] = $f;
            }
        }

        require_once ROOT_DIR . '/views/admin/detail_admin.php';
    }

    public function dashboard() {
        global $conn;

        // 1. Stats Cards Data
        // Total Research
        $res = $conn->query("SELECT COUNT(*) as total FROM research_list");
        $total_research = ($res && $row = $res->fetch_assoc()) ? $row['total'] : 0;

        // Total Budget
        $res = $conn->query("SELECT SUM(CAST(REPLACE(budget, ',', '') AS DECIMAL(15,2))) as total FROM research_list");
        $total_budget = ($res && $row = $res->fetch_assoc()) ? $row['total'] : 0;
        
        if ($total_budget >= 1000000) {
            $total_budget_display = round($total_budget / 1000000, 1) . 'M';
        } else {
            $total_budget_display = number_format($total_budget);
        }

        // Total Funding Sources
        $res = $conn->query("SELECT COUNT(DISTINCT funding_source) as total FROM research_list WHERE funding_source IS NOT NULL AND funding_source != ''");
        $total_funding_sources = ($res && $row = $res->fetch_assoc()) ? $row['total'] : 0;

        // Total Researchers & Top Researchers Data
        $res = $conn->query("SELECT authors, departments FROM research_list WHERE authors IS NOT NULL AND authors != ''");
        $researchers = array();
        while ($row = $res->fetch_assoc()) {
            $auths = explode(',', $row['authors']);
            $dept = $row['departments'];
            foreach ($auths as $a) {
                $a = trim($a);
                if (empty($a)) continue;
                if (!isset($researchers[$a])) {
                    $researchers[$a] = array('name' => $a, 'faculty' => $dept, 'projects' => 0);
                }
                $researchers[$a]['projects']++;
            }
        }
        $total_researchers = count($researchers);
        
        $researcherList = array_values($researchers);
        $projects_col = array();
        foreach ($researcherList as $key => $row) {
            $projects_col[$key] = $row['projects'];
        }
        array_multisort($projects_col, SORT_DESC, $researcherList);
        $top_researchers = array_slice($researcherList, 0, 10);

        // 2. Charts Data
        // Research by Year
        $res = $conn->query("SELECT publication_year, COUNT(*) as count FROM research_list WHERE publication_year IS NOT NULL AND publication_year != '' GROUP BY publication_year ORDER BY publication_year ASC");
        $chart_research_year = array('labels' => array(), 'data' => array());
        while ($row = $res->fetch_assoc()) {
            $chart_research_year['labels'][] = $row['publication_year'];
            $chart_research_year['data'][] = intval($row['count']);
        }

        // Quartile Stats
        $res = $conn->query("SELECT quartile, COUNT(*) as count FROM research_list WHERE quartile IS NOT NULL AND quartile != '' GROUP BY quartile ORDER BY quartile ASC");
        $chart_quartile = array('labels' => array(), 'data' => array());
        while ($row = $res->fetch_assoc()) {
            $chart_quartile['labels'][] = $row['quartile'];
            $chart_quartile['data'][] = intval($row['count']);
        }

        // Faculty Proportion
        $res = $conn->query("SELECT departments, COUNT(*) as count FROM research_list WHERE departments IS NOT NULL AND departments != '' GROUP BY departments");
        $chart_faculty = array('labels' => array(), 'data' => array());
        $bg_colors = array('rgba(59, 130, 246, 0.8)', 'rgba(249, 115, 22, 0.8)', 'rgba(34, 197, 94, 0.8)', 'rgba(234, 179, 8, 0.8)', 'rgba(148, 163, 184, 0.8)', 'rgba(168, 85, 247, 0.8)', 'rgba(236, 72, 153, 0.8)');
        $colors_mapped = array();
        $i = 0;
        while ($row = $res->fetch_assoc()) {
            $chart_faculty['labels'][] = $row['departments'];
            $chart_faculty['data'][] = intval($row['count']);
            $colors_mapped[] = $bg_colors[$i % count($bg_colors)];
            $i++;
        }
        $chart_faculty['colors'] = $colors_mapped;

        // Budget by Year
        $res = $conn->query("SELECT publication_year, SUM(CAST(REPLACE(budget, ',', '') AS DECIMAL(15,2))) as total_budget FROM research_list WHERE publication_year IS NOT NULL AND publication_year != '' GROUP BY publication_year ORDER BY publication_year ASC");
        $chart_budget_year = array('labels' => array(), 'data' => array());
        while ($row = $res->fetch_assoc()) {
            $chart_budget_year['labels'][] = 'ปี ' . $row['publication_year'];
            // Store as millions for the chart if necessary, or full numbers
            // The mockup chart used 15.5 for 15.5M. Let's send raw and the chart can handle it or we convert to millions
            $chart_budget_year['data'][] = round(floatval($row['total_budget']) / 1000000, 2);
        }

        // 3. Funding Sources Table
        $res = $conn->query("SELECT funding_source, COUNT(*) as projects, SUM(CAST(REPLACE(budget, ',', '') AS DECIMAL(15,2))) as budget FROM research_list WHERE funding_source IS NOT NULL AND funding_source != '' GROUP BY funding_source ORDER BY budget DESC");
        $funding_data = array();
        while ($row = $res->fetch_assoc()) {
            $src = $row['funding_source'];
            $type = (strpos($src, 'มหาวิทยาลัย') !== false || strpos($src, 'คณะ') !== false) ? 'internal' : 'external';
            $funding_data[] = array(
                'name' => $src,
                'type' => $type,
                'projects' => intval($row['projects']),
                'budget' => floatval($row['budget'])
            );
        }

        require_once ROOT_DIR . '/views/admin/dashboard.php';
    }

    public function download() {
        global $conn;
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $field = isset($_GET['field']) ? $_GET['field'] : '';
        
        if ($id > 0 && ($field === 'successpdf' || $field === 'contract' || $field === 'kpi_1file' || $field === 'kpi_2file')) {
            $stmt = $conn->prepare("SELECT {$field} FROM research_list WHERE id=?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($fileData);
                    $stmt->fetch();
                    if (!empty($fileData)) {
                        header('Content-Type: application/pdf'); 
                        header('Content-Disposition: inline; filename="' . $field . '_' . $id . '.pdf"');
                        echo $fileData;
                        exit;
                    }
                }
            }
        } elseif ($id > 0 && $field === 'doc_file') {
            $stmt = $conn->prepare("SELECT file_name, file FROM research_file WHERE id=?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($fileName, $fileData);
                    $stmt->fetch();
                    if (!empty($fileData)) {
                        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                        $contentType = 'application/octet-stream';
                        if ($ext === 'pdf') $contentType = 'application/pdf';
                        elseif (in_array($ext, array('jpg', 'jpeg'))) $contentType = 'image/jpeg';
                        elseif ($ext === 'png') $contentType = 'image/png';
                        elseif ($ext === 'doc') $contentType = 'application/msword';
                        elseif ($ext === 'docx') $contentType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                        elseif ($ext === 'xls') $contentType = 'application/vnd.ms-excel';
                        elseif ($ext === 'xlsx') $contentType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                        elseif ($ext === 'zip') $contentType = 'application/zip';
                        
                        header('Content-Type: ' . $contentType); 
                        $safeName = !empty($fileName) ? $fileName : "doc_{$id}";
                        // Remove quotes to prevent header injection just in case
                        $safeName = str_replace('"', '', $safeName);
                        header('Content-Disposition: inline; filename="' . $safeName . '"');
                        echo $fileData;
                        exit;
                    }
                }
            }
        }
        echo "File not found.";
        exit;
    }
}
?>
