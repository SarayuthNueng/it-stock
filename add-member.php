<?php session_start(); ?>
<?php
include "db/connect-db.php";

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

$sql = "SELECT * FROM pname";
$kumnum = $conn->query($sql);

$sql = "SELECT * FROM status";
$u_status = $conn->query($sql);

$sql = "SELECT * FROM koffice";
$office = $conn->query($sql);

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
                            <h4 class="page-title pull-left">เพิ่มสมาชิก</h4>
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
                                    <h4 class="header-title">เพิ่มสมาชิก</h4>
                                </div>
                            </div>
                            <form action="add-member-addsave.php" method="POST" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-lg-4">
                                        <label class="col-form-label">ชื่อผู้ใช้</label>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="ชื่อผู้ใช้" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-form-label">รหัสผ่าน</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-form-label">เลขบัตรประชาชน</label>
                                        <input type="text" id="cid" name="cid" class="form-control" placeholder="เลขบัตรประชาชน" required>
                                    </div>

                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-2">
                                        <label class="col-form-label">คำนำหน้า</label>
                                        <select class="custom-select" name="pname" id="pname">
                                            <option selected="selected">กรุณาเลือก</option>
                                            <?php foreach ($kumnum as $k) : ?>
                                                <option value="<?= $k['pname_name']; ?>"><?= $k['pname_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-5">
                                        <label class="col-form-label">ชื่อ - นามสกุล</label>
                                        <input type="text" class="form-control" aria-label="Text input with dropdown button" id="fullname" name="fullname" placeholder="ชื่อ - นามสกุล" required>
                                    </div>
                                    <div class="col-lg-5">
                                        <label class="col-form-label">เบอร์โทรศัพท์</label>
                                        <input type="text" id="tel" name="tel" class="form-control" placeholder="เบอร์โทรศัพท์" required>
                                    </div>
                                </div>

                                <div class="row mt-3">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="col-form-label">หน่วยงาน</label>
                                            <select class="custom-select" name="txtoffice" id="txtoffice">
                                                <option selected="selected">กรุณาเลือก</option>
                                                <?php foreach ($office as $o) : ?>
                                                    <option value="<?= $o['k_name']; ?>"><?= $o['k_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-form-label">ตำแหน่ง</label>
                                        <input type="text" id="position" name="position" class="form-control" placeholder="ตำแหน่ง" required>

                                    </div>
                                    <div class="col-lg-4">
                                        <label class="col-form-label">สถานะ</label>
                                        <select class="custom-select" name="status" id="status">
                                            <option selected="selected">กรุณาเลือก</option>
                                            <?php foreach ($u_status as $s) : ?>
                                                <option value="<?= $s['status_name']; ?>"><?= $s['status_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
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