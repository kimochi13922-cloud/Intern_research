<?php
require_once 'functions/common.php';
require_once 'includes/header.php';
?>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-4">แดชบอร์ดผู้ใช้งานทั่วไป (User Dashboard)</h2>
    <p class="text-slate-600 mb-8">ยินดีต้อนรับสู่หน้าแดชบอร์ด ข้อมูลสถิติงานวิจัยเบื้องต้น</p>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Chart Container 1 -->
        <div class="w-full h-[350px] bg-slate-50 p-4 rounded-2xl border border-slate-100">
            <canvas id="researchChart"></canvas>
        </div>
        
        <!-- Chart Container 2 (Doughnut) -->
        <div class="w-full h-[350px] bg-slate-50 p-4 rounded-2xl border border-slate-100 flex justify-center items-center">
            <canvas id="facultyDoughnutChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('researchChart').getContext('2d');
        const researchChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['2022', '2023', '2024', '2025', '2026'],
                datasets: [{
                    label: 'จำนวนงานวิจัย (รายปี)',
                    data: [45, 52, 78, 112, 64],
                    backgroundColor: 'rgba(249, 115, 22, 0.7)', // Tailwind orange-500 with opacity
                    borderColor: 'rgba(234, 88, 12, 1)',   // Tailwind orange-600
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                family: "'Sarabun', sans-serif"
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'สถิติจำนวนงานวิจัยในแต่ละปี',
                        font: {
                            family: "'Sarabun', sans-serif",
                            size: 18,
                            weight: 'bold'
                        }
                    }
                }
            }
        });

        // Doughnut Chart
        const doughnutCtx = document.getElementById('facultyDoughnutChart').getContext('2d');
        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: ['คณะวิทยาศาสตร์', 'คณะวิศวกรรมศาสตร์', 'คณะแพทยศาสตร์', 'คณะเกษตรศาสตร์', 'อื่นๆ'],
                datasets: [{
                    data: [35, 25, 20, 15, 5],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)', // blue
                        'rgba(249, 115, 22, 0.8)', // orange
                        'rgba(34, 197, 94, 0.8)',  // green
                        'rgba(234, 179, 8, 0.8)',  // yellow
                        'rgba(148, 163, 184, 0.8)' // slate
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { font: { family: "'Sarabun', sans-serif" } }
                    },
                    title: {
                        display: true,
                        text: 'สัดส่วนงานวิจัยแบ่งตามคณะ',
                        font: { family: "'Sarabun', sans-serif", size: 16, weight: 'bold' }
                    }
                }
            }
        });
    });
</script>

<?php
require_once 'includes/footer.php';
?>
