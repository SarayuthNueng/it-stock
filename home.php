<?php
//connect db
include("db/connect-db.php");
?>
<?php session_start(); ?>


<?php

if (!$_SESSION["user_id"]) {  //check session

    Header("Location: index.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 

} else { ?>

    <?php if ($_SESSION["ulevel"] == "member") {
        Header("Location: dashboard_admin.php");
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
                                <h4 class="page-title pull-left">รายการเบิก</h4>
                            </div>
                        </div>
                        <?php include 'components/username.php' ?>
                    </div>
                </div>

                <!-- cart -->
                <?php
                if (isset($_GET['m_id']) && ($_GET['act'])) {
                    $m_id = mysqli_real_escape_string($conn, $_GET['m_id']);
                    $act = mysqli_real_escape_string($conn, $_GET['act']);

                    // add to cart
                    if ($act == 'add' && !empty($m_id)) {
                        if (isset($_SESSION['cart'][$m_id])) {
                            $_SESSION['cart'][$m_id]++;
                        } else {
                            $_SESSION['cart'][$m_id] = 1;
                        }
                    }
                    // add to cart

                    // remove product
                    if ($act == 'remove' && !empty($m_id))  //ยกเลิกการสั่งซื้อ
                    {
                        unset($_SESSION['cart'][$m_id]);
                    }
                    // remove product

                    // update cart
                    if ($act == 'update') {
                        $amount_array = $_POST['amount'];
                        foreach ($amount_array as $m_id => $amount) {
                            $_SESSION['cart'][$m_id] = $amount;
                        }
                    }
                    // update cart

                    // cancel cart
                    if ($act == 'cancel') {
                        unset($_SESSION['cart']);
                    }
                    // cancel cart
                }
                ?>

                <!-- page title area end -->
                <div class="main-content-inner">
                    <form id="frmcart" name="frmcart" method="post" action="?act=update&m_id=0">
                        <div id="shopping-cart">
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h4 class="header-title">รายการที่ต้องการเบิก</h4>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table table-stripped text-center" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ลำดับ</th>
                                                        <th width='10%'>รูปภาพ</th>
                                                        <th>วัสดุ</th>
                                                        <th>ราคาต่อหน่วย</th>
                                                        <th width='10%'>จำนวน</th>
                                                        <th>ราคารวม</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $total = 0;
                                                if (!empty($_SESSION['cart'])) {
                                                    foreach ($_SESSION['cart'] as $m_id => $qty) {
                                                        $sql = "SELECT * FROM material WHERE m_id=$m_id";
                                                        $query = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_array($query);
                                                        $sum = $row['m_price'] * $qty; //เอาราคา คูณ จำนวน
                                                        $total += $sum; //ราคารวม
                                                        $m_number = $row['m_number']; //จำนวนสินค้าในสต๊อก
                                                        echo "<tr>";
                                                        echo "<td>" .  @$i += 1 . "</td>";
                                                        if ($row["m_image"] != "") {
                                                            echo "<td><img src='uploads/" . $row["m_image"] . " ' ></td>";
                                                        } else {
                                                            echo "<td><img src='uploads/NoImage.png' ></td>";
                                                        }
                                                        echo "<td>"
                                                            . "<b>ชื่อวัสดุ : &nbsp;&nbsp;</b>"
                                                            . $row["m_name"]
                                                            . "<br>"
                                                            . "<b>จำนวนคงเหลือ : &nbsp;&nbsp;</b>"
                                                            . $row["m_number"]
                                                            . "</td>";
                                                        echo "<td>" . number_format($row["m_price"], 2) . "&nbsp;&nbsp;บาท</td>";
                                                        echo "<td>";
                                                        echo "<input class='form-control text-center' type='number' name='amount[$m_id]' value='$qty' size='2'min='1' max='$m_number'/></td>";
                                                        echo "<td>" . number_format($sum, 2) . "&nbsp;&nbsp;บาท</td>";
                                                        //remove product
                                                        echo "<td><a class='btn btn-danger' href='home.php?m_id=$m_id&act=remove'>ลบ</td>";
                                                        echo "</tr>";
                                                    }
                                                    echo "<tr>";
                                                    echo "<td colspan='5'><b>ราคารวมทั้งหมด</b></td>";
                                                    echo "<td>" . "<b>" . number_format($total, 2) . "</b>&nbsp;&nbsp;บาท" . "</td>";
                                                    echo "<td></td>";
                                                    echo "</tr>";
                                                }
                                                if ($total > 0) {
                                                ?>
                                                    <tr>

                                                        <td colspan="7">
                                                            <input type="button" class="btn btn-danger" name="btncancel" value="ยกเลิก" onclick="window.location='home.php?act=cancel&m_id=0';" />
                                                            <input type="submit" class="btn btn-warning" name="button" id="button" value="ยืนยันการเบิก" />

                                                            <?php if (isset($_GET['m_id']) && ($_GET['act'])) { ?>
                                                                <?php if ($act == 'update') {
                                                                ?>
                                                                    <input type="button" class="btn btn-success" name="Submit2" value="เบิกวัสดุ" onclick="window.location='confirmorder.php';" />
                                                                <?php  }
                                                                ?>
                                                            <?php } ?>

                                                        </td>
                                                    </tr>
                                                <?php } else { ?>
                                                    <tr>
                                                        <td colspan="6">
                                                            <h6 class="text-center">-- ไม่มีรายการเบิก --</h6>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    <!-- list tool -->
                    <?php
                    //เรียกข้อมูลมาแสดงทั้งหมด

                    $sql = "SELECT m.*,s.s_name 
                        FROM material m
                        LEFT JOIN type_stock s on s.s_id = m.m_s_id
                        ORDER BY m_id DESC";
                    $result = mysqli_query($conn, $sql);
                    ?>

                    <div class="card-area">
                        <div class="row">
                            <?php while ($row = mysqli_fetch_array($result)) { ?>
                                <div class="col-lg-2 col-md-4 mt-5">
                                    <div class="card card-bordered">
                                        <?php if ($row['m_image'] != '') { ?>
                                            <img class="card-img-top img-fluid" src="uploads/<?php echo $row["m_image"]; ?>" alt="image">
                                        <?php } else { ?>
                                            <img class="card-img-top img-fluid" src="uploads/NoImage.png" alt="image">
                                        <?php } ?>
                                        <div class="card-body">
                                            <h6><b>ชื่อ</b> : <?php echo  $row["m_name"]; ?></h6>
                                            <h6><b>ราคา</b> : <?php echo  $row["m_price"]; ?></h6>
                                            <h6><b>จำนวน</b> : <?php echo  $row["m_number"]; ?></h6>
                                            <h6><b>ประเภทวัสดุ</b> : <?php echo  $row["s_name"]; ?></h6>
                                            <p><b>รายละเอียด</b> : <?php echo  $row["m_detail"]; ?></p>
                                            <div class="row justify-content-center">
                                                <?php if ($row["m_number"] > 0) { ?>
                                                    <a href="home.php?m_id=<?php echo $row["m_id"]; ?>&act=add" class="text-center mt-3 btn btn-primary">
                                                        <h6>เบิกวัสดุ</h6>
                                                    </a>
                                                <?php } else { ?>
                                                    <button class="mt-3 btn btn-secondary" disabled>
                                                        <h6>วัสดุหมด</h6>
                                                    </button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>
            <!-- main content area end -->
            <?php include 'components/footer.php' ?>


        <?php } ?>

    <?php } ?>