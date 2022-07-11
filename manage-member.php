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
                            <h4 class="page-title pull-left">จัดการบุคคลากร</h4>
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
                                    <h4 class="header-title">บุคคลากรทั้งหมด</h4>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row justify-content-end">
                                        <div class="col-lg-2 ">
                                            <a type="button" href="add-member.php" style="float: right;" class="mb-3 btn btn-primary"><i class="ti-plus mx-2"></i>เพิ่มบุคคลากร</a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="data-tables ">
                                <div class="table-responsive">
                                    <table id="dataTable" class=" table table table-stripped text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>รหัส</th>
                                                <th>ชื่อผู้ใช้</th>
                                                <th>รหัสผ่าน</th>
                                                <th>ชื่อ-นามสกุล</th>
                                                <th>เลขบัตรประชาชน</th>
                                                <th>เบอร์โทรศัพท์</th>
                                                <th>หน่วยงาน</th>
                                                <th>ตำแหน่ง</th>
                                                <th>ระดับผู้ใช้งาน</th>
                                                <th>สถานะ</th>
                                                <th>แก้ไข</th>
                                                <th>ลบ</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //คิวรี่ข้อมูลมาแสดงในตาราง
                                            require_once 'db/connect-db.php';
                                            $sql = "SELECT * FROM users";
                                            $result = $conn->query($sql);
                                            foreach ($result as $u) {
                                            ?>
                                                <tr>
                                                    <td><?= $u['user_id']; ?></td>
                                                    <td><?= $u['username']; ?></td>
                                                    <td><a type="button" style="color: steelblue; font-weight: bold;" href="reset-password-member.php?user_id=<?= $u['user_id']; ?>">
                                                        แก้ไขรหัสผ่าน
                                                    </a></td>
                                                    <td><?= $u['pname']; ?> <?= $u['fullname']; ?></td>
                                                    <td><?= $u['cid']; ?></td>
                                                    <td><?= $u['tel']; ?></td>
                                                    <td><?= $u['txtoffice']; ?></td>
                                                    <td><?= $u['position']; ?></td>
                                                    <td><?= $u['ulevel']; ?></td>
                                                    <td><?= $u['status']; ?></td>
                                                    <td><a href="manage-member-edit.php?user_id=<?php echo $u['user_id'] ?>"><i style="color: green;" class="ti-settings"></i></a></td>
                                                    <td><a href="manage-member-del.php?del_mem=<?php echo $u['user_id'] ?>" class="btn-del"><i style="color: red;" class="ti-trash"></i></a></td>
                                                </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>
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