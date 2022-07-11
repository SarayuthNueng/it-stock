<?php 
include 'condb.php';
if(isset($_POST['id'])){
$id = $_POST['id'];	
		// prepare and bind
		$stmt = $conn->prepare("
			UPDATE  tbl_member  SET 
		name=?,
		email=?,
		phone=?
		WHERE id=$id
		");
		$stmt->bind_param("sss", $name, $email, $phone);
/*
The argument may be one of four types:
i - integer
d - double
s - string
b - BLOB
*/

		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$stmt->execute();
		if($stmt->error){
			echo $stmt->error;
		}else{
			echo "update successfully <a href='index.php'> home </a> ";
		}
		$stmt->close();
		$conn->close();
 }

?>