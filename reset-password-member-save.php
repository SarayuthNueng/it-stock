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
    
}
catch (PDOException $e) {   //หากเชื่อมต่อผิดพลาดให้แสดงข้อความเตือน
    echo "Failed to connect" . $e->getMessage();
}
?>

<?php
 //ถ้ามีค่าส่งมาจากฟอร์ม
if(isset($_POST['user_id']) && isset($_POST['password'])) {

//ประกาศตัวแปรรับค่าจากฟอร์ม
$user_id = $_POST['user_id'];
$password = md5($_POST['password']);

//sql update
$stmt = $db->prepare("UPDATE users SET password=:password WHERE user_id=:user_id");
$stmt->bindParam(':user_id', $user_id , PDO::PARAM_INT);
$stmt->bindParam(':password', $password , PDO::PARAM_STR);
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
                  title: "แก้ไขรหัสผ่านสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "manage-member.php"; //หน้าที่ต้องการให้กระโดดไป
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
                  window.location = "reset-password-member.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
$conn = null; //close connect db
} //isset
?>