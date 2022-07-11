<?php session_start(); ?>
<?php
include "db/connect-db.php";

$sql = "SELECT * FROM koffice";
$office = $conn->query($sql);

$sql = "SELECT * FROM pname";
$kumnum = $conn->query($sql);

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
                            <h4 class="page-title pull-left">ยืนยันการเบิก</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="home.php">หน้าหลัก</a></li>
                                <li><span>ยืนยันการเบิก</span></li>
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
                                    <h4 class="header-title">รายการเบิก</h4>
                                </div>
                            </div>

                            <form id="frmcart" name="frmcart" method="post" action="saveorder.php">
                                <div class="table-responsive">
                                    <table class="table table table-stripped text-center" style="width:100%">

                                        <tr>
                                            <td style="font-weight: bold;">วัสดุ</td>
                                            <td style="font-weight: bold;">ราคา</td>
                                            <td style="font-weight: bold;">จำนวน</td>
                                            <td style="font-weight: bold;">รวม/รายการ</td>
                                        </tr>
                                        <?php
                                        $total = 0;
                                        foreach ($_SESSION['cart'] as $m_id => $qty) {
                                            $sql    = "SELECT * FROM material WHERE m_id=$m_id";
                                            $query    = mysqli_query($conn, $sql);
                                            $row    = mysqli_fetch_array($query);
                                            $sum    = $row['m_price'] * $qty;
                                            $total    += $sum;
                                            echo "<tr>";
                                            echo "<td>" . $row["m_name"] . "</td>";
                                            echo "<td>" . number_format($row['m_price'], 2) . "</td>";
                                            echo "<td>$qty</td>";
                                            echo "<td>" . number_format($sum, 2) . "</td>";
                                            echo "</tr>";
                                        }
                                        echo "<tr>";
                                        echo "<td colspan='3'><b>รวม</b></td>";
                                        echo "<td " . "<b>" . number_format($total, 2) . "</b>" . "</td>";
                                        echo "</tr>";
                                        ?>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 class="header-title">รายละเอียดผู้เบิก</h4>
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
                                    <div class="col-lg-4">
                                        <label class="col-form-label">ชื่อ - นามสกุล</label>
                                        <input type="text" class="form-control" aria-label="Text input with dropdown button" id="name" name="name" placeholder="ชื่อ - นามสกุล" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="col-form-label">หน่วยงานที่่นำไปใช้</label>
                                            <select class="custom-select" name="office" id="office">
                                                <option selected="selected">กรุณาเลือก</option>
                                                <?php foreach ($office as $o) : ?>
                                                    <option value="<?= $o['k_name']; ?>"><?= $o['k_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="col-form-label">ตำแหน่ง</label>
                                        <input type="text" id="position" name="position" class="form-control" placeholder="ตำแหน่ง" required>
                                    </div>
                                </div>
                                
                                <div class="row justify-content-center mb-5 mt-3">
                                    <div class="col-md-2">
                                        <a href="home.php" type="button" class="btn btn-secondary btn-block"><i class="fa fa-times"></i> ย้อนกลับ</a>
                                    </div>
                                    <div class="col-md-2">
                                        <input class="btn btn-primary btn-block" type="submit" name="Submit2" value="ยืนยันการเบิก" />
                                    </div>
                                </div>
                                <input type="hidden" name="total" value="<?php echo $total; ?>">
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main content area end -->

        <?php include 'components/footer.php' ?>

    <?php } ?>