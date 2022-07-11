<?php session_start(); ?>
<?php
include "db/connect-db.php";

$sname = $_POST['s_name'];
// เช็คข้อมูลซ้ำ
$check = "SELECT * FROM type_stock WHERE s_name = '$sname' ";
$result = mysqli_query($conn, $check) or die(mysqli_error($conn));
$num = mysqli_num_rows($result);
echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
if ($num > 0) {
    echo '<script>
            setTimeout(function() {
            swal({
            title: "มีชื่อวัสดุอุปกรณ์นี้แล้ว กรุณาสมัครใหม่อีกครั้ง !",
            type: "warning",
            showConfirmButton: false,
            timer: 2000
            }, function() {
                window.location = "manage-tool-type.php"; //หน้าที่ต้องการให้กระโดดไป
            });
        }, 1000);
        </script>';
    //ถ้ามี ข้อมูล นี้อยู่ในระบบแล้วให้แจ้งเตือน
    // echo "<script>";
    // echo "alert(' มีชื่อวัสดุอุปกรณ์นี้แล้ว กรุณาสมัครใหม่อีกครั้ง !');";
    // echo "window.location='manage-tool-type-add.php';";
    // echo "</script>";
} else {
    //ถ้าไม่มีก็บันทึกลงฐานข้อมูล
    $sql = "INSERT INTO type_stock (s_name) VALUES ('$sname') ";
    $result2 = mysqli_query($conn, $sql) or die("Error in query: $sql" . mysqli_error($conn));

    echo '<script>
            setTimeout(function() {
            swal({
            title: "บันทึกข้อมูลเรียบร้อย",
            type: "success",
            showConfirmButton: false,
            timer: 1500
            }, function() {
                window.location = "manage-tool-type.php"; //หน้าที่ต้องการให้กระโดดไป
            });
        }, 1000);
        </script>';
}

//ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);

?>