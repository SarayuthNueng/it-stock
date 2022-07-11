<?php session_start(); ?>

<?php
include('db/connect-db.php');

$sID = $_POST['m_id'];

//ตัวแปร
$m_name = $_POST['m_name'];
$m_price = $_POST['m_price'];
$m_s_id = $_POST['m_s_id'];
$m_number = $_POST['m_number'];
$m_date = $_POST['m_date'];
$m_time = $_POST['m_time'];
$m_detail = $_POST['m_detail'];


if (isset($_POST["submit"]) && !$_FILES['m_image']['error']) {
	$file = $_FILES['m_image']['tmp_name'];
	$sourceProperties = getimagesize($file);
	//ฟังก์ชั่นวันที่
	date_default_timezone_set('Asia/Bangkok');
	$date = date("Ymd");

	//ตัดขื่อเอาเฉพาะนามสกุล
	$typefile = strrchr($_FILES['m_image']['name'], ".");

	//สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
	if ($typefile == '.jpeg' || $typefile  == '.jpg' || $typefile  == '.png') {

		//ฟังก์ชั่นสุ่มตัวเลข
		$numrand = (mt_rand());
		$fileNewName = $date . $numrand . $typefile;
		// $path_copy = $path . $fileNewName;
		$path_link = "uploads/" . $fileNewName;

		$folderPath = "uploads/";
		$ext = "." . pathinfo($_FILES['m_image']['name'], PATHINFO_EXTENSION);
		$imageType = $sourceProperties[2];

		switch ($imageType) {

			case IMAGETYPE_PNG:
				$imageResourceId = imagecreatefrompng($file);
				$targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
				imagepng($targetLayer, $folderPath . $fileNewName);
				break;

			case IMAGETYPE_GIF:
				$imageResourceId = imagecreatefromgif($file);
				$targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
				imagegif($targetLayer, $folderPath . $fileNewName);
				break;

			case IMAGETYPE_JPEG:
				$imageResourceId = imagecreatefromjpeg($file);
				$targetLayer = imageResize($imageResourceId, $sourceProperties[0], $sourceProperties[1]);
				imagejpeg($targetLayer, $folderPath . $fileNewName);
				break;

			default:
				echo "Invalid Image type.";
				exit;
				break;
		}
	} // move_uploaded_file($file, $folderPath . $fileNewName . "_origin." . $ext);
} else {

	// header("location: manage-tool.php");
	echo '<script>
		setTimeout(function() {
		swal({
		title: "บันทึกข้อมูลเรียบร้อย",
		type: "success",
		showConfirmButton: false,
		timer: 5000
		}, function() {
			window.location = "manage-tool.php"; //หน้าที่ต้องการให้กระโดดไป
		});
	}, 5000);
	</script>';
}

function imageResize($imageResourceId, $width, $height)
{
	$targetWidth = $width < 1280 ? $width : 1280;
	$targetHeight = ($height / $width) * $targetWidth;
	$targetLayer = imagecreatetruecolor($targetWidth, $targetHeight);
	imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
	return $targetLayer;
}


/** show details */
function size_as_kb($size = 0)
{
	if ($size < 1048576) {
		$size_kb = round($size / 1024, 2);
		return "{$size_kb} KB";
	} else {
		$size_mb = round($size / 1048576, 2);
		return "{$size_mb} MB";
	}
}

function imgSize($img)
{
	$targetWidth = $img[0] < 1280 ? $img[0] : 1280;
	$targetHeight = ($img[1] / $img[0]) * $targetWidth;
	return [round($targetWidth, 2), round($targetHeight, 2)];
}

// เพิ่มไฟล์เข้าไปในตาราง uploadfile

if ($_FILES['m_image']['name'] == '') {
	$sql2 = "UPDATE material SET m_name='$m_name',m_price='$m_price', m_number='$m_number', m_date='$m_date', m_time='$m_time', m_detail='$m_detail', m_s_id='$m_s_id'
	WHERE m_id = '$sID' ";

	$result2 = mysqli_query($conn, $sql2) or die("Error in query: $sql2 " . mysqli_error($conn));

	echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
	if ($result2) {
		echo '<script>
		setTimeout(function() {
		swal({
		title: "บันทึกข้อมูลเรียบร้อย",
		type: "success",
		showConfirmButton: false,
		timer: 1500
		}, function() {
			window.location = "manage-tool.php"; //หน้าที่ต้องการให้กระโดดไป
		});
	}, 1000);
	</script>';
	}
	mysqli_close($conn);
} else {

	$sql1 = "SELECT * FROM material WHERE m_id = '$sID' ";
	$query = mysqli_query($conn, $sql1);
	$oo = mysqli_fetch_assoc($query);

	if ($oo['m_image'] != '') {
		unlink("uploads/" . $oo['m_image']);
	}

	$sql = "UPDATE material SET m_name='$m_name',m_price='$m_price', m_number='$m_number', m_date='$m_date', m_time='$m_time', m_detail='$m_detail',m_image='$fileNewName', m_s_id='$m_s_id'
	WHERE m_id = '$sID' ";

	$result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

	echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
	if ($result) {
		echo '<script>
		setTimeout(function() {
		swal({
		title: "บันทึกข้อมูลเรียบร้อย",
		type: "success",
		showConfirmButton: false,
		timer: 1500
		}, function() {
			window.location = "manage-tool.php"; //หน้าที่ต้องการให้กระโดดไป
		});
	}, 1000);
	</script>';
	}
	mysqli_close($conn);
}

?>
