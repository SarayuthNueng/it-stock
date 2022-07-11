<?php session_start(); ?>
<?php
include "db/connect-db.php";

$o_id = $_GET['o_id'];

// query cart detail
$querycartdetail = "SELECT d.* , m.m_image, m.m_name, m.m_price, h.*
FROM order_detail as d 
INNER JOIN order_head as h ON d.o_id = h.o_id
INNER JOIN material as m ON d.m_id = m.m_id
WHERE d.o_id=$o_id";
$rscartdetail = mysqli_query($conn, $querycartdetail);
$rowdetail = mysqli_fetch_array($rscartdetail);
// echo '<pre>';
// print_r($rowdetail);
// echo '</pre>';
// exit;
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
                            <h4 class="page-title pull-left">รายละเอียดการเบิก</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="home.php">หน้าหลัก</a></li>
                                <li><span>รายละเอียดการเบิก</span></li>
                            </ul>
                        </div>
                    </div>
                    <?php include 'components/username.php' ?>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <button onclick="printDiv('divprint')" class="btn btn-primary" id="print-btn">Print</button>
                <div class="col-12 mt-5">
                    <div class="card">
                        <div id="divprint">
                            <div class="card-body">
                                <div class="row mb-3 mt-4">
                                    <div class="col-lg-12 text-center">
                                        <img src="assets/img_login/logo-sd.png" alt="" width="10%">
                                    </div>
                                </div>
                                <div class="row mb-5 text-center mt-4">
                                    <div class="col-lg-12">
                                        <h5><strong>ใบรายละเอียดรายการเบิก</strong></h5>
                                    </div>
                                </div>
                                <div class="form-row text-center mb-4">
                                    <div class="col-md-4 mb-3">
                                        <label>
                                            <h6 style="color: #000;"><strong>ชื่อ - นามสกุล :</strong>&nbsp;<?php echo $rowdetail['o_pname']; ?><?php echo $rowdetail['o_name']; ?></h6>
                                        </label>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>
                                            <h6 style="color: #000;"><strong>หน่วยงานที่นำไปใช้ :</strong>&nbsp;<?php echo $rowdetail['o_office']; ?></h6>
                                        </label>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>
                                            <h6 style="color: #000;"><strong>ตำแหน่ง :</strong>&nbsp;<?php echo $rowdetail['o_position']; ?></h6>
                                        </label>
                                    </div>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table table-stripped text-center" style="width:100%">

                                        <tr>
                                            <td bgcolor="#EAEAEA">ลำดับ</td>
                                            <td bgcolor="#EAEAEA">img</td>
                                            <td bgcolor="#EAEAEA">วัสดุ</td>
                                            <td bgcolor="#EAEAEA">ราคา</td>
                                            <td bgcolor="#EAEAEA">จำนวน</td>
                                            <td bgcolor="#EAEAEA">รวม(บาท)</td>
                                        </tr>
                                        <?php

                                        $total = 0;
                                        foreach ($rscartdetail as $row) {

                                            $total += $row["d_subtotal"]; //ราคารวมออเดอร์  
                                            echo "<tr>";
                                            echo "<td>" .  @$i += 1 . "</td>";
                                            echo "<td><img src='uploads/" . $row["m_image"] . " ' width='80'></td>";
                                            echo "<td>" . $row["m_name"] . "</td>";
                                            echo "<td>" . number_format($row["m_price"], 2) . "</td>";
                                            echo "<td>" . number_format($row["d_qty"]) . "</td>";
                                            echo "<td>" . number_format($row["d_subtotal"], 2) . "</td>";
                                        }
                                        echo "<tr>";
                                        echo "<td colspan='4' bgcolor='#EAEAEA'><b>ราคารวม</b></td>";
                                        echo "<td bgcolor='#EAEAEA'>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                                        echo "<td bgcolor='#EAEAEA'></td>";
                                        echo "</tr>";

                                        ?>

                                    </table>

                                </div>
                                <div class="row justify-content-end mb-5 mt-3">
                                    <div class="col-md-2">
                                        <a type="button" class="btn btn-primary btn-block" href="home.php">ตกลง</a>
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

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();

            document.body.innerHTML = originalContents;


        }
    </script>