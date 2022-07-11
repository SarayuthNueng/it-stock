<?php
session_start();
include("db/connect-db.php");
// set the default timezone to use.
date_default_timezone_set('Asia/Bangkok');
?>
<meta charset=utf-8>

<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

// echo '<hr>';

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;

$name = $_POST["name"];
$office = $_POST["office"];
$pname = $_POST["pname"];
$position = $_POST["position"];
$o_commitname = $_POST["o_commitname"];
// $total_qty = $_POST["total_qty"];
$total = $_POST["total"];
$dttm = Date("Y-m-d G:i:s");
//บันทึกการสั่งซื้อลงใน order_detail
mysqli_query($conn, "BEGIN");
$sql1    = "INSERT INTO order_head VALUES(null, '$dttm', '$name', '$office', '$pname', '$position', '$o_commitname', '$total')";
$query1    = mysqli_query($conn, $sql1);
// echo $sql1;
// exit;
//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
$sql2 = "SELECT max(o_id) AS o_id FROM order_head WHERE o_name='$name' AND o_office='$office' AND o_dttm='$dttm' ";
$query2    = mysqli_query($conn, $sql2);
$row = mysqli_fetch_array($query2);
$o_id = $row["o_id"]; // order id ล่าสุดที่อยู่ใน order_head

// echo '<br>';
// echo $sql2;
// echo '<br>';
// echo $o_id;
// echo '<br>';
// exit;
//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
foreach ($_SESSION['cart'] as $m_id => $qty) {
    $sql3    = "SELECT * FROM material WHERE m_id=$m_id";
    $query3    = mysqli_query($conn, $sql3);
    $row3    = mysqli_fetch_array($query3);
    $pricetotal    = $row3['m_price'] * $qty;
    $count = mysqli_num_rows($query3);

    $sql4    = "INSERT INTO order_detail VALUES(null, $o_id, $m_id, $qty, $pricetotal)";
    $query4    = mysqli_query($conn, $sql4);

    // echo '<pre>';
    // echo $sql4;
    // echo '</pre>';

    //ตัดสต๊อก
    for ($i = 0; $i < $count; $i++) {
        $instock =  $row3['m_number']; //จำนวนสินค้าที่มีอยู่
 
        $updatestock = $instock - $qty; //คำนวณสต๊อกที่มียุลบกับที่ซื้อไป

        $sql5 = "UPDATE material SET  
            m_number=$updatestock
            WHERE  m_id=$m_id ";
        $query5 = mysqli_query($conn, $sql5);
    }

    
}
// exit; 
echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

if ($query1 && $query4) {
    mysqli_query($conn, "COMMIT");
    echo '<script>
    setTimeout(function() {
    swal({
    title: "ทำรายการเบิกเรียบร้อยแล้ว",
    type: "success",
    showConfirmButton: false,
    timer: 2000
    }, function() {
        window.location = "order-view.php?o_id='. $o_id . '"; //หน้าที่ต้องการให้กระโดดไป
    });
}, 1000);
</script>';
    foreach ($_SESSION['cart'] as $m_id) {
        //unset($_SESSION['cart'][$m_id]);
        unset($_SESSION['cart']);
    }
} else {
    mysqli_query($conn, "ROLLBACK");
    echo '<script>
    setTimeout(function() {
    swal({
    title: "ทำรายการเบิกไม่สำเร็จ",
    type: "warning",
    showConfirmButton: false,
    timer: 2000
    }, function() {
        window.location = "confirmorder.php?o_id='. $o_id . '"; //หน้าที่ต้องการให้กระโดดไป
    });
}, 1000);
</script>';
}
?>
<!-- <script type="text/javascript">
    alert("<?php // echo $msg; ?>");
    window.location = 'order-view.php?o_id=<?php // echo $o_id; ?>';
</script> -->






</body>

</html>