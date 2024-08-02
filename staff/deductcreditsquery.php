<?php 
	
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_NAME','leave_staff');

	$conn = mysqli_connect('localhost','root','','leave_staff') or die(mysqli_error());

	// Establish database connection.
	try
	{
	$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
	}
	catch (PDOException $e)
	{
	exit("Error: " . $e->getMessage());
	}


	date_default_timezone_set('Asia/Manila');

	
	$leave_type = $_POST['leave_type'];
	$date_to = $_POST['date_to'];
	$files = @$_POST['files'];
	$date_to2 = strtotime($_POST['date_to']);
	$date_from = $_POST['date_from'];
	$date_from2 = strtotime($_POST['date_from']);
	$description = $_POST['description'];
	$postingdate = date('Y-m-d');
	$empid = $_GET['empid'];
	$day_type = $_POST['day_type'];

	// $Status = $_GET['Status'];
	
	$num_days = "";

	

	if (is_uploaded_file($_FILES['files']['tmp_name'])) {

	$images = $_FILES['files'];
	$types = $images['type'];
	$filename = $images['name'];
	$imgData = addslashes(file_get_contents($_FILES['files']['tmp_name']));
    $imageProperties = getimageSize($_FILES['files']['tmp_name']);


	if ($day_type == "2" ) {
	  $num_days = 0.5;
	  # code...
	}else{
	   	$num_days = abs($date_to2-$date_from2)/86400;
	}


	$sql = "INSERT INTO `tblleaves` 
	(`LeaveType`, `ToDate`, `FromDate`, `Description`, `PostingDate`, `AdminRemark`, `registra_remarks`, `AdminRemarkDate`, `Status`, `admin_status`, `IsRead`, `empid`, `num_days`, `filename`, `imageType`, `files`) VALUES('$leave_type', '$date_to', '$date_from', '$description', '$postingdate', ' ', ' ', '0', '0', '0', '0', '$empid', '$num_days', '$filename', '$types', '$imgData');";

	$sql2 = "SELECT * FROM tblempcred WHERE leaveid = '$leave_type' AND emp_id = '$empid' ";
	$res2 = mysqli_query($conn, $sql2);
	$rowget = mysqli_fetch_array($res2);

	$currentcred = $rowget['credits'];

	$finalcred = "";

	// echo $currentcred;

	if(mysqli_query($conn, $sql)){
		echo "<script>alert('Your leave request is pending, wait for your approval');location.href = 'apply_leave.php'</script>";
	}


	}else{

	if ($day_type == "2" ) {
	  $num_days = 0.5;
	  # code...
	}else{
	   	$num_days = abs($date_to2-$date_from2)/86400;
	}


	$sql = "INSERT INTO `tblleaves` 
	(`LeaveType`, `ToDate`, `FromDate`, `Description`, `PostingDate`, `AdminRemark`, `registra_remarks`, `AdminRemarkDate`, `Status`, `admin_status`, `IsRead`, `empid`, `num_days`, `filename`, `imageType`, `files`) VALUES('$leave_type', '$date_to', '$date_from', '$description', '$postingdate', ' ', ' ', '0', '0', '0', '0', '$empid', '$num_days', '', '', '');";

	$sql2 = "SELECT * FROM tblempcred WHERE leaveid = '$leave_type' AND emp_id = '$empid' ";
	$res2 = mysqli_query($conn, $sql2);
	$rowget = mysqli_fetch_array($res2);

	$currentcred = $rowget['credits'];

	$finalcred = "";

	// echo $currentcred;

	if(mysqli_query($conn, $sql)){
		echo "<script>alert('Your leave request is pending, wait for your approval');location.href = 'apply_leave.php'</script>";
	}
	}

	// if($day_type == "2"){
	// 	$finalcred = $currentcred - 0.5;
	// }else{
	// 	$finalcred = $currentcred - $num_days;
	// }

	// if($currentcred < $num_days){
	// 	echo "<script>alert('Credits is not enough');location.href = 'apply_leave.php'</script>";
	// 	echo "Error";
	// }
	// else{

	// 	$sql22 = "UPDATE tblempcred SET credits = '$finalcred' WHERE emp_id = '$empid' AND leaveid = '$leave_type' ";

		// if($res22 = mysqli_query($conn, $sql22)){
			
			
		// }
		

	// }

	
 ?>