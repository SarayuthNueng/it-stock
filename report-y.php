<?php
$query =
    "SELECT SUM(o_total) AS total, 
    DATE_FORMAT(o_dttm, '%Y') AS o_dttm
    FROM order_head
    GROUP BY DATE_FORMAT(o_dttm, '%Y')
    ORDER BY DATE_FORMAT(o_dttm, '%Y') DESC
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
<h3 align="center">รายงานแยกตามปี ในแบบกราฟ</h3>

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
                    label: 'รายงานยอดรวม แยกตามปี (บาท)',
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
    <h3 class="text-center mb-3">รายการแยกตามปีทั้งหมด</h3>
    <div class="data-tables ">
        <div class="table-responsive">
            <table id="dataTable" class=" table table table-stripped text-center table-info" style="width:100%">
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