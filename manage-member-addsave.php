<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
?>
<?php session_start(); ?>
<?php
include "db/connect-db.php";

$username = $_POST['username'];
$password = md5($_POST['password']);
$pname = $_POST['pname'];
$fullname = $_POST['fullname'];
$cid = $_POST['cid'];
$tel = $_POST['tel'];
$txtoffice = $_POST['txtoffice'];
$position = $_POST['position'];


// เช็คข้อมูลซ้ำ
$check = "SELECT * FROM users WHERE username = '$username' AND cid = '$cid'";

$regis = mysqli_query($conn, $check) or die(mysqli_error($conn));
$num = mysqli_num_rows($regis);

echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
if ($num > 0) {
    echo '<script>
            setTimeout(function() {
            swal({
            title: "มีชื่อผู้ใช้นี้แล้ว กรุณาสมัครใหม่อีกครั้ง !",
            type: "warning",
            showConfirmButton: false,
            timer: 2000
            }, function() {
                window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
            });
        }, 1000);
        </script>';
} else {
    //ถ้าไม่มีก็บันทึกลงฐานข้อมูล
    $sql = "INSERT INTO users (username, password, pname, fullname, cid, tel, txtoffice, position, ulevel, status) VALUES ('$username', '$password', '$pname', '$fullname', '$cid', '$tel', '$txtoffice', '$position', 'member', 'รออนุมัติ') ";
    $regis2 = mysqli_query($conn, $sql) or die("Error in query: $sql" . mysqli_error($conn));

    echo '<script>
            setTimeout(function() {
            swal({
            title: "บันทึกข้อมูลเรียบร้อย กรุณารอการอนุมัติ",
            type: "success",
            showConfirmButton: false,
            timer: 1500
            }, function() {
                window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
            });
        }, 1000);
        </script>';
}

//ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);

?>