<?php session_start(); ?>
<?php
include "db/connect-db.php";


$kname = $_POST['k_name'];
// เช็คข้อมูลซ้ำ
$check = "SELECT * FROM koffice WHERE k_name = '$kname' ";
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
            title: "มีชื่อหน่วยงานนี้แล้ว กรุณากรอกใหม่อีกครั้ง !",
            type: "warning",
            showConfirmButton: false,
            timer: 2000
            }, function() {
                window.location = "manage-office.php"; //หน้าที่ต้องการให้กระโดดไป
            });
        }, 1000);
    //     </script>';
} else {
    //ถ้าไม่มีก็บันทึกลงฐานข้อมูล
    $sql = "INSERT INTO koffice (k_name) VALUES ('$kname') ";
    $result2 = mysqli_query($conn, $sql) or die("Error in query: $sql" . mysqli_error($conn));

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
}

//ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);

?>