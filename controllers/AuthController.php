<?php
class AuthController {
    public function showLogin() {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            header('Location: ' . BASE_URL . 'admin/research');
            exit;
        }
        $error = '';
        require_once ROOT_DIR . '/views/login.php';
    }

    public function login() {
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        $error = '';

        $admin_accounts = array(
            'admin' => 'admin123',
            'test' => 'test' // Test account with role admin
        );

        if (array_key_exists($username, $admin_accounts) && $admin_accounts[$username] === $password) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'admin';
            header('Location: ' . BASE_URL . 'admin/research');
            exit;
        } else {
            $error = 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง'; // Invalid username/password
            require_once ROOT_DIR . '/views/login.php';
        }
    }

    public function logout() {
        if (session_id() == '') {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: " . BASE_URL . "login");
        exit;
    }
}
?>
