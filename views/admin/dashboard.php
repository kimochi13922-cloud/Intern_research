<?php
require_once 'functions/common.php';
require_once 'includes/header.php';
?>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-4">แดชบอร์ดผู้ดูแลระบบ (Admin Dashboard)</h2>
    <p class="text-slate-600 mb-8">ยินดีต้อนรับสู่หน้าแดชบอร์ด ข้อมูลสถิติงานวิจัยเชิงลึกสำหรับผู้ดูแลระบบ</p>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Card 1: งานวิจัยทั้งหมด -->
        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-4 bg-blue-100 rounded-xl text-blue-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">งานวิจัยทั้งหมด</p>
                <h3 class="text-2xl font-extrabold text-slate-800">351</h3>
            </div>
        </div>

        <!-- Card 2: งบประมาณทั้งหมด -->
        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-4 bg-green-100 rounded-xl text-green-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">งบประมาณทั้งหมด</p>
                <h3 class="text-2xl font-extrabold text-slate-800">100.2M</h3>
            </div>
        </div>

        <!-- Card 3: แหล่งงบประมาณทั้งหมด -->
        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-4 bg-purple-100 rounded-xl text-purple-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">แหล่งงบประมาณ</p>
                <h3 class="text-2xl font-extrabold text-slate-800">15</h3>
            </div>
        </div>

        <!-- Card 4: นักวิจัยทั้งหมด -->
        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-4 bg-orange-100 rounded-xl text-orange-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">นักวิจัยทั้งหมด</p>
                <h3 class="text-2xl font-extrabold text-slate-800">120</h3>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Chart Container 1 -->
        <div class="w-full h-[350px] bg-slate-50 p-4 rounded-2xl border border-slate-100">
            <canvas id="researchChart"></canvas>
        </div>
        
        <!-- Chart Container 4 (Budget Bar Chart) -->
        <div class="w-full h-[350px] bg-slate-50 p-4 rounded-2xl border border-slate-100">
            <canvas id="budgetChart"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Chart Container 2 -->
        <div class="w-full h-[350px] bg-slate-50 p-4 rounded-2xl border border-slate-100">
            <canvas id="quartileChart"></canvas>
        </div>
        
        <!-- Chart Container 3 (Doughnut) -->
        <div class="w-full h-[350px] bg-slate-50 p-4 rounded-2xl border border-slate-100 flex justify-center items-center">
            <canvas id="facultyDoughnutChart"></canvas>
        </div>
    </div>

    <!-- Funding Sources Table Section -->
    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h3 class="text-xl font-bold text-slate-800">ตารางแหล่งทุนวิจัย</h3>
            <div class="flex space-x-2">
                <button onclick="filterFunding('all')" id="btn-fund-all" class="px-4 py-2 text-sm font-medium rounded-lg bg-orange-600 text-white transition-colors">ทั้งหมด</button>
                <button onclick="filterFunding('internal')" id="btn-fund-internal" class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 transition-colors">ภายใน</button>
                <button onclick="filterFunding('external')" id="btn-fund-external" class="px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 transition-colors">ภายนอก</button>
            </div>
        </div>
        <div class="overflow-x-auto overflow-y-auto max-h-[500px] border border-slate-200 rounded-lg">
            <table class="min-w-full bg-white relative">
                <thead class="bg-slate-100 border-b border-slate-200 sticky top-0 z-10 shadow-sm">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">แหล่งทุน</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">ประเภท</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">จำนวนโครงการ</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">งบประมาณรวม (บาท)</th>
                    </tr>
                </thead>
                <tbody id="funding-table-body" class="divide-y divide-slate-100">
                    <!-- JS will populate -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart 1: Bar Chart
        const ctx1 = document.getElementById('researchChart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['2022', '2023', '2024', '2025', '2026'],
                datasets: [{
                    label: 'จำนวนโครงการวิจัย',
                    data: [45, 52, 78, 112, 64],
                    backgroundColor: 'rgba(249, 115, 22, 0.7)',
                    borderColor: 'rgba(234, 88, 12, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'สถิติจำนวนโครงการวิจัยจำแนกตามปี',
                        font: { family: "'Sarabun', sans-serif", size: 16 }
                    }
                }
            }
        });

        // Chart 2: Line Chart for Quartile
        const ctx2 = document.getElementById('quartileChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Q1', 'Q2', 'Q3', 'Q4'],
                datasets: [{
                    label: 'จำนวนบทความตีพิมพ์',
                    data: [120, 85, 45, 20],
                    borderColor: 'rgba(59, 130, 246, 1)', // Tailwind blue-500
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'สถิติการตีพิมพ์ผลงานวิจัยจำแนกตามระดับ Quartile',
                        font: { family: "'Sarabun', sans-serif", size: 16 }
                    }
                }
            }
        });

        // Chart 3: Doughnut Chart
        const doughnutCtx = document.getElementById('facultyDoughnutChart').getContext('2d');
        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: ['คณะวิทยาศาสตร์', 'คณะวิศวกรรมศาสตร์', 'คณะแพทยศาสตร์', 'คณะเกษตรศาสตร์', 'อื่นๆ'],
                datasets: [{
                    label: 'จำนวนโครงการวิจัย',
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
                        text: 'สัดส่วนโครงการวิจัยจำแนกตามส่วนงาน',
                        font: { family: "'Sarabun', sans-serif", size: 16 }
                    }
                }
            }
        });

        // Chart 4: Budget Bar Chart
        const budgetCtx = document.getElementById('budgetChart').getContext('2d');
        new Chart(budgetCtx, {
            type: 'bar',
            data: {
                labels: ['ปี 2562', 'ปี 2563', 'ปี 2564', 'ปี 2565', 'ปี 2566'],
                datasets: [{
                    label: 'มูลค่างบประมาณ (บาท)',
                    data: [15.5, 18.2, 12.0, 24.5, 30.0],
                    backgroundColor: 'rgba(16, 185, 129, 0.7)', // emerald
                    borderColor: 'rgba(5, 150, 105, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'สถิติงบประมาณวิจัยที่ได้รับจำแนกตามปีงบประมาณ',
                        font: { family: "'Sarabun', sans-serif", size: 16 }
                    }
                }
            }
        });

        // Funding Table Logic
        const fundingData = [
            { name: 'ทุนวิจัยมหาวิทยาลัย', type: 'internal', projects: 45, budget: 15000000 },
            { name: 'ทุนวิจัยคณะ', type: 'internal', projects: 22, budget: 4500000 },
            { name: 'สกสว.', type: 'external', projects: 18, budget: 25000000 },
            { name: 'วช.', type: 'external', projects: 12, budget: 18000000 },
            { name: 'สวทช.', type: 'external', projects: 8, budget: 12500000 },
            { name: 'ภาคเอกชน', type: 'external', projects: 15, budget: 25200000 }
        ];

        window.filterFunding = function(type) {
            // Update buttons
            document.querySelectorAll('[id^="btn-fund-"]').forEach(btn => {
                if (btn.id === 'btn-fund-' + type) {
                    btn.className = 'px-4 py-2 text-sm font-medium rounded-lg bg-orange-600 text-white transition-colors shadow-sm';
                } else {
                    btn.className = 'px-4 py-2 text-sm font-medium rounded-lg bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 transition-colors shadow-sm';
                }
            });

            // Filter data
            const filtered = type === 'all' ? fundingData : fundingData.filter(d => d.type === type);
            
            // Render table
            const tbody = document.getElementById('funding-table-body');
            tbody.innerHTML = '';
            filtered.forEach(item => {
                const typeLabel = item.type === 'internal' ? 
                    '<span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800 border border-green-200">ภายใน</span>' : 
                    '<span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-100 text-blue-800 border border-blue-200">ภายนอก</span>';
                
                tbody.innerHTML += `
                    <tr class="hover:bg-orange-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-800">${item.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">${typeLabel}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right font-medium">${item.projects}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-800 font-bold text-right">${item.budget.toLocaleString()}</td>
                    </tr>
                `;
            });
        };

        // Init table
        filterFunding('all');
    });
</script>

<?php
require_once 'includes/footer.php';
?>
