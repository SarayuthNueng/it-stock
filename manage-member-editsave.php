<?php 
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
?>
<?php session_start(); ?>
<?php
include "db/connect-db.php";

$user_id = $_POST['user_id'];
$username = $_POST['username'];
$cid = $_POST['cid'];
$pname = $_POST['pname'];
$fullname = $_POST['fullname'];
$tel = $_POST['tel'];
$txtoffice = $_POST['txtoffice'];
$position = $_POST['position'];
$status = $_POST['status'];

// print_r($sid);
// print_r($sname);

$sql = "UPDATE users SET username = '$username', cid = '$cid', pname = '$pname', fullname = '$fullname', tel = '$tel', txtoffice = '$txtoffice', position = '$position', status = '$status' WHERE user_id = '$user_id' ";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

echo '<script>
            setTimeout(function() {
            swal({
            title: "แก้ไขข้อมูลเรียบร้อย",
            type: "success",
            showConfirmButton: false,
            timer: 1500
            }, function() {
                window.location = "manage-member.php"; //หน้าที่ต้องการให้กระโดดไป
            });
        }, 1000);
        </script>';

//ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);

?>