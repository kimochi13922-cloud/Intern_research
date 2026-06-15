<?php
if (session_id() == '') {
    session_start();
}
// Fallback if BASE_URL isn't defined
if (!defined('BASE_URL')) {
    define('BASE_URL', '/intern_research/');
}
$current_route = defined('CURRENT_ROUTE') ? CURRENT_ROUTE : 'index';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intern Research</title>
    <!-- Tailwind CSS v3 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <style>body { font-family: 'Sarabun', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">
    
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Brand / Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?php echo BASE_URL; ?>" class="flex items-center gap-3 no-underline group">
                        <img src="<?php echo BASE_URL; ?>assets/img/ennulogo.png" alt="logo ennu" class="h-10 w-10 object-contain group-hover:opacity-80 transition-opacity">
                        <span class="font-bold text-xl text-slate-800 group-hover:text-orange-600 transition-colors">ระบบฐานข้อมูลโครงงานวิจัย</span>
                    </a>
                </div>
                
                <!-- Navbar Menu -->
                <div class="flex items-center space-x-2">
                    <?php 
                    $home_route = '';
                    ?>
                    <a href="<?php echo BASE_URL . $home_route; ?>" class="px-3 py-2 rounded-md text-sm font-medium transition-all <?php echo ($current_route == '' || $current_route == 'index' || $current_route == 'user/index') ? 'bg-orange-50 text-orange-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'; ?>">หน้าแรก</a>
                    
                    <?php 
                    $research_link = (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') ? 'admin/research' : 'user/research';
                    ?>
                    <a href="<?php echo BASE_URL . $research_link; ?>" class="px-3 py-2 rounded-md text-sm font-medium transition-all <?php echo (strpos($current_route, 'research') !== false || strpos($current_route, 'mou_') !== false) ? 'bg-orange-50 text-orange-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'; ?>">ฐานข้อมูลโครงงานงานวิจัย</a>
                    
                    <!-- Auth Logic -->
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                        <div class="pl-4 ml-2 border-l border-gray-200">
                            <a href="<?php echo BASE_URL; ?>logout" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-bold rounded-lg shadow-sm text-red-600 bg-red-50 hover:bg-red-100 hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                <svg class="mr-2 -ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                ออกจากระบบ
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="pl-4 ml-2 border-l border-gray-200">
                            <a href="<?php echo BASE_URL; ?>login" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-bold rounded-lg shadow-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors">
                                เข้าสู่ระบบ
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
