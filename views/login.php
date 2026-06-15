<?php
// login.php is now a pure view loaded by AuthController
require_once ROOT_DIR . '/functions/common.php';
$error = isset($error) ? $error : '';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - Intern Research</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;500;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Sarabun', sans-serif; }</style>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-slate-800">เข้าสู่ระบบ</h2>
            <p class="text-slate-500 mt-2 text-sm">ระบบจัดการ Research</p>
        </div>

        <?php if ($error): ?>
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r" role="alert">
            <p><?php echo escape_html($error); ?></p>
        </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo BASE_URL; ?>login" class="space-y-6">
            <div>
                <label for="username" class="block text-sm font-semibold text-slate-700 mb-1">ชื่อผู้ใช้งาน</label>
                <input id="username" name="username" type="text" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="Username" value="test">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1">รหัสผ่าน</label>
                <input id="password" name="password" type="password" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="Password" value="test">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200 mb-4">
                    ลงชื่อเข้าใช้
                </button>
                <div class="relative flex items-center justify-center mb-4">
                    <span class="absolute inset-x-0 h-px bg-gray-200"></span>
                    <span class="relative bg-white px-4 text-sm text-gray-400">หรือ</span>
                </div>
                <a href="<?php echo BASE_URL; ?>" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-bold text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                    เข้าใช้งานโดยไม่ล็อกอิน
                </a>
            </div>
        </form>
    </div>
</body>
</html>
