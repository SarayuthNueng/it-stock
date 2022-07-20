<?php session_start(); ?>
<?php
include "db/connect-db.php";
$sql = "SELECT * FROM koffice";
$office = $conn->query($sql);



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
                            <h4 class="page-title pull-left">รายงานการเบิก - จ่าย แยกตามหน่วยงาน</h4>
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
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label">หน่วยงาน</label>
                                    <select class="custom-select" name="txtoffice" id="txtoffice">
                                        <option selected="selected">กรุณาเลือก</option>
                                        <?php foreach ($office as $o) : ?>
                                            <option value="<?= $o['k_name']; ?>"><?= $o['k_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <?php
                            $query =
                                "SELECT SUM(o_total) AS total, DATE_FORMAT(o_dttm, '%d-%M-%Y') AS o_dttm, o_office
                                FROM order_head WHERE o_office = '$o[kname]'
                                GROUP BY DATE_FORMAT(o_dttm, '%Y-%m-%d')
                                ORDER BY DATE_FORMAT(o_dttm, '%Y-%m-%d') DESC
                                ";
                            $result = mysqli_query($conn, $query);
                            $resultchart = mysqli_query($conn, $query);
                            //for chart
                            $o_dttm = array();
                            $total = array();
                            while ($rs = mysqli_fetch_array($resultchart)) {
                                $o_dttm[] = "\"" . $rs['o_dttm'] . "\"";
                                $total[] = "\"" . $rs['total'] . "\"";

                                // echo '<hr>';
                                // echo $rs['total'];
                            }
                            // ตัด , ออก
                            $o_dttm = implode(",", $o_dttm);
                            $total = implode(",", $total);

                            // echo $total;


                            ?>
                            <h3 align="center">รายงานแยกตามหน่วยงาน ในแบบกราฟ</h3>

                            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
                            <hr>
                            <p align="center">
                                <canvas id="myChart" width="800px" height="300px"></canvas>
                                <script>
                                    var ctx = document.getElementById("myChart").getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            // กำหนด วันที่
                                            labels: [<?php echo $o_dttm; ?>

                                            ],
                                            datasets: [{
                                                label: 'รายงานยอดรวม แยกตามหน่วยงาน (บาท)',
                                                data: [<?php echo $total; ?>],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(255,99,132,1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                </script>
                            </p>
                            <div class="col-sm-12 mt-5">
                                <h3 class="text-center mb-4">รายการแยกตามหน่วยงานทั้งหมด</h3>

                                <div class="data-tables ">
                                    <div class="table-responsive">
                                        <table id="dataTable" class=" table table table-stripped text-center table-success" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>วัน/เดือน/ปี</th>
                                                    <th>ยอดรวมแต่ละวัน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ototal = 0;
                                                while ($row2 = mysqli_fetch_array($result)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row2['o_dttm']; ?></td>
                                                        <td align="right"><?php echo number_format($row2['total'], 2); ?>&nbsp;บาท</td>
                                                    </tr>
                                                <?php $ototal += $row2['total'];
                                                } ?>
                                                <tr>
                                                    <td align="center"><b>รวมทั้งหมด(ทุกวัน)</b></td>
                                                    <td align="right"><b>
                                                            <?php echo number_format($ototal, 2); ?>&nbsp;บาท</b>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <?php mysqli_close($conn); ?>

                        </div>
                    </div>
                </div>
                <!-- Dark table end -->

            </div>
        </div>
        <!-- main content area end -->

        <?php include 'components/footer.php' ?>

    <?php } ?>