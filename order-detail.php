<?php
include 'db/connect-db.php';

$o_id = $_GET['o_id'];

// query cart detail
$querycartdetail = "SELECT d.* , p.p_pic, p.p_name, p.p_price, h.*
FROM order_detail as d 
INNER JOIN order_head as h ON d.o_id = h.o_id
INNER JOIN product as p ON d.p_id = p.p_id
WHERE d.o_id=$o_id";
$rscartdetail = mysqli_query($conn, $querycartdetail);
$rowdetail = mysqli_fetch_array($rscartdetail);
// echo '<pre>';
// print_r($rowdetail);
// echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดการเบิก</title>
</head>

<body>
    <h4 align="center">รายละเอียดการเบิก</h4>
    <h4 align="center">
        รหัสรายการเบิก : <?php echo $rowdetail['o_id']; ?><br>
        ผู้รับ : <?php echo $rowdetail['o_name']; ?><br>
        หน่วยงาน : <?php echo $rowdetail['o_office']; ?>, ตำแหน่ง : <?php echo $rowdetail['o_position']; ?><br>
        วันที่สั่งซื้อ : <?php echo $rowdetail['o_dttm']; ?><br>
    </h4>
    <table width="600" border="0" align="center" class="square">

        <tr>
            <td bgcolor="#EAEAEA">#</td>
            <td bgcolor="#EAEAEA">img</td>
            <td bgcolor="#EAEAEA">สินค้า</td>
            <td align="center" bgcolor="#EAEAEA">ราคา</td>
            <td align="center" bgcolor="#EAEAEA">จำนวน</td>
            <td align="center" bgcolor="#EAEAEA">รวม(บาท)</td>
        </tr>
        <?php

        $total = 0;
        foreach ($rscartdetail as $row) {

            $total += $row["d_subtotal"]; //ราคารวมออเดอร์  
            echo "<tr>";
            echo "<td width='20'>" .  @$i += 1 . "</td>";
            echo "<td><img src='assets/images/" . $row["p_pic"] . " ' width='80'></td>";
            echo "<td width='334'>" . $row["p_name"] . "</td>";
            echo "<td width='46' align='right'>" . number_format($row["p_price"], 2) . "</td>";
            echo "<td width='46' align='right'>" . number_format($row["d_qty"]) . "</td>";
            echo "<td width='93' align='right'>" . number_format($row["d_subtotal"], 2) . "</td>";
        }
        echo "<tr>";
        echo "<td colspan='5' bgcolor='#CEE7FF' align='center'><b>ราคารวม</b></td>";
        echo "<td align='right' bgcolor='#CEE7FF'>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
        echo "<td align='left' bgcolor='#CEE7FF'></td>";
        echo "</tr>";

        ?>
        <tr>

            <td colspan="6" align="right">
                <a type="button" class="btn btn-primary btn-block" href="home.php">ตกลง</a>
            </td>
        </tr>
    </table>

</body>

</html>