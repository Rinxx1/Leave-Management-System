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


$getid = $_GET['getid'];


if(isset($_POST['btnsave'])){	

	$lt = "SELECT * FROM `tblleavetype` ORDER BY id ASC ";
	$res = mysqli_query($conn, $lt);
	while($row = mysqli_fetch_array($res)){

		$id = $row['id'];

		$lv = @$_POST['lc'.$id];


		$insert = "INSERT INTO `tblempcred` (`emp_id`, `leaveid`, `credits`, `status`) VALUES ('$getid', '$id', '$lv', '1')";
		if(mysqli_query($conn, $insert)){
			echo "<Script>alert('Success!');location.href = 'edit_staff.php?edit=".$getid."'</script>";
		}else{
			echo "Error";
		}

	}
}
else if(isset($_POST['btnupdate'])){
	$lt2 = "SELECT * FROM `tblleavetype` ORDER BY id ASC ";
	$res2 = mysqli_query($conn, $lt2);
	while($row = mysqli_fetch_array($res2)){

		$id2 = $row['id'];

		$lv2 = $_POST['lc'.$id2];

		$sql3 = "SELECT * FROM `tblempcred` WHERE leaveid = '$id2' AND emp_id = '$getid'";
    	$sql4 = mysqli_query($conn, $sql3);
    	$sql5 = mysqli_fetch_array($sql4);

    	$cds = $_POST['ec'.$sql5['empcredID']];


		$insert2 = "UPDATE tblempcred SET credits = '$lv2' WHERE empcredID = '$cds' ";
		if(mysqli_query($conn, $insert2)){
			echo "<Script>alert('Success!');location.href = 'staff.php?edit=".$getid."'</script>";
		}else{
			echo "Error";
		}

	}
}

 ?>