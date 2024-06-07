<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.11.3/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.11.3/main.min.css" rel="stylesheet">
</head>
<body>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $total_job ?></h3>
                            <p>Job Request</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="job_request" class="small-box-footer">
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $total_user ?></h3>
                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main row -->
        <div class="row">
            <!-- Area Chart col -->
            <section class="col-lg-6 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Area Chart
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="chart" style="position: relative; height: 300px;">
                            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Donut Chart col -->
            <section class="col-lg-6 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Status Jobs
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="chart" style="position: relative; height: 300px;">
                            <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <!-- Welcome Card -->
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-3 d-flex align-items-center justify-content-center">
                    <img src="<?= base_url('assets/dist/img/profile/logo_glopac.png') ?>" class="card-img" style="max-width: 32%; height: auto; margin: 10px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 22px; font-weight: bold;">Welcome <?= $user['name']; ?></h5>
                        <p class="card-text" style="font-size: 18px;">Saat ini Anda login pada Glopac Manufacture Resource Planning. Glopac Manufacture Resource Planning adalah Main Internal Application untuk mengelola Purchase Order, Sales Order, Customer Proforma, Inventory, Manufacture dan Payroll pada PT Glopac Indonesia. Abstrak-PT Glopac Indonesia merupakan perusahaan produksi kemasan makanan dan dengan salah satu produknya yaitu Paper Cups.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Data untuk Area Chart
            const areaChartLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const areaChartData = {
                labels: areaChartLabels,
                datasets: [{
                    label: 'Jobs',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: <?= json_encode(array_column($job_requests, 'job_count'), JSON_NUMERIC_CHECK) ?>
                }]
            };

            // Data untuk Donut Chart
            const donutChartData = {
                labels: ['Not Started', 'On Going', 'Done'],
                datasets: [{
                    data: [<?= $not_started ?>, <?= $on_going ?>, <?= $done ?>],
                    backgroundColor: ['#ff0000', '#00c0ef', '#00a65a'],
                }]
            };

            // Inisialisasi Area Chart
            const areaChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
            const areaChart = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                }
            });

            // Inisialisasi Donut Chart
            const donutChartCanvas = document.getElementById('sales-chart-canvas').getContext('2d');
            const donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutChartData,
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                }
            });
        });
    </script>
</body>
</html>
