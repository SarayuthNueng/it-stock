<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
?>
<?php
session_start();

if (isset($_SESSION['user_id'])) {

    include "db/connect-db.php"; //ต่อกับ database

    // เชคค่าที่ส่งมา
    if (
        isset($_POST['op']) && isset($_POST['np'])
        && isset($_POST['c_np'])
    ) {

        // validation เชคค่าว่าถูกไหม
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $op = validate($_POST['op']);
        $np = validate($_POST['np']);
        $c_np = validate($_POST['c_np']);

        // เรียก $_SESSION user_id เพื่อทำ check
        $user_id = $_SESSION['user_id'];



        // sweet alert 
        echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

        // เข้าสู่เงื่อนไข
        if (empty($op)) {
            echo '<script>
                setTimeout(function() {
                swal({
                    title: "รหัสผ่านเก่าไม่ถูกต้อง",
                    type: "error"
                }, function() {
                    window.location = "profile.php?user_id=' . $user_id . '"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';
        } else if (empty($np)) {
            echo '<script>
                setTimeout(function() {
                swal({
                    title: "กรุณาใส่รหัสผ่านใหม่",
                    type: "error"
                }, function() {
                    window.location = "profile.php?user_id=' . $user_id . '"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';
        } else if ($np !== $c_np) {
            echo '<script>
                setTimeout(function() {
                swal({
                    title: "รหัสผ่านใหม่ไม่ตรงกัน",
                    type: "error"
                }, function() {
                    window.location = "profile.php?user_id=' . $user_id . '"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';
            exit();
        } else {
            // hashing the password | ตรวจสอบค่า op,np
            $op = md5($op);
            $np = md5($np);
            

            // ทำการเลือกค่า ใน database แล้วเชค op ในdatabase
            $sql = "SELECT password
					FROM users WHERE 
					user_id='$user_id' AND password='$op'";
            $result = mysqli_query($conn, $sql);

            //  ถ้ามีค่า = 1 ค่า ให้ทำการ update ค่า np ลงไป
            if (mysqli_num_rows($result) === 1) {

                $sql_2 = "UPDATE users
						SET password='$np'
						WHERE user_id='$user_id'";
                mysqli_query($conn, $sql_2);

                echo '<script>
                setTimeout(function() {
                swal({
                    title: "แก้ไขรหัสผ่านสำเร็จ",
                    type: "success"
                }, function() {
                    window.location = "profile.php?user_id=' . $user_id . '"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';


                exit();
            } else {
                echo '<script>
                setTimeout(function() {
                swal({
                    title: "รหัสผ่านไม่ถูกต้อง",
                    type: "error"
                }, function() {
                    window.location = "profile.php?user_id=' . $user_id . '"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';
            }
        }
    } else {
        header("Location: profile.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
