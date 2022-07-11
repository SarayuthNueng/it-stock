<?php session_start(); ?>
<?php
include "db/connect-db.php";

$sql = "SELECT * FROM type_stock";
$result = mysqli_query($conn, $sql);

?>
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
                            <h4 class="page-title pull-left">เพิ่มประเภทวัสดุ</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="home.php">หน้าหลัก</a></li>
                                <li><span>จัดการประเภทวัสดุ</span></li>
                            </ul>
                        </div>
                    </div>
                    <?php include 'components/username.php' ?>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="header-title">เพิ่มประเภทวัสดุ</h4>
                                </div>
                            </div>
                            <form action="manage-tool-type-addsave.php" method="POST" enctype="multipart/form-data">
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-6">
                                        <label class="mb-3">ชื่อประเภทวัสดุ</label>
                                        <input type="text" id="s_name" name="s_name" class="form-control" placeholder="ชื่อประเภทวัสดุ" required>
                                    </div>
                                </div>
                                <div class="row justify-content-center mb-5 mt-3">
                                    <div class="col-md-2">
                                        <button type="button" onclick="history.back(-1)" class="btn btn-secondary btn-block"><i class="fa fa-times"></i> ย้อนกลับ</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> บันทึก</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main content area end -->

        <?php include 'components/footer.php' ?>

    <?php } ?>