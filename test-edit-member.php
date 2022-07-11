<?php
include 'db/connect-db.php';
if(isset($_GET['user_id'])){
$user_id = $_GET['user_id'];
$sql = "SELECT * FROM users WHERE user_id=$user_id";
$result = $connect->query($sql);
$row = mysqli_fetch_array($result);
$num = $result->num_rows;
//echo $num;
//print_r($row);
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<div class="container">
	<div class="row">
		<div  class="col-sm-5">
			<br>
			<h3>Form Update Data</h3>
			<form action="saveedit.php" method="post">
				<div class="form-group">
				id : <input type="number" name="user_id" readonly value="<?php echo $row['user_id'];?>" class="form-control">
				</div>
				<div class="form-group">
				name : <input type="text" name="username" required value="<?php echo $row['username'];?>" class="form-control" placeholder="name"> 
				</div>
				<div class="form-group">
				email : <input type="email" name="ulevel" required value="<?php echo $row['ulevel'];?>" class="form-control" placeholder="email">
			</div>
				<div class="form-group">
				phone : <input type="tel" name="tel" required value="<?php echo $row['tel'];?>" class="form-control" placeholder="phone">
				</div>
				<div class="form-group">
				<button type="submit" class="btn btn-success">save</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php }else{  echo 'Error!';  } ?>