<?php session_start(); ?>

<?php
require_once 'db/connect-db.php';


$sql = "SELECT m.*,s.s_name 
FROM material m
LEFT JOIN type_stock s on s.s_id = m.m_s_id";
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
                            <h4 class="page-title pull-left">จัดการวัสดุ</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="home.php">หน้าหลัก</a></li>
                                <li><span>จัดการวัสดุ</span></li>
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
                                    <h4 class="header-title">จัดการวัสดุคงคลังทั้งหมด</h4>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row justify-content-end">
                                        <div class="col-lg-2 ">
                                            <a type="button" href="manage-tool-add.php" style="float: right;" class="mb-3 btn btn-primary"><i class="ti-plus mx-2"></i>เพิ่มวัสดุ</a>
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
                                                <th width="10%">รูปภาพ</th>
                                                <th>ชื่อวัสดุ</th>
                                                <th>รายละเอียด</th>
                                                <th>ราคาต่อหน่วย</th>
                                                <th>ประเภทวัสดุ</th>
                                                <th>จำนวนที่รับเข้า</th>
                                                <th>วันที่รับเข้า</th>
                                                <th>เวลาที่รับเข้า</th>
                                                <th>แก้ไข</th>
                                                <th>ลบ</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                <tr>
                                                    <td><?php echo $row['m_id'] ?></td>

                                                    <?php if ($row['m_image'] != '') { ?>
                                                        <td><img src="uploads/<?php echo $row['m_image'] ?>" alt="" ></td>
                                                    <?php } else { ?>
                                                        <td><img src="uploads/NoImage.png" alt="" ></td>
                                                    <?php  } ?>

                                                    <td><?php echo $row['m_name'] ?></td>
                                                    <td><?php echo $row['m_detail'] ?></td>
                                                    <td><?php echo $row['m_price'] ?></td>
                                                    <td><?php echo $row['s_name'] ?></td>
                                                    <td><?php echo $row['m_number'] ?></td>
                                                    <td><?php echo $row['m_date'] ?></td>
                                                    <td><?php echo $row['m_time'] ?></td>
                                                    <td><a href="manage-tool-edit.php?edit=<?php echo $row['m_id'] ?>"><i style="color: green;" class="ti-settings"></i></a></td>
                                                    <td><a href="manage-tool-del.php?del=<?php echo $row['m_id'] ?>" class="btn-del"><i style="color: red;" class="ti-trash"></i></a></td>
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