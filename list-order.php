<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ระบบวัสดุคงคลังIT | โรงพยาบาลสมเด็จ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,300&subset=thai,latin' rel='stylesheet' type='text/css'>
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- sweetalert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<?php
include "db/connect-db.php";
$queryorder = "SELECT * FROM order_head";
// -- WHERE m_id=$m_id ให้แสดงเฉพาะของคนที่login

$rsorder = mysqli_query($conn, $queryorder);
// echo $queryorder;

?>

<body>
    <div class="container">
        <h3>history order</h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อผู้เบิกของ</th>
                    <th>date</th>
                    <th>total</th>
                    <th>ชื่อผู้อนุมัติ</th>
                    <th>view</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rsorder as $row) { ?>
                    <tr>
                        <td><?php echo $row['o_id']; ?></td>
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
                        <td><?php echo $row['o_dttm']; ?></td>
                        <td><?php echo number_format($row['o_total'], 2); ?></td>
                        <td>
                            <?php
                            echo '<b>';
                            echo $row['o_commitname'];
                            echo '</b>';
                            ?>
                        </td>
                        <td>
                            <?php 
                            $o_id = $row['o_id']; //order id
                            echo "<a href='view-order.php?o_id=$o_id&do=view-order' class='btn btn-info btn-xs'>เปิดดู</a>" ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>