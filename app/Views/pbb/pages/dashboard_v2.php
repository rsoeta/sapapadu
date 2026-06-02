<?= $this->extend('pbb/templates/index'); ?>
<?= $this->section('content'); ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap');

    .content-wrapper {
        font-family: 'Quicksand', sans-serif;
        background-color: #f8fafc;
    }

    /* Tab Styling */
    .nav-tabs-elegant {
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 25px;
        gap: 10px;
    }

    .nav-tabs-elegant .nav-link {
        border: none;
        color: #64748b;
        font-weight: 700;
        padding: 12px 20px;
        border-radius: 12px 12px 0 0;
        transition: all 0.3s;
        position: relative;
    }

    .nav-tabs-elegant .nav-link.active {
        color: #0ea5e9;
        background: transparent;
    }

    .nav-tabs-elegant .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background: #0ea5e9;
        border-radius: 3px;
    }

    /* Elegant Card & KPI */
    .elegant-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .kpi-card {
        border-radius: 16px;
        padding: 24px 20px;
        color: white;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        height: 100%;
    }

    .kpi-card:hover {
        transform: translateY(-5px);
    }

    .bg-primary-elegant {
        background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
    }

    .bg-success-elegant {
        background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
    }

    .bg-warning-elegant {
        background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%);
    }

    .bg-danger-elegant {
        background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
    }

    /* Progress RT Legend & Custom Design */
    .legend-item-sm {
        display: flex;
        align-items: center;
        padding: 5px 0;
        font-size: 0.85rem;
    }

    .legend-color {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        margin-right: 12px;
    }

    .alert-green-soft {
        background-color: #dcfce7;
        color: #166534;
        font-weight: 600;
        border-radius: 10px;
        padding: 12px;
        text-align: center;
    }

    /* Custom Scrollbar for Ranking & RT Chart */
    .custom-list-group {
        max-height: 350px;
        overflow-y: auto;
        padding: 10px;
    }

    .custom-list-item {
        border: none;
        border-bottom: 1px solid #f1f5f9;
        padding: 12px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.2s;
        border-radius: 8px;
    }

    .custom-list-item:hover {
        background-color: #f8fafc;
    }

    .badge-percent {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .custom-select-elegant {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 10px 15px;
        height: auto !important;
        font-weight: 600;
        color: #334155 !important;
        background-color: #ffffff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: all 0.2s;
    }

    .custom-select-elegant:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
        outline: none;
    }

    .chart-rt-container {
        position: relative;
        height: 400px;
        width: 100%;
        min-width: 800px;
    }
</style>

<div class="content-wrapper">
    <div class="container-fluid py-4">

        <ul class="nav nav-tabs nav-tabs-elegant border-0" id="dashboardTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab"><i class="fas fa-th-large mr-2"></i> Overview Capaian</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="analisis-tab" data-toggle="tab" href="#analisis" role="tab"><i class="fas fa-chart-bar mr-2"></i> Analisis Wilayah</a>
            </li>
        </ul>

        <div class="row mb-4 mt-2">
            <div class="col-md-3 col-6 mb-2">
                <label class="text-xs font-weight-bold text-muted text-uppercase mb-1">Tahun</label>
                <select id="filterTahun" class="form-control custom-select-elegant"></select>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <label class="text-xs font-weight-bold text-muted text-uppercase mb-1">Dusun</label>
                <select id="filterDusun" class="form-control custom-select-elegant"></select>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <label class="text-xs font-weight-bold text-muted text-uppercase mb-1">RW</label>
                <select id="filterRw" class="form-control custom-select-elegant">
                    <option value="">Semua RW</option>
                </select>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <label class="text-xs font-weight-bold text-muted text-uppercase mb-1">RT</label>
                <select id="filterRt" class="form-control custom-select-elegant">
                    <option value="">Semua RT</option>
                </select>
            </div>
        </div>

        <div class="tab-content" id="dashboardTabsContent">

            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                <div class="row mb-2">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="kpi-card bg-primary-elegant"><small>TOTAL TARGET</small>
                            <h4 id="kpiTarget" class="font-weight-bold mt-2">Rp 0</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="kpi-card bg-success-elegant"><small>CAPAIAN</small>
                            <h4 id="kpiCapaian" class="font-weight-bold mt-2">Rp 0</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="kpi-card bg-warning-elegant"><small>PERSENTASE</small>
                            <h4 id="kpiPersentase" class="font-weight-bold mt-2">0.00%</h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="kpi-card bg-danger-elegant"><small>SISA TARGET</small>
                            <h4 id="kpiSisa" class="font-weight-bold mt-2">Rp 0</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="elegant-card h-100">
                            <div class="bg-light px-4 py-3 border-bottom text-dark font-weight-bold"><i class="fas fa-chart-pie text-primary mr-2"></i> Komposisi Pembayaran</div>
                            <div class="p-4" style="position: relative; height: 300px;"><canvas id="komposisiChart"></canvas></div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="elegant-card h-100">
                            <div class="bg-light px-4 py-3 border-bottom text-dark font-weight-bold"><i class="fas fa-chart-area text-purple mr-2" style="color:#9333ea;"></i> Timeline Setoran</div>
                            <div class="p-4" style="position: relative; height: 300px;"><canvas id="timelineChart"></canvas></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="elegant-card">
                            <div class="px-4 py-3 text-white font-weight-bold" style="background: linear-gradient(90deg, #10b981, #059669);"><i class="fa-solid fa-trophy text-warning mr-2"></i> Top 10 RT Tertinggi</div>
                            <ul id="topList" class="list-group custom-list-group">
                                <li class="custom-list-item text-center text-muted">Memuat data...</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="elegant-card">
                            <div class="px-4 py-3 text-white font-weight-bold" style="background: linear-gradient(90deg, #ef4444, #dc2626);"><i class="fa-solid fa-triangle-exclamation text-warning mr-2"></i> Bottom 10 RT Terendah</div>
                            <ul id="bottomList" class="list-group custom-list-group">
                                <li class="custom-list-item text-center text-muted">Memuat data...</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="analisis" role="tabpanel">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="elegant-card h-100 d-flex flex-column">
                            <div class="text-white p-3 text-center font-weight-bold" style="background: #9333ea; position: relative;">
                                PROGRES PER DUSUN
                                <div style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.2); padding: 5px 10px; border-radius: 50%;"><i class="fas fa-map-marked-alt"></i></div>
                            </div>
                            <div class="p-4 flex-grow-1" style="position: relative; height: 280px;">
                                <canvas id="chartDusun"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="elegant-card h-100 d-flex flex-column">
                            <div class="text-white p-3 text-center font-weight-bold" style="background: #0ea5e9; position: relative;">
                                PROGRES PER RW
                                <div style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.2); padding: 5px 10px; border-radius: 50%;"><i class="fas fa-users"></i></div>
                            </div>
                            <div class="p-4 flex-grow-1" style="position: relative; height: 280px;">
                                <canvas id="chartRw"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="elegant-card h-100 d-flex flex-column">
                            <div class="text-white p-3 text-center font-weight-bold" style="background: #15803d; position: relative;">
                                DISTRIBUSI PROGRES RT
                                <div style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.2); padding: 5px 10px; border-radius: 50%;"><i class="fas fa-users-cog"></i></div>
                            </div>
                            <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                                <div class="row align-items-center mb-3">
                                    <div class="col-5" style="position: relative; height: 160px; padding-right: 0;">
                                        <canvas id="chartDistribusi"></canvas>
                                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                            <small class="text-dark font-weight-bold d-block" style="line-height: 1.2;">Total</small>
                                            <h5 class="font-weight-bold mb-0 text-dark" id="totalRtCount">0 RT</h5>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="legend-item-sm">
                                            <div class="legend-color" style="background: #22c55e;"></div> <span class="font-weight-bold text-dark">100% (Lunas)</span> <span id="countLunas" class="text-success font-weight-bold ml-auto">0 RT</span>
                                        </div>
                                        <div class="legend-item-sm">
                                            <div class="legend-color" style="background: #86efac;"></div> <span class="font-weight-bold text-dark">75% - 99%</span> <span id="countHampir" class="text-dark font-weight-bold ml-auto">0 RT</span>
                                        </div>
                                        <div class="legend-item-sm">
                                            <div class="legend-color" style="background: #facc15;"></div> <span class="font-weight-bold text-dark">50% - 74%</span> <span id="countSetengah" class="text-dark font-weight-bold ml-auto">0 RT</span>
                                        </div>
                                        <div class="legend-item-sm">
                                            <div class="legend-color" style="background: #fb923c;"></div> <span class="font-weight-bold text-dark">25% - 49%</span> <span id="countKurang" class="text-dark font-weight-bold ml-auto">0 RT</span>
                                        </div>
                                        <div class="legend-item-sm">
                                            <div class="legend-color" style="background: #f87171;"></div> <span class="font-weight-bold text-dark">0% - 24%</span> <span id="countMinim" class="text-dark font-weight-bold ml-auto">0 RT</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert-green-soft">
                                    Ayo dorong RT di sekitar kita agar progres semakin naik! 💪
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="elegant-card">
                            <div class="text-white p-3 px-4 font-weight-bold d-flex justify-content-between align-items-center" style="background: linear-gradient(90deg, #0d9488, #14b8a6);">
                                <span><i class="fas fa-chart-bar mr-2 text-warning"></i> PROGRES PER RT KESELURUHAN</span>
                                <div style="background: rgba(255,255,255,0.2); padding: 5px 12px; border-radius: 20px; font-size: 0.85rem;"><i class="fas fa-info-circle"></i> Geser/Scroll untuk melihat lebih banyak</div>
                            </div>
                            <div class="p-4" style="overflow-x: auto;">
                                <div class="chart-rt-container">
                                    <canvas id="chartRt"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let charts = {};

    $(document).ready(function() {
        initAllCharts();
        loadTahun();
        loadDusun();

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            loadAll();
        });
        $('#filterTahun, #filterDusun, #filterRw, #filterRt').change(loadAll);
    });

    /* =========================
       🎨 CHART CUSTOM PLUGINS
    ========================= */
    // 1. Plugin Label Persen untuk Pie Chart
    const piePercentLabel = {
        id: 'piePercentLabel',
        afterDraw(chart) {
            const {
                ctx
            } = chart;
            const dataset = chart.data.datasets[0];
            const meta = chart.getDatasetMeta(0);
            if (!dataset || !meta) return;
            ctx.save();
            ctx.font = 'bold 13px Quicksand, sans-serif';
            ctx.fillStyle = '#ffffff';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            meta.data.forEach((arc, i) => {
                const value = dataset.data[i];
                if (!value || value <= 0) return;
                const pos = arc.tooltipPosition();
                ctx.fillText(value.toFixed(1) + '%', pos.x, pos.y);
            });
            ctx.restore();
        }
    };

    // 2. Plugin Label Persen untuk Bar Chart (Dusun, RW, RT) - VERSI STACKED
    const barPercentLabel = {
        id: 'barPercentLabel',
        afterDraw(chart) {
            const {
                ctx
            } = chart;
            const dataset = chart.data.datasets[0]; // Hanya ambil dataset pertama (Progres)
            const meta = chart.getDatasetMeta(0);

            if (!meta.hidden) {
                meta.data.forEach((element, index) => {
                    const value = dataset.data[index];
                    if (value > 0) {
                        ctx.fillStyle = '#334155'; // Warna teks Slate-700
                        ctx.font = 'bold 11px Quicksand, sans-serif';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';
                        const dataString = value.toFixed(1) + '%';

                        // Gambar teks persis di atas batang progres (menimpa area sisa yang berwarna abu)
                        ctx.fillText(dataString, element.x, element.y - 3);
                    }
                });
            }
        }
    };

    /* =========================
       📊 INIT SEMUA CHART
    ========================= */
    function initAllCharts() {
        // --- 1. KOMPOSISI (PIE) & 2. TIMELINE (LINE) ---
        // (Biarkan kode komposisiChart dan timelineChart seperti aslinya...)

        // (Salin kode komposisiChart dan timelineChart aslimu di sini)
        charts.komposisi = new Chart(document.getElementById('komposisiChart'), {
            type: 'pie',
            data: {
                labels: ['Lunas', 'Belum Lunas', 'Bermasalah'],
                datasets: [{
                    data: [0, 0, 0],
                    backgroundColor: ['#0ea5e9', '#a855f7', '#f43f5e'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                family: 'Quicksand',
                                weight: 'bold'
                            }
                        }
                    }
                }
            },
            plugins: [piePercentLabel]
        });

        charts.timeline = new Chart(document.getElementById('timelineChart'), {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Total Setoran',
                    data: [],
                    borderColor: '#9333ea',
                    backgroundColor: 'rgba(147, 51, 234, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#9333ea',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [4, 4],
                            color: '#f1f5f9'
                        },
                        border: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });


        // Config standard untuk Bar Charts (Dusun, RW, RT) -> DIBUAT STACKED
        const commonBarOptions = {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 15
                }
            },
            plugins: {
                legend: {
                    display: true, // Tampilkan legend agar user tahu warna Progres vs Sisa
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8,
                        font: {
                            family: 'Quicksand',
                            weight: 'bold'
                        }
                    }
                }
            },
            scales: {
                y: {
                    stacked: true,
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: v => v + '%'
                    },
                    grid: {
                        color: '#f1f5f9'
                    },
                    border: {
                        display: false
                    }
                },
                x: {
                    stacked: true,
                    grid: {
                        display: false
                    },
                    border: {
                        display: false
                    }
                }
            }
        };

        // --- 3. DUSUN (BAR) ---
        charts.dusun = new Chart(document.getElementById('chartDusun'), {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                        label: 'Progres',
                        backgroundColor: '#a855f7',
                        data: []
                    },
                    {
                        label: 'Sisa Target',
                        backgroundColor: '#cccccc',
                        data: []
                    } // Warna abu-abu murni
                ]
            },
            options: commonBarOptions,
            plugins: [barPercentLabel]
        });

        // --- 4. RW (BAR) ---
        charts.rw = new Chart(document.getElementById('chartRw'), {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                        label: 'Progres',
                        backgroundColor: '#38bdf8',
                        data: []
                    },
                    {
                        label: 'Sisa Target',
                        backgroundColor: '#cccccc',
                        data: []
                    } // Warna abu-abu murni
                ]
            },
            options: commonBarOptions,
            plugins: [barPercentLabel]
        });

        // --- 6. RT KESELURUHAN FULL WIDTH (BAR) ---
        charts.rt = new Chart(document.getElementById('chartRt'), {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                        label: 'Progres',
                        backgroundColor: '#14b8a6',
                        data: []
                    },
                    {
                        label: 'Sisa Target',
                        backgroundColor: '#cccccc',
                        data: []
                    } // Warna abu-abu murni
                ]
            },
            options: Object.assign({}, commonBarOptions, {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 45,
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: v => v + '%'
                        },
                        grid: {
                            color: '#f1f5f9'
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }),
            plugins: [barPercentLabel]
        });

        // --- 5. DISTRIBUSI (DOUGHNUT) ---
        // (Biarkan kode distribusiChart aslinya...)
        charts.distribusi = new Chart(document.getElementById('chartDistribusi'), {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [0, 0, 0, 0, 0],
                    backgroundColor: ['#22c55e', '#86efac', '#facc15', '#fb923c', '#f87171'],
                    borderWidth: 0,
                    cutout: '75%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        enabled: false
                    }
                },
                layout: {
                    padding: 0
                }
            }
        });

    }

    /* =========================
       🔄 CONTROLLER PEMUAT DATA
    ========================= */
    function loadAll() {
        const activeTab = $('.nav-link.active').attr('id');
        const thn = $('#filterTahun').val() || new Date().getFullYear();
        const dsn = $('#filterDusun').val() || '';
        const rw = $('#filterRw').val() || '';
        const rt = $('#filterRt').val() || '';

        if (activeTab === 'overview-tab') {
            loadKpi(thn, dsn, rw, rt);
            loadKomposisi(thn, dsn, rw, rt);
            loadTimeline(thn, dsn, rw, rt);
            loadRanking(thn);
        } else {
            loadAnalisisCharts(thn, dsn, rw);
        }
    }

    // (Fungsi loadKpi, loadKomposisi, loadTimeline, loadRanking sama seperti sebelumnya)
    async function loadKpi(tahun, dusun, rw, rt) {
        const res = await fetch(`/dashboard/kpi?tahun=${tahun}&dusun=${dusun}&rw=${rw}&rt=${rt}`);
        const data = await res.json();
        $('#kpiTarget').text(formatRupiah(data.target));
        $('#kpiCapaian').text(formatRupiah(data.capaian));
        $('#kpiPersentase').text(data.persentase + '%');
        $('#kpiSisa').text(formatRupiah(data.sisa));
    }

    async function loadKomposisi(tahun, dusun, rw, rt) {
        const res = await fetch(`/dashboard/komposisi?tahun=${tahun}&dusun=${dusun}&rw=${rw}&rt=${rt}`);
        const data = await res.json();
        let total = (data.lunas || 0) + (data.belum || 0) + (data.bermasalah || 0);
        charts.komposisi.data.datasets[0].data = total === 0 ? [0, 0, 0] : [(data.lunas / total * 100), (data.belum / total * 100), (data.bermasalah / total * 100)];
        charts.komposisi.update();
    }

    async function loadTimeline(tahun, dusun, rw, rt) {
        const res = await fetch(`/dashboard/timeline?tahun=${tahun}&dusun=${dusun}&rw=${rw}&rt=${rt}`);
        const data = await res.json();
        charts.timeline.data.labels = data.map(x => x.tanggal);
        charts.timeline.data.datasets[0].data = data.map(x => Number(x.total));
        charts.timeline.update();
    }

    async function loadRanking(tahun) {
        const res = await fetch(`/dashboard/ranking-rt?tahun=${tahun}`);
        const data = await res.json();
        if (!Array.isArray(data)) return;
        data.sort((a, b) => b.dataPersentase - a.dataPersentase);

        let topHtml = '',
            bottomHtml = '';
        data.slice(0, 10).forEach((r, idx) => {
            let p = Number(r.dataPersentase || 0);
            let bgClass = p >= 80 ? 'background: #dcfce7; color: #166534;' : p >= 50 ? 'background: #fef9c3; color: #854d0e;' : 'background: #fee2e2; color: #991b1b;';
            topHtml += `<li class="custom-list-item"><div class="d-flex align-items-center gap-3"><div style="width:30px; height:30px; border-radius:50%; background:#f1f5f9; display:flex; align-items:center; justify-content:center; font-weight:bold; color:#64748b; margin-right:15px;">${idx + 1}</div><div><strong style="color:#334155;">RT ${r.rt_fix || pad(r.rt)} / RW ${r.rw_fix || pad(r.rw)}</strong><div style="font-size: 0.8rem; color:#64748b;">${r.alamat_rt || '-'}</div></div></div><span class="badge-percent" style="${bgClass}">${p.toFixed(2)}%</span></li>`;
        });

        data.slice(-10).reverse().forEach((r, idx) => {
            let p = Number(r.dataPersentase || 0);
            let bgClass = p >= 80 ? 'background: #dcfce7; color: #166534;' : p >= 50 ? 'background: #fef9c3; color: #854d0e;' : 'background: #fee2e2; color: #991b1b;';
            bottomHtml += `<li class="custom-list-item"><div class="d-flex align-items-center gap-3"><div style="width:30px; height:30px; border-radius:50%; background:#f1f5f9; display:flex; align-items:center; justify-content:center; font-weight:bold; color:#64748b; margin-right:15px;">${idx + 1}</div><div><strong style="color:#334155;">RT ${r.rt_fix || pad(r.rt)} / RW ${r.rw_fix || pad(r.rw)}</strong><div style="font-size: 0.8rem; color:#64748b;">${r.alamat_rt || '-'}</div></div></div><span class="badge-percent" style="${bgClass}">${p.toFixed(2)}%</span></li>`;
        });

        $('#topList').html(topHtml || '<li class="custom-list-item text-center text-muted">Belum ada data.</li>');
        $('#bottomList').html(bottomHtml || '<li class="custom-list-item text-center text-muted">Belum ada data.</li>');
    }

    /* =========================
       2️⃣ TAB ANALISIS LOGIC
    ========================= */
    async function loadAnalisisCharts(thn, dsn, rw) {
        // Dusun
        const resDsn = await $.get(`/dashboard/progress-dusun?tahun=${thn}`);
        charts.dusun.data.labels = resDsn.map(i => i.label);
        charts.dusun.data.datasets[0].data = resDsn.map(i => i.persentase); // Data Progres
        charts.dusun.data.datasets[1].data = resDsn.map(i => 100 - i.persentase); // Kalkulasi Data Sisa
        charts.dusun.update();

        // RW
        const resRw = await $.get(`/dashboard/progress-rw?tahun=${thn}&dusun=${dsn}`);
        charts.rw.data.labels = resRw.map(i => i.label);
        charts.rw.data.datasets[0].data = resRw.map(i => i.persentase); // Data Progres
        charts.rw.data.datasets[1].data = resRw.map(i => 100 - i.persentase); // Kalkulasi Data Sisa
        charts.rw.update();

        // Distribusi (Tetap sama)
        const resDist = await $.get(`/dashboard/distribusi-rt?tahun=${thn}&dusun=${dsn}`);
        const d = resDist.distribusi;
        charts.distribusi.data.datasets[0].data = [d.lunas, d.hampir, d.setengah, d.kurang, d.minim];
        charts.distribusi.update();

        $('#totalRtCount').text(resDist.total_rt + ' RT');
        $('#countLunas').text(d.lunas + ' RT');
        $('#countHampir').text(d.hampir + ' RT');
        $('#countSetengah').text(d.setengah + ' RT');
        $('#countKurang').text(d.kurang + ' RT');
        $('#countMinim').text(d.minim + ' RT');

        // RT Keseluruhan (NEW)
        const resRt = await $.get(`/dashboard/progress-rt?tahun=${thn}&dusun=${dsn}&rw=${rw}`);
        charts.rt.data.labels = resRt.map(i => i.label);
        charts.rt.data.datasets[0].data = resRt.map(i => i.persentase); // Data Progres
        charts.rt.data.datasets[1].data = resRt.map(i => 100 - i.persentase); // Kalkulasi Data Sisa

        // Sesuaikan lebar canvas chart RT jika datanya banyak
        const chartRtContainer = document.querySelector('.chart-rt-container');
        if (resRt.length > 20) {
            chartRtContainer.style.width = (resRt.length * 40) + 'px';
        } else {
            chartRtContainer.style.width = '100%';
        }
        charts.rt.update();
    }

    /* =========================
       🎛️ DROPDOWN API
    ========================= */
    function loadTahun() {
        $.get('/api/wilayah/tahun', function(res) {
            let html = '<option value="">Semua Tahun</option>';
            res.forEach(r => {
                html += `<option value="${r.tahun}">${r.tahun}</option>`;
            });
            $('#filterTahun').html(html);
            $('#filterTahun').val(new Date().getFullYear());
            loadAll();
        });
    }

    function loadDusun() {
        $.get('/api/wilayah/dusun', function(res) {
            let html = '<option value="">Semua Dusun</option>';
            res.forEach(r => {
                html += `<option value="${r.dusun}">Dusun ${r.dusun} - ${r.nama}</option>`;
            });
            $('#filterDusun').html(html);
        });
    }
    $('#filterDusun').change(function() {
        let dusun = $(this).val();
        $.get('/api/wilayah/rw', {
            dusun
        }, function(res) {
            let html = '<option value="">Semua RW</option>';
            res.forEach(r => {
                html += `<option value="${r.rw}">RW ${String(r.rw).padStart(3,'0')}</option>`;
            });
            $('#filterRw').html(html);
            $('#filterRt').html('<option value="">Semua RT</option>');
            loadAll();
        });
    });
    $('#filterRw').change(function() {
        let dusun = $('#filterDusun').val();
        let rw = $(this).val();
        $.get('/api/wilayah/rt', {
            dusun,
            rw
        }, function(res) {
            let html = '<option value="">Semua RT</option>';
            res.forEach(r => {
                html += `<option value="${r.rt}">RT ${String(r.rt).padStart(3,'0')}</option>`;
            });
            $('#filterRt').html(html);
            loadAll();
        });
    });

    function formatRupiah(angka) {
        return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    function pad(num) {
        return String(num).padStart(3, '0');
    }
</script>

<?= $this->endSection(); ?>