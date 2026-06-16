<?php
class UserController {
    public function research() {
        global $conn;
        // Get filters from URL
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $year = isset($_GET['year']) ? trim($_GET['year']) : '';
        $department = isset($_GET['department']) ? trim($_GET['department']) : '';

        $sql = "SELECT * FROM research_list WHERE vision = 1";

        if (!empty($search)) {
            $searchEscaped = $conn->real_escape_string($search);
            $sql .= " AND (name LIKE '%$searchEscaped%' OR authors LIKE '%$searchEscaped%')";
        }
        if (!empty($year)) {
            $sql .= " AND publication_year = '" . $conn->real_escape_string($year) . "'";
        }
        if (!empty($department)) {
            $sql .= " AND departments = '" . $conn->real_escape_string($department) . "'";
        }

        $result = $conn->query($sql);

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
}
?>
