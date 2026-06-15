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

<!-- Statistics Section -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow">
        <div class="p-4 bg-blue-50 rounded-xl text-blue-600 mr-6">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">ผลงานตีพิมพ์ทั้งหมด</p>
            <h3 class="text-3xl font-extrabold text-slate-800">1,248</h3>
        </div>
    </div>
    
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow">
        <div class="p-4 bg-green-50 rounded-xl text-green-600 mr-6">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">ผลงานระดับ Q1/Q2</p>
            <h3 class="text-3xl font-extrabold text-slate-800">856</h3>
        </div>
    </div>
    
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow">
        <div class="p-4 bg-purple-50 rounded-xl text-purple-600 mr-6">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
        </div>
        <div>
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">จำนวน Citation รวม</p>
            <h3 class="text-3xl font-extrabold text-slate-800">15,420</h3>
        </div>
    </div>
</section>

<!-- Additional Info / Features -->
<section class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12">
    <div class="text-center mb-10">
        <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-4">ทำไมต้องใช้ระบบฐานข้อมูลของเรา?</h2>
        <p class="text-slate-500 max-w-2xl mx-auto">ระบบถูกออกแบบมาเพื่อรองรับการจัดเก็บ สืบค้น และวิเคราะห์ข้อมูลงานวิจัยได้อย่างมีประสิทธิภาพ</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center">
            <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <h4 class="text-xl font-bold text-slate-800 mb-2">สืบค้นรวดเร็ว</h4>
            <p class="text-slate-600 text-sm">ค้นหางานวิจัยด้วยคำสำคัญ ชื่อนักวิจัย หรือแยกตาม SDG ได้อย่างรวดเร็วและแม่นยำ</p>
        </div>
        <div class="text-center">
            <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            </div>
            <h4 class="text-xl font-bold text-slate-800 mb-2">แสดงผลเชิงสถิติ</h4>
            <p class="text-slate-600 text-sm">สรุปข้อมูลเป็นกราฟและตัวเลข เพื่อให้ผู้บริหารและนักวิจัยนำไปใช้ประโยชน์ต่อได้ทันที</p>
        </div>
        <div class="text-center">
            <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h4 class="text-xl font-bold text-slate-800 mb-2">ปลอดภัยและเสถียร</h4>
            <p class="text-slate-600 text-sm">ระบบรักษาความปลอดภัยในการเข้าถึงข้อมูล และจัดการสิทธิ์ผู้ใช้งานได้อย่างรัดกุม</p>
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
