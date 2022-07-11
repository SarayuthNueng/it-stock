<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
?>
<!-- connent db -->
<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "stock_it";

try {   //ทำการเชื่อมต่อ database
    $db = new PDO("mysql:host={$db_host}; dbname={$db_name}", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {   //หากเชื่อมต่อผิดพลาดให้แสดงข้อความเตือน
    echo "Failed to connect" . $e->getMessage();
}
?>
<?php
if (isset($_GET['user_id'])) {
    $stmt = $db->prepare("SELECT* FROM users WHERE user_id=?");
    $stmt->execute([$_GET['user_id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
    if ($stmt->rowCount() < 1) {
        header('Location: index.php');
        exit();
    }
} //isset
?>
<?php
 //ถ้ามีค่าส่งมาจากฟอร์ม
if(isset($_POST['user_id']) && isset($_POST['pname']) && isset($_POST['fullname']) && isset($_POST['cid']) && isset($_POST['tel']) && isset($_POST['txtoffice']) && isset($_POST['position'])) {
    
//ประกาศตัวแปรรับค่าจากฟอร์ม
$user_id = $_POST['user_id'];
$pname = $_POST['pname'];
$fullname = $_POST['fullname'];
$cid = $_POST['cid'];
$tel = $_POST['tel'];
$txtoffice = $_POST['txtoffice'];
$position = $_POST['position'];
//sql update
$stmt = $db->prepare("UPDATE users SET pname=:pname, fullname=:fullname, cid=:cid, tel=:tel, txtoffice=:txtoffice, position=:position WHERE user_id=:user_id");
$stmt->bindParam(':user_id', $user_id , PDO::PARAM_INT);
$stmt->bindParam(':pname', $pname , PDO::PARAM_STR);
$stmt->bindParam(':fullname', $fullname , PDO::PARAM_STR);
$stmt->bindParam(':cid', $cid , PDO::PARAM_STR);
$stmt->bindParam(':tel', $tel , PDO::PARAM_STR);
$stmt->bindParam(':txtoffice', $txtoffice , PDO::PARAM_STR);
$stmt->bindParam(':position', $position , PDO::PARAM_STR);
$stmt->execute();

// sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

 if($stmt->rowCount() > 0){
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "แก้ไขโปรไฟล์สำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "profile.php?user_id=' . $user_id . '"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }else{
       echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  type: "error"
              }, function() {
                  window.location = "profile.php?user_id=' . $user_id . '"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
$conn = null; //close connect db
} //isset
?>