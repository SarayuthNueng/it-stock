<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit;
 ?>
<?php 
session_start();
        if(isset($_POST['username'])){
				//connection
                  include("db/connect-db.php");
				//รับค่า user & password
                  $username = $_POST['username'];
                  $password = md5($_POST['password']);
				//query 
                  $sql="SELECT * FROM users Where username='".$username."' AND password='".$password."' ";

                  $result = mysqli_query($conn,$sql);
				
                  if(mysqli_num_rows($result)==1){

                      $row = mysqli_fetch_array($result);

                      $_SESSION["user_id"] = $row["user_id"];
                      $_SESSION["username"] = $row["username"];
                      $_SESSION["pname"] = $row["pname"];
                      $_SESSION["fullname"] = $row["fullname"];
                      $_SESSION["ulevel"] = $row["ulevel"];

                      if($_SESSION["ulevel"]=="admin"){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php

                        Header("Location: home.php");

                      }

                      if ($_SESSION["ulevel"]=="member"){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php

                        Header("Location: home.php");

                      }

                  }else{
                    echo "<script>";
                        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                        // echo "window.history.back()";
                        echo "window.location='index.php'";
                    echo "</script>";

                  }

        }else{


             Header("Location: index.php"); //user & password incorrect back to login again

        }
