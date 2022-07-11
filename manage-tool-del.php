<?php session_start(); ?>
<?php
include "db/connect-db.php";

$sid = $_GET['del'];

$sql = "DELETE FROM material WHERE m_id = '$sid' ";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// header('location: manage-tool-type.php?m=1');

echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

echo '<script>
            setTimeout(function() {
            swal({
            title: "ลบข้อมูลเรียบร้อย",
            type: "success",
            showConfirmButton: false,
            timer: 1500
            }, function() {
                window.location = "manage-tool.php"; //หน้าที่ต้องการให้กระโดดไป
            });
        }, 1000);
        </script>';

// //ปิดการเชื่อมต่อกับฐานข้อมูล
// mysqli_close($conn);

?>