<?php
class UserController {
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

        $sql = "SELECT * FROM research_list WHERE vision = 1";

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

        require_once ROOT_DIR . '/views/user/research.php';
    }

    public function detail() {
        global $conn;
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        $row = null;
        if ($id > 0) {
            $res = $conn->query("SELECT * FROM research_list WHERE id = " . $id . " AND vision = 1");
            if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
            }
        }
        
        require_once ROOT_DIR . '/views/user/detail.php';
    }

    public function dashboard() {
        require_once ROOT_DIR . '/views/user/dashboard.php';
    }

    public function download() {
        global $conn;
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $field = isset($_GET['field']) ? $_GET['field'] : '';
        
        if ($id > 0 && ($field === 'successpdf' || $field === 'contract' || $field === 'kpi_1file' || $field === 'kpi_2file')) {
            // Check vision=1 so users can only download published files
            $stmt = $conn->prepare("SELECT {$field} FROM research_list WHERE id=? AND vision=1");
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
            $stmt = $conn->prepare("SELECT f.file_name, f.file FROM research_file f JOIN research_list r ON f.owner_id = r.id WHERE f.id=? AND r.vision=1");
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
                        $safeName = str_replace('"', '', $safeName);
                        header('Content-Disposition: inline; filename="' . $safeName . '"');
                        echo $fileData;
                        exit;
                    }
                }
            }
        }
        echo "File not found or access denied.";
        exit;
    }
}
?>
