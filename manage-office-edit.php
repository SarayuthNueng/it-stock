<?php session_start(); ?>
<?php
include "db/connect-db.php";


$kID = $_GET['edit'];

$sql = "SELECT * FROM koffice WHERE k_id = '$kID' ";
$query = mysqli_query($conn, $sql);

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
                            <h4 class="page-title pull-left">แก้ไขหน่วยงาน</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="home.php">หน้าหลัก</a></li>
                                <li><span>จัดการหน่วยงาน</span></li>
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
                                    <h4 class="header-title">แก้ไขหน่วยงาน</h4>
                                </div>
                            </div>
                            <form action="manage-office-editsave.php" method="POST" enctype="multipart/form-data">
                                <?php while ($row = mysqli_fetch_array($query)) { ?>
                                    <div class="row justify-content-center mb-4">
                                        <div class="col-lg-6">
                                            <label class="mb-3">ชื่อหน่วยงาน</label>
                                            <input type="text" id="k_name" name="k_name" value="<?php echo $row['k_name'] ?>" class="form-control" placeholder="ชื่อหน่วยงาน">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mb-5 mt-3">
                                        <input type="hidden" name="k_id" value="<?php echo $kID; ?>">
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