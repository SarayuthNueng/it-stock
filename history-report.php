<?php session_start(); ?>
<?php
include "db/connect-db.php";
$queryorder = "SELECT * FROM order_head";
// -- WHERE m_id=$m_id ให้แสดงเฉพาะของคนที่login

$rsorder = mysqli_query($conn, $queryorder);
// echo $queryorder;

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
                            <h4 class="page-title pull-left">ประวัติการเบิก</h4>
                        </div>
                    </div>
                    <?php include 'components/username.php' ?>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- Dark table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="data-tables datatable-dark">
                                <table id="dataTable3" class="table table table-stripped " style="width:100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th width='10px' >รหัส</th>
                                            <th>วันที่เบิก</th>
                                            <th>ชื่อผู้เบิกของ</th>
                                            <th>ชื่อผู้อนุมัติ</th>
                                            <th>ราคารวม(บาท)</th>
                                            <th>ดูรายละเอียด</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rsorder as $row) { ?>
                                            <tr>
                                                <td class="text-center"><?php echo $row['o_id']; ?></td>
                                                <td class="text-center"><?php echo $row['o_dttm']; ?></td>
                                                <td>
                                                    <?php
                                                    echo '<b>';
                                                    echo $row['o_pname'];
                                                    echo $row['o_name'];
                                                    echo '</b>';
                                                    echo '<br>';
                                                    echo '<b>' . 'หน่วยงาน' . '</b>' . '&nbsp;' .  $row['o_office'] . '<b>' . ' ตำแหน่ง ' . '</b>' . $row['o_position'];
                                                    ?>

                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    echo '<b>';
                                                    echo $row['o_commitname'];
                                                    echo '</b>';
                                                    ?>
                                                </td>
                                                <td class="text-center"><?php echo number_format($row['o_total'], 2); ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    $o_id = $row['o_id']; //order id
                                                    echo "<a href='view-order.php?o_id=$o_id&do=view-order' class='btn btn-info btn-xs'>เปิดดู</a>" ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dark table end -->

            </div>
        </div>
        <!-- main content area end -->

        <?php include 'components/footer.php' ?>

    <?php } ?>