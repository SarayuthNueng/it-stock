<?php session_start(); ?>
<?php

if (!$_SESSION["user_id"]) {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else { ?>
    <!-- connent db -->
    <?php

    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "stock_it";

    try {   //ทำการเชื่อมต่อ database
        $db = new PDO("mysql:host={$db_host}; dbname={$db_name}", $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {   //หากเชื่อมต่อผิดพลาดให้แสดงข้อความเตือน
        echo "Failed to connect" . $e->getMessage();
    }
    ?>
    <?php
    if (isset($_GET['user_id'])) {
        $stmt = $db->prepare("SELECT* FROM users WHERE user_id=?");
        $stmt->execute([$_GET['user_id']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
        if ($stmt->rowCount() < 1) {
            header('Location: index.php');
            exit();
        }
    } //isset
    ?>
    <?php
    include "db/connect-db.php";

    $sql = "SELECT * FROM pname";
    $kum = $conn->query($sql);

    $sql = "SELECT * FROM txtoffice";
    $office = $conn->query($sql);

    ?>
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
                            <h4 class="page-title pull-left">โปรไฟล์</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="home.php">หน้าหลัก</a></li>
                                <li><span>โปรไฟล์</span></li>
                            </ul>
                        </div>
                    </div>
                    <?php include 'components/username.php' ?>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <div class="col-12 mt-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-menu">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#per_details_tab">เกี่ยวกับ</a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#password_tab">รหัสผ่าน</a> </li>
                                </ul>
                            </div>
                            <div class="tab-content profile-tab-cont">
                                <div class="tab-pane fade show active" id="per_details_tab">
                                    <div class="row ">
                                        <div class="col-lg-12">
                                            <div class="card ">
                                                <div class="card-body ">
                                                    <h5 class="card-title d-flex justify-content-between ">
                                                        <span>ข้อมูลโปรไฟล์</span>
                                                        <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>แก้ไข</a>
                                                    </h5>

                                                    <div class="row mt-5">
                                                        <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">ชื่อผู้ใช้งาน :</p>
                                                        <p class="col-sm-9"><?php echo $row['username']; ?></p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">คำนำหน้า :</p>
                                                        <p class="col-sm-9"><?php echo $row['pname']; ?></p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">ชื่อ - นามสกุล :</p>
                                                        <p class="col-sm-9"><?php echo $row['fullname']; ?></p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">เลขบัตรประจำตัวประชาชน :</p>
                                                        <p class="col-sm-9"><?php echo $row['cid']; ?></p>
                                                    </div>
                                                    <div class="row ">
                                                        <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">เบอร์โทรศัพท์ :</p>
                                                        <p class="col-sm-9"><?php echo $row['tel']; ?></p>
                                                    </div>
                                                    <div class="row ">
                                                        <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">หน่วยงาน :</p>
                                                        <p class="col-sm-9"><?php echo $row['txtoffice']; ?></p>
                                                    </div>
                                                    <div class="row ">
                                                        <p class="col-sm-3 text-sm-right mb-0 mb-sm-3">ตำแหน่ง :</p>
                                                        <p class="col-sm-9"><?php echo $row['position']; ?></p>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">ข้อมูลโปรไฟล์</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="profile-edit-save.php" method="post">
                                                                <div class="row form-row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>ชื่อผู้ใช้งาน</label>
                                                                            <div class="form-group">
                                                                                <input type="text" disabled="disabled" name="username" class="form-control" value="<?php echo $row['username']; ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-6 col-sm-6">
                                                                        <label class="col-form-label">คำนำหน้า</label>
                                                                        <select class="custom-select" name="pname" id="pname">
                                                                            <option selected="selected" value="<?php echo $row['pname'] ?>">กรุณาเลือก</option>
                                                                            <?php foreach ($kum as $k) : ?>
                                                                                <option value="<?= $k['pname_name']; ?>"><?= $k['pname_name']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>ชื่อ - นามสกุล</label>
                                                                            <input type="text" class="form-control" name="fullname" value="<?php echo $row['fullname']; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>เลขบัตรประจำตัวประชาชน</label>
                                                                            <input type="text" class="form-control" name="cid" value="<?php echo $row['cid']; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>เบอร์โทรศัพท์</label>
                                                                            <input type="text" name="tel" value="<?php echo $row['tel']; ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>หน่วยงาน</label>
                                                                            <select class="custom-select" name="txtoffice" id="txtoffice">
                                                                                <option selected="selected" value="<?php echo $row['txtoffice'] ?>">กรุณาเลือก</option>
                                                                                <?php foreach ($office as $o) : ?>
                                                                                    <option value="<?= $o['txtoffice_name']; ?>"><?= $o['txtoffice_name']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>ตำแหน่ง</label>
                                                                            <input type="text" name="position" value="<?php echo $row['position']; ?>" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                                                                <button type="submit" class="btn btn-primary btn-block">แก้ไข</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="password_tab" class="tab-pane fade">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">แก้ไขรหัสผ่าน</h5>
                                            <div class="row">
                                                <div class="col-md-10 col-lg-6">
                                                    <form action="change-p.php" method="post">
                                                        <div class="form-group">
                                                            <label>รหัสผ่าน เก่า</label>
                                                            <input type="text" name="op" class="form-control" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>รหัสผ่าน ใหม่</label>
                                                            <input type="text" name="np" class="form-control" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>ยืนยัน รหัสผ่าน</label>
                                                            <input type="text" name="c_np" class="form-control" required>
                                                        </div>
                                                        <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                                                        <button class="btn btn-primary" type="submit">แก้ไข</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main content area end -->

        <?php include 'components/footer.php' ?>

    <?php } ?>