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
                <h3 class="text-2xl font-extrabold text-slate-800"><?php echo number_format($total_research); ?></h3>
            </div>
        </div>

        <!-- Card 2: งบประมาณทั้งหมด -->
        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-4 bg-green-100 rounded-xl text-green-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">งบประมาณทั้งหมด</p>
                <h3 class="text-2xl font-extrabold text-slate-800"><?php echo escape_html($total_budget_display); ?></h3>
            </div>
        </div>

        <!-- Card 3: แหล่งงบประมาณทั้งหมด -->
        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-4 bg-purple-100 rounded-xl text-purple-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">แหล่งงบประมาณ</p>
                <h3 class="text-2xl font-extrabold text-slate-800"><?php echo number_format($total_funding_sources); ?></h3>
            </div>
        </div>

        <!-- Card 4: นักวิจัยทั้งหมด -->
        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-4 bg-orange-100 rounded-xl text-orange-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">นักวิจัยทั้งหมด</p>
                <h3 class="text-2xl font-extrabold text-slate-800"><?php echo number_format($total_researchers); ?></h3>
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

    <!-- Researchers Table Section -->
    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 mt-8">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h3 class="text-xl font-bold text-slate-800">ตารางนักวิจัย (Researchers)</h3>
        </div>
        <div class="overflow-x-auto overflow-y-auto max-h-[500px] border border-slate-200 rounded-lg">
            <table class="min-w-full bg-white relative">
                <thead class="bg-slate-100 border-b border-slate-200 sticky top-0 z-10 shadow-sm">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">ชื่อ-สกุลนักวิจัย</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">สังกัด/คณะ</th>
                        <th class="px-6 py-3 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">จำนวนผลงาน</th>
                    </tr>
                </thead>
                <tbody id="researcher-table-body" class="divide-y divide-slate-100">
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
        // Plugin to show numbers with callout lines pointing outside the doughnut
        const doughnutOutlabelsPlugin = {
            id: 'doughnutOutlabels',
            afterDraw(chart, args, options) {
                if (chart.config.type !== 'doughnut') return;
                const { ctx, data } = chart;
                
                chart.data.datasets.forEach((dataset, i) => {
                    const meta = chart.getDatasetMeta(i);
                    meta.data.forEach((element, index) => {
                        const value = dataset.data[index];
                        if (!value || value <= 0) return;
                        
                        const midAngle = element.startAngle + (element.endAngle - element.startAngle) / 2;
                        const centerX = element.x;
                        const centerY = element.y;
                        const radius = element.outerRadius;
                        
                        // Calculate start point (on the edge of the doughnut)
                        const startX = centerX + Math.cos(midAngle) * radius;
                        const startY = centerY + Math.sin(midAngle) * radius;
                        
                        // Line extension length
                        const lineExtension = 10; 
                        const endX = centerX + Math.cos(midAngle) * (radius + lineExtension);
                        const endY = centerY + Math.sin(midAngle) * (radius + lineExtension);
                        
                        // Horizontal tail
                        const tailLength = 10;
                        const isRightSide = Math.cos(midAngle) > 0;
                        const tailX = endX + (isRightSide ? tailLength : -tailLength);
                        
                        // Draw line
                        ctx.beginPath();
                        ctx.moveTo(startX, startY);
                        ctx.lineTo(endX, endY);
                        ctx.lineTo(tailX, endY);
                        ctx.strokeStyle = dataset.backgroundColor[index] || '#64748b';
                        ctx.lineWidth = 2;
                        ctx.stroke();
                        
                        // Draw text
                        ctx.fillStyle = '#475569'; // text-slate-600
                        ctx.font = 'bold 12px "Sarabun", sans-serif';
                        ctx.textAlign = isRightSide ? 'left' : 'right';
                        ctx.textBaseline = 'middle';
                        
                        const textPadding = 6;
                        const textX = tailX + (isRightSide ? textPadding : -textPadding);
                        
                        const labelText = chart.data.labels[index] || '';
                        const displayText = labelText + ' (' + value + ')';
                        
                        ctx.fillText(displayText, textX, endY);
                    });
                });
            }
        };
        Chart.register(doughnutOutlabelsPlugin);

        // Chart 1: Bar Chart
        const ctx1 = document.getElementById('researchChart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($chart_research_year['labels']); ?>,
                datasets: [{
                    label: 'จำนวนโครงการวิจัย',
                    data: <?php echo json_encode($chart_research_year['data']); ?>,
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
                labels: <?php echo json_encode($chart_quartile['labels']); ?>,
                datasets: [{
                    label: 'จำนวนบทความตีพิมพ์',
                    data: <?php echo json_encode($chart_quartile['data']); ?>,
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
                labels: <?php echo json_encode($chart_faculty['labels']); ?>,
                datasets: [{
                    label: 'จำนวนโครงการวิจัย',
                    data: <?php echo json_encode($chart_faculty['data']); ?>,
                    backgroundColor: <?php echo json_encode($chart_faculty['colors']); ?>,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: { left: 80, right: 80, top: 20, bottom: 20 }
                },
                radius: '80%',
                plugins: {
                    legend: {
                        display: false
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
                labels: <?php echo json_encode($chart_budget_year['labels']); ?>,
                datasets: [{
                    label: 'มูลค่างบประมาณ (ล้านบาท)',
                    data: <?php echo json_encode($chart_budget_year['data']); ?>,
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
        const fundingData = <?php echo json_encode($funding_data); ?>;

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
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-800">
                            <a href="<?php echo BASE_URL; ?>admin/research?search=${encodeURIComponent(item.name)}" class="text-orange-600 hover:text-orange-800 hover:underline transition-colors cursor-pointer">
                                ${item.name}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">${typeLabel}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 text-right font-medium">${item.projects}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-800 font-bold text-right">${item.budget.toLocaleString()}</td>
                    </tr>
                `;
            });
        };

        // Init table
        filterFunding('all');

        // Researcher Table Logic
        const researcherData = <?php echo json_encode($top_researchers); ?>;

        function renderResearchers() {
            const tbody = document.getElementById('researcher-table-body');
            tbody.innerHTML = '';
            researcherData.forEach(item => {
                tbody.innerHTML += `
                    <tr class="hover:bg-blue-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-800">
                            <a href="<?php echo BASE_URL; ?>admin/research?search=${encodeURIComponent(item.name)}" class="text-blue-600 hover:text-blue-800 hover:underline transition-colors cursor-pointer">
                                ${item.name}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">${item.faculty}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-800 text-right font-medium">${item.projects}</td>
                    </tr>
                `;
            });
        }

        renderResearchers();
    });
</script>

<?php
require_once 'includes/footer.php';
?>
