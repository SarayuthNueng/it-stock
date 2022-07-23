<form action="" method="get" class="form-horizontal">
    <h3>เลือกช่วงวันที่ในการเรียกดูยอดขาย</h3>
    <div class="row form-group mt-4 mb-4">
        <div class="col-sm-1 control-label">
            Start
        </div>
        <div class="col-sm-3">
            <input type="date" name="ds" required class="form-control">
        </div>
        <div class="col-sm-1 control-label">
            End
        </div>
        <div class="col-sm-3">
            <input type="date" name="de" required class="form-control">
        </div>
        <div class="col-sm-1 mb-4">
            <button type="submit" name="act" value="daterange" class="btn btn-primary">ค้นหา</button>
        </div>
    </div>
</form>
<?php

$ds = $_GET['ds']; //date start
$de = $_GET['de']; //date end

$query =
    "SELECT SUM(o_total) AS total, 
    DATE_FORMAT(o_dttm, '%d-%M-%Y') AS o_dttm
    FROM order_head 
    WHERE o_dttm BETWEEN '$ds 0:0:0.000000' 
    AND '$de 23:59:59.000000'
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
<h3 align="center">รายงานแยกตามวันที่ ในแบบกราฟ</h3>
<p class="mt-4">
    วันที่เริ่มต้น : <?php echo date('d/m/y', strtotime($ds));?>
    ถึงวันที่ : <?php echo date('d/m/y', strtotime($de));?>
</p>

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
                    label: 'รายงานยอดรวม แยกตามวัน (บาท)',
                    data: [<?php echo $total; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)',
                        'rgba(153, 102, 255)',
                        'rgba(255, 159, 64)'
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
    <h3 class="text-center mb-4">รายการแยกตามวันทั้งหมด</h3>

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