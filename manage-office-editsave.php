<?php session_start(); ?>
<?php
include "db/connect-db.php";

$kid = $_POST['k_id'];
$kname = $_POST['k_name'];


$sql = "UPDATE koffice SET k_name = '$kname' WHERE k_id = '$kid' ";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

echo '<script>
            setTimeout(function() {
            swal({
            title: "บันทึกข้อมูลเรียบร้อย",
            type: "success",
            showConfirmButton: false,
            timer: 1500
            }, function() {
                window.location = "manage-office.php"; //หน้าที่ต้องการให้กระโดดไป
            });
        }, 1000);
        </script>';

//ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);

?>