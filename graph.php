<?php session_start(); ?>
<?php

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
                        <h4 class="page-title pull-left">รายงานกราฟ</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="home.php">หน้าหลัก</a></li>
                            <li><span>รายงานกราฟ</span></li>
                        </ul>
                    </div>
                </div>
                <?php include 'components/username.php' ?>
            </div>
        </div>
        <!-- page title area end -->
        <div class="main-content-inner">
            <!-- bar chart start -->
            <div class="row">
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div id="ambarchart1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div id="amlinechart4"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div id="highpiechart4"></div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5">
                <div class="card">
                            <div id="highpiechart6"></div>
                        </div>
                </div>
                

            </div>
            <!-- bar chart end -->

        </div>
    </div>
    <!-- main content area end -->

    <?php include 'components/footer.php' ?>

    <?php } ?>