
<?php 
	if(isset($_GET['id']));
	$id = $_GET['id'];

	include 'config.php';
	$sql = "DELETE FROM tblleaves WHERE id = '$id';";
	if(mysqli_query($con,$sql)){
		header("location:leaves.php");
	}

 ?>