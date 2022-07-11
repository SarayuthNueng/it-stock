<?php session_start(); ?>

<?php
include "db/connect-db.php";

$sql = "SELECT * FROM koffice";
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
                            <h4 class="page-title pull-left">จัดการหน่วยงาน</h4>
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
                                    <h4 class="header-title">จัดการหน่วยงานทั้งหมด</h4>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row justify-content-end">
                                        <div class="col-lg-2 ">
                                            <a href="manage-office-add.php" style="float: right;" class="mb-3 btn btn-primary"><i class="ti-plus mx-2"></i>เพิ่มหน่วยงาน</a>
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
                                                <th>ชื่อหน่วยงาน</th>
                                                <th>แก้ไข</th>
                                                <th>ลบ</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                <tr>
                                                    <td><?php echo $row['k_id'] ?></td>
                                                    <td><?php echo $row['k_name'] ?></td>
                                                    <td><a href="manage-office-edit.php?edit=<?php echo $row['k_id'] ?>"><i style="color: green;" class="ti-settings"></i></a></td>
                                                    <td><a href="manage-office-del.php?del=<?php echo $row['k_id'] ?>" class="btn-del"><i style="color: red;" class="ti-trash"></i></a></td>
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


    <script>
        $('.btn-del').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: 'ต้องการลบข้อมูลหรือไม่ !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ไม่'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
        })
        $('#btn').on('click', function() {

            Swal.fire({
                type: 'success',
                title: 'You Title!',
                text: 'Your Text'
            })
        })



    </script>