<?php session_start(); ?>
<?php
include "db/connect-db.php";

$sql = "SELECT COUNT(o_id) as count_oh FROM order_head";
$coh = $conn->query($sql);

$sql = "SELECT COUNT(m_id) as count_m FROM material";
$cm = $conn->query($sql);

$sql = "SELECT COUNT(s_id) as count_s FROM type_stock";
$type = $conn->query($sql);

if (!$_SESSION["user_id"]) {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else { ?>
    <?php include 'components/head.php' ?>
    <!-- page container area start -->
    <div class="page-container">

        <?php include 'components/sidebar.php' ?>

        <!-- main content area start -->
        <div class="main-content">
            <?php include 'components/header.php' ?>
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">แดชบอร์ด</h4>
                        </div>
                    </div>
                    <?php include 'components/username.php' ?>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-report mb-xs-30">
                                <?php foreach ($coh as $row) : ?>
                                    <div class="s-report-inner pr--20 pt--30 mb-3">
                                        <div class="icon"><i class="fa fa-file-text-o"></i></div>
                                        <div class="s-report-title d-flex justify-content-between">
                                            <h4 class="header-title mb-0">รายการเบิกทั้งหมด</h4>
                                        </div>
                                        <div class="d-flex justify-content-between pb-2">
                                            <h2><?= $row['count_oh']; ?></h2>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <canvas id="myChartLine1" width="100%"></canvas>
                                <script>
                                    const ctx1 = document.getElementById('myChartLine1');
                                    const myChartLine1 = new Chart(ctx1, {
                                        type: 'line',
                                        data: {
                                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [12, 19, 3, 5, 2, 3],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132)',
                                                    'rgba(54, 162, 235)',
                                                    'rgba(255, 206, 86)',
                                                    'rgba(75, 192, 192)',
                                                    'rgba(153, 102, 255)',
                                                    'rgba(255, 159, 64)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 2
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: false
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-report mb-xs-30">
                                <?php foreach ($cm as $row) : ?>
                                    <div class="s-report-inner pr--20 pt--30 mb-3">
                                        <div class="icon"><i class="fa fa-print"></i></div>
                                        <div class="s-report-title d-flex justify-content-between">
                                            <h4 class="header-title mb-0">จำนวนวัสดุทั้งหมด</h4>
                                        </div>
                                        <div class="d-flex justify-content-between pb-2">
                                            <h2><?= $row['count_m']; ?></h2>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <canvas id="myChartLine2" width="100%"></canvas>
                                <script>
                                    const ctx2 = document.getElementById('myChartLine2');
                                    const myChartLine2 = new Chart(ctx2, {
                                        type: 'line',
                                        data: {
                                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [12, 19, 3, 5, 2, 3],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132)',
                                                    'rgba(54, 162, 235)',
                                                    'rgba(255, 206, 86)',
                                                    'rgba(75, 192, 192)',
                                                    'rgba(153, 102, 255)',
                                                    'rgba(255, 159, 64)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 2
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: false
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-report">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-filter"></i></div>
                                    <?php foreach ($type as $row) : ?>
                                        <div class="s-report-title d-flex justify-content-between">
                                            <h4 class="header-title mb-0">จำนวนประเภทวัสดุทั้งหมด</h4>
                                        </div>
                                        <div class="d-flex justify-content-between pb-2">
                                            <h2><?= $row['count_s']; ?></h2>
                                        </div>
                                </div>
                            <?php endforeach; ?>
                            <canvas id="myChartLine3" width="100%"></canvas>
                                <script>
                                    const ctx3 = document.getElementById('myChartLine3');
                                    const myChartLine3 = new Chart(ctx3, {
                                        type: 'line',
                                        data: {
                                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [12, 19, 3, 5, 2, 3],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132)',
                                                    'rgba(54, 162, 235)',
                                                    'rgba(255, 206, 86)',
                                                    'rgba(75, 192, 192)',
                                                    'rgba(153, 102, 255)',
                                                    'rgba(255, 159, 64)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 2
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: false
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <!-- Statistics area start -->
                    <div class="col-lg-8 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">User Statistics</h4>
                                <canvas id="myChartBar4" width="100%"></canvas>
                                <script>
                                    const ctx4 = document.getElementById('myChartBar4');
                                    const myChartBar4 = new Chart(ctx4, {
                                        type: 'bar',
                                        responsive: true,
                                        data: {
                                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [12, 19, 3, 5, 2, 3],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132)',
                                                    'rgba(54, 162, 235)',
                                                    'rgba(255, 206, 86)',
                                                    'rgba(75, 192, 192)',
                                                    'rgba(153, 102, 255)',
                                                    'rgba(255, 159, 64)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 0
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- Statistics area end -->
                    <!-- Advertising area start -->
                    <div class="col-lg-4 mt-5">
                        <div class="card h-full">
                            <div class="card-body">
                                <h4 class="header-title">Advertising & Marketing</h4>
                                <canvas id="myChartDoughnut" width="100%"></canvas>
                                <script>
                                    const ctx5 = document.getElementById('myChartDoughnut');
                                    const myChartDoughnut = new Chart(ctx5, {
                                        type: 'doughnut',
                                        data: {
                                            labels: ['Red', 'Blue', 'Yellow'],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [12, 19, 3],
                                                backgroundColor: [
                                                    'rgb(255, 99, 132)',
                                                    'rgb(54, 162, 235)',
                                                    'rgb(255, 205, 86)'
                                                ],
                                                hoverOffset: 4
                                            }]
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- Advertising area end -->

                </div>
            </div>
        </div>
        <!-- main content area end -->

        <?php include 'components/footer.php' ?>

    <?php } ?>