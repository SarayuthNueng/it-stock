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
                            <h4 class="page-title pull-left">จัดการประเภทวัสดุ</h4>
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
                                    <h4 class="header-title">จัดการประเภทวัสดุคงคลังทั้งหมด</h4>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row justify-content-end">
                                        <div class="col-lg-2 ">
                                            <a href="manage-tool-type-add.php" style="float: right;" class="mb-3 btn btn-primary"><i class="ti-plus mx-2"></i>เพิ่มประเภทวัสดุ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="data-tables ">
                                <div class="table-responsive">
                                    <table id="dataTable" class=" table table table-stripped text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width='20%'>รหัส</th>
                                                <th width='60px'>ชื่อประเภทวัสดุ</th>
                                                <th width='10%'>แก้ไข</th>
                                                <th width='10%'>ลบ</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                <tr>
                                                    <td><?php echo $row['s_id'] ?></td>
                                                    <td align="left"><?php echo $row['s_name'] ?></td>
                                                    <td><a href="manage-tool-type-edit.php?s_id=<?php echo $row['s_id'] ?>"><i style="color: green;" class="ti-settings"></i></a></td>
                                                    <td><a href="manage-tool-type-del.php?del=<?php echo $row['s_id'] ?>" class="btn-del"><i style="color: red;" class="ti-trash"></i></a></td>
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