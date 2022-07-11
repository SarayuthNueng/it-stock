<?php 
include 'db/connect-db.php';
// prepare and bind
$stmt = $connect->prepare("DELETE FROM users WHERE user_id=?");
$stmt->bind_param("i", $user_id);
/*
The argument may be one of four types:
i - integer
d - double
s - string
b - BLOB
*/
$user_id = $_GET['user_id'];
$stmt->execute();


if($stmt->error){
	echo $stmt->error;
}else{
	echo "del successfully <a href='index.php'> home </a> ";
}


$stmt->close();
$connect->close();

?>