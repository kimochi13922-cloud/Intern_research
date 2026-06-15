<?php
// Database connection removed

class UserMockResult {
    public $num_rows;
    private $data;
    private $position = 0;

    public function __construct($data) {
        $this->data = $data;
        $this->num_rows = count($data);
    }

    public function fetch_assoc() {
        if ($this->position < $this->num_rows) {
            $row = $this->data[$this->position];
            $this->position++;
            return $row;
        }
        return null;
    }
}

class UserController {
    public function research() {
        // Get filters from URL
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $year = isset($_GET['year']) ? trim($_GET['year']) : '';
        $department = isset($_GET['department']) ? trim($_GET['department']) : '';

        // Mock data for the table
        $mockData = array(
            array(
                'id' => 1,
                'title' => 'Development of AI Models for Healthcare Predictive Analytics',
                'authors' => 'Dr. Jane Doe, Dr. John Smith',
                'year' => '2026',
                'publish_year' => '2026',
                'operation' => 'คณะแพทยศาสตร์',
                'project_duration' => '1 ม.ค. 2025 - 31 ธ.ค. 2026',
                'quartile' => 'Q1',
                'citation' => '42'
            ),
            array(
                'id' => 2,
                'title' => 'Sustainable Agricultural Practices in Northern Thailand',
                'authors' => 'Prof. Somchai, Dr. Nattapong',
                'year' => '2025',
                'publish_year' => '2025',
                'operation' => 'คณะเกษตรศาสตร์',
                'project_duration' => '1 ส.ค. 2024 - 31 ก.ค. 2025',
                'quartile' => 'Q2',
                'citation' => '15'
            )
        );

        $filteredData = array();
        foreach ($mockData as $item) {
            $matchSearch = empty($search) || stripos($item['title'], $search) !== false || stripos($item['authors'], $search) !== false;
            $matchYear = empty($year) || $item['year'] === $year;
            $matchDepartment = empty($department) || $item['operation'] === $department;

            if ($matchSearch && $matchYear && $matchDepartment) {
                $filteredData[] = $item;
            }
        }

        $result = new UserMockResult($filteredData);
        require_once ROOT_DIR . '/views/user/research.php';
    }

    public function detail() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        $row = null;
        if ($id > 0) {
            // Mock data for testing
            $row = array(
                'id' => $id,
                'title' => 'Development of AI Models for Healthcare Predictive Analytics',
                'authors' => 'Dr. Jane Doe, Dr. John Smith',
                'year' => '2026',
                'operation' => 'คณะแพทยศาสตร์',
                'project_duration' => '1 ม.ค. 2025 - 31 ธ.ค. 2026',
                'quartile' => 'Q1',
                'citation' => '42'
            );
        }
        
        require_once ROOT_DIR . '/views/user/detail.php';
    }
}
?>
