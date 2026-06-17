<?php
require_once 'functions/common.php';
require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="relative bg-white overflow-hidden rounded-3xl shadow-xl border border-gray-100 mb-12">
    <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-white z-0"></div>
    <div class="absolute inset-y-0 right-0 w-1/2 bg-gradient-to-l from-orange-100 to-transparent opacity-60 z-0 hidden md:block"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 py-16 lg:py-24 flex flex-col lg:flex-row items-center">
        <div class="lg:w-1/2 pr-0 lg:pr-12 text-center lg:text-left">
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-sm font-semibold mb-6 shadow-sm border border-orange-200">
                <span class="flex w-2 h-2 rounded-full bg-orange-500 mr-2 animate-pulse"></span>
                ระบบฐานข้อมูลงานวิจัยใหม่ล่าสุด
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight mb-6">
                สืบค้นและจัดการ <br class="hidden lg:block"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-yellow-500">งานวิจัยคุณภาพ</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-600 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                แพลตฟอร์มรวบรวมผลงานตีพิมพ์ บทความวิชาการ และฐานข้อมูล Citation ที่เป็นมาตรฐานระดับสากล เพื่อสนับสนุนการวิจัยและการพัฒนาที่ยั่งยืน (SDGs)
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                <?php 
                $explore_link = (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') ? 'admin/research' : 'user/research';
                ?>
                <a href="<?php echo BASE_URL . $explore_link; ?>" class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-orange-600 rounded-xl hover:bg-orange-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    สืบค้นงานวิจัย
                </a>
                
                <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true): ?>
                <a href="<?php echo BASE_URL; ?>login" class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-slate-700 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 hover:shadow transition-all duration-200">
                    เข้าสู่ระบบจัดการข้อมูล
                </a>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Illustration / Graphic -->
        <div class="lg:w-1/2 mt-16 lg:mt-0 relative hidden sm:block">
            <div class="relative w-full aspect-square max-w-lg mx-auto">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-10 w-32 h-32 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                <div class="absolute top-10 left-10 w-32 h-32 bg-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-8 left-20 w-32 h-32 bg-red-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                
                <div class="absolute inset-0 bg-white bg-opacity-40 backdrop-blur-sm rounded-3xl border border-white/60 shadow-2xl p-6 transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <div class="w-full h-full bg-slate-50 rounded-xl border border-slate-100 overflow-hidden flex flex-col">
                        <!-- Mock Header -->
                        <div class="h-10 border-b border-slate-200 flex items-center px-4 bg-white">
                            <div class="flex space-x-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                        </div>
                        <!-- Mock Body -->
                        <div class="p-6 flex-grow flex flex-col gap-4">
                            <div class="w-3/4 h-6 bg-slate-200 rounded-md"></div>
                            <div class="w-full h-4 bg-slate-100 rounded-md"></div>
                            <div class="w-5/6 h-4 bg-slate-100 rounded-md"></div>
                            <div class="w-full h-24 bg-orange-50 rounded-lg border border-orange-100 mt-4 flex items-end p-4 gap-2">
                                <div class="w-1/6 h-full bg-orange-300 rounded-t-sm"></div>
                                <div class="w-1/6 h-3/4 bg-orange-400 rounded-t-sm"></div>
                                <div class="w-1/6 h-1/2 bg-orange-200 rounded-t-sm"></div>
                                <div class="w-1/6 h-full bg-orange-500 rounded-t-sm"></div>
                                <div class="w-1/6 h-5/6 bg-orange-400 rounded-t-sm"></div>
                                <div class="w-1/6 h-1/3 bg-orange-300 rounded-t-sm"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                    
<style>
/* Custom animations for the hero graphic */
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
  animation: blob 7s infinite;
}
.animation-delay-2000 {
  animation-delay: 2s;
}
.animation-delay-4000 {
  animation-delay: 4s;
}
</style>

<?php
require_once 'includes/footer.php';
?>
