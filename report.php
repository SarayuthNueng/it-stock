<?php session_start(); ?>
<?php
include "db/connect-db.php";

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
                            <h4 class="page-title pull-left">รายงานการเบิก - จ่าย</h4>
                        </div>
                    </div>
                    <?php include 'components/username.php' ?>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- Dark table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-5">
                                <a href="report.php" class="btn btn-success mb-2"><i class="ti-export mx-2"></i>รายวัน</a>
                                <a href="report.php?act=m" class="btn btn-warning mb-2"><i class="ti-export mx-2"></i>รายเดือน</a>
                                <a href="report.php?act=y" class="btn btn-info mb-2"><i class="ti-export mx-2"></i>รายปี</a>
                                <a href="report.php?act=date" class="btn btn-danger mb-2"><i class="ti-export mx-2"></i>เรียกดูตามวัน</a>
                            </div>

                            <?php
                            $act = (isset($_GET['act']) ? $_GET['act'] : '');
                            if ($act == 'm') {
                                // ตามเดือน
                                include('report-m.php');
                            } else if ($act == 'y') {
                                // ตามปี
                                include('report-y.php');
                            } else if ($act == 'date') {
                                // ตามวันที่
                                include('report-d.php');
                            } else if ($act == 'daterange') {
                                // ตามวันที่
                                include('report-daterange.php');
                            } else {
                                // ตามวัน
                                include('report-d.php');
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Dark table end -->

            </div>
        </div>
        <!-- main content area end -->

        <?php include 'components/footer.php' ?>

    <?php } ?>