<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	</head>
	<body>
		<div class="container" style="margin-top: 50px;">
			<?php
				include 'db/connect-db.php';
				$sql = "SELECT * FROM users";
				$result = $connect->query($sql);
				echo '<h3> Basic CRUD PHP OOP 
				<a href="formadd.php" class="btn btn-primary"> + data </a>
				</h3>';
				echo '
				<table class="table table-hover">
					<thead>
							<tr class="table-primary">
								<th>id</th>
								<th>name</th>
								<th>ulevel</th>
								<th>phone</th>
								<th>edit</th>
								<th>del</th>
						</tr>
				</thead>
				';
				echo '<tbody>';
					foreach ($result as $k) {
						echo '<tr>';
							echo "<td>".$k['user_id']."</td>";
							echo "<td>".$k['username']."</td>";
							echo "<td>".$k['ulevel']."</td>";
							echo "<td>".$k['tel']."</td>";
							echo "<td>"
								."<a href='test-edit-member.php?user_id=".$k['user_id']."' class='btn btn-warning btn-sm'>"
								."edit</a></td>";
								echo "<td>"
									."<a href='del-member.php?user_id=".$k['user_id']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Do you want to delete this record? !!!')\">"
									."del</a></td>";
								echo '</tr>';
							}
						echo '</tbody>';
					?>
					
				</div>
			</body>
		</html>