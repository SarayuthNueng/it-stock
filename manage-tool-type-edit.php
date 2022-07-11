<?php session_start(); ?>
<?php
include "db/connect-db.php";

$sID = $_GET['s_id'];

$sql = "SELECT * FROM type_stock WHERE s_id = '$sID' ";
$query = mysqli_query($conn, $sql);
// $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
// print_r($result['s_name']);


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
                            <h4 class="page-title pull-left">แก้ไขประเภทวัสดุ</h4>
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
                                    <h4 class="header-title">แก้ไขประเภทวัสดุ</h4>
                                </div>
                            </div>
                            <form action="manage-tool-type-editsave.php" method="POST" enctype="multipart/form-data">
                            <?php while ($row = mysqli_fetch_array($query)) { ?>
                                    <div class="row justify-content-center mb-4">
                                        <div class="col-lg-6">
                                            <label class="mb-3">ชื่อประเภทวัสดุ</label>
                                            <input type="text" id="s_name" name="s_name" value="<?php echo $row['s_name'] ?>" class="form-control" placeholder="ชื่อประเภทวัสดุ">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mb-5 mt-3">
                                        <input type="hidden" name="s_id" value="<?php echo $sID; ?>">
                                        <div class="col-md-2">
                                            <button type="button" onclick="history.back(-1)" class="btn btn-secondary btn-block"><i class="fa fa-times"></i> ย้อนกลับ</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> บันทึก</button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main content area end -->

        <?php include 'components/footer.php' ?>

    <?php } ?>